<?php
/**
 ************************************
 *           Author: sunqiaoyu      *
 *         Date: 2019-12-24 16:01   *
 * **********************************
 **/

namespace app\controllers;

use app\controllers\BaseController;

class WxgamecidController extends BaseController
{

    public function actionIndex()
    {
        return $this->render('index');
    }
    
}