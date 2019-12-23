<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

class AccountcateAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'account/account.css'
    ];
    public $js = [
        'request/request.js',
        'account/accountcate-index.js',
        'account/accountacte-components.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
