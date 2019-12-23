<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace app\assets;
use yii\web\AssetBundle;
class SettingAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'setting/app/app.css',
        'UEditor/themes/default/css/ueditor.css'
    ];
    public $js = [
        'UEditor/ueditor.parse.js',
        'UEditor/ueditor.config.js',
        'UEditor/ueditor.all.min.js',
        'request/request.js',
        'setting/app/app-index.js',
//        'setting/app/app-components.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}