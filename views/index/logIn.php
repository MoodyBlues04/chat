<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Вход';
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>Пожалуйста, заполните следующие поля для входа на сайт:</p>

<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= Html::submitButton('Login') ?>
<?php ActiveForm::end(); ?>