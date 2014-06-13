<?php


use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
$this->registerJsFile('PixelAdmin/js/jquery.2.0.3.min.js', [], ['position' => View::POS_HEAD]);
$this->registerJs(''
        . "$('ul.navigation > li#database > ul.mm-dropdown > li#tools > ul.mm-dropdown > li#tools-import').addClass('active').parent().parent().addClass('open').parent().parent().addClass('active open');"
        , View::POS_READY);
$this->title = "Impor Data Anggota";
?>

<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?= Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?= Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard-list']); ?>"><?= Yii::t('app', 'Beranda'); ?></a>
    </li>    
    <li class="active">
        Impor
    </li>
</ul>

<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa fa-file page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Impor Data Anggota') ?>                            
            </h1>
        </div>
        <div class="col-xs-4">

        </div>
    </div>
</div>