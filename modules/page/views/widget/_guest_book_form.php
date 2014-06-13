<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Widget $model
 * @var yii\widgets\ActiveForm $form
 */

$param = $new->isNewRecord ? [null, "limit" => 1] : \yii\helpers\Json::decode($model->content);
?>

<div class="widget-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 45])->label("Judul") ?>
    <div class="form-group field-widgetmodel-limit">
        <label class="control-label" for="widgetmodel-limit">Limit</label>
        <?= Html::dropDownList('WidgetModel[limit]', $param["limit"], [1 => "Limit 1", 2 => "Limit 2", 3 => "Limit 3", 4 => "Limit 4", 5 => "Limit 5", 6 => "Limit 6"], ['class' => 'form-control']) ?>
    </div>
    <?= $form->field($model, 'layoute_position')->dropDownList(['homeright' => 'Widget Posisi Kanan', 'homeleft' => 'Widget Kiri', 'homesidebar' => 'Sidebar'])->label('Posisi Layout') ?>
    <?= $form->field($model, 'status')->dropDownList(['Publish' => 'Publish', 'Draft' => 'Draft']) ?>
    <?= Html::activeHiddenInput($model, 'type') ?>
    <div class="form-group">
        <?= Html::submitButton('<i class="fa  fa-check"></i>&nbsp; ' . Yii::t('app', 'Simpan'), ['class' => $new->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
