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
    <?= $form->field($model, 'name')->textInput(['maxlength' => 45])->label('Nama Skolah') ?>
    <?= $form->field($model, 'taxonomy_id')->dropDownList(SchoolSerch::getAreas())->Label('Daerah') ?>
    <?= $form->field($model, 'type')->dropDownList(['Negeri' => 'Negeri', 'Swasta' => 'Swasta'], ['maxlength' => 45])->label("Instansi") ?>
    <?= $form->field($model, 'address')->textarea(['style' => 'resize:none', 'rows' => 6, 'maxlength' => 255])->label("Alamat") ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => 45])->label('Alamat Email') ?>
    <?= $form->field($model, 'zip_code')->textInput(['maxlength' => 45])->label('Kode Post') ?>
    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => 15])->label('No Telpon') ?>

    <div class="form-group">
        <?= Html::submitButton(Html::tag('i', '', ['class' => 'fa  fa-check']) . '&nbsp; ' . Yii::t('app', 'Simpan'), ['id' => 'save-page', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
