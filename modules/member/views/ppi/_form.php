<?php

use yii\helpers\Html;
use yii\web\View;
use yii\web\Session;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use app\modules\member\searchs\PpiSerch;

$msg = new Session();
/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Member $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerJs(
    "$('ul.navigation > li#database > ul.mm-dropdown > li#member > ul.mm-dropdown > li#ppi').addClass('active').parent().parent().addClass('open').parent().parent().addClass('active open');"
    . "init.push(function () { $('#front-photo-file-input').pixelFileInput({ placeholder: 'Photo tampak depan...' }); });"
    . "init.push(function () { $('#side-photo-file-input').pixelFileInput({ placeholder: 'Photo tampak samping...' }); });"
    . "init.push(function () { $('#identity_card-file-input').pixelFileInput({ placeholder: 'KTP...' }); });"
    . "init.push(function () { $('#certificate-of-organization-file-input').pixelFileInput({ placeholder: 'Sertifikat organisasi...' }); });"
    . "init.push(function () { $('#birth-date').datepicker();});"
    . '$("#select-year").select2({ allowClear: true, placeholder: "Tahun angkatan"});'
    . '$("#select-unit").select2({ allowClear: true, placeholder: "Status pendidikan"});'
    . '$("#select-membership_status").select2({ allowClear: true, placeholder: "Status angota"});'
    . '$("#select-status_organization").select2({ allowClear: true, placeholder: "Status organisasi"});'
    . '$("#select-marital_status").select2({ allowClear: true, placeholder: "Status perkawinan"});'
    . '$("#select-job").select2({ allowClear: true, placeholder: "Pekerjaan"});'
    . '$("#select-dress_size").select2({ allowClear: true, placeholder: "Ukuran baju"});'
    . '$("#select-relationship_phone_number").select2({ allowClear: true, placeholder: "Status dengan no hp"});'
    . '$("#select-father_work").select2({ allowClear: true, placeholder: "Pekerjaan bapak"});'
    . '$("#select-mother_work").select2({ allowClear: true, placeholder: "Pekerjaan ibu"});'
    . '$("#select-gender").select2({ allowClear: true, placeholder: "Jenis kelamin"});'
    . '$("#select-religion").select2({ allowClear: true, placeholder: "Agama"});'
    . '$("#select-blood_group").select2({ allowClear: true, placeholder: "Golongan darah"});'
    . '$("#select-school").select2({ allowClear: true, placeholder: "Golongan darah"});'
    . '$("#select-area").select2({ allowClear: true, placeholder: "Golongan darah"});'
    . '$("#select-save_status").select2({ allowClear: true, placeholder: "Save status"});'
    . '$("#select-languageskill").select2({ allowClear: true, placeholder: "Pilih"});'
    . '$("#select-lifeskill").select2({ allowClear: true, placeholder: "Pilih"});'
    . '$("#select-brevetawards").select2({ allowClear: true, placeholder: "Penghargaan"});'
    . 'init.push(function () {$("#member-form").validate({ignore: ".ignore, .select2-input",focusInvalid: false,rules: {"PpiModel[email]":{required: true,email: true}, "PpiModel[save_status]":{required: true}} , messages:{"PpiModel[save_status]": "Tidak boleh kosong.","PpiModel[email]":"Tidak boleh kosong dan masukkan alamat email yang valid" } }); });'
    , View::POS_END);
?>

<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'options' => ['novalidate' => 'novalidate', 'id' => 'member-form', 'enctype' => 'multipart/form-data'],
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

]); ?>
<div class="col-xs-12 col-sm-8">
    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">Data Pribadi</span>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'nra')->textInput(['maxlength' => 45]) ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => 45]) ?>
            <?= $form->field($model, 'nickname')->textInput() ?>
            <?= $form->field($model, 'birth')->textInput(['placeholder' => '08/02/1990', 'id' => 'birth-date', 'maxlength' => 45]) ?>
            <?= $form->field($model, 'address')->textarea(['rows' => 6, 'maxlength' => 255]) ?>
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
            <?= $form->field($model, 'zip_code')->textInput(['maxlength' => 45]) ?>
            <?= $form->field($model, 'identity_card_number')->textInput(['rows' => 6]) ?>
            <?=
            $form->field($model, 'blood_group')->dropDownList([
                'Golongan Darah O' => 'Golongan Darah O',
                'Golongan Darah A' => 'Golongan Darah A',
                'Golongan Darah B' => 'Golongan Darah B',
                'Golongan Darah AB' => 'Golongan Darah AB',
            ], ['id' => 'select-blood_group', 'maxlength' => 45])
            ?>
            <?= $form->field($model, 'school_id')->dropDownList(PpiSerch::getSchools(), ['id' => 'select-school']) ?>
            <?= $form->field($model, 'taxonomy_id')->dropDownList(PpiSerch::getAreas(), ['id' => 'select-area']) ?>
            <?= $form->field($model, 'tribal_members')->textInput(['maxlength' => 45]) ?>
            <?= $form->field($model, 'taxonomies')->dropDownList(PpiSerch::getBrevetAwards(), ['multiple'=>'multiple','name'=>'PpiModel[brevet_award]','id' => 'select-brevetawards'])->label('Brevet Penghargaan') ?>
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
            <?= $form->field($model, 'email')->textInput(['id' => 'jq-validation-email', 'maxlength' => 45])->label('Email', ['for' => 'jq-validation-email']) ?>
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
            <?= $form->field($model, 'income_father')->textInput(['maxlength' => 45]) ?>
            <?= $form->field($model, 'income_mothers')->textInput(['maxlength' => 45]) ?>
            <?= $form->field($model, 'number_of_brothers')->textInput() ?>
            <?= $form->field($model, 'number_of_sisters')->textInput() ?>
            <?= $form->field($model, 'number_of_children')->textInput() ?>
        </div>
    </div>
</div>
<div class="col-xs-12 col-sm-4">
    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">Persyaratan</span>
        </div>
        <div class="panel-body">

            <?php //$form->field($model, 'front_photo')->fileInput(['id'=>'front-photo-file-input']) ?>
            <?php //$form->field($model, 'side_photo')->fileInput() ?>
            <?php //$form->field($model, 'identity_card')->fileInput() ?>
            <?php //$form->field($model, 'certificate_of_organization')->fileInput() ?>
            <div class="form-group">
                <div class="col-sm-12">
                    <?= Html::activeFileInput($model, 'front_photo', ['accept' => 'image/jpeg,image/png', 'id' => 'front-photo-file-input']) ?>
                    <div class="help-block "
                         style="color: #a94442"><?= Yii::$app->session->getFlash('front_photo_error') ?></div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <?= Html::activeFileInput($model, 'side_photo', ['id' => 'side-photo-file-input']) ?>
                    <div class="help-block "
                         style="color: #a94442"><?= Yii::$app->session->getFlash('side_photo_error') ?></div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <?= Html::activeFileInput($model, 'identity_card', ['id' => 'identity_card-file-input']) ?>
                    <div class="help-block "
                         style="color: #a94442"><?= Yii::$app->session->getFlash('identity_card_error') ?></div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <?= Html::activeFileInput($model, 'certificate_of_organization', ['id' => 'certificate-of-organization-file-input']) ?>
                </div>
            </div>

        </div>
    </div>
    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">Keterampilan</span>
        </div>
        <div class="panel-body">

            <?php //$form->field($model, 'taxonomies')->checkboxList(PpiSerch::getLangSkills())->label('Keterampilan Bahasa Asing') ?>
            <?php //$form->field($model, 'taxonomies')->checkboxList(PpiSerch::getLifeSkills())->label('Keterampilan Personal') ?>
            <?php //$form->field($model, 'taxonomies')->checkboxList(PpiSerch::getBrevetAwards())->label('Brevet Penghargaan') ?>
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


            <?php //$form->field($model, 'brevetaward')->textInput(['maxlength' => 45]) ?>
            <?php //$form->field($model, 'lifeskill')->textInput(['maxlength' => 45]) ?>
            <?php //$form->field($model, 'languageskill')->textInput(['maxlength' => 45]) ?>
            <?php //$form->field($model, 'taxonomies')->checkboxList(PpiSerch::getLifeSkills(), ['name' => 'MemberModel[life_skills][]'])->label('Keterampilan Personal') ?>
            <?php //$form->field($model, 'taxonomies')->checkboxList(PpiSerch::getBrevetAwards(), ['name' => 'MemberModel[brevet_award][]'])->label('Brevet Penghargaan') ?>

        </div>

    </div>

    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">Catatan</span>
        </div>
        <div class="panel-body">
            <?php //$form->field($model, 'note')->textarea(['rows' => 6, 'maxlength' => 255])->label('') ?>
            <div class="form-group field-ppimodel-note required">
                <div class="col-sm-12">
                    <?= Html::activeTextarea($model, 'note', ['class' => 'form-control', 'rows' => 6, 'maxlength' => 255]) ?>
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
                'Trash' => 'Trash'
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
