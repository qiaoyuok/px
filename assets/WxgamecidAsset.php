<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace app\assets;
use yii\web\AssetBundle;
class WxgamecidAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'menu/menu.css'
    ];
    public $js = [
        'request/request.js',
        'wxgamecid/wxgamecid-index.js',
        'wxgamecid/wxgamecid-components.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}