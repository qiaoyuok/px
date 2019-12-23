<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\controllers\AdminController;

class SiteController extends AdminController
{

    /**
     * actionIndex          后台首页
     * Date: 2019/03/05
     * Author: sunqiaoyu
     */
    public function actionIndex(){

        return $this->render('index');

    }

    /**
     * actionError          报错页面
     * Date: 2019/03/05
     * Author: sunqiaoyu
     * @return string
     */
    public function actionError()
    {
        return $this->render('error');
    }

}
