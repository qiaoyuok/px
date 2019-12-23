<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div id="container">
    <row class="header" v-cloak>
        <div class="title"><img src="/images/logo.png" alt=""><span>后台管理</span></div>
        <div class="body">
            <div class="left">
                <span class="glyphicon glyphicon-align-justify" @click="menutoogle" aria-hidden="true"></span>
                <p>用户管理</p>
            </div>
            <div class="right">
                <el-dropdown>
                    <span class="el-dropdown-link">用户操作<i class="el-icon-arrow-down el-icon--right"></i></span>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item><a href="<?= Url::to(['user/logout']) ?>">退出登录</a></el-dropdown-item>
                        <el-dropdown-item divided><a href="<?= Url::to(['user/repassword']) ?>">修改密码</a></el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
            </div>
        </div>
    </row>
    <row class="main">
        <div class="aside">
                <el-collapse v-cloak v-model="activeName" accordion>
                    <el-collapse-item title="用户管理" name="1">
                        <a href="#">用户列表</a>
                        <a href="#">查询用户</a>
                    </el-collapse-item>
                    <el-collapse-item title="订单管理" name="2">
                        <a href="#">已完成</a>
                        <a href="#">代发货</a>
                    </el-collapse-item>
                    <el-collapse-item title="设置" name="3">
                        <a href="<?= Url::to(['menu/index']) ?>">菜单管理</a>
                        <a href="#">公告管理</a>
                    </el-collapse-item>
                </el-collapse>
            </div>
        <div class="content">

            <?= $content ?>

        </div>
    </row>
    <row class="footer">
        <div>练习后台模板</div>
    </row>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
