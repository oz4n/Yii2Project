<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
USE yii\web\View;
/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Post $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerJs( "$('ul.navigation > li.mm-dropdown > ul > li#post').addClass('active').parent().parent().addClass('active open');", View::POS_READY);
?>

<div class="col-sm-8">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'title')->textInput(['placeholder'=>'Judul . . .','maxlength' => 225])->label("") ?>
    <?= $form->field($model, 'content')->textarea(['placeholder' =>'Isi . . .','rows' => 6])->label("") ?>
    <?=
    $form->field($model, 'status')->dropDownList([
        '' => 'None',
        'Publish' => 'Publish',
        'Draft' => 'Draft',
        'Trash' => 'Trash'
    ], ['id' => 'select-save_status', 'maxlength' =>15]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<div class="col-sm-4">

</div>
