<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\member\models\search\ProvinceSerch;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Province $model
 * @var yii\widgets\ActiveForm $form
 */
//$form = new \yii\widgets\ActiveForm();
?>

<div class="province-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'type')->dropDownList(['Provinsi' => 'Provinsi', 'Kabupaten' => 'Kabupaten', 'Kota' => 'Kota'], ['maxlength' => 45]) ?>
    <?= $form->field($model, 'parent_id')->dropDownList(ProvinceSerch::loadParents()); ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
