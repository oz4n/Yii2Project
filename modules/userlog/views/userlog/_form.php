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

    <?= $form->field($model, 'user_ip')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'absolute_url')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'usera_gent')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'action_method')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'platform')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'contry')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'region')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'browser')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'time_zone')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'create_at')->textInput() ?>

    <?= $form->field($model, 'update_et')->textInput() ?>

    <?= $form->field($model, 'zip_code')->textInput(['maxlength' => 45]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
