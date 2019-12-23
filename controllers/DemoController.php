<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/03/12
 * Time: 22:13
 */

namespace app\controllers;

use yii\web\Controller;
use app\controllers\BaseController;
use Imagine\Imagick\Imagine;

class DemoController extends BaseController
{

    public function actionIndex()
    {
        $imagine = new Imagine();
        var_dump($imagine->open('C:\phpStudy\PHPTutorial\php\php-7.1.13-nts\php.gif')
            ->save(__DIR__."/../web/a.gif", array('jpeg_quality' => 50)) // from 0 to 100
            ->save(__DIR__."/../web/b.gif", array('png_compression_level' => 9)));
        exit;

    }

}