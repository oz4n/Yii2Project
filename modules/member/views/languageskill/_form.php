<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\member\models\search\LanguageSkillSerch;

/**
 * @var yii\web\View $this
 * @var app\modules\member\models\LanguageSkillModel $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="language-skill-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_id')->dropDownList(LanguageSkillSerch::loadParents()); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

<?= $form->field($model, 'status')->dropDownList(['Publish' => 'Publish', 'Draft' => 'Draft'], ['maxlength' => 45]) ?>


    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
