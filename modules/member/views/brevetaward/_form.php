<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

//use app\modules\member\searchs\BrevetAwardSerch;

/**
 * @var yii\web\View $this
 * @var \app\modules\dao\ar\Taxonomy $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerJs(
    "$('ul.navigation > li.mm-dropdown > ul > li#appreciation').addClass('active').parent().parent().addClass('active open');"
    , View::POS_READY);
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'name')->textInput(['maxlength' => 255])->label('Nama Brevet Penghargaan') ?>
<?php //$form->field($model, 'parent_id')->dropDownList(BrevetAwardSerch::getParents())->label('Induk') ?>
<?= $form->field($model, 'description')->textarea(['rows' => 6, 'maxlength' => 255]) ?>
<div class="form-group">
    <?= Html::submitButton(Html::tag('i', '', ['class' => 'fa  fa-check']) . '&nbsp; ' . Yii::t('app', 'Simpan'), ['id' => 'save-page', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
