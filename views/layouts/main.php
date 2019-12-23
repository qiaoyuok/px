<?php

use app\controllers\BaseController;

$menus = BaseController::$menus;
$controlleroption = $this->context->id."/".$this->context->action->id;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="keywords" content="HTML5 Admin Template"/>
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="/assets/theme.css"/>
    <link rel="stylesheet" href="/assets/skins/default.css"/>
    <script src="/assets/vendor/modernizr/modernizr.js"></script>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <style>
        [v-cloak]{
            display: none;
        }
    </style>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<section class="body">

    <!-- start: header -->
    <header class="header">

        <!--顶部logo-->
        <div class="logo-container">
            <a href="../" class="logo"> <img src="/assets/images/logo.png" height="35" alt="Porto Admin"/> </a>

            <h3>By Rain</h3>

            <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html"
                 data-fire-event="sidebar-left-opened">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>
        <div class="header-middle">
            <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html"
                 data-fire-event="sidebar-left-toggle">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
            <h4><?= $this->title ?></h4>
        </div>
        <!-- start: search & user box -->
        <div class="header-right">
            <!--用户操作区域-->
            <span class="separator"></span>
            <div id="userbox" class="userbox">
                <a href="#" data-toggle="dropdown">
                    <figure class="profile-picture">
                        <img src="/assets/images/logo.png" alt="Joseph Doe" class="img-circle"
                             data-lock-picture="/assets/images/logo.png"/>
                    </figure>
                    <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                        <span class="name">John Doe Junior</span> <span class="role">administrator</span>
                    </div>

                    <i class="fa custom-caret"></i> </a>

                <div class="dropdown-menu">
                    <ul class="list-unstyled">
                        <li class="divider"></li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i
                                        class="fa fa-user"></i> My Profile</a>
                        </li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i
                                        class="fa fa-lock"></i> Lock Screen</a>
                        </li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="<?= Url::to(['login/out']) ?>"><i
                                        class="fa fa-power-off"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="inner-wrapper">
        <aside id="sidebar-left" class="sidebar-left">
            <div class="nano">
                <div class="nano-content">
                    <nav id="menu" class="nav-main" role="navigation">
                        <ul class="nav nav-main">
                            <?php foreach ($menus as $k => $v) { if (count($v['children']) == 0){?>
                                <li class="<?php echo (is_numeric(strpos($v['router'],$controlleroption))) ?'nav-active':''; ?>"><a href="<?= "/".$v['router'] ?>"> <?php }else{
                                    $children = [];
                                    foreach($v['children'] as $k2=>$v2){
                                        $children[] = $v2['router'];
                                    }
                                ?>
                                <li class="<?php echo (is_numeric(strpos($v['router'],$controlleroption)))||in_array($controlleroption,$children)?'nav-active nav-parent nav-expanded':'nav-parent'; ?>"><a><?php } ?>
                                            <i class="fa <?= $v['icon'] ?>" aria-hidden="true"></i>
                                            <span><?= $v['name'] ?></span>

                                    </a>
                                    <?php if (count($v['children']) > 0) { ?>
                                        <ul class="nav nav-children">
                                            <?php foreach ($v['children'] as $k1 => $v1) { ?>
                                                <li class="<?php echo (is_numeric(strpos($v1['router'],$controlleroption))) ?'nav-active':''; ?>">
                                                    <a href="<?= "/".$v1['router'] ?>">
                                                        <i class="fa <?= $v1['icon'] ?>" aria-hidden="true"></i>
                                                        <?= $v1['name'] ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php }?>
                                </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </aside>

        <!--内容区域-->
        <section role="main" class="content-body row">

            <?= $content ?>

        </section>
    </div>
    <script src="/assets/vendor/jquery/jquery.js"></script>
    <script src="/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="/assets/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="/assets/vendor/magnific-popup/magnific-popup.js"></script>
    <script src="/assets/javascripts/theme.js"></script>
    <script src="/assets/javascripts/theme.custom.js"></script>
    <script src="/assets/javascripts/theme.init.js"></script>
</section>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
