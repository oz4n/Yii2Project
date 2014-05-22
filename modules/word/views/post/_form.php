<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use app\modules\word\searchs\PostSerch;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Post $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerJs("$('ul.navigation > li.mm-dropdown > ul > li#post').addClass('active').parent().parent().addClass('active open');", View::POS_READY);
?>
<?php $form = ActiveForm::begin(); ?>
    <div class="col-sm-8">

        <?= $form->field($model, 'title')->textInput(['placeholder' => 'Judul . . .', 'maxlength' => 225])->label("") ?>
        <?= $form->field($model, 'content')->textarea(['placeholder' => 'Isi . . .', 'rows' => 6])->label("") ?>
        <?=
        $form->field($model, 'status')->dropDownList([
            '' => 'None',
            'Publish' => 'Publish',
            'Draft' => 'Draft',
            'Trash' => 'Trash'
        ], ['id' => 'select-save_status', 'maxlength' => 15]);
        ?>

    </div>

    <div class="col-sm-4">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">Kategory</span>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?=  Html::activeCheckboxList($model, 'status',PostSerch::getCategories()) ?>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">Tag</span>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?=  Html::activeDropDownList($model, 'tag',PostSerch::getTags()) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>