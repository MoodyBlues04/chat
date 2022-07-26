<?php
use yii\widgets\ActiveForm;
?>
<div class="img-form-container">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

        <?= $form->field($model, 'imageFile')->fileInput() ?>

        <button class="btn btn-primary">Submit</button>

    <?php ActiveForm::end() ?>
    <a href="./profile">Back</a>
</div>