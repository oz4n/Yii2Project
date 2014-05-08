<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\member\models\LifeSkillModel $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="life-skill-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_id')->textInput() ?>

    <?= $form->field($model, 'term_id')->textInput() ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'lft')->textInput() ?>

    <?= $form->field($model, 'rgt')->textInput() ?>

    <?= $form->field($model, 'root')->textInput() ?>

    <?= $form->field($model, 'level')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'create_et')->textInput() ?>

    <?= $form->field($model, 'update_et')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'count')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => 45]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
