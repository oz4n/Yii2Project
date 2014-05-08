<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\member\searchs\MemberSerch;
/**
 * @var yii\web\View $this
 * @var app\modules\member\models\MemberModel $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<?php $form = ActiveForm::begin(); ?>
    <div class="col-sm-2">
        <?= $form->field($model, 'front_photo')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'side_photo')->textarea(['maxlength' => 45]) ?>
        <?= $form->field($model, 'identity_card')->textarea(['maxlength' => 45]) ?>
        <?= $form->field($model, 'certificate_of_organization')->textarea(['rows' => 6]) ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model, 'nra')->textInput(['maxlength' => 45]) ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => 45]) ?>
        <?= $form->field($model, 'nickname')->textInput() ?>
        <?= $form->field($model, 'birth')->textInput(['maxlength' => 45]) ?>
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
        <?= $form->field($model, 'zip_code')->textInput(['maxlength' => 45]) ?>
        <?= $form->field($model, 'identity_card_number')->textInput(['rows' => 6]) ?>
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
        <?= $form->field($model, 'unit')->dropDownList(['SMA' => 'SMA', 'SMK' => 'SMK', 'MA' => 'MA'], ['maxlength' => 45]) ?>
        <?= $form->field($model, 'nationality')->textInput(['maxlength' => 45]) ?>
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
        <?= $form->field($model, 'year')->dropDownList(MemberSerch::loadYears(), ['maxlength' => 45]) ?>
        <?= $form->field($model, 'address')->textInput(['maxlength' => 45]) ?>
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
        <?=
        $form->field($model, 'blood_group')->dropDownList([
            'O' => 'O',
            'A' => 'A',
            'B' => 'B',
            'AB' => 'AB',
        ], ['maxlength' => 45])
        ?>
        <?= $form->field($model, 'school_id')->dropDownList(MemberSerch::loadSchools()) ?>
        <?= $form->field($model, 'taxonomy_id')->dropDownList(MemberSerch::loadAreas()) ?>
    </div>

    <div class="col-sm-5">
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

        <?=
        $form->field($model, 'membership_status')->dropDownList([
            'Anggota Biasa (PPI)' => 'Anggota Biasa (PPI)',
            'Anggota Kehormatan' => 'Anggota Kehormatan',
            'Pengurus Kota' => 'Pengurus Kota',
            'Pengurus Kab' => 'Pengurus Kab',
            'Pengurus Provinsi' => 'Pengurus Provinsi',
            'Pengurus Pusat' => 'Pengurus Pusat',
            'Capas' => 'Capas',
        ], ['maxlength' => 45])
        ?>

        <?=
        $form->field($model, 'status_organization')->dropDownList([
            'Aktif' => 'Aktif',
            'Non Aktif' => 'Non Aktif',
            'PDTH' => 'PDTH',
        ], ['maxlength' => 45])
        ?>


        <?= $form->field($model, 'names_recommended')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($model, 'note')->textInput(['maxlength' => 255]) ?>
        <?= $form->field($model, 'language_skills')->checkboxList(MemberSerch::loadLangSkills(), ['maxlength' => 255]) ?>
        <?= $form->field($model, 'life_skill')->checkboxList(MemberSerch::loadLifeSkills(), ['maxlength' => 255]) ?>
        <?= $form->field($model, 'brevet_award')->checkboxList(['A', 'B', 'C', 'D'], ['maxlength' => 255]) ?>

    </div>


<?php ActiveForm::end(); ?>