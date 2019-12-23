<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/03/14
 * Time: 20:45
 */

namespace app\controllers;

use app\controllers\BaseController;
use app\models\Accountcate;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use app\models\Freevip;
use app\models\Accountconfig;
use app\models\AccountBaseConfig;
use app\models\FreevipCate;
use app\models\Freeaccounts;

class FreevipController extends BaseController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * actionGetVipType     获取会员种类 包括全部和已选择的
     * 2019/03/17 16:02
     * 15899
     */
    public function actionGetVipType()
    {
        $this->response();
        // 获取所有分类
        $allCates = ArrayHelper::toArray(Accountcate::findAll(['status' => 1]));
        $allCates = Accountcate::toTree($allCates);

        //获取已添加大分类
        $freevip = new Freevip();
        $freevip::$table = "{{%freevip_cate}}";
        $addedCase_tmp = ArrayHelper::toArray($freevip::find()->all());

        $AddedCates = []; //已添加的分类

        foreach ($allCates as $k => $v) {
            foreach ($addedCase_tmp as $k1 => $v1) {
                if ($v['id'] == $v1['cateId']) {
                    $AddedCates[] = $v;
                    unset($allCates[$k]);
                }
            }
        }

        $unAddedCates = $allCates;


        //1-1、获取已添加的免费会员账号配置
        foreach ($AddedCates as $k => $v) {

            foreach ($v['children'] as $k1 => $v1) {

                //1-2、具体的平台配置获取
                $accountConfig = Accountconfig::find()->where(['cateId' => $v1['id']])->asArray()->one();
                $AddedCates[$k]['children'][$k1]['logo'] = $accountConfig['logo'];
                //1-2-1、获取该平台所有账号类型
                $accountType = json_decode($accountConfig['accountType'], true);
                $accountBaseType = AccountBaseConfig::find()->where(['id' => $accountType])->asArray()->all();

                //1-2-2、获取该平台所有VIP类型
                $vipType = json_decode($accountConfig['vipType'], true);

                //1-3、计算出不同账号类型下未配置的vip类型
                $freevip_connfig_main = new Freevip();
                $freevip_connfig_main::$table = "{{%freeconfig_main}}";

                //盛放配置的容器
                $config = [];

                foreach ($accountBaseType as $baseKey => $baseValue) {
                    $configedVipType = ArrayHelper::getColumn($freevip_connfig_main::find()->where(['cateId' => $v1['id'], 'accountType' => $baseValue['id']])->asArray()->all(), 'vipType');
                    $unConfigVipType = array_diff($vipType, $configedVipType);
                    //1-4、组装数据结构
                    $VipBaseType = AccountBaseConfig::findAll(['id' => $unConfigVipType]);
                    $config[] = ['accountType' => $baseValue, "config" => $VipBaseType];
                }
                $AddedCates[$k]['children'][$k1]['config'] = $config;
            }
        }

        return ['unAddedCates' => $unAddedCates, 'addedCase' => $AddedCates];
    }

    /**
     * actionAddFreevipType         添加免费会员种类
     * 2019/03/17 16:37
     * 15899
     */
    public function actionAddFreevipCate()
    {
        $this->response();
        $freeVipCate = new Freevip();
        $freeVipCate::$table = "{{%freevip_cate}}";
        $cateId = is_numeric(\Yii::$app->request->post('cateId')) ? \Yii::$app->request->post('cateId') : die(json_encode(['code' => 0, 'msg' => '数据不合法']));
        $cate_name = \Yii::$app->request->post('cate_name');

        $freeVipCate->cateId = $cateId;
        $freeVipCate->cate_name = $cate_name;
        if ($freeVipCate->save()) {
            return ['code' => 1, 'msg' => '添加分类成功'];
        } else {
            return ['code' => 0, 'msg' => '添加分类失败'];
        }
    }

    /**
     * actionAddFreevipConfig           添加免费会员
     * 2019/03/17 21:43
     * 15899
     */
    public function actionAddFreevipConfig()
    {
        $this->response();
        $freevip = new Freevip();
        $freevip->parent_cate_id = \Yii::$app->request->post()['freeconfig_main']['parent_cate_id'];
        $freevip->parent_cate_name = \Yii::$app->request->post()['freeconfig_main']['parent_cate_name'];
        $freevip->cateId = \Yii::$app->request->post()['freeconfig_main']['cateId'];
        $freevip->vip_name = \Yii::$app->request->post()['freeconfig_main']['vip_name'];
        $freevip->vipType = \Yii::$app->request->post()['freeconfig_main']['vipType'];
        $freevip->accountType = \Yii::$app->request->post()['freeconfig_main']['accountType'];
        $freevip->logo = \Yii::$app->request->post()['freeconfig_main']['logo'];

        if ($freevip->save()) {

            //更新redis信息
            $timespace = self::getSpaceTime();
            $this->actionEditFreevipTime($timespace);
            return ['code' => 1, 'msg' => '添加成功'];
        } else {
            return ['code' => 0, 'msg' => '添加失败'];
        }
    }

    /**
     * actionGetFreeVipConfigs          获取所有已配置的免费会员
     * 2019/03/18 21:25
     * 15899
     * @return array
     */
    public function actionGetFreeVipConfigs()
    {
        $this->response();
        $freevipCate = FreevipCate::find()->all();
        $tmp_arr = [];

        foreach ($freevipCate as $k => $v) {

            //获取当前父分类下的所有子分类
            $childrens_tmp = Freevip::find()->where("parent_cate_id = " . $v['cateId'] . " and status != 2 ")->asArray()->orderBy("cateId desc,accountType desc,vipType desc")->all();

            $childrens_tmp = ArrayHelper::index($childrens_tmp, 'id');

            //计算每个平台下的分类数量，显示时合并分组用
            $group = \Yii::$app->db->createCommand('select count(1) as count, id from {{%freeconfig_main}} where `parent_cate_id` = ' . $v['cateId'] . ' and status != 2  group by `cateId` order by cateId desc')->queryAll();

            foreach ($group as $groupIndex => $groupValue) {
                $childrens_tmp[$groupValue['id']]['rowspan'] = $groupValue['count'];
            }

            $childrens = [];

            foreach ($childrens_tmp as $childrensTmpIndex => $childrensTmpValue) {

                //统计前端展示的数据

                //1、账号库存
                $accountStock = Freeaccounts::find()->where(['free_main_id' => $childrensTmpValue['id']])->andWhere([">", "account_times", 0])->count('id');
                $childrensTmpValue['accountStock'] = $accountStock ? $accountStock : 0;

                //2、提取次数库存
                $getVipStock = Freeaccounts::find()->where(['free_main_id' => $childrensTmpValue['id'], 'status' => 1])->sum('account_times');
                $childrensTmpValue['getVipStock'] = $getVipStock ? $getVipStock : 0;

                //3、总共添加账号数
                $allAccountStock = Freeaccounts::find()->where(['free_main_id' => $childrensTmpValue['id']])->count('id');
                $childrensTmpValue['allAccountStock'] = $allAccountStock ? $allAccountStock : 0;

                $childrens[] = $childrensTmpValue;
            }
            ArrayHelper::multisort($childrens, ['cateId', 'rowspan'], [SORT_DESC, SORT_DESC]);
            $tmp_arr[] = $childrens;
        }

        //获取账号基础配置信息  数字转文字
        $accountBaseConfig = AccountBaseConfig::find()->asArray()->all();
        $accountBaseConfig = ArrayHelper::map($accountBaseConfig, 'id', 'value');
        foreach ($tmp_arr as $k => $v) {
            foreach ($v as $k1 => $v1) {
                $tmp_arr[$k][$k1]['vipType'] = $accountBaseConfig[$v1['vipType']];
                $tmp_arr[$k][$k1]['accountType'] = $accountBaseConfig[$v1['accountType']];
            }
        }
        return $tmp_arr;
    }

    /**
     * actionDelFreevipConfig       删除账号项配置
     * 2019/03/18 20:30
     * @param int $id
     * 15899
     */
    public function actionDelFreevipConfig($id = 0)
    {
        $this->response();

        if (Freevip::updateAll(['status' => 2], ['id' => $id])) {
            return ['code' => 1, 'msg' => '删除成功'];
        } else {
            return ['code' => 0, 'msg' => "删除失败"];
        }
    }

    /**
     * actionEditFreevipConfig          修改免费会员单向配置
     * 2019/03/18 21:01
     * @param string $field
     * @param string $value
     * @param string $id
     * 15899
     * @return array
     */
    public function actionEditFreevipConfig($field = '', $value = '', $id = '')
    {
        $this->response();
        if (Freevip::updateAll(["$field" => $value], ['id' => $id])) {

            //更新redis信息
            $timespace = self::getSpaceTime();
            $this->actionEditFreevipTime($timespace);
            return ['code' => 1, 'msg' => '编辑成功'];
        } else {
            return ['code' => 0, 'msg' => '编辑失败'];
        }
    }

    /**
     * actionGetTimeSpace           获取时间间隔配置
     * 2019/03/19 21:01
     * 15899
     */
    public function actionGetTimeSpace()
    {
        $this->response();
        $freevip = new Freevip();
        $freevip::$table = "{{%free_time}}";
        $freeviptime = $freevip::find()->asArray()->all();

        $timespace = (int)(empty($freeviptime) ? 1 : $freeviptime[0]['space_time']);

        $num = 24 / $timespace;

        $tmp_arr = [];

        for ($i = 0; $i < $num; $i++) {
            if ($i * $timespace < 10) {
                $time = "0" . $i * $timespace . ":00";
            } else {
                $time = $i * $timespace . ":00";
            }
            $now_time = date("H:i");
            $end_time = (strtotime($time) + 3600 * $timespace);
            if (strtotime($now_time) >= strtotime($time) && strtotime($now_time) < $end_time) {
                $tmp_arr[] = ['time' => $time, 'is_active' => 'is_active', 'status' => '抢购中'];
            } elseif (strtotime($now_time) > strtotime($time)) {
                $tmp_arr[] = ['time' => $time, 'is_active' => 'end', 'status' => '已结束'];
            } else {
                $tmp_arr[] = ['time' => $time, 'is_active' => '', 'status' => '未开始'];
            }
        }
        return ['selectedtime' => $timespace, 'times' => $tmp_arr];
    }

    /**
     * actionEditFreevipTime        修改免费会员领取时间间隔
     * 2019/03/19 22:06
     * @param int $value
     * 15899
     */
    public function actionEditFreevipTime($value = 1)
    {
        $this->response();
        $freevip = new Freevip();
        $freevip::$table = "{{%freeconfig_main}}";

        $freeviplist = $freevip::find()->select('id,item_count')->where(['status' => 1])->asArray()->all();

        $freevip = new Freevip();
        $freevip::$table = "{{%freeaccounts}}";

        $tmp = array ();
        foreach ($freeviplist as $k => $v) {
            $id = $v['id'];
            unset($v['id']);
            $tmp[$id] = $v;
        }

        $num = 24 / $value;       //共计多少轮

        // 此处还需添加redis抢购会员缓存
        $redis = \Yii::$app->freevip_redis;

        //先清空缓存
        $redis->flushdb();

        //重置缓存
        for ($i = 0; $i < $num; $i++) {
            $redis->set("freevip_time:" . $i * $value, json_encode($tmp));
        }

        $freevip = new Freevip();
        $freevip::$table = "{{%free_time}}";
        $space_time = $freevip::find()->asArray()->all();
        if ($space_time) {
            if ($freevip::updateAll(['space_time' => $value], ['id' => $space_time[0]['id']])) {
                return ['code' => 1, 'msg' => '修改时间间隔成功'];
            } else {
                return ['code' => 0, 'msg' => '修改时间间隔失败'];
            }
        } else {
            $freevip->space_time = $value;
            if ($freevip->save()) {
                return ['code' => 1, 'msg' => '修改时间间隔成功'];
            } else {
                return ['code' => 0, 'msg' => '修改时间间隔失败'];
            }
        }
    }

    /**
     * actionAddFreevipStock        免费会员添加库存
     * 2019/03/21 21:02
     * @param int $id
     * 15899
     */
    public function actionAddFreevipStock($id = 0)
    {
        $this->response();
        $endTime = \Yii::$app->request->post('endTime') / 1000;
        $account = \Yii::$app->request->post('account');
        $accounts_tmp = explode("\n", $account);
        $accounts = [];

        $freevipMainInfo = Freevip::findOne(['id' => $id]);

        if (empty($freevipMainInfo)) {
            return ['code' => 0, 'msg' => '参数出错'];
        }

        foreach ($accounts_tmp as $k => $v) {
            if (!empty($v)) {
                $accountAndPass = explode("----", $v);
                $password = '';
                if (!empty($accountAndPass[1])) {
                    $password = explode("----", $accountAndPass[1])[0];
                }
                $accounts[] = [$id, $accountAndPass[0], $password, $freevipMainInfo->account_times, $freevipMainInfo->code_num, time(), time()];
            }
        }
        $num = count($accounts);

        if (empty($num)) {
            return ['code' => 0, 'msg' => '不能添加空的数据'];
        }

        Freevip::updateAll(['endTime' => $endTime], ['id' => $id]);

        \Yii::$app->db->createCommand()
            ->batchInsert('mini_freeaccounts',
                ['free_main_id', 'account', 'password', "account_times", "code_num", 'created_at', 'updated_at'],
                $accounts
            )->execute();

        return ['code' => 1, 'msg' => '添加库存成功'];
    }

    /**
     * getSPaceTIme             获取当前的时间轴配置间隔
     * 2019/05/20 19:58
     * 15899
     */
    private static function getSpaceTime()
    {

        $freevip = new Freevip();
        $freevip::$table = "{{%free_time}}";
        $freeviptime = $freevip::find()->asArray()->all();
        $timespace = (int)(empty($freeviptime) ? 1 : $freeviptime[0]['space_time']);
        return $timespace;
    }

    /**
     * actionGetStock               获取账号库存
     * 2019/05/20 21:50
     * @param int $free_main_id
     * @param int $page
     * @param int $limit
     * 15899
     * @return Freeaccounts[]
     */
    public function actionGetStock($free_main_id = 0, $page = 1, $limit = 9)
    {

        $this->response();
        $total = Freeaccounts::find()->where(['free_main_id' => $free_main_id])->count();
        $stocks = Freeaccounts::find()->where(['free_main_id' => $free_main_id])->offset(($page - 1) * $limit)->limit($limit)->all();

        return ['total' => (int)$total, 'stocks' => $stocks];
    }

    /**
     * actionEditStock          编辑账号库存
     * 2019/05/20 21:32
     * @param string $field
     * @param string $value
     * @param string $id
     * 15899
     * @return array
     */
    public function actionEditStock($field = '', $value = '', $id = '')
    {
        $this->response();
        if (Freeaccounts::updateAll(["$field" => $value, 'updated_at' => time()], ['id' => $id])) {

            return ['code' => 1, 'msg' => '编辑成功'];
        } else {
            return ['code' => 0, 'msg' => '编辑失败'];
        }
    }

    /**复制商品
     * actionCopyGoods
     * 2019/06/29 11:50
     * @param int $id
     * 15899
     */
    public function actionCopyGoods($id = 0)
    {
        $this->response();
        $goodsModel = Freevip::find()->where(['id' => $id])->asArray()->one();
        $freevip = new Freevip();
        $freevip->parent_cate_id = $goodsModel['parent_cate_id'];
        $freevip->parent_cate_name = $goodsModel['parent_cate_name'];
        $freevip->cateId = $goodsModel['cateId'];
        $freevip->vip_name = $goodsModel['vip_name'];
        $freevip->vipType = $goodsModel['vipType'];
        $freevip->accountType = $goodsModel['accountType'];
        $freevip->logo = $goodsModel['logo'];
        $freevip->viptime = $goodsModel['viptime'];
        $freevip->endTime = $goodsModel['endTime'];

        if ($freevip->save()) {
            // 更新redis信息
            $timespace = self::getSpaceTime();
            $this->actionEditFreevipTime($timespace);
            return ['code' => 1, 'msg' => "复制成功"];
        } else {
            return ['code' => 0, 'msg' => "复制失败"];
        }
    }
}