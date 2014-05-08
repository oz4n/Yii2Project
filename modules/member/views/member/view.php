<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\modules\member\models\MemberModel $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Member Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'taxonomy_id',
            'school_id',
            'user_id',
            'nra',
            'name',
            'nickname',
            'unit',
            'front_photo:ntext',
            'side_photo:ntext',
            'address',
            'birth',
            'nationality',
            'religion',
            'gender',
            'marital_status',
            'job',
            'blood_group',
            'father_name',
            'mother_name',
            'father_work',
            'mother_work',
            'income_father',
            'income_mothers',
            'number_of_brothers',
            'number_of_sisters',
            'number_of_children',
            'educational_status',
            'zip_code',
            'phone_number',
            'other_phone_number',
            'relationship_phone_number',
            'email:email',
            'organizational_experience',
            'year',
            'illness',
            'height_body',
            'weight_body',
            'dress_size',
            'pants_size',
            'shoe_size',
            'hat_size',
            'membership_status',
            'status_organization',
            'identity_card',
            'identity_card_number:ntext',
            'certificate_of_organization:ntext',
            'names_recommended',
            'note',
            'create_et',
            'update_et',
        ],
    ]) ?>

</div>
