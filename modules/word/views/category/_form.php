<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use app\modules\word\searchs\CategorySerch;
/**
 * @var yii\web\View $this
 * @var \app\modules\dao\ar\Taxonomy $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerJs(
    "$('ul.navigation > li.mm-dropdown > ul > li#category').addClass('active').parent().parent().addClass('active open');"
    , View::POS_READY);
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'name')->textInput(['maxlength' => 255])->label('Nama Kategory') ?>
<?= $form->field($model, 'parent_id')->dropDownList(CategorySerch::getParents())->label('Induk') ?>
<?= $form->field($model, 'description')->textarea(['rows'=>6,'maxlength' => 255, 'style' => 'resize: none;'])->label('Keterangan') ?>
<div class="form-group">
    <?= Html::submitButton(Html::tag('i','',['class'=>'fa  fa-check']).'&nbsp; '.Yii::t('app', 'Simpan'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
