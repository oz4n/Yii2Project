<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Widget $model
 * @var yii\widgets\ActiveForm $form
 */
$param = $new->isNewRecord ? ["city" => null, "address" => null, 'email' => null, 'phone' => null] : \yii\helpers\Json::decode($model->content);

?>

<div class="widget-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 45])->label("Judul") ?>
    <?= $form->field($model, 'city')->textInput(['value' => $param['city'], 'maxlength' => 45])->label("Kota") ?>
    <?= $form->field($model, 'address')->textInput(['value' => $param['address'], 'rows' => 6, 'maxlength' => 255, 'style' => 'resize:none'])->label("Alamat") ?>
    <?= $form->field($model, 'email')->textInput(['value' => $param['email'], 'maxlength' => 45])->label("Email") ?>
    <?= $form->field($model, 'phone')->textInput(['value' => $param['phone'], 'maxlength' => 45])->label('No Telpon') ?>
    <?= $form->field($model, 'layoute_position')->dropDownList(['sidebar' => 'Sidebar', 'footer' => 'Footer'])->label('Posisi Layout') ?>
    <?= $form->field($model, 'status')->dropDownList(['Publish' => 'Publish', 'Draft' => 'Draft']) ?>
    <?= Html::activeHiddenInput($model, 'type') ?>
    <div class="form-group">
        <?= Html::submitButton('<i class="fa  fa-check"></i>&nbsp; ' . Yii::t('app', 'Simpan'), ['class' => $new->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
