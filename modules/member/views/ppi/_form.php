<?php

use yii\helpers\Html;
use yii\web\View;
use yii\web\Session;
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
    , View::POS_READY);
?>

<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'options' => ['enctype' => 'multipart/form-data'],
    'fieldConfig' => [
        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
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
            <?= $form->field($model, 'birth')->textInput(['maxlength' => 45]) ?>
            <?= $form->field($model, 'address')->textarea(['rows' => 6, 'maxlength' => 255]) ?>
            <?=
            $form->field($model, 'gender')->dropDownList([
                'Laki-Laki' => 'Laki-Laki',
                'Perempuan' => 'Perempuan',
            ], ['maxlength' => 45])
            ?>
            <?=
            $form->field($model, 'religion')->dropDownList([
                'Islam' => 'Islam',
                'Katholik' => 'Katholik',
                'Protestan' => 'Protestan',
                'Hindu' => 'Hindu',
                'Budha' => 'Budha',
                'Konghuchu' => 'Konghuchu',
            ], ['maxlength' => 45])
            ?>
            <?= $form->field($model, 'nationality')->textInput(['maxlength' => 45]) ?>
            <?= $form->field($model, 'zip_code')->textInput(['maxlength' => 45]) ?>
            <?= $form->field($model, 'identity_card_number')->textInput(['rows' => 6]) ?>
            <?=
            $form->field($model, 'blood_group')->dropDownList([
                'Golongan Darah (O)' => 'Golongan Darah (O)',
                'Golongan Darah (A)' => 'Golongan Darah (A)',
                'Golongan Darah (B)' => 'Golongan Darah (B)',
                'Golongan Darah (AB)' => 'Golongan Darah (AB)',
            ], ['maxlength' => 45])
            ?>
            <?= $form->field($model, 'school_id')->dropDownList(PpiSerch::getSchools()) ?>
            <?= $form->field($model, 'taxonomy_id')->dropDownList(PpiSerch::getAreas()) ?>
            <?= $form->field($model, 'tribal_members')->textInput(['maxlength' => 45]) ?>
            <?= $form->field($model, 'brevetaward')->textInput(['maxlength' => 45]) ?>
            <?= $form->field($model, 'lifeskill')->textInput(['maxlength' => 45]) ?>
            <?= $form->field($model, 'languageskill')->textInput(['maxlength' => 45]) ?>
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
            ], ['maxlength' => 45])
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
            ], ['maxlength' => 45])
            ?>
            <?=
            $form->field($model, 'status_organization')->dropDownList([
                'Aktif' => 'Aktif',
                'Non Aktif' => 'Non Aktif',
                'Mutasi' => 'Mutasi',
                'PDTH' => 'PDTH',
            ], ['maxlength' => 45])
            ?>
            <?= $form->field($model, 'year')->dropDownList(PpiSerch::getYears(), ['maxlength' => 45]) ?>
            <?=
            $form->field($model, 'educational_status')->dropDownList([
                'SMA/MA/SMK' => 'SMA/MA/SMK',
                'S1' => 'S1',
                'S2' => 'S2',
                'S3' => 'S3',
                'D2' => 'D2',
                'S3' => 'D3',
            ], ['maxlength' => 45])
            ?>
            <?=
            $form->field($model, 'marital_status')->dropDownList([
                'Belum Menikah' => 'Belum Menikah',
                'Menikah' => 'Menikah',
                'Janda' => 'Janda',
                'Duda' => 'Duda',
            ], ['maxlength' => 45])
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
            ], ['maxlength' => 45])
            ?>
        </div>
    </div>

    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">Kontak</span>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'email')->textInput(['maxlength' => 45]) ?>
            <?= $form->field($model, 'phone_number')->textInput(['maxlength' => 45]) ?>
            <?= $form->field($model, 'other_phone_number')->textInput(['maxlength' => 45]) ?>
            <?=
            $form->field($model, 'relationship_phone_number')->dropDownList([
                "Orang Tua" => 'Orang Tua',
                "Kakak" => 'Kakak',
                "Adik" => 'Adik',
                "Keluarga" => 'Keluarga',
                "Teman" => 'Teman',
            ], ['maxlength' => 45])
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
            ], ['maxlength' => 45])
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
            ], ['maxlength' => 45])
            ?>
            <?= $form->field($model, 'income_father')->textInput(['maxlength' => 45]) ?>
            <?= $form->field($model, 'income_mothers')->textInput(['maxlength' => 45]) ?>
            <?= $form->field($model, 'number_of_brothers')->textInput() ?>
            <?= $form->field($model, 'number_of_sisters')->textInput() ?>
            <?= $form->field($model, 'number_of_children')->textInput() ?>
        </div>
    </div>
    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">Catatan</span>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'note')->textarea(['rows' => 6, 'maxlength' => 255])->label('') ?>
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

            <?= Html::activeFileInput($model, 'front_photo', ['accept' => 'image/jpeg,image/png', 'id' => 'front-photo-file-input']) ?>
            <div class="help-block "
                 style="color: #a94442"><?= Yii::$app->session->getFlash('front_photo_error') ?></div>
            <br>
            <?= Html::activeFileInput($model, 'side_photo', ['id' => 'side-photo-file-input']) ?>
            <div class="help-block "
                 style="color: #a94442"><?= Yii::$app->session->getFlash('side_photo_error') ?></div>
            <br>
            <?= Html::activeFileInput($model, 'identity_card', ['id' => 'identity_card-file-input']) ?>
            <div class="help-block "
                 style="color: #a94442"><?= Yii::$app->session->getFlash('identity_card_error') ?></div>
            <br>
            <?= Html::activeFileInput($model, 'certificate_of_organization', ['id' => 'certificate-of-organization-file-input']) ?>
            <br>
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


            <?= $form->field($model, 'taxonomies')->checkboxList(PpiSerch::getLangSkills(), ['name' => 'MemberModel[language_skills][]'])->label('Keterampilan Bahasa Asing') ?>
            <?= $form->field($model, 'taxonomies')->checkboxList(PpiSerch::getLifeSkills(), ['name' => 'MemberModel[life_skills][]'])->label('Keterampilan Personal') ?>
            <?= $form->field($model, 'taxonomies')->checkboxList(PpiSerch::getBrevetAwards(), ['name' => 'MemberModel[brevet_award][]'])->label('Brevet Penghargaan') ?>
            <?=
            $form->field($model, 'save_status')->dropDownList([
                '' => 'None',
                'Publish' => 'Publish',
                'Draft' => 'Draft',
                'Trash' => 'Trash'
            ], ['maxlength' => 8])->label('');
            ?>
        </div>
        <div class="panel-footer">
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>

</div>


<?php ActiveForm::end(); ?>
