<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use app\modules\member\searchs\LanguageSkillSerch;
/**
 * @var yii\web\View $this
 * @var \app\modules\dao\ar\Taxonomy $model
 * @var yii\widgets\ActiveForm $form
 */

$this->registerJs(
    "$('ul.navigation > li.mm-dropdown > ul > li#langskill').addClass('active').parent().parent().addClass('open');"
    , View::POS_READY);
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'name')->textInput(['maxlength' => 255])->label('Nama Keterampilan Bahasa') ?>
<?= $form->field($model, 'parent_id')->dropDownList(LanguageSkillSerch::getParents())->label('Induk') ?>
<?= $form->field($model, 'description')->textarea(['rows'=>6,'maxlength' => 255])->label('Keterangan') ?>
<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Simpan') : Yii::t('app', 'Ubah'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
