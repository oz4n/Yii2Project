<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\School $model
 * @var yii\widgets\ActiveForm $form
 */
$form = new \yii\widgets\ActiveForm();
?>

<div class="school-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'type')->dropDownList(['Negri' => 'Negri', 'Swasta' => 'Swasta']) ?>    

    <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'zip_code')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => 15]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
