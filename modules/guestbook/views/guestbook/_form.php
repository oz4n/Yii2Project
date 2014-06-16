<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Guestbook $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="col-sm-6">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 45])->label('Nama') ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6, 'style' => 'resize:none', 'maxlength' => 255])->label('Isi') ?>
    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-check"></i>&nbsp; ' . Yii::t('app', 'Simpan'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
