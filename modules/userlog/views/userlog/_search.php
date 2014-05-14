<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\userlog\searchs\UserLogSerch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="user-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'create_at') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'contry') ?>

    <?php // echo $form->field($model, 'ip_address') ?>

    <?php // echo $form->field($model, 'sistem_oprasi') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'browser') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
