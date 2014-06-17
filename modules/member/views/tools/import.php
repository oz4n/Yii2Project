<?php


use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile('PixelAdmin/js/jquery.2.0.3.min.js', [], ['position' => View::POS_HEAD]);
$this->registerJs(''
    . "$('ul.navigation > li#database > ul.mm-dropdown > li#tools > ul.mm-dropdown > li#tools-import').addClass('active').parent().parent().addClass('open').parent().parent().addClass('active open');"
    . '
	init.push(function () {
	    $("#file-xls").pixelFileInput({ placeholder: "Pilih file..." });
	})
				'
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
    <?php ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'form-inline']]) ?>

    <div class="col-sm-4">
        <?= Html::fileInput('file', null, ['id' => 'file-xls', 'accept' => '.xls,.xlsx,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel', 'class' => 'form-control']) ?>
    </div>
    <div class="col-sm-8">
        <?= Html::submitButton(Html::tag('i', '', ['class' => 'fa fa-check']) . '&nbsp;&nbsp;' . Yii::t('app', 'Impor'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end() ?>
</div>
