<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\assets\AppAsset;

$this->title = 'Вход';
AppAsset::register($this);
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>Пожалуйста, заполните следующие поля для входа на сайт:</p>

<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>