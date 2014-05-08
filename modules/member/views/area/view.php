<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var \app\modules\member\models\AreaModel $model
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
        <a href="<?php echo Url::toRoute('/member/area/index'); ?>"><?php echo Yii::t('app', Html::encode('Daerah')); ?></a>
    </li>
    <li class="active">
        <?php echo Yii::t('app', Html::encode($this->title)); ?>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="text-center text-left-sm">
                <i class="fa fa-sitemap page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Lihat Detail') ?>
                <?= Yii::t('app', 'atau'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass} Baru', [
                    'modelClass' => 'Daerah',
                ]), ['create'])
                ?>
            </h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-body">
                <?=
                DetailView::widget([
                    'model' => $model,
                    'options' => ['class'=>'table'],
                    'attributes' => [
                        'id',
                        'parent_id',
                        'term_id',
                        'name',
                        'description',
                        'count',
                        'slug',
                        'status',
                        'position',
                        'lft',
                        'rgt',
                        'root',
                        'level',
                        'create_et',
                        'update_et',
                    ],
                ])
                ?>
            </div>
        </div>
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
        ])
        ?>
    </div>
</div>






