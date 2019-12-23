<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/03/10
 * Time: 15:28
 */

namespace app\controllers;

use Yii;
use app\controllers\BaseController;
use app\models\Accountcate;
use app\models\Accountconfig;
use yii\helpers\ArrayHelper;
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
use app\models\AccountBaseConfig;

class AccountconfigController extends BaseController
{

    public function actionIndex()
    {
        $auth = new Auth(self::ACCESS_KEY, self::SECRET_KEY);
        $token = $auth->uploadToken(self::BUCKET_NAME);
        return $this->render('index', ['token' => $token]);
    }

    /**
     * actionGetAccountConfig               获取平台配置信息
     * 2019/05/18 18:10
     * 15899
     * @return array
     */
    public function actionGetAccountConfig()
    {

        $this->response();
        //获取所有的分类
        $accountCates = Accountcate::getCates();

        //获取子分类下的配置
        foreach ($accountCates as $k => $v) {

            foreach ($v['children'] as $k1 => $v1) {

                //获取该平台下的详细配置 ，账号类型，会员类型，分期信息
                $config = $this->getConfig($v1['id']);

                //解决图片缓存不刷新问题
                $config['logo'] = $config['logo'] . "?v=" . time();
                $config['accountType'] = json_decode($config['accountType'], true);
                $config['vipType'] = json_decode($config['vipType'], true);
                $config['fenqi'] = json_decode($config['fenqi'], true);

                $accountCates[$k]['children'][$k1]['config'] = $config;
            }
        }
        $accountBaseConfig = self::getAccountBaseConfig();
        return ['accountCates' => $accountCates, 'accountBaseConfig' => $accountBaseConfig];
    }

    /**
     * getAccountBaseConfig             获取账号的基础配置信息
     * 2019/05/18 18:24
     * 15899
     */
    private static function getAccountBaseConfig()
    {
        $accountBaseConfig_tmp = AccountBaseConfig::find()->all();

        $accountBaseConfig = [
            "accountType" => [],
            "vipType" => [],
            "fenqi" => [],
        ];

        //对配置进行分组 accountType 、vipType、fenqi
        foreach ($accountBaseConfig_tmp as $k => $v) {
            switch ($v['type']) {
                case 1:
                    $accountBaseConfig['accountType'][] = ["index" => $v['id'], "value" => $v['value']];
                    break;
                case 2:
                    $accountBaseConfig['vipType'][] = ["index" => $v['id'], "value" => $v['value']];
                    break;
                default:
                    $accountBaseConfig['fenqi'][] = ["index" => $v['id'], "value" => $v['value']];
                    break;
            }
        }
        return $accountBaseConfig;
    }

    /**
     * getConfig            获取平台下的配置信息
     * 2019/05/18 18:16
     * @param string $cateId 平台ID号
     * 15899
     * @return array
     */
    public function getConfig($cateId = '')
    {
        return ArrayHelper::toArray(Accountconfig::findOne(['cateId' => $cateId]));
    }

    /**
     * actionEditConfig             编辑账号配置
     * 2019/05/18 22:54
     * @param string $cateId
     * @param string $field
     * 15899
     * @return array
     */
    public function actionEditConfig($cateId = '', $field = '')
    {
        $this->response();
        $value = Yii::$app->request->post('value');

        //获取当前平台的配置信息
        if (Accountconfig::updateAll(["$field" => $value], ['cateId' => $cateId])) {
            return ['code' => 1, 'msg' => '修改配置信息成功'];
        } else {
            return ['code' => 0, 'msg' => '修改配置信息失败'];
        }
    }

    /**
     * actionAddConfig              添加账号基础配置
     * 2019/05/18 16:52
     * @param int $cateId 平台ID号
     * @param string $field 字段
     * @param string $value 值
     * 15899
     * @return array
     */
    public function actionAddConfig($cateId = 0, $field = '', $value = '')
    {
        $this->response();
        if (empty($value)) {
            return ['code' => 0, 'msg' => '值不能为空'];
        }

        //field为accountType、vipType、fenqi时，添加到账号基础配置中
        $types = ['accountType' => 1, 'vipType' => 2, 'fenqi' => 3];
        $typesKeys = array_keys($types);

        if (in_array($field, $typesKeys)) {
            $accountBaseConfig = new AccountBaseConfig();
            $accountBaseConfig->type = $types[$field];
            $accountBaseConfig->value = $value;
            if ($accountBaseConfig->save()) {
                return ['code' => 1, 'msg' => "添加配置成功"];
            } else {
                return ['code' => 0, 'msg' => "添加配置失败"];
            }
        }

        //先去获取配置信息
        $accountcofig = ArrayHelper::toArray(Accountconfig::findOne(['cateId' => $cateId]));
        $accountcofig[$field] = json_decode($accountcofig[$field], true);
        $accountcofig[$field]['data'][] = $value;

        $accountcofig[$field] = json_encode($accountcofig[$field]);

        if (Accountconfig::updateAll(["$field" => $accountcofig[$field]], ['cateId' => $cateId])) {
            return ['code' => 1, 'msg' => "添加配置成功"];
        } else {
            return ['code' => 0, 'msg' => "添加配置失败"];
        }

    }

    /**
     * actionDelConfig          删除账号配置
     * 2019/05/18 22:30
     * @param int $cateId
     * @param string $field
     * @param string $value
     * 15899
     * @return array
     */
    public function actionDelConfig($cateId = 0, $field = '', $value = '')
    {
        $this->response();
        if (empty($value) && $value != 0) {
            return ['code' => 0, 'msg' => '删除失败'];
        }

        //先去获取配置信息
        $accountcofig = Accountconfig::findOne(['cateId' => $cateId]);

        //获取当前字段的配置信息
        $accountcofig[$field] = json_decode($accountcofig[$field], true);

        //删除配置值
        $res = json_encode(array_values(array_diff($accountcofig[$field], json_decode($value, true))));

        //删除基础配置项
        AccountBaseConfig::deleteAll(['id' => json_decode($value, true)]);

        //对帐号配置的平台做处理
        Accountconfig::updateAll(["$field" => $res], ['cateId' => $cateId]);

        return ['code' => 1, 'msg' => '删除成功'];
    }

    /**
     * actionSaveImageName      保存上传的图片名
     * 2019/05/18 22:58
     * @param string $logo
     * @param int $cateId
     * 15899
     */
    public function actionSaveImageName($logo = '', $cateId = 0)
    {
        Accountconfig::updateAll(['logo' => $logo], ['cateId' => $cateId]);
    }

    /**
     * actionSaveImageName      保存横图上传的图片名
     * 2019/05/18 22:58
     * @param string $logo
     * @param int $cateId
     * 15899
     */
    public function actionSaveImageSwiper($swiper = '', $cateId = 0)
    {
        Accountconfig::updateAll(['swiper' => $swiper], ['cateId' => $cateId]);
    }

}