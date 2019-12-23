<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\LoginAsset;
LoginAsset::register($this);

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="UTF-8">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?= $this->title ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="login-box">
    <div class="user-login">
        <h1>User Login</h1>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"user-login-input\">{input}</div>\n<div class=\"login-error\">{error}</div>",
                'labelOptions' => ['class' => 'user-login-label'],
            ],
        ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <div class="user-login-but">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
