<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

class AccountconfigAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'account/account.css',
        'UEditor/themes/default/css/ueditor.css'
    ];
    public $js = [
        'request/request.js',
        'UEditor/ueditor.parse.js',
        'UEditor/ueditor.config.js',
        'UEditor/ueditor.all.min.js',
        'account/accountconfig-index.js',
        'account/accountconfig-components.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
