<?php

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\File $model
 */

$this->title = "Tambah Dokumen";
$this->registerJs(
    "$('ul.navigation > li.mm-dropdown > ul > li#document').addClass('active').parent().parent().addClass('active open');"
    , View::POS_READY);
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?= Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?= Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard']); ?>"><?= Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?= Url::toRoute(['/filemanager/document/index', 'action' => 'filemanager-document-list']); ?>"><?= Yii::t('app', Html::encode('Dokumen')); ?></a>
    </li>
    <li class="active">
        Tambah Dokumen
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa  fa-file-o page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Dokumen') ?>
               
            </h1>
        </div>
        <div class="col-xs-4">
            
        </div>
    </div>
</div>
<div class="row">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
