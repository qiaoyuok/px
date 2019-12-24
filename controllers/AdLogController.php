<?php


namespace app\controllers;

use yii\rest\Controller;
use yii\filters\AccessControl;
use app\models\Ad;
use app\models\UserWxgamecid;
use yii\web\Response;

class AdLogController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['add-log'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['add-log'],
                        'roles' => ['?'],
                    ]
                ],
            ],
        ];
    }

    public function actionAddLog()
    {
        $this->response();
        $get = \Yii::$app->request->get();
        if (!isset($get['userId']) || !isset($get['wxgamecid'])){
            $this->response();
            return ['code'=>0,'msg'=>"userId is not exists!"];
        }

        $redis = \Yii::$app->get("redis");

        if ($redis->get("userAdLog:".$get['userId'])){
            return ['code'=>0,'msg'=>"so fast"];
        }

        $redis->set("userAdLog:".$get['userId'],1);
        $redis->expire("userAdLog:".$get['userId'],5);

        $wxgamecidInfo = UserWxgamecid::find()->where(['userId' => $get['userId']])->one();

        if (!empty($wxgamecidInfo)){
            $get['wxgamecid'] = $wxgamecidInfo['wxgamecid'];
        }else{
            $wxgamecidInfo = new UserWxgamecid();
            $wxgamecidInfo->userId = $get['userId'];
            $wxgamecidInfo->wxgamecid = $get['wxgamecid'];
            $wxgamecidInfo->created_at = time();
            $wxgamecidInfo->save();
        }

        $adLog = new Ad();
        $get['created_at'] = time();
        if ($adLog->load(['Ad'=>$get]) && $adLog->validate()){
            if ($adLog->save()){
                return ['code'=>1];
            }else{
                return ['code'=>0,'msg'=>'save error!'];
            }
        }
    }

    public function response()
    {
        $response = \Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
    }
}