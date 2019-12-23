<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/05/11
 * Time: 11:34
 */

namespace app\assets;

use yii\web\AssetBundle;

class GoodsaddAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'feedback/css/feedback.css',
        'UEditor/themes/default/css/ueditor.css'
    ];
    public $js = [
        'UEditor/ueditor.parse.js',
        'UEditor/ueditor.config.js',
        'UEditor/ueditor.all.min.js',
        'request/request.js',
        'goods/add/goods-add-index.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}