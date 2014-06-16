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
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">Lis data impor</span>
            </div>
            <div class="panel-body">

                <div class="table-responsive">
                    <?php
                    $objPHPExcel = \PHPExcel_IOFactory::load(\Yii::getAlias('@web') . 'resources/report/import/' . $uniq);

                    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                        $worksheetTitle = $worksheet->getTitle();
                        $highestRow = $worksheet->getHighestRow(); // e.g. 10
                        $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                        $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
                        $nrColumns = ord($highestColumn) - 64;
                        echo '<table id="table-import" class="table">';
                        echo '<thead style="display:none">';
                        for ($row = 5; $row <= $highestRow; ++$row) {
                            if ($row === 5) {
                                echo '<tr>';
                                for ($col = 0; $col < $highestColumnIndex; ++$col) {
                                    $cell = $worksheet->getCellByColumnAndRow($col, $row);
                                    $val = $cell->getValue();
                                    switch ($col) {
                                        case 0;
                                            echo "<th data-val='$col'>number</th>";
                                            break;
                                        case 1;
                                            echo "<th data-val='$col'>nra</th>";
                                            break;
                                        case 2;
                                            echo "<th data-val='$col'>name</th>";
                                            break;
                                        case 3;
                                            echo "<th data-val='$col'>nickname</th>";
                                            break;
                                        case 4;
                                            echo "<th data-val='$col'>identity_card_number</th>";
                                            break;
                                        case 5;
                                            echo "<th data-val='$col'>birth</th>";
                                            break;
                                        case 6;
                                            echo "<th data-val='$col'>age</th>";
                                            break;
                                        case 7;
                                            echo "<th data-val='$col'>address</th>";
                                            break;
                                        case 8;
                                            echo "<th data-val='$col'>gender</th>";
                                            break;
                                        case 9;
                                            echo "<th data-val='$col'>religion</th>";
                                            break;
                                        case 10;
                                            echo "<th data-val='$col'>nationality</th>";
                                            break;
                                        case 11;
                                            echo "<th data-val='$col'>taxonomy_id</th>"; //asal daerah
                                            break;
                                        case 12;
                                            echo "<th data-val='$col'>tribal_members</th>";
                                            break;
                                        case 13;
                                            echo "<th data-val='$col'>school_id</th>"; // asal sekolah
                                            break;
                                        case 14;
                                            echo "<th data-val='$col'>zip_code</th>";
                                            break;
                                        case 15;
                                            echo "<th data-val='$col'>blood_group</th>";
                                            break;
                                        case 16;
                                            echo "<th data-val='$col'>brevetaward</th>";
                                            break;
                                        case 17;
                                            echo "<th data-val='$col'>organizational_experience</th>";
                                            break;
                                        case 18;
                                            echo "<th data-val='$col'>illness</th>";
                                            break;
                                        case 19;
                                            echo "<th data-val='$col'>height_body</th>";
                                            break;
                                        case 20;
                                            echo "<th data-val='$col'>weight_body</th>";
                                            break;
                                        case 21;
                                            echo "<th data-val='$col'>dress_size</th>";
                                            break;
                                        case 22;
                                            echo "<th data-val='$col'>pants_size</th>";
                                            break;
                                        case 23;
                                            echo "<th data-val='$col'>shoe_size</th>";
                                            break;
                                        case 24;
                                            echo "<th data-val='$col'>hat_size</th>";
                                            break;
                                        case 25;
                                            echo "<th data-val='$col'>membership_status</th>";
                                            break;
                                        case 26;
                                            echo "<th data-val='$col'>status_organization</th>";
                                            break;
                                        case 27;
                                            echo "<th data-val='$col'>year</th>";
                                            break;
                                        case 28;
                                            echo "<th data-val='$col'>educational_status</th>";
                                            break;
                                        case 29;
                                            echo "<th data-val='$col'>marital_status</th>";
                                            break;
                                        case 30;
                                            echo "<th data-val='$col'>job</th>";
                                            break;
                                        case 31;
                                            echo "<th data-val='$col'>email</th>";
                                            break;
                                        case 32;
                                            echo "<th data-val='$col'>phone_number</th>";
                                            break;
                                        case 33;
                                            echo "<th data-val='$col'>other_phone_number</th>";
                                            break;
                                        case 34;
                                            echo "<th data-val='$col'>relationship_phone_number</th>";
                                            break;
                                        case 35;
                                            echo "<th data-val='$col'>father_name</th>";
                                            break;
                                        case 36;
                                            echo "<th data-val='$col'>mother_name</th>";
                                            break;
                                        case 37;
                                            echo "<th data-val='$col'>father_work</th>";
                                            break;
                                        case 38;
                                            echo "<th data-val='$col'>mother_work</th>";
                                            break;
                                        case 39;
                                            echo "<th data-val='$col'>income_father</th>";
                                            break;
                                        case 40;
                                            echo "<th data-val='$col'>income_mothers</th>";
                                            break;
                                        case 41;
                                            echo "<th data-val='$col'>number_of_brothers</th>";
                                            break;
                                        case 42;
                                            echo "<th data-val='$col'>number_of_sisters</th>";
                                            break;
                                        case 43;
                                            echo "<th data-val='$col'>number_of_children</th>";
                                            break;
                                        case 44;
                                            echo "<th data-val='$col'>languageskill</th>";
                                            break;
                                        case 45;
                                            echo "<th data-val='$col'>lifeskill</th>";
                                            break;
                                        case 46;
                                            echo "<th data-val='$col'>note</th>";
                                            break;
                                    }
//                switch ($col) {
//                    case 0;
//                        echo "<th data-val='$col'>number</th>";
//                        break;
//                    case 1;
//                        echo "<th data-val='$col'>nra</th>";
//                        break;
//                    case 2;
//                        echo "<th data-val='$col'>name</th>";
//                        break;
//                    case 3;
//                        echo "<th data-val='$col'>nickname</th>";
//                        break;
//                    case 4;
//                        echo "<th data-val='$col'>identity_card</th>";
//                        break;
//                    case 5;
//                        echo "<th data-val='$col'>birth</th>";
//                        break;
//                    case 6;
//                        echo "<th data-val='$col'>age</th>";
//                        break;
//                    case 7;
//                        echo "<th data-val='$col'>address</th>";
//                        break;
//                    case 8;
//                        echo "<th data-val='$col'>gender</th>";
//                        break;
//                    case 9;
//                        echo "<th data-val='$col'>religion</th>";
//                        break;
//                    case 10;
//                        echo "<th data-val='$col'>nationality</th>";
//                        break;
//                    case 11;
//                        echo "<th data-val='$col'>taxonomy_id</th>"; //asal daerah
//                        break;
//                    case 12;
//                        echo "<th data-val='$col'>tribal_members</th>";
//                        break;
//                    case 13;
//                        echo "<th data-val='$col'>school_id</th>"; // asal sekolah
//                        break;
//                    case 14;
//                        echo "<th data-val='$col'>zip_code</th>";
//                        break;
//                    case 15;
//                        echo "<th data-val='$col'>blood_group</th>";
//                        break;
//                    case 16;
//                        echo "<th data-val='$col'>brevet_award</th>";
//                        break;
//                    case 17;
//                        echo "<th data-val='$col'>organizational_experience</th>";
//                        break;
//                    case 18;
//                        echo "<th data-val='$col'>illness</th>";
//                        break;
//                    case 19;
//                        echo "<th data-val='$col'>height_body</th>";
//                        break;
//                    case 20;
//                        echo "<th data-val='$col'>weight_body</th>";
//                        break;
//                    case 21;
//                        echo "<th data-val='$col'>dress_size</th>";
//                        break;
//                    case 22;
//                        echo "<th data-val='$col'>pants_size</th>";
//                        break;
//                    case 23;
//                        echo "<th data-val='$col'>shoe_size</th>";
//                        break;
//                    case 24;
//                        echo "<th data-val='$col'>hat_size</th>";
//                        break;
//                    case 25;
//                        echo "<th data-val='$col'>membership_status</th>";
//                        break;
//                    case 26;
//                        echo "<th data-val='$col'>status_organization</th>";
//                        break;
//                    case 27;
//                        echo "<th data-val='$col'>year</th>";
//                        break;
//                    case 28;
//                        echo "<th data-val='$col'>educational_status</th>";
//                        break;
//                    case 29;
//                        echo "<th data-val='$col'>marital_status</th>";
//                        break;
//                    case 30;
//                        echo "<th data-val='$col'>job</th>";
//                        break;
//                    case 31;
//                        echo "<th data-val='$col'>email</th>";
//                        break;
//                    case 32;
//                        echo "<th data-val='$col'>phone_number</th>";
//                        break;
//                    case 33;
//                        echo "<th data-val='$col'>other_phone_number</th>";
//                        break;
//                    case 34;
//                        echo "<th data-val='$col'>relationship_phone_number</th>";
//                        break;
//                    case 35;
//                        echo "<th data-val='$col'>father_name</th>";
//                        break;
//                    case 36;
//                        echo "<th data-val='$col'>mother_name</th>";
//                        break;
//                    case 37;
//                        echo "<th data-val='$col'>father_work</th>";
//                        break;
//                    case 38;
//                        echo "<th data-val='$col'>mother_work</th>";
//                        break;
//                    case 39;
//                        echo "<th data-val='$col'>income_father</th>";
//                        break;
//                    case 40;
//                        echo "<th data-val='$col'>income_mother</th>";
//                        break;
//                    case 41;
//                        echo "<th data-val='$col'>number_of_brothers</th>";
//                        break;
//                    case 42;
//                        echo "<th data-val='$col'>number_of_sisters</th>";
//                        break;
//                    case 43;
//                        echo "<th data-val='$col'>number_of_children</th>";
//                        break;
//                    case 44;
//                        echo "<th data-val='$col'>language_skill</th>";
//                        break;
//                    case 45;
//                        echo "<th data-val='$col'>life_skill</th>";
//                        break;
//                    case 46;
//                        echo "<th data-val='$col'>note</th>";
//                        break;
//                }
                                }
//            echo "<th>front_photo</th>";
                                echo '</tr>';
                            }
                        }
                        echo '</thead>';


                        for ($row = 5; $row <= $highestRow; ++$row) {
                            if ($row === 5) {
                                echo '<tr>';
                                for ($col = 0; $col < $highestColumnIndex; ++$col) {
                                    $cell = $worksheet->getCellByColumnAndRow($col, $row);
                                    $val = $cell->getValue();
                                    echo "<th data-val='$col'>" . $val . '</th>';
                                }
//            echo "<th>Photo Tampak Depan</th>";
                                echo '</tr>';
                            } else {
                                echo '<tr>';
                                for ($col = 0; $col < $highestColumnIndex; ++$col) {
                                    $cell = $worksheet->getCellByColumnAndRow($col, $row);
                                    $val = $cell->getValue();
                                    switch ($col) {
                                        case 1;
                                            echo '<td data-vale="' . $col . '">' . Html::tag("a", $val, ["href" => 'javascript:undefined;', 'class' => 'edit-nra', 'data-type' => 'text', 'data-title' => 'NRA']) . '</td>';
                                            break;
                                        case 2;
                                            echo '<td data-vale="' . $col . '">' . Html::tag("a", $val, ["href" => 'javascript:undefined;', 'class' => 'edit-name', 'data-type' => 'text', 'data-title' => 'Nama Lengkap']) . '</td>';
                                            break;
                                        case 3;
                                            echo '<td data-vale="' . $col . '">' . Html::tag("a", $val, ["href" => 'javascript:undefined;', 'class' => 'edit-nickname', 'data-type' => 'text', 'data-title' => 'Nama Panggilan']) . '</td>';
                                            break;
//                                        case 4;
//
//                                            break;
//                                        case 5;
//
//                                            break;
//                                        case 6;
//
//                                            break;
//                                        case 7;
//
//                                            break;
//                                        case 8;
//
//                                            break;
//                                        case 9;
//
//                                            break;
//                                        case 10;
//
//                                            break;
//                                        case 11;
//
//                                            break;
//                                        case 12;
//
//                                            break;
//                                        case 13;
//
//                                            break;
//                                        case 14;
//
//                                            break;
//                                        case 15;
//
//                                            break;
//                                        case 16;
//
//                                            break;
//                                        case 17;
//
//                                            break;
//                                        case 18;
//
//                                            break;
//                                        case 19;
//
//                                            break;
//                                        case 20;
//
//                                            break;
//                                        case 21;
//
//                                            break;
//                                        case 22;
//
//                                            break;
//                                        case 23;
//
//                                            break;
//                                        case 24;
//
//                                            break;
//                                        case 25;
//
//                                            break;
//                                        case 26;
//
//                                            break;
//                                        case 27;
//
//                                            break;
//                                        case 28;
//
//                                            break;
//                                        case 29;
//
//                                            break;
//                                        case 30;
//
//                                            break;
//                                        case 31;
//
//                                            break;
//                                        case 32;
//
//                                            break;
//                                        case 33;
//
//                                            break;
//                                        case 34;
//
//                                            break;
//                                        case 35;
//
//                                            break;
//                                        case 36;
//
//                                            break;
//                                        case 37;
//
//                                            break;
//                                        case 38;
//
//                                            break;
//                                        case 39;
//
//                                            break;
//                                        case 40;
//
//                                            break;
//                                        case 41;
//
//                                            break;
//                                        case 42;
//
//                                            break;
//                                        case 43;
//
//                                            break;
//                                        case 44;
//
//                                            break;
//                                        case 45;
//
//                                            break;
//                                        case 46;
//
//                                            break;
                                        default;
                                            echo '<td data-vale="' . $col . '">' . Html::a($val, '#', ['class' => 'edit-table', 'data-type' => 'text', 'data-title' => 'Perbaharui']) . '</td>';
                                    }
                                }
//            echo '<td>' . Html::tag("a", "Tambahkan Photo Tampak Depan", ["href" => 'javascript:undefined;', 'class' => 'edit-front-photo', 'data-type' => 'file', 'data-title' => 'Photo Tampak Depan']) . '</td>';
                                echo '</tr>';
                            }
                        }
                        echo '</table>';
                    }
                    ?>
                </div>
            </div>
            <div class="panel-footer">
<?php $form = ActiveForm::begin(['action'=>  Url::toRoute(['/member/tools/saveimport','action'=>'member-tools-saveimport']),'options' => ["class" => 'form-inline']]) ?>
<?=
$form->field($model, 'type_member')->dropDownList([
    'PPI' => 'PPI',
    'Paskibra' => 'Paskibra',
    'Capas' => 'Capas',
        ], ['id' => 'select-save_status', 'maxlength' => 8])->label("Status Anggota");
?>
                <?=
                $form->field($model, 'save_status')->dropDownList([
                    'Status Penyimpanan' => "Status Penyimpanan",
                    'Draft' => 'Draft',
                    'Publish' => 'Publish',
                    'Trash' => 'Trash',
                    'Pending' => 'Pending',
                        ], ['id' => 'select-save_status', 'maxlength' => 8])->label("");
                ?>
                <?= Html::activehiddenInput($model, "member_data", ["id" => "import-data"]) ?>
                <?= Html::submitButton(Html::tag('i', '', ['class' => 'fa fa-check']) . '&nbsp;&nbsp;' . Yii::t('app', 'Simpan'), ['style' => "margin-top:-6px", 'id' => 'convert-table', 'class' => 'btn btn-success']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>

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