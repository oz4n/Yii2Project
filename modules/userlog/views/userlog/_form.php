<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\UserLog $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'create_at')->textInput() ?>

    <?= $form->field($model, 'url')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'contry')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'ip_address')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'sistem_oprasi')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'browser')->textInput(['maxlength' => 45]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
