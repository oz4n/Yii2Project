<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\AuthItem $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerJs(
    "$('ul.navigation > li#user > ul.mm-dropdown > li#rule-account').addClass('active').parent().addClass('open').parent().addClass('active open');"
    , View::POS_READY);
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'description')->textInput(['rows' => 6])->label("Nama Rule") ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
