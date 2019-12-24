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

    public function actionGetAdLogs($startAt = "2019-11-23",$endAt = '2019-12-27')
    {
        $startTime = strtotime($startAt);
        $endTime = strtotime($endAt)+86000;
        $loop = ($endTime-$startTime)/86400;

        $adLogsTmp = Ad::find()
            ->where(['and',[">=","created_at",$startTime],["<=","created_at",$endTime]])
            ->orderBy("created_at asc")
            ->asArray()
            ->all();

        $this->response();
        $legends = ["中途退出","正常"];
        $series = [];
        $dates = [];

        //1、获取时间线
        for ($i=0;$i<=$loop;$i++){
            $date = date("m月d日",strtotime("+{$i} day",$startTime));
            array_push($dates,$date);
        }

        //2、获取分组内对应日期内的数据
        if (!empty($adLogsTmp)){
            $adLogsTmpLegend = ArrayHelper::index($adLogsTmp,null,"status");
            //2-1、分组
            foreach ($legends as $k=>$legend){
                $series[$legend] = [];
                //2-2、日期
                foreach($dates as $date){
                    //2-3、数量  当前日期初始数量为0；
                    $num = 0;
                    $arr = [];
                    foreach ($adLogsTmpLegend[$k] as $adlog){
                        if (date("m月d日",$adlog['created_at']) == $date){
                            $num++;
                            array_push($arr,$adlog['id']);
                        }
                    }
                    $series[$legend][] = $num;
                }
            }
        }

        return ["legends"=>$legends,"dates"=>$dates,"series"=>$series];
    }

    public function response()
    {
        $response = \Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
    }

}
