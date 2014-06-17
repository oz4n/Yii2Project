<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Widget $model
 * @var yii\widgets\ActiveForm $form
 */
$param = $new->isNewRecord ? ["google_link" => null, "facebook_link" => null, 'twiter_link' => null] : \yii\helpers\Json::decode($model->content);

?>

<div class="widget-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 45])->label("Judul") ?>
    <?= $form->field($model, 'google_link')->textInput(['placeholder'=>'http://','value' => $param['google_link'], 'maxlength' => 45])->label("Google+") ?>
    <?= $form->field($model, 'facebook_link')->textInput(['placeholder'=>'http://','value' => $param['facebook_link'], 'rows' => 6, 'maxlength' => 255])->label("Facebook") ?>
    <?= $form->field($model, 'twiter_link')->textInput(['placeholder'=>'http://','value' => $param['twiter_link'], 'maxlength' => 45])->label("Twiter") ?>
    <?= $form->field($model, 'layoute_position')->dropDownList(['sidebar' => 'Sidebar', 'footer' => 'Footer'])->label('Posisi Layout') ?>
    <?= $form->field($model, 'status')->dropDownList(['Publish' => 'Publish', 'Draft' => 'Draft']) ?>
    <?= Html::activeHiddenInput($model, 'type') ?>
    <div class="form-group">
        <?= Html::submitButton('<i class="fa  fa-check"></i>&nbsp; ' . Yii::t('app', 'Simpan'), ['class' => $new->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
