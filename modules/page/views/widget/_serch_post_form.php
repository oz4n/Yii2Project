<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Widget $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="widget-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 45]) ?>
    <?= $form->field($model, 'layoute_position')->dropDownList(['homeright' => 'Widget Posisi Kanan', 'homeleft' => 'Widget Kiri', 'homesidebar' => 'Sidebar'])->label('Posisi Layout') ?>
    <?= $form->field($model, 'status')->dropDownList(['Publish' => 'Publish', 'Draft' => 'Draft']) ?>
    <?= Html::activeHiddenInput($model, 'type') ?>
    <div class="form-group">
        <?= Html::submitButton('<i class="fa  fa-check"></i>&nbsp; '.Yii::t('app', 'Simpan'), ['class' => $new->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
