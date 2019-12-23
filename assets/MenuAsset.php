<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace app\assets;
use yii\web\AssetBundle;
class MenuAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'menu/menu.css'
    ];
    public $js = [
        'request/request.js',
        'menu/menu-index.js',
        'menu/menu-components.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}