<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\File $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="col-sm-6">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= Html::activeHiddenInput($model, 'user_id') ?>    
    <?php if($model->isNewrecord):?>
    <div class="form-group">        
        <?= Html::fileInput('file', null, ['class' => 'form-control']) ?>
    </div>
    <?php endif;?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'style' => 'resize:none', 'maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-check"></i>&nbsp; ' . Yii::t('app', 'Simpan'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>