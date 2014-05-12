<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Member $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="member-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'taxonomy_id')->textInput() ?>

    <?= $form->field($model, 'school_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'number_of_brothers')->textInput() ?>

    <?= $form->field($model, 'number_of_sisters')->textInput() ?>

    <?= $form->field($model, 'number_of_children')->textInput() ?>

    <?= $form->field($model, 'nra')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'nickname')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'birth')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'nationality')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'religion')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'gender')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'marital_status')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'blood_group')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'father_name')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'mother_name')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'educational_status')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'other_phone_number')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'relationship_phone_number')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'illness')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'height_body')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'weight_body')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'membership_status')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'status_organization')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'type_member')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'tribal_members')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'identity_card_number')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'names_recommended')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'save_status')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'front_photo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'side_photo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'identity_card')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'certificate_of_organization')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'other_content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'create_et')->textInput() ?>

    <?= $form->field($model, 'update_et')->textInput() ?>

    <?= $form->field($model, 'job')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'income_member')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'father_work')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'mother_work')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'income_father')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'income_mothers')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'organizational_experience')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'brevetaward')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'lifeskill')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'languageskill')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'zip_code')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'dress_size')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'pants_size')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'shoe_size')->textInput(['maxlength' => 5]) ?>

    <?= $form->field($model, 'hat_size')->textInput(['maxlength' => 5]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
