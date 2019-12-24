<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/03/06
 * Time: 20:45
 */

namespace app\controllers;

use app\controllers\BaseController;
use Yii;
use yii\helpers\ArrayHelper;
use app\models\Ad;
use yii\web\Response;

class DashboardController extends BaseController
{
    /**                 菜单管理首页
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGetAdLogs()
    {
        $adLogsTmp = Ad::find()->orderBy("created_at asc")->all();
        $this->response();
        $legends = [];
        $data = [];
        $times = [];
        if (!empty($adLogsTmp)){
            foreach ($adLogsTmp as $k=>$v){
                $time = date("m月d日",$v['created_at']);
                $legend = $v['status']==0?"中途退出":"正常";
                !in_array($legend,$legends)?array_push($legends,$legend):'';
                !in_array($time,$times)?array_push($times,$time):'';
                if (!isset($data[$legend][$time])){
                    $data[$legend][$time] = 1;
                }else{
                    $data[$legend][$time]++;
                }

            }
        }
        return ["legends"=>$legends,"times"=>$times,"data"=>$data];
    }

    public function response()
    {
        $response = \Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
    }

}
