<?php

use yii\helpers\Html;
use yii\helpers\Url;
/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\AuthItem $model
 */

$this->title = Yii::t('app', 'Tambah {modelClass}', [
    'modelClass' => 'Hak Akses',
]);
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?php echo Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?php echo Url::toRoute(['/dashboard/dashboard/index','action'=>'dashboard-list']); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute(['/user/admin/index','action'=>'user-list']); ?>"><?php echo Yii::t('app', Html::encode('Pengguna')); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute(['/userrbac/rule/index','action'=>'user-rule-list']); ?>"><?php echo Yii::t('app', Html::encode('Hak Akses')); ?></a>
    </li>
    <li class="active">
        <?php echo Yii::t('app', Html::encode($this->title)); ?>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm">
            <i class="fa  fa-barcode page-header-icon"> </i>
            &nbsp;
            <?= Html::encode('Hak Akses') ?>
        </h1>

    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?=
        $this->render('_form', [
            'model' => $model,
            'ruleparent' => null
        ]) 
        ?>
    </div>
</div>
