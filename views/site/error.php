<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = '出错了';
?>
<div class="site-error">
    <h3 style="color: #ff0000;font-size: 46px;">ERROR!</h3>
    <div class="alert alert-danger">
        <?= nl2br(Html::encode("The above error occurred while the Web server was processing your request.\n Please contact us if you think this is a server error. Thank you.")) ?>
    </div>
</div>
