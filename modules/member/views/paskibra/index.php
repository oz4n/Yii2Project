<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\member\searchs\PaskibraSerch $searchModel
 */

$this->title = Yii::t('app', 'Members');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'Member',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'taxonomy_id',
            'school_id',
            'user_id',
            'nra',
            // 'name',
            // 'nickname',
            // 'front_photo:ntext',
            // 'side_photo:ntext',
            // 'address',
            // 'birth',
            // 'nationality',
            // 'religion',
            // 'gender',
            // 'age',
            // 'marital_status',
            // 'job',
            // 'income_member',
            // 'blood_group',
            // 'father_name',
            // 'mother_name',
            // 'father_work',
            // 'mother_work',
            // 'income_father',
            // 'income_mothers',
            // 'number_of_brothers',
            // 'number_of_sisters',
            // 'number_of_children',
            // 'educational_status',
            // 'zip_code',
            // 'phone_number',
            // 'other_phone_number',
            // 'relationship_phone_number',
            // 'email:email',
            // 'organizational_experience',
            // 'year',
            // 'illness',
            // 'height_body',
            // 'weight_body',
            // 'dress_size',
            // 'pants_size',
            // 'shoe_size',
            // 'hat_size',
            // 'brevetaward',
            // 'lifeskill',
            // 'languageskill',
            // 'membership_status',
            // 'status_organization',
            // 'type_member',
            // 'tribal_members',
            // 'identity_card:ntext',
            // 'certificate_of_organization:ntext',
            // 'identity_card_number',
            // 'names_recommended',
            // 'note',
            // 'other_content:ntext',
            // 'save_status',
            // 'create_et',
            // 'update_et',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
