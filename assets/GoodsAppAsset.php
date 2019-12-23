<?php
/**
 * Created by PhpStorm.
 * User: 15899
 * Date: 2019/05/11
 * Time: 11:34
 */

namespace app\assets;

use yii\web\AssetBundle;

class GoodsAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'feedback/css/feedback.css',
    ];
    public $js = [
        'request/request.js',
        'goods/index/goods-index.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}