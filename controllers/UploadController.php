<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/03/12
 * Time: 22:34
 */

namespace app\controllers;

use app\controllers\BaseController;
use Imagine\Imagick\Imagine;
use app\models\Accountconfig;
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;

class UploadController extends BaseController
{

    public static $imgPath = 'http://192.168.1.103:8081/';
    const ACCESS_KEY = "LGjg8n_jNgPKteD2S3Q55LLARnN6g7_JRbL0SgJf";
    const SECRET_KEY = "4WCOQTWbJNKkybAdtq3sr5h0QL14y7yblP9HtMxP";
    const BUCKET_NAME = "iamge";

    public function beforeAction($action)
    {

        $currentaction = $action->id;

        $novalidactions = ['ueditor'];

        if (in_array($currentaction, $novalidactions)) {

            $action->controller->enableCsrfValidation = false;
        }
        parent::beforeAction($action);

        return true;
    }

    public function actionUpload($cate_id = '', $cate_name = '')
    {

        $this->response();
//        $imagine = new Imagine();
//        $filename = $cate_name . ".png";
//        $imagine->open($_FILES['file']['tmp_name'])->save(__DIR__ . "/../web/images/viplogo/" . $filename);

//        Accountconfig::updateAll(['logo' => $filename],['cate_id'=>$cate_id]);

//        return ['code' => 1, 'msg' => '上传成功'];
    }

}