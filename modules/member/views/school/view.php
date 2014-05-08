<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var app\modules\member\models\SchoolModel $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'School Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?php echo Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?php echo Url::toRoute('/dashboard/dashboard/index'); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute('/member/school/index'); ?>"><?php echo Yii::t('app', Html::encode('Sekolah')); ?></a>
    </li>
    <li class="active">
        <?= Yii::t('app', 'Lihat Detail Sekolah'); ?>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa fa-home page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Lihat Detail Sekolah') ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass} Baru', [
                    'modelClass' => 'Sekolah',
                ]), ['create'])
                ?>
            </h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'taxonomy_id',
                'name',
                'type',
                'address',
                'email:email',
                'zip_code',
                'phone_number',
                'create_et',
                'update_et',
            ],
        ])
        ?>
    </div>

</div>
<div class="row">
    <div class="col-sm-12">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>
</div>
