<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

class FreevipgetrecordAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'freevip/freevip.css'
    ];
    public $js = [
        'request/request.js',
        'freevipgetrecord/freevipgetrecord-components.js',
        'freevipgetrecord/freevipgetrecord-index.js'
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
