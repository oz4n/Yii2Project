<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var \app\modules\member\models\AreaModel $model
 */

$this->title = Yii::t('app', 'Perbaharui {modelClass} ', [
    'modelClass' => 'daerah',
]);
?>

<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?php echo Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?php echo Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard-list']); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute(['/member/area/index', 'action' => 'member-area-list']); ?>"><?php echo Yii::t('app', Html::encode('Daerah')); ?></a>
    </li>
    <li class="active">
        <?php echo Yii::t('app', Html::encode($this->title . ' : ' . $model->name)); ?>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="text-center text-left-sm">
                <i class="fa  fa-map-marker page-header-icon"> </i>
                &nbsp;
                <?= Html::encode($this->title) ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass} Baru', [
                    'modelClass' => 'Daerah',
                ]), Url::toRoute(['/member/area/create', 'action' => 'member-area-create']))
                ?>
            </h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>
    </div>
    <div class="col-sm-6">

    </div>
</div>

