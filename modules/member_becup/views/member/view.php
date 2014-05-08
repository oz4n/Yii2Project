<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use Yii;
/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Member $model
 */

$this->title = $model->name;
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?php echo Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?php echo Url::toRoute('/dashboard/dashboard/index'); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute('/member/member/index'); ?>"><?php echo Yii::t('app', Html::encode('Anggota')); ?></a>
    </li>
    <li class="active">
        <?php echo Yii::t('app','Lihat Detail') . ' : ' . $this->title; ?>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="menu-icon fa fa-users page-header-icon"> </i>
                &nbsp;
                <?= Html::encode(Yii::t('app','Lihat Detail')) ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass} Baru', [
                    'modelClass' => 'Anggota',
                ]), ['create'])
                ?>
            </h1>
        </div>
        <div class="col-xs-4">

        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-3">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])
        ?>
    </div>
    <div class="col-sm-9">
        <div class="panel">
            <div class="panel-body">
                <?=
                DetailView::widget([
                    'model' => $model,
                    'options' => ['class' => 'table'],
                    'attributes' => [
                        'id',
                        'province_id',
                        'school_id',
                        'user_id',
                        'nra',
                        'name',
                        'nickname:ntext',
                        'unit',
                        'front_photo:ntext',
                        'side_photo',
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
                ])
                ?>
            </div>
        </div>
    </div>
</div>

