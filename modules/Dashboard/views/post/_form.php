<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\ActiveRecord\Post $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="post-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

		<?= $form->field($model, 'slug')->textarea(['rows' => 6]) ?>

		<?= $form->field($model, 'create_time')->textInput() ?>

		<?= $form->field($model, 'update_time')->textInput() ?>

		<?= $form->field($model, 'account_id')->textInput() ?>

		<?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>

		<?= $form->field($model, 'parent')->textInput() ?>

		<?= $form->field($model, 'status')->textInput(['maxlength' => 5]) ?>

		<?= $form->field($model, 'comment_status')->textInput(['maxlength' => 5]) ?>

		<?= $form->field($model, 'post_status')->textInput(['maxlength' => 25]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
