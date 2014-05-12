<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\member\searchs\PaskibraSerch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="member-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'taxonomy_id') ?>

    <?= $form->field($model, 'school_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'nra') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'nickname') ?>

    <?php // echo $form->field($model, 'front_photo') ?>

    <?php // echo $form->field($model, 'side_photo') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'birth') ?>

    <?php // echo $form->field($model, 'nationality') ?>

    <?php // echo $form->field($model, 'religion') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'marital_status') ?>

    <?php // echo $form->field($model, 'job') ?>

    <?php // echo $form->field($model, 'income_member') ?>

    <?php // echo $form->field($model, 'blood_group') ?>

    <?php // echo $form->field($model, 'father_name') ?>

    <?php // echo $form->field($model, 'mother_name') ?>

    <?php // echo $form->field($model, 'father_work') ?>

    <?php // echo $form->field($model, 'mother_work') ?>

    <?php // echo $form->field($model, 'income_father') ?>

    <?php // echo $form->field($model, 'income_mothers') ?>

    <?php // echo $form->field($model, 'number_of_brothers') ?>

    <?php // echo $form->field($model, 'number_of_sisters') ?>

    <?php // echo $form->field($model, 'number_of_children') ?>

    <?php // echo $form->field($model, 'educational_status') ?>

    <?php // echo $form->field($model, 'zip_code') ?>

    <?php // echo $form->field($model, 'phone_number') ?>

    <?php // echo $form->field($model, 'other_phone_number') ?>

    <?php // echo $form->field($model, 'relationship_phone_number') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'organizational_experience') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'illness') ?>

    <?php // echo $form->field($model, 'height_body') ?>

    <?php // echo $form->field($model, 'weight_body') ?>

    <?php // echo $form->field($model, 'dress_size') ?>

    <?php // echo $form->field($model, 'pants_size') ?>

    <?php // echo $form->field($model, 'shoe_size') ?>

    <?php // echo $form->field($model, 'hat_size') ?>

    <?php // echo $form->field($model, 'brevetaward') ?>

    <?php // echo $form->field($model, 'lifeskill') ?>

    <?php // echo $form->field($model, 'languageskill') ?>

    <?php // echo $form->field($model, 'membership_status') ?>

    <?php // echo $form->field($model, 'status_organization') ?>

    <?php // echo $form->field($model, 'type_member') ?>

    <?php // echo $form->field($model, 'tribal_members') ?>

    <?php // echo $form->field($model, 'identity_card') ?>

    <?php // echo $form->field($model, 'certificate_of_organization') ?>

    <?php // echo $form->field($model, 'identity_card_number') ?>

    <?php // echo $form->field($model, 'names_recommended') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'other_content') ?>

    <?php // echo $form->field($model, 'save_status') ?>

    <?php // echo $form->field($model, 'create_et') ?>

    <?php // echo $form->field($model, 'update_et') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
