<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\member\searchs\SchoolSerch;
use yii\web\View;
/**
 * @var yii\web\View $this
 * @var app\modules\member\models\SchoolModel $model
 * @var yii\widgets\ActiveForm $form
 */

$this->registerJs(
    "$('ul.navigation > li.mm-dropdown > ul > li#school').addClass('active').parent().parent().addClass('active open');"
    , View::POS_READY);
?>

<div class="school-model-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 45]) ?>
    <?= $form->field($model, 'taxonomy_id')->dropDownList(SchoolSerch::getAreas()) ?>
    <?= $form->field($model, 'type')->dropDownList(['Negeri' => 'Negeri', 'Swasta' => 'Swasta'], ['maxlength' => 45]) ?>
    <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => 45]) ?>
    <?= $form->field($model, 'zip_code')->textInput(['maxlength' => 45]) ?>
    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => 15]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
