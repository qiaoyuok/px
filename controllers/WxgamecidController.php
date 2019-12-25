<?php
/**
 ************************************
 *           Author: sunqiaoyu      *
 *         Date: 2019-12-24 16:01   *
 * **********************************
 **/

namespace app\controllers;

use app\controllers\BaseController;
use app\models\Wxgamecid;

class WxgamecidController extends BaseController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGetWxgamecidList()
    {
        $this->response();
        $wxgamecidList = Wxgamecid::find()->all();

        return $wxgamecidList;
    }

    public function actionAddWxgamecid()
    {
        $wxgamecid = new Wxgamecid();
        $this->response();
        $data = \Yii::$app->request->post();
        $data['Wxgamecid']['created_at'] = time();
        if ($wxgamecid->load($data) && $wxgamecid->validate()) {
            if ($wxgamecid->save()) {
                return ['code' => 1, 'msg' => '添加成功'];
            } else {
                return ['code' => 0, 'msg' => '添加失败！'];
            }
        } else {
            return ['code' => 0, 'msg' => '数据不合法！'];
        }
    }

    public function actionDelWxgamecid($id = '')
    {
        $this->response();

        if (Wxgamecid::deleteAll(['id' => $id])) {
            return ['code' => 1, 'msg' => "删除成功"];
        } else {
            return ['code' => 0, "msg" => "删除失败"];
        }
    }

    public function actionEditWxgamecid($field = '', $id = '', $value = '')
    {
        $this->response();
        if (empty($value) && $value != "0") {
            return ['code' => 0, 'msg' => '内容不能为空'];
        }
        if (Wxgamecid::updateAll(["$field" => $value], ['id' => $id])) {
            return ['code' => 1, 'msg' => '编辑渠道成功'];
        } else {
            return ['code' => 0, 'msg' => '编辑渠道失败'];
        }
    }
}