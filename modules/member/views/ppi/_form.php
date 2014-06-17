<?php

use Yii;
use yii\helpers\Html;
use yii\web\View;

use yii\bootstrap\ActiveForm;
use app\modules\member\searchs\PpiSerch;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Member $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerJs(
    "$('ul.navigation > li#database > ul.mm-dropdown > li#member > ul.mm-dropdown > li#ppi').addClass('active').parent().parent().addClass('open').parent().parent().addClass('active open');"
    . "init.push(function () { $('#birth-date').datepicker({language:'id',format: 'dd MM yyyy'});});"
    . 'init.push(function () { '
    . '$(".select2-results").slimScroll({height: 190 });'
    . '$("#select-year").select2({ allowClear: true, placeholder: "Tahun angkatan"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-unit").select2({ allowClear: true, placeholder: "Status pendidikan"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-membership_status").select2({ allowClear: true, placeholder: "Status angota"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-status_organization").select2({ allowClear: true, placeholder: "Status organisasi"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-marital_status").select2({ allowClear: true, placeholder: "Status perkawinan"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-job").select2({ allowClear: true, placeholder: "Pekerjaan"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-dress_size").select2({ allowClear: true, placeholder: "Ukuran baju"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-relationship_phone_number").select2({ allowClear: true, placeholder: "Status dengan no hp"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-father_work").select2({ allowClear: true, placeholder: "Pekerjaan bapak"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-mother_work").select2({ allowClear: true, placeholder: "Pekerjaan ibu"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-gender").select2({ allowClear: true, placeholder: "Jenis kelamin"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-religion").select2({ allowClear: true, placeholder: "Agama"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-blood_group").select2({ allowClear: true, placeholder: "Golongan darah"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-school").select2({ allowClear: true, placeholder: "Asal sekolah"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-area").select2({ allowClear: true, placeholder: "Asal daerah"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-save_status").select2({ allowClear: true, placeholder: "Save status"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-languageskill").select2({ allowClear: true, placeholder: "Pilih"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-lifeskill").select2({ allowClear: true, placeholder: "Pilih"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-brevetawards").select2({ allowClear: true, placeholder: "Penghargaan"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-income_father").select2({ allowClear: true, placeholder: "Penghasilan bapak"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-income_mothers").select2({ allowClear: true, placeholder: "Penghasilan ibu"}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '});'
    , View::POS_READY);
?>

<?php
$form = ActiveForm::begin([
    'layout' => 'horizontal',
    'options' => ['novalidate' => 'novalidate', 'id' => 'member-form'],
    'fieldConfig' => [
        // 'template' => "{label}\n{input}\n{hint}\n{error}",
        'horizontalCssClasses' => [
            'label' => 'col-sm-4',
            'offset' => 'col-sm-offset-4',
            'wrapper' => 'col-sm-8',
            'error' => '',
            'hint' => '',
        ],
    ],
]);
?>
    <div class="col-xs-12 col-sm-8">
        <div class="panel colourable">
            <div class="panel-heading">
                <span class="panel-title">Data Pribadi</span>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'nra')->textInput(['maxlength' => 45]) ?>
                <?= $form->field($model, 'name')->textInput(['maxlength' => 45]) ?>
                <?= $form->field($model, 'nickname')->textInput() ?>
                <?= $form->field($model, 'identity_card_number')->textInput(['rows' => 45]) ?>
                <?= $form->field($model, 'birth')->textInput(['placeholder' => '02 Agustus 1990', 'id' => 'birth-date', 'maxlength' => 45]) ?>
                <?= $form->field($model, 'age')->textInput(['maxlength' => 3]) ?>
                <?= $form->field($model, 'address')->textarea(['style' => 'resize:none', 'rows' => 6, 'maxlength' => 255]) ?>
                <?=
                $form->field($model, 'gender')->dropDownList([
                    'Laki-Laki' => 'Laki-Laki',
                    'Perempuan' => 'Perempuan',
                ], ['id' => 'select-gender', 'maxlength' => 45])
                ?>
                <?=
                $form->field($model, 'religion')->dropDownList([
                    'Islam' => 'Islam',
                    'Katholik' => 'Katholik',
                    'Protestan' => 'Protestan',
                    'Hindu' => 'Hindu',
                    'Budha' => 'Budha',
                    'Konghuchu' => 'Konghuchu',
                ], ['id' => 'select-religion', 'maxlength' => 45])
                ?>
                <?= $form->field($model, 'nationality')->textInput(['maxlength' => 45]) ?>
                <?= $form->field($model, 'taxonomy_id')->dropDownList(PpiSerch::getAreas(), ['id' => 'select-area']) ?>
                <?= $form->field($model, 'tribal_members')->textInput(['maxlength' => 45]) ?>
                <?= $form->field($model, 'school_id')->dropDownList(PpiSerch::getSchools(), ['id' => 'select-school']) ?>
                <?= $form->field($model, 'zip_code')->textInput(['maxlength' => 45]) ?>
                <?=
                $form->field($model, 'blood_group')->dropDownList([
                    'Golongan Darah O' => 'Golongan Darah O',
                    'Golongan Darah A' => 'Golongan Darah A',
                    'Golongan Darah B' => 'Golongan Darah B',
                    'Golongan Darah AB' => 'Golongan Darah AB',
                ], ['id' => 'select-blood_group', 'maxlength' => 45])
                ?>


                <?= $form->field($model, 'taxonomies')->dropDownList(PpiSerch::getBrevetAwards(), ['multiple' => 'multiple', 'name' => 'PpiModel[brevet_award]', 'id' => 'select-brevetawards'])->label('Brevet Penghargaan') ?>
                <?= $form->field($model, 'organizational_experience')->textInput(['maxlength' => 45]) ?>
                <?= $form->field($model, 'illness')->textInput(['maxlength' => 45]) ?>
                <?= $form->field($model, 'height_body')->textInput(['maxlength' => 45]) ?>
                <?= $form->field($model, 'weight_body')->textInput(['maxlength' => 45]) ?>
                <?=
                $form->field($model, 'dress_size')->dropDownList([
                    'S' => 'S',
                    'M' => 'M',
                    'L' => 'L',
                    'XS' => 'XS',
                    'XL' => 'XL',
                    'XXL' => 'XXL',
                    'XXXL' => 'XXXL',
                ], ['id' => 'select-dress_size', 'maxlength' => 45])
                ?>
                <?= $form->field($model, 'pants_size')->textInput(['maxlength' => 45]) ?>
                <?= $form->field($model, 'shoe_size')->textInput(['maxlength' => 45]) ?>
                <?= $form->field($model, 'hat_size')->textInput(['maxlength' => 45]) ?>
            </div>
        </div>

        <div class="panel colourable">
            <div class="panel-heading">
                <span class="panel-title">Status</span>
            </div>
            <div class="panel-body">
                <?=
                $form->field($model, 'membership_status')->dropDownList([
                    'Anggota Biasa' => 'Anggota Biasa',
                    'Anggota Kehormatan' => 'Anggota Kehormatan',
                    'Pengurus Kota' => 'Pengurus Kota',
                    'Pengurus Kab' => 'Pengurus Kab',
                    'Pengurus Provinsi' => 'Pengurus Provinsi',
                    'Pengurus Pusat' => 'Pengurus Pusat',
                ], ['id' => 'select-membership_status', 'maxlength' => 45])
                ?>
                <?=
                $form->field($model, 'status_organization')->dropDownList([
                    'Aktif' => 'Aktif',
                    'Non Aktif' => 'Non Aktif',
                    'Mutasi' => 'Mutasi',
                    'PDTH' => 'PDTH',
                ], ['id' => 'select-status_organization', 'maxlength' => 45])
                ?>
                <?= $form->field($model, 'year')->dropDownList(PpiSerch::getYears(), ['id' => 'select-year', 'maxlength' => 45]) ?>
                <?=
                $form->field($model, 'educational_status')->dropDownList([
                    'SMA' => 'SMA',
                    'SMK' => 'SMK',
                    'MA' => 'MA',
                    'S1' => 'S1',
                    'S2' => 'S2',
                    'S3' => 'S3',
                    'D2' => 'D2',
                    'S3' => 'D3',
                ], ['id' => 'select-unit', 'maxlength' => 45])
                ?>
                <?=
                $form->field($model, 'marital_status')->dropDownList([
                    'Belum Menikah' => 'Belum Menikah',
                    'Menikah' => 'Menikah',
                    'Janda' => 'Janda',
                    'Duda' => 'Duda',
                ], ['id' => 'select-marital_status', 'maxlength' => 45])
                ?>
                <?=
                $form->field($model, 'job')->dropDownList([
                    'PNS' => 'PNS',
                    'TNI/PORLI' => 'TNI/PORLI',
                    'Karyawan Swasta' => 'Karyawan Swasta',
                    'Pelajar/Mahasisawa' => 'Pelajar/Mahasisawa',
                    'Guru/Dosen' => 'Guru/Dosen',
                    'Wiraswasta' => 'Wiraswasta',
                    'Ibu Rumah Tangga' => 'Ibu Rumah Tangga',
                ], ['id' => 'select-job', 'maxlength' => 45])
                ?>
            </div>
        </div>

        <div class="panel colourable">
            <div class="panel-heading">
                <span class="panel-title">Kontak</span>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'email')->textInput(['maxlength' => 45])->label('Email', ['for' => 'jq-validation-email']) ?>
                <?= $form->field($model, 'phone_number')->textInput(['maxlength' => 45]) ?>
                <?= $form->field($model, 'other_phone_number')->textInput(['maxlength' => 45]) ?>
                <?=
                $form->field($model, 'relationship_phone_number')->dropDownList([
                    "Orang Tua" => 'Orang Tua',
                    "Kakak" => 'Kakak',
                    "Adik" => 'Adik',
                    "Keluarga" => 'Keluarga',
                    "Teman" => 'Teman',
                ], ['id' => 'select-relationship_phone_number', 'maxlength' => 45])
                ?>
            </div>
        </div>
        <div class="panel colourable">
            <div class="panel-heading">
                <span class="panel-title">Data Kekeluargaan</span>
            </div>
            <div class="panel-body">
                <?= $form->field($model, 'father_name')->textInput(['maxlength' => 45]) ?>
                <?= $form->field($model, 'mother_name')->textInput(['maxlength' => 45]) ?>
                <?=
                $form->field($model, 'father_work')->dropDownList([
                    'PNS' => 'PNS',
                    'TNI/PORLI' => 'TNI/PORLI',
                    'Karyawan Swasta' => 'Karyawan Swasta',
                    'Pelajar/Mahasisawa' => 'Pelajar/Mahasisawa',
                    'Guru/Dosen' => 'Guru/Dosen',
                    'Wiraswasta' => 'Wiraswasta',
                ], ['id' => 'select-father_work', 'maxlength' => 45])
                ?>
                <?=
                $form->field($model, 'mother_work')->dropDownList([
                    'PNS' => 'PNS',
                    'TNI/PORLI' => 'TNI/PORLI',
                    'Karyawan Swasta' => 'Karyawan Swasta',
                    'Pelajar/Mahasisawa' => 'Pelajar/Mahasisawa',
                    'Guru/Dosen' => 'Guru/Dosen',
                    'Wiraswasta' => 'Wiraswasta',
                    'Ibu Rumah Tangga' => 'Ibu Rumah Tangga',
                ], ['id' => 'select-mother_work', 'maxlength' => 45])
                ?>
                <?=
                $form->field($model, 'income_father')->dropDownList([
                    '0' => 'None',
                    'Rp.17000000 s/d Rp.19000000' => 'Rp.17000000 s/d Rp.19000000',
                    'Rp.12000000 s/d Rp.16000000' => 'Rp.12000000 s/d Rp.16000000',
                    'Rp.11000000 s/d Rp.13000000' => 'Rp.11000000 s/d Rp.13000000',
                    'Rp.8000000 s/d Rp.10000000' => 'Rp.8000000 s/d Rp.10000000',
                    'Rp.4000000 s/d Rp.7000000' => 'Rp.4000000 s/d Rp.7000000',
                    'Rp.1000000 s/d Rp.3000000' => 'Rp.1000000 s/d Rp.3000000',
                ], ['id' => 'select-income_father', 'maxlength' => 45])
                ?>
                <?=
                $form->field($model, 'income_mothers')->dropDownList([
                    '0' => 'None',
                    'Rp.17000000 s/d Rp.19000000' => 'Rp.17000000 s/d Rp.19000000',
                    'Rp.12000000 s/d Rp.16000000' => 'Rp.12000000 s/d Rp.16000000',
                    'Rp.11000000 s/d Rp.13000000' => 'Rp.11000000 s/d Rp.13000000',
                    'Rp.8000000 s/d Rp.10000000' => 'Rp.8000000 s/d Rp.10000000',
                    'Rp.4000000 s/d Rp.7000000' => 'Rp.4000000 s/d Rp.7000000',
                    'Rp.1000000 s/d Rp.3000000' => 'Rp.1000000 s/d Rp.3000000',
                ], ['id' => 'select-income_mothers', 'maxlength' => 45])
                ?>
                <?= $form->field($model, 'number_of_brothers')->textInput() ?>
                <?= $form->field($model, 'number_of_sisters')->textInput() ?>
                <?= $form->field($model, 'number_of_children')->textInput() ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-4">
    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">Keterampilan</span>
        </div>
        <div class="panel-body">

            <?php //$form->field($model, 'taxonomies')->checkboxList(PpiSerch::getLangSkills())->label('Keterampilan Bahasa Asing') ?>
            <?php //$form->field($model, 'taxonomies')->checkboxList(PpiSerch::getLifeSkills())->label('Keterampilan Personal') ?>
            <?php //$form->field($model, 'taxonomies')->checkboxList(PpiSerch::getBrevetAwards())->label('Brevet Penghargaan')   ?>
            <?php //$form->field($model, 'taxonomies')->checkboxList(PpiSerch::getLangSkills(), ['name' => 'MemberModel[language_skills][]'])->label('Keterampilan Bahasa Asing') ?>
            <div class="form-group field-ppimodel-languageskill">
                <?= Html::activeLabel($model, 'languageskill', ['class' => 'pull-left col-sm-12 ']) ?>

                <div class="col-sm-12">
                    <?= Html::activeDropDownList($model, 'taxonomies', PpiSerch::getLangSkills(), ['class' => 'form-control', 'name' => 'PpiModel[language_skill][]', 'multiple' => 'multiple', 'id' => 'select-languageskill']) ?>
                </div>
            </div>

            <div class="form-group field-ppimodel-languageskill">
                <?= Html::activeLabel($model, 'lifeskill', ['class' => 'pull-left col-sm-12 ']) ?>

                <div class="col-sm-12">
                    <?= Html::activeDropDownList($model, 'taxonomies', PpiSerch::getLifeSkills(), ['class' => 'form-control', 'name' => 'PpiModel[life_skill][]', 'multiple' => 'multiple', 'id' => 'select-lifeskill']) ?>
                </div>
            </div>

            <div class="form-group field-ppimodel-languageskill">
                <?= Html::activeLabel($model, 'otherlifeskill', ['class' => 'pull-left col-sm-12 ']) ?>

                <div class="col-sm-12">
                    <?= Html::activeTextInput($model, 'otherlifeskill', ['class' => 'form-control']) ?>
                </div>
            </div>


            <?php //$form->field($model, 'brevetaward')->textInput(['maxlength' => 45]) ?>
            <?php //$form->field($model, 'lifeskill')->textInput(['maxlength' => 45]) ?>
            <?php //$form->field($model, 'languageskill')->textInput(['maxlength' => 45]) ?>
            <?php //$form->field($model, 'taxonomies')->checkboxList(PpiSerch::getLifeSkills(), ['name' => 'MemberModel[life_skills][]'])->label('Keterampilan Personal')   ?>
            <?php //$form->field($model, 'taxonomies')->checkboxList(PpiSerch::getBrevetAwards(), ['name' => 'MemberModel[brevet_award][]'])->label('Brevet Penghargaan')   ?>

        </div>

    </div>

    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">Photo Tampak Depan</span>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <div id="preview-front-photo" class="dz-preview dz-image-preview"
                         style="<?php echo $model->front_photo == null ? "display: none;" : ""; ?> border-radius: 0px; width: 284px; margin: 0">
                        <div class="dz-details">
                            <div class="dz-size">
                                Ukuran Photo: 
                                <span data-dz-size="">
                                    <strong>120x300</strong> px
                                </span>
                            </div>
                            <div class="dz-thumbnail-wrapper">
                                <div class="dz-thumbnail" style="width: 265px; height: 170px;">
                                    <img id="img-target-photo"
                                         src="<?php echo $model->front_photo == null ? "" : Yii::getAlias('@web') . "/resources/images/member/frontphoto/" . $model->front_photo; ?>"
                                         data-dz-thumbnail="" style="max-height: 202px;">
                                </div>
                            </div>
                        </div>
                        <a id="remove-front-photo" class="select-image dz-remove" href="#" style="border-radius: 0"
                           data-toggle="modal" data-target="#modal-sizes-2">Ganti Photo</a>
                    </div>
                    <div id="select-front-photo" class="select-image dropzone-box" data-toggle="modal"
                         data-target="#modal-sizes-2"
                         style="<?php echo $model->front_photo == null ? "" : "display: none;"; ?>">
                        <div class="dz-default dz-message" style="margin-left: -40px">
                            <i class="fa fa-cloud-upload"></i>
                        </div>
                    </div>
                    <?= Html::activeHiddenInput($model, 'front_photo', ['id' => 'input-file']) ?>
                </div>
            </div>
        </div>

    </div>
    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">Photo Tampak Samping</span>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <div id="preview-front-photo" class="dz-preview dz-image-preview"
                         style="<?php echo $model->side_photo == null ? "display: none;" : ""; ?> border-radius: 0px; width: 284px; margin: 0">
                        <div class="dz-details">
                            <div class="dz-size">
                                Ukuran Photo: 
                                <span data-dz-size="">
                                    <strong>120x300</strong> px
                                </span>
                            </div>
                            <div class="dz-thumbnail-wrapper">
                                <div class="dz-thumbnail" style="width: 265px; height: 170px;">
                                    <img id="img-target-photo"
                                         src="<?php echo $model->side_photo == null ? "" : Yii::getAlias('@web') . "/resources/images/member/sidephoto/" . $model->side_photo; ?>"
                                         data-dz-thumbnail="" style="max-height: 202px;">
                                </div>
                            </div>
                        </div>
                        <a id="remove-front-photo" class="select-image dz-remove" href="#" style="border-radius: 0"
                           data-toggle="modal" data-target="#modal-sizes-2">Ganti Photo</a>
                    </div>
                    <div id="select-front-photo" class="select-image dropzone-box" data-toggle="modal"
                         data-target="#modal-sizes-2"
                         style="<?php echo $model->side_photo == null ? "" : "display: none;"; ?>">
                        <div class="dz-default dz-message" style="margin-left: -40px">
                            <i class="fa fa-cloud-upload"></i>
                        </div>
                    </div>
                    <?= Html::activeHiddenInput($model, 'side_photo', ['id' => 'input-file']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">Scann KTP</span>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <div id="preview-front-photo" class="dz-preview dz-image-preview"
                         style="<?php echo $model->identity_card == null ? "display: none;" : ""; ?> border-radius: 0px; width: 284px; margin: 0">
                        <div class="dz-details">
                            <div class="dz-size">
                                Ukuran Photo: 
                                <span data-dz-size="">
                                    <strong>120x300</strong> px
                                </span>
                            </div>
                            <div class="dz-thumbnail-wrapper">
                                <div class="dz-thumbnail" style="width: 265px; height: 170px;">
                                    <img id="img-target-photo"
                                         src="<?php echo $model->identity_card == null ? "" : Yii::getAlias('@web') . "/resources/images/member/identitycard/" . $model->identity_card; ?>"
                                         data-dz-thumbnail="" style="max-height: 202px;">
                                </div>
                            </div>
                        </div>
                        <a id="remove-front-photo" class="select-image dz-remove" href="#" style="border-radius: 0"
                           data-toggle="modal" data-target="#modal-sizes-2">Ganti Photo</a>
                    </div>
                    <div id="select-front-photo" class="select-image dropzone-box" data-toggle="modal"
                         data-target="#modal-sizes-2"
                         style="<?php echo $model->identity_card == null ? "" : "display: none;"; ?>">
                        <div class="dz-default dz-message" style="margin-left: -40px">
                            <i class="fa fa-cloud-upload"></i>
                        </div>
                    </div>
                    <?= Html::activeHiddenInput($model, 'identity_card', ['id' => 'input-file']) ?>
                </div>
            </div>
        </div>

    </div>
    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">Sertifikat Organisasi</span>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <div id="preview-front-photo" class="dz-preview dz-image-preview"
                         style="<?php echo $model->certificate_of_organization == null ? "display: none;" : ""; ?> border-radius: 0px; width: 284px; margin: 0">
                        <div class="dz-details">
                            <div class="dz-size">
                                Ukuran Photo: 
                                <span data-dz-size="">
                                    <strong>120x300</strong> px
                                </span>
                            </div>
                            <div class="dz-thumbnail-wrapper">
                                <div class="dz-thumbnail" style="width: 265px; height: 170px;">
                                    <img id="img-target-photo"
                                         src="<?php echo $model->certificate_of_organization == null ? "" : Yii::getAlias('@web') . "/resources/images/member/certificate/" . $model->certificate_of_organization; ?>"
                                         data-dz-thumbnail="" style="max-height: 202px;">
                                </div>
                            </div>
                        </div>
                        <a id="remove-front-photo" class="select-image dz-remove" href="#" style="border-radius: 0"
                           data-toggle="modal" data-target="#modal-sizes-2">Ganti Photo</a>
                    </div>
                    <div id="select-front-photo" class="select-image dropzone-box" data-toggle="modal"
                         data-target="#modal-sizes-2"
                         style="<?php echo $model->certificate_of_organization == null ? "" : "display: none;"; ?>">
                        <div class="dz-default dz-message" style="margin-left: -40px">
                            <i class="fa fa-cloud-upload"></i>
                        </div>
                    </div>
                    <?= Html::activeHiddenInput($model, 'certificate_of_organization', ['id' => 'input-file']) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">Catatan</span>
        </div>
        <div class="panel-body">
            <?php //$form->field($model, 'note')->textarea(['rows' => 6, 'maxlength' => 255])->label('')   ?>
            <div class="form-group field-ppimodel-note required">
                <div class="col-sm-12">
                    <?= Html::activeTextarea($model, 'note', ['style' => 'resize:none', 'class' => 'form-control', 'rows' => 6, 'maxlength' => 255]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">Aksi</span>
        </div>
        <div class="panel-body">
            <?=
            $form->field($model, 'save_status')->dropDownList([
                '' => 'None',
                'Publish' => 'Publish',
                'Draft' => 'Draft',
                'Trash' => 'Trash',
                'Pending' => 'Pending',
            ], ['id' => 'select-save_status', 'maxlength' => 8]);
            ?>

        </div>
        <div class="panel-footer">
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <?= Html::submitButton($model->isNewRecord ? Html::tag('i', '', ['class' => 'fa fa-check']) . '&nbsp;&nbsp;' . Yii::t('app', 'Simpan') : Html::tag('i', '', ['class' => 'fa fa-check']) . '&nbsp;&nbsp;' . Yii::t('app', 'Simpan'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php ActiveForm::end(); ?>

    <div class="row" style="display: none">
        <div class="col-sm-12">
            <textarea id="redactor"></textarea>
        </div>
    </div>

<?php
$this->registerJs(
    '$("#redactor").redactor({
    imageUpload:"' . Url::toRoute(['/filemanager/image/uploadredactorimage']) . '",
        imageGetJson:"' . Url::toRoute(['/filemanager/image/loadredactorimage']) . '",
        albumGetJson:"' . Url::toRoute(['/filemanager/image/loadredactoralbum']) . '",
        buttons:["html"],
        imageUploadErrorCallback:function(data){
            $("html,body").animate({ scrollTop: 0 }, 500);
            PixelAdmin.plugins.alerts.add("<strong>Maap!</strong>&nbsp;" + data.error, {
                type:"danger",
                auto_close:9
            });
        },
        buttons: ["italic"],
        fileUpload:"' . Url::toRoute(['/filemanager/document/uploaddredactorfile']) . '",
        fileGetJson:"' . Url::toRoute(['/filemanager/document/loadredactorfile']) . '",
        fileUploadErrorCallback:function(data){           
            $("html,body").animate({ scrollTop: 0 }, 500);
            PixelAdmin.plugins.alerts.add("<strong>Maap!</strong>&nbsp;" + data.error, {
                type:"danger",
                auto_close:9
            });
        },
        uploadFields:{
            "' . Yii::$app->request->csrfParam . '" : "' . Yii::$app->request->getCsrfToken() . '",
        },
        lang: "id",
        imgLoading:"' . Yii::getAlias('@web') . "/PixelAdmin/img/loading.gif" . '",
        _csrf:"' . Yii::$app->request->getCsrfToken() . '",
        _csrfname:"' . Yii::$app->request->csrfParam . '",
    });
    $(".redactor_box").css({"display":"none"});
', View::POS_READY);
?>