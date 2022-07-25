<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\assets\AppAsset;

AppAsset::register($this);
?>

<?php $form = ActiveForm::begin(); ?>
<!-- на if сделать ['enableLabel' => false] и ['placeholder' => 'Name', 'class'=>'form-control text-center']
 в зависимости от того введены ли -->
    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'surname')->textInput() ?>
    <?= $form->field($model, 'status')->dropDownList([
            '0' => 'Активный',
            '1' => 'Отключен',
            '2'=>'Удален'
        ]);
    ?>
    <?= Html::submitButton('Save', ['class' => 'login-button btn btn-primary']) ?>
<?php ActiveForm::end(); ?>



