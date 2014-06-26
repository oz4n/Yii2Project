<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJs(''
        . "$('ul.navigation > li#database > ul.mm-dropdown > li#tools > ul.mm-dropdown > li#tools-import').addClass('active').parent().parent().addClass('open').parent().parent().addClass('active open');"
        . '
	init.push(function () {
	    $("#file-xls").pixelFileInput({ placeholder: "Pilih file..." });
	})'
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
                <i class="fa fa-files-o page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Impor Data Anggota') ?>
            </h1>
        </div>
        <div class="col-xs-4">

        </div>
    </div>
</div>
<div class="row" style="margin-bottom: 15px">   
    <div class="col-sm-6">
        <?php if (Yii::$app->getSession()->hasFlash('import_valid_info')): ?>
            <div class="alert alert-danger">
                <p>Format file .xlsx Yang anda unggah tidak sesuai dengan format yang sudah di tentukan.</p>
                <p>Silahkan download format data Anggota yang diperbolehkan pada tautan di bawah ini.</p>
                <ol>
                    <li><?= Html::a('Unduh Format Data Anggota Purna Paskibraka Indonesia', ['/member/tools/download','action'=>'member-tools-download','file'=>'ppi'], ['style' => 'color:#b94a48;','data-method' => 'post', 'data-confirm' => 'Tekan ok untuk mengunduh file format untuk ppi?']) ?></li>
                    <li><?= Html::a('Unduh Format Data Anggota Paskibra', ['/member/tools/download','action'=>'member-tools-download','file'=>'paskibra'], ['style' => 'color:#b94a48;','data-method' => 'post', 'data-confirm' => 'Tekan ok untuk mengunduh file format untuk paskibra?']) ?></li>
                    <li><?= Html::a('Unduh Format Data Calon Anggota Paskibra', ['/member/tools/download','action'=>'member-tools-download','file'=>'capas'], ['style' => 'color:#b94a48;','data-method' => 'post', 'data-confirm' => 'Tekan ok untuk mengunduh file format untuk capas?']) ?></li>
                </ol>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                <p>
                    Sebelum melakukan impor data anggota sebaiknya anda mengikuti format yang sudah di tentukan. Silahkan download format data anggota pada tautan di bawah ini
                </p>
                <ol>
                    <li><?= Html::a('Unduh Format Data Anggota Purna Paskibraka Indonesia', ['/member/tools/download','action'=>'member-tools-download','file'=>'ppi'],['data-method' => 'post', 'data-confirm' => 'Tekan ok untuk mengunduh file format untuk ppi?']) ?></li>
                    <li><?= Html::a('Unduh Format Data Anggota Paskibra', ['/member/tools/download','action'=>'member-tools-download','file'=>'paskibra'],['data-method' => 'post', 'data-confirm' => 'Tekan ok untuk mengunduh file format untuk paskibra?']) ?></li>
                    <li><?= Html::a('Unduh Format Data Calon Anggota Paskibra', ['/member/tools/download','action'=>'member-tools-download','file'=>'capas'],['data-method' => 'post', 'data-confirm' => 'Tekan ok untuk mengunduh file format untuk capas?']) ?></li>
                </ol>
            </div>
        <?php endif; ?>
        <?php
        ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])
        ?>

        <div class="form-group">
            <?=
            Html::fileInput('file', null, ['id' => 'file-xls', 'accept' => '.xls,.xlsx,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel', 'class' => 'form-control'])
            ?>           
        </div>
        <div class="form-group">
            <?=
            Html::dropDownList('member_type', null, [
                "Capas" => "Anggota Capas",
                "PPI" => "Aanggota PPI",
                "Paskibra" => "Anggota Paskibra",
                    ], ['class' => 'form-control'])
            ?> 
        </div>

        <div class="form-group">
            <?= Html::submitButton(Html::tag('i', '', ['class' => 'fa fa-check']) . '&nbsp;&nbsp;' . Yii::t('app', 'Impor'), ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
    <div class="col-sm-6">

    </div>

</div>
