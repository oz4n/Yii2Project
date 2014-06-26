<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
<div class="row">
    <div class="col-sm-12">

        <?php
        if ($member === "PPI" || $member === "Paskibra") {
            echo $this->render('_ppi_paskibra_list_view', [
                'model' => $model,
                'member' => $member,
                'file' => $file
            ]);
        } else if ($member == "Capas") {
            echo $this->render('_capas', [
                'model' => $model,
                'member' => $member,
                'file' => $file
            ]);
        } else {
            echo "asdasd";
        }
        ?>
        <?php
        $this->registerJs(
                '
    $("#convert-table").click( function() {
        var table = $("#table-import").tableToJSON();
        $("#import-data").attr("value",JSON.stringify(table));
        console.log(table);
    });
    init.push(function () {
        $(".edit-table").editable({
            type: "text",
            name: "username",
            title: "Enter username"
        });
        $(".edit-nra").editable({
            validate: function(value) {
                if($.trim(value) == "") return "Tidak boleh kosong";
            }
        });
        $(".edit-name").editable({
            validate: function(value) {
                if($.trim(value) == "") return "Tidak boleh kosong";
            }
        });
        $(".edit-nickname").editable({
            validate: function(value) {
                if($.trim(value) == "") return "Tidak boleh kosong";
            }
        });
        $(".edit-address").editable({
            showbuttons: "bottom"
        });
    });
    '
                , View::POS_READY);
        ?>
    </div>
</div>