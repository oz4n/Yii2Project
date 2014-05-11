<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use app\modules\member\searchs\AreaSerch;

/**
 * @var yii\web\View $this
 * @var app\modules\member\models\AreaModel $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerJs(
    "$('ul.navigation > li.mm-dropdown > ul > li#area').addClass('active').parent().parent().addClass('active open');"
    , View::POS_READY);
?>


<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
<?= $form->field($model, 'parent_id')->dropDownList(AreaSerch::getParents()) ?>
<?= $form->field($model, 'description')->textarea(['rows' => 6, 'maxlength' => 255]) ?>
<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
