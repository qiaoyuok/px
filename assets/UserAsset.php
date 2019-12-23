<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

class UserAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'user/user.css'
    ];
    public $js = [
        'request/request.js',
        'user/user-index.js'
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
