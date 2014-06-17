<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$param = $new->isNewRecord ? ["category" => null, "limit" => 1] : \yii\helpers\Json::decode($model->content);
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => 45])->label('Judul') ?>
<?php
    switch ($pagetype) {
        case "pagehome":
            echo $form->field($model, 'layoute_position')->dropDownList(['homeright' => 'Widget Posisi Kanan', 'homeleft' => 'Widget Kiri', 'homesidebar' => 'Sidebar'])->label('Posisi Layout');
            break;
        case "pagecontact":
            echo Html::activeHiddenInput($model, 'layoute_position', ['value'=>'contactsidebar']);
            break;
        case "pagememberppi":
            echo Html::activeHiddenInput($model, 'layoute_position', ['value'=>'memberppisidebar']);
            break;
        case "pagememberpaskibra":
            echo Html::activeHiddenInput($model, 'layoute_position', ['value'=>'memberpaskibrasidebar']);
            break;
        case "pagemembercapas":
            echo Html::activeHiddenInput($model, 'layoute_position', ['value'=>'membercapassidebar']);
            break;
    }
    ?>
<div class="form-group field-widgetmodel-category">
    <label class="control-label" for="widgetmodel-category">Kategori</label>
<?= Html::dropDownList('WidgetModel[category]', $param["category"], $model->getCategory(), ['class' => 'form-control']) ?>
</div>
<div class="form-group field-widgetmodel-limit">
    <label class="control-label" for="widgetmodel-limit">Limit</label>
<?= Html::dropDownList('WidgetModel[limit]', $param["limit"], [1 => "Limit 1", 2 => "Limit 2", 3 => "Limit 3", 4 => "Limit 4", 5 => "Limit 5", 6 => "Limit 6"], ['class' => 'form-control']) ?>
</div>
<?= $form->field($model, 'status')->dropDownList(['Publish' => 'Publish', 'Draft' => 'Draft']) ?>
    <?= Html::activeHiddenInput($model, 'type') ?>
<div class="form-group">
<?= Html::submitButton('<i class="fa  fa-check"></i>&nbsp; ' . Yii::t('app', 'Simpan'), ['class' => $new->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>