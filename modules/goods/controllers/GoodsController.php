<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/05/11
 * Time: 10:43
 */

namespace app\modules\goods\controllers;

use app\controllers\BaseController;
use Qiniu\Auth;
use app\modules\goods\models\Goods;
use app\modules\goods\models\GoodsAccounts;

class GoodsController extends BaseController
{
    public static $qiniu = "https://image.mysvip.cn/";

    public function actionIndex()
    {
        return $this->render('index');

    }

    public function actionAdd()
    {
        $auth = new Auth(self::ACCESS_KEY, self::SECRET_KEY);
        $token = $auth->uploadToken(self::BUCKET_NAME);
        return $this->render('add', ['token' => $token]);
    }

    /**
     * actionAddGoods       添加商品操作
     * 2019/06/15 17:15
     * 15899
     */
    public function actionAddGoods()
    {
        Goods::$post = \Yii::$app->request->post('Goods');
        $this->response();
        $data = \Yii::$app->request->post();
//        return $data;
        if (!empty($data['Goods']['images'])) {
            $len = strlen(self::$qiniu);
            foreach ($data['Goods']['images'] as $k => $v) {
                unset($data['Goods']['images'][$k]['uid']);
                unset($data['Goods']['images'][$k]['status']);
                $data['Goods']['images'][$k]['url'] = substr($data['Goods']['images'][$k]['url'], $len);
            }
            $data['Goods']['images'] = json_encode($data['Goods']['images']);
        } else {
            $data['Goods']['images'] = "[]";
        }

        if (!empty($data['Goods']['fenqi'])) {
            $data['Goods']['fenqi'] = json_encode($data['Goods']['fenqi']);
        } else {
            $data['Goods']['fenqi'] = "[]";
        }

        if (!empty($data['Goods']['endTime'])) {
            $data['Goods']['endTime'] = strtotime($data['Goods']['endTime']);
        }

        $data['Goods']['attributes'] = json_encode($data['Goods']['attributes']);
        $goods = new Goods();
        if (isset($data['Goods']['id'])) {
            $goods = Goods::findOne(['id' => $data['Goods']['id']]);
        }
        if ($goods->load($data) && $goods->validate()) {
            if ($goods->save()) {
                if (isset($data['Goods']['id']) && $data['Goods']['id'] != 0) {
                    return ['code' => 1, 'msg' => '编辑商品成功'];
                }
                return ['code' => 1, 'msg' => '添加商品成功'];
            } else {
                if (isset($data['Goods']['id']) && $data['Goods']['id'] != 0) {
                    return ['code' => 0, 'msg' => '编辑商品成功'];
                }
                return ['code' => 0, 'msg' => '添加商品失败'];
            }
        } else {
            if (isset($data['Goods']['id']) && $data['Goods']['id'] != 0) {
                return ['code' => 0, 'msg' => '参数校验失败'];
            }
            return ['code' => 0, 'msg' => '参数校验失败'];
        }
    }

    /**
     * actionGetGoodsList       获取商品列表
     * 2019/06/16 16:53
     * @param int $goodsType
     * 15899
     * @return array
     */
    public function actionGetGoodsList($goodsType = 1)
    {
        $goodsList = Goods::find()->where("status != 3 and goodsType=" . $goodsType)->all();
        $total = Goods::find()->where("status != 3 and goodsType=" . $goodsType)->count();
        $this->response();
        return ['goodsList' => $goodsList, 'total' => (int)$total];
    }

    /**
     * actionEditGoods          编辑商品状态
     * 2019/06/15 23:21
     * @param int $id
     * @param string $field
     * @param string $value
     * 15899
     */
    public function actionEditGoodsStatus($id = 0, $field = '', $value = '')
    {
        $this->response();
        if (Goods::updateAll(["$field" => $value], ['id' => $id])) {
            if ($value == 3) {
                return ['code' => 1, "msg" => '删除商品成功'];
            }
            return ['code' => 1, "msg" => '编辑状态成功'];
        } else {
            if ($value == 3) {
                return ['code' => 0, "msg" => '删除商品失败'];
            }
            return ['code' => 0, 'msg' => '编辑状态失败'];
        }
    }

    /**
     * actionEdit           编辑商品
     * 2019/06/15 23:40
     * @param int $id
     * 15899
     */
    public function actionEdit($id = 0)
    {
        $auth = new Auth(self::ACCESS_KEY, self::SECRET_KEY);
        $token = $auth->uploadToken(self::BUCKET_NAME);
        $goodsDetail = Goods::find()->where(['id' => $id])->asArray()->one();
        return $this->render('edit', ['goods' => $goodsDetail, "token" => $token]);
    }

    /**
     * actionCopyGoods          复制商品
     * 2019/06/16 12:31
     * @param int $id
     * 15899
     */
    public function actionCopyGoods($id = 0)
    {
        $this->response();
        $goodsDetail = Goods::find()->where(['id' => $id])->asArray()->one();
        unset($goodsDetail['id']);
        $goods = new Goods();
        $Detail['Goods'] = $goodsDetail;
        Goods::$post = $goodsDetail;

        if ($goods->load($Detail) && $goods->validate()) {
            if ($goods->save()) {
                return ['code' => 1, 'msg' => "复制成功"];
            } else {
                return ['code' => 0, 'msg' => "复制失败"];
            }
        } else {
            return ['code' => 0, 'msg' => '意外错误'];
        }
    }

    /**添加账号库存
     * actionAddAccount
     * 2019/06/23 21:43
     * @param int $id
     * 15899
     */
    public function actionAddAccounts($id = 0)
    {
        $this->response();
        $account = \Yii::$app->request->post('accounts');
        $row = \Yii::$app->request->post('row');
        $accounts_tmp = explode("\n", $account);

        $goods = Goods::findOne(['id' => $id]);

        if (empty($goods)) {
            return ['code' => 0, 'msg' => '商品不存在'];
        }
        $accounts = [];
        foreach ($accounts_tmp as $k => $v) {
            if (!empty($v)) {
                $accountAndPass = explode("----", $v);
                $password = '';
                if (!empty($accountAndPass[1])) {
                    $password = explode("----", $accountAndPass[1])[0];
                }
                $accounts[] = array ($id, $accountAndPass[0], $password, $row['everyTimes'], $row['loginTimes'], time(), time());
            }
        }
        $num = count($accounts);

        if (empty($num)) {
            return ['code' => 0, 'msg' => '不能添加空的数据'];
        }

        \Yii::$app->db->createCommand()
            ->batchInsert('mini_goods_accounts',
                ['goodsId', 'account', 'password', "account_times", "code_num", 'created_at', 'updated_at'],
                $accounts
            )->execute();

        return ['code' => 1, 'msg' => '添加库存成功'];
    }

    /**获取账号库存
     * actionGetStock
     * 2019/06/23 22:24
     * @param int $giidsId
     * @param int $page
     * @param int $limit
     * 15899
     * @return array
     */
    public function actionGetStock($goodsId = 0, $page = 1, $limit = 9)
    {
        $this->response();
        $total = GoodsAccounts::find()->where(['goodsId' => $goodsId])->count();
        $stocks = GoodsAccounts::find()->where(['goodsId' => $goodsId])->offset(($page - 1) * $limit)->limit($limit)->all();

        return ['total' => (int)$total, 'stocks' => $stocks];
    }

    /**编辑库存
     * actionEditStock
     * 2019/06/23 22:24
     * @param string $field
     * @param string $value
     * @param string $id
     * 15899
     * @return array
     */
    public function actionEditStock($field = '', $value = '', $id = '')
    {
        $this->response();
        if (GoodsAccounts::updateAll(["$field" => $value, 'updated_at' => time()], ['id' => $id])) {

            return ['code' => 1, 'msg' => '编辑成功'];
        } else {
            return ['code' => 0, 'msg' => '编辑失败'];
        }
    }
}