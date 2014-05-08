<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\member\searchs\AreaSerch;
/**
 * @var yii\web\View $this
 * @var app\modules\member\models\AreaModel $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
<?= $form->field($model, 'parent_id')->dropDownList(AreaSerch::loadParents()) ?>
<?= $form->field($model, 'description')->textarea(['maxlength' => 255]) ?>
<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
