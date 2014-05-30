<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\appearance\searchs\MenuSearc $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="taxonomy-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'parent_id') ?>

    <?= $form->field($model, 'term_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'count') ?>

    <?php // echo $form->field($model, 'slug') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'lft') ?>

    <?php // echo $form->field($model, 'rgt') ?>

    <?php // echo $form->field($model, 'root') ?>

    <?php // echo $form->field($model, 'level') ?>

    <?php // echo $form->field($model, 'create_et') ?>

    <?php // echo $form->field($model, 'update_et') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
