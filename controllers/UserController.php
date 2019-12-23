<?php
/**
 ************************************
 *           Author: sunqiaoyu      *
 *         Date: 2019/03/05 18:29   *
 * **********************************
 **/

namespace app\controllers;

use yii\web\Controller;
use Yii;
use app\controllers\BaseController;
use app\models\User;

class UserController extends BaseController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGetUser($page = 1, $limit = 9, $nickname = '', $tel = '', $datetime = '')
    {
        $this->response();

        if (!empty($datetime) && $datetime!='null') {
            $datetime = explode(",", $datetime);

            $start = floor($datetime[0]/1000);
            $end = floor($datetime[1]/1000);

            $total = User::find()
                ->andFilterWhere(['like', 'nickname', $nickname])
                ->andFilterWhere(['like', 'tel', $tel])
                ->andFilterWhere(['>', 'created_at', $start])
                ->andFilterWhere(['<', 'created_at', $end])
                ->count();
            return ['total' => $total, 'data' => User::find()
                ->andFilterWhere(['like', 'nickname', $nickname])
                ->andFilterWhere(['like', 'tel', $tel])
                ->andFilterWhere(['>', 'created_at', $start])
                ->andFilterWhere(['<', 'created_at', $end])
                ->offset(($page - 1) * $limit)
                ->limit($limit)
                ->all()];
        } else {
            $total = User::find()
                ->andFilterWhere(['like', 'nickname', $nickname])
                ->andFilterWhere(['like', 'tel', $tel])
                ->count();
            return ['total' => $total, 'data' => User::find()
                ->andFilterWhere(['like', 'nickname', $nickname])
                ->andFilterWhere(['like', 'tel', $tel])
                ->offset(($page - 1) * $limit)
                ->limit($limit)
                ->all()];
        }
    }

    public function actionEditUser($field = '', $id = '', $value = '')
    {
        $this->response();
        if (empty($value) && $value != "0") {
            return ['code' => 0, 'msg' => '内容不能为空'];
        }
        if (User::updateAll(["$field" => $value], ['uid' => $id])) {
            return ['code' => 1, 'msg' => '修改用户信息成功'];
        } else {
            return ['code' => 0, 'msg' => '修改用户信息失败'];
        }
    }

}
