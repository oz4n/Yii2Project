<?php

use yii\bootstrap\ActiveForm;
use app\modules\member\searchs\PpiSerch;
use yii\helpers\Html;
use dosamigos\fileupload\FileUpload;

//use yii\web\View;
//$this->registerCssFile('site/js/plugins/upload/css/style.css', [], ['position' => View::POS_HEAD]);
//$this->registerJsFile('site/js/plugins/upload/js/jquery.knob.js', [], ['position' => View::POS_END]);
//$this->registerJsFile('site/js/plugins/upload/js/jquery.ui.widget.js', [], ['position' => View::POS_END]);
//$this->registerJsFile('site/js/plugins/upload/js/jquery.iframe-transport.js', [], ['position' => View::POS_END]);
//$this->registerJsFile('site/js/plugins/upload/js/jquery.fileupload.js', [], ['position' => View::POS_END]);
//$this->registerJsFile('site/js/plugins/upload/js/script.js', [], ['position' => View::POS_END]);
?>

<div class="col-sm-12">
    <div class="sorting-block">

        <?=
        \yii\widgets\Menu::widget([
            'options' => ['class' => 'sorting-nav sorting-nav-v1 text-center'],
            'itemOptions' => ['class' => 'filter'],
            'items' => [
                ['label' => 'Data Anggota', 'url' => ['/site/member/index', 'role' => Yii::$app->user->identity->role, 'slug' => Yii::$app->user->identity->slug]],
//                ['label' => Yii::t('user', 'Profil'), 'url' => ['/user/settings/profile']],
                ['label' => Yii::t('user', 'Pengaturan Email'), 'url' => ['/user/settings/email']],
                ['label' => Yii::t('user', 'Pengaturan Kata sandi'), 'url' => ['/user/settings/password']],
//                ['label' => Yii::t('user', 'Networks'), 'url' => ['/user/settings/networks']],
            ]
        ])
        ?>
    </div>
    <div class="row">
        <div class="col-md-8 mb-margin-bottom-30">

            <?php
            $form = ActiveForm::begin([
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
            ]);
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-tasks"></i> Data Pribadi</h3>
                </div>
                <div class="panel-body">
                    <?= $form->field($member, 'nra')->textInput(['disabled' => 'disabled','maxlength' => 45]) ?>
                    <?= $form->field($member, 'name')->textInput(['maxlength' => 45]) ?>
                    <?= $form->field($member, 'nickname')->textInput() ?>
                    <?= $form->field($member, 'identity_card_number')->textInput(['rows' => 45]) ?>
                    <?= $form->field($member, 'birth')->textInput(['placeholder' => '02 Agustus 1990', 'id' => 'birth-date', 'maxlength' => 45]) ?>
                    <?= $form->field($member, 'age')->textInput(['maxlength' => 3]) ?>
                    <?= $form->field($member, 'address')->textarea(['style' => 'resize:none', 'rows' => 6, 'maxlength' => 255]) ?>
                    <?=
                    $form->field($member, 'gender')->dropDownList([
                        'Laki-Laki' => 'Laki-Laki',
                        'Perempuan' => 'Perempuan',
                            ], ['id' => 'select-gender', 'maxlength' => 45])
                    ?>
                    <?=
                    $form->field($member, 'religion')->dropDownList([
                        'Islam' => 'Islam',
                        'Katholik' => 'Katholik',
                        'Protestan' => 'Protestan',
                        'Hindu' => 'Hindu',
                        'Budha' => 'Budha',
                        'Konghuchu' => 'Konghuchu',
                            ], ['id' => 'select-religion', 'maxlength' => 45])
                    ?>
                    <?= $form->field($member, 'nationality')->textInput(['maxlength' => 45]) ?>
                    <?= $form->field($member, 'taxonomy_id')->dropDownList(PpiSerch::getAreas(), ['id' => 'select-area']) ?>
                    <?= $form->field($member, 'tribal_members')->textInput(['maxlength' => 45]) ?>
                    <?= $form->field($member, 'school_id')->dropDownList(PpiSerch::getSchools(), ['id' => 'select-school']) ?>
                    <?= $form->field($member, 'zip_code')->textInput(['maxlength' => 45]) ?>
                    <?=
                    $form->field($member, 'blood_group')->dropDownList([
                        'Golongan Darah O' => 'Golongan Darah O',
                        'Golongan Darah A' => 'Golongan Darah A',
                        'Golongan Darah B' => 'Golongan Darah B',
                        'Golongan Darah AB' => 'Golongan Darah AB',
                            ], ['id' => 'select-blood_group', 'maxlength' => 45])
                    ?>


                    <?= $form->field($member, 'taxonomies')->dropDownList(PpiSerch::getBrevetAwards(), ['multiple' => 'multiple', 'name' => 'MemberModel[brevet_award]', 'id' => 'select-brevetawards'])->label('Brevet Penghargaan') ?>
                    <?= $form->field($member, 'organizational_experience')->textInput(['maxlength' => 45]) ?>
                    <?= $form->field($member, 'illness')->textInput(['maxlength' => 45]) ?>
                    <?= $form->field($member, 'height_body')->textInput(['maxlength' => 45]) ?>
                    <?= $form->field($member, 'weight_body')->textInput(['maxlength' => 45]) ?>
                    <?=
                    $form->field($member, 'dress_size')->dropDownList([
                        'S' => 'S',
                        'M' => 'M',
                        'L' => 'L',
                        'XS' => 'XS',
                        'XL' => 'XL',
                        'XXL' => 'XXL',
                        'XXXL' => 'XXXL',
                            ], ['id' => 'select-dress_size', 'maxlength' => 45])
                    ?>
                    <?= $form->field($member, 'pants_size')->textInput(['maxlength' => 45]) ?>
                    <?= $form->field($member, 'shoe_size')->textInput(['maxlength' => 45]) ?>
                    <?= $form->field($member, 'hat_size')->textInput(['maxlength' => 45]) ?>
                </div>
            </div>       
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-tasks"></i> Status</h3>
                </div>
                <div class="panel-body">
                    <?=
                    $form->field($member, 'membership_status')->dropDownList([
                        'Anggota Biasa' => 'Anggota Biasa',
                        'Anggota Kehormatan' => 'Anggota Kehormatan',
                        'Pengurus Kota' => 'Pengurus Kota',
                        'Pengurus Kab' => 'Pengurus Kab',
                        'Pengurus Provinsi' => 'Pengurus Provinsi',
                        'Pengurus Pusat' => 'Pengurus Pusat',
                            ], ['id' => 'select-membership_status', 'maxlength' => 45])
                    ?>
                    <?=
                    $form->field($member, 'status_organization')->dropDownList([
                        'Aktif' => 'Aktif',
                        'Non Aktif' => 'Non Aktif',
                        'Mutasi' => 'Mutasi',
                        'PDTH' => 'PDTH',
                            ], ['id' => 'select-status_organization', 'maxlength' => 45])
                    ?>
                    <?= $form->field($member, 'year')->dropDownList(PpiSerch::getYears(), ['id' => 'select-year', 'maxlength' => 45]) ?>
                    <?=
                    $form->field($member, 'educational_status')->dropDownList([
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
                    $form->field($member, 'marital_status')->dropDownList([
                        'Belum Menikah' => 'Belum Menikah',
                        'Menikah' => 'Menikah',
                        'Janda' => 'Janda',
                        'Duda' => 'Duda',
                            ], ['id' => 'select-marital_status', 'maxlength' => 45])
                    ?>
                    <?=
                    $form->field($member, 'job')->dropDownList([
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-tasks"></i> Kontak</h3>
                </div>
                <div class="panel-body">
                    <?= $form->field($member, 'email')->textInput(['maxlength' => 45])->label('Email', ['for' => 'jq-validation-email']) ?>
                    <?= $form->field($member, 'phone_number')->textInput(['maxlength' => 45]) ?>
                    <?= $form->field($member, 'other_phone_number')->textInput(['maxlength' => 45]) ?>
                    <?=
                    $form->field($member, 'relationship_phone_number')->dropDownList([
                        "Orang Tua" => 'Orang Tua',
                        "Kakak" => 'Kakak',
                        "Adik" => 'Adik',
                        "Keluarga" => 'Keluarga',
                        "Teman" => 'Teman',
                            ], ['id' => 'select-relationship_phone_number', 'maxlength' => 45])
                    ?>
                </div>
            </div> 

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-tasks"></i> Data Kekeluargaan</h3>
                </div>
                <div class="panel-body">
                    <?= $form->field($member, 'father_name')->textInput(['maxlength' => 45]) ?>
                    <?= $form->field($member, 'mother_name')->textInput(['maxlength' => 45]) ?>
                    <?=
                    $form->field($member, 'father_work')->dropDownList([
                        'PNS' => 'PNS',
                        'TNI/PORLI' => 'TNI/PORLI',
                        'Karyawan Swasta' => 'Karyawan Swasta',
                        'Pelajar/Mahasisawa' => 'Pelajar/Mahasisawa',
                        'Guru/Dosen' => 'Guru/Dosen',
                        'Wiraswasta' => 'Wiraswasta',
                            ], ['id' => 'select-father_work', 'maxlength' => 45])
                    ?>
                    <?=
                    $form->field($member, 'mother_work')->dropDownList([
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
                    $form->field($member, 'income_father')->dropDownList([
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
                    $form->field($member, 'income_mothers')->dropDownList([
                        '0' => 'None',
                        'Rp.17000000 s/d Rp.19000000' => 'Rp.17000000 s/d Rp.19000000',
                        'Rp.12000000 s/d Rp.16000000' => 'Rp.12000000 s/d Rp.16000000',
                        'Rp.11000000 s/d Rp.13000000' => 'Rp.11000000 s/d Rp.13000000',
                        'Rp.8000000 s/d Rp.10000000' => 'Rp.8000000 s/d Rp.10000000',
                        'Rp.4000000 s/d Rp.7000000' => 'Rp.4000000 s/d Rp.7000000',
                        'Rp.1000000 s/d Rp.3000000' => 'Rp.1000000 s/d Rp.3000000',
                            ], ['id' => 'select-income_mothers', 'maxlength' => 45])
                    ?>
                    <?= $form->field($member, 'number_of_brothers')->textInput() ?>
                    <?= $form->field($member, 'number_of_sisters')->textInput() ?>
                    <?=
                    $form->field($member, 'number_of_children')->textInput()
                    ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-tasks"></i> Keterampilan</h3>
                </div>
                <div class="panel-body">
                    <?=
                    $form->field($member, 'taxonomies')->dropDownList(PpiSerch::getLangSkills(), ['class' => 'form-control', 'name' => 'MemberModel[language_skill][]', 'multiple' => 'multiple', 'id' => 'select-languageskill'])->label('Keterampilan Bahasa')
                    ?>
                    <?=
                    $form->field($member, 'taxonomies')->dropDownList(PpiSerch::getLifeSkills(), ['class' => 'form-control', 'name' => 'MemberModel[life_skill][]', 'multiple' => 'multiple', 'id' => 'select-lifeskill'])->label('Keterampilan Personal')
                    ?>

                    <?=
                    $form->field($member, 'otherlifeskill')->textInput()->label('Keterampilan Lainnya')
                    ?>

                </div>
            </div> 
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-tasks"></i> Catatan</h3>
                </div>
                <div class="panel-body">            
                    <?=
                    $form->field($member, 'note')->textarea(['rows' => 6, 'style' => 'resize:none'])->label('Catatan tentang diri anda')
                    ?>            
                </div>
            </div>
            <!--<footer>-->
            <?= Html::submitButton('<i class="fa fa-check"></i>&nbsp; Simpan', ['class' => 'btn btn-u']) ?>
            <!--</footer>-->
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-sm-4 mb-margin-bottom-30">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-picture-o"></i> Foto tampak depan</h3>
                </div>
                <div class="panel-body">
                    <div id="add-front-image">
                        <?php if ($member->front_photo !== null): ?>
                            <img src="<?= Yii::getAlias('@web') . "/resources/images/member/frontphoto/" . $member->front_photo ?>" style="width: 1024px" class="img-responsive">                            
                        <?php endif; ?>  
                        <div id="progressbox-front" class="progress progress-striped active" style="margin-bottom: 0; display: none">
                            <div id="progress" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="fileUpload btn btn-u btn-block">
                        <span>Unggah foto</span>
                        <?=
                        FileUpload::widget([
                            'name' => 'file',
                            'plus' => true,
                            'url' => ['/site/member/upload'],
                            'options' => ['accept' => 'image/*', 'title' => 'Ganti Photo'],
                            'clientOptions' => [
                                'dataType' => 'json',
                                'autoUpload' => true,
                                'previewMaxWidth' => 611,
                                'previewMaxHeight' => 850,
                                'previewCrop' => true,
                                'maxFileSize' => 2000000,
                                'formData' => [
                                    Yii::$app->request->csrfParam => Yii::$app->request->getCsrfToken(),
                                    'imagetype' => 'frontphoto',
                                    'id' => $member->id,
                                ]
                            ],
                            'clientEvents' => [
                                'fileuploadprogressall' => ' function (e, data) {'
                                . 'var progress = parseInt(data.loaded / data.total * 100, 10);'
                                . 'jQuery("#progressbox-front").css("display","block");'
                                . 'jQuery("#progressbox-front .progress-bar").css("width",progress + "%");'
                                . '}',
                                'fileuploaddone' => 'function (e, data){'
                                . 'jQuery("#progressbox-front").css("display","none");'
                                . '}',
                                'fileuploadprocessalways' => 'function (e, data) {'
                                . 'var index = data.index,file = data.files[index];'
                                . 'if (file.preview) {'
                                . "jQuery('#add-front-image').find('canvas').css('display','none');"
                                . "jQuery('#add-front-image').find('img').css('display','none');"
                                . "jQuery('#add-front-image').prepend(file.preview);"
                                . "jQuery('#add-front-image').find('canvas').addClass('img-responsive');"
                                . '}'
                                . '}',
                            ]
                        ]);
                        ?>
                    </div>                    
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-picture-o"></i> Foto tampak samping</h3>
                </div>
                <div class="panel-body">
                    <div id="add-side-image">
                        <?php if ($member->side_photo !== null): ?>
                            <img src="<?= Yii::getAlias('@web') . "/resources/images/member/sidephoto/" . $member->side_photo ?>" style="width: 1024px" class="img-responsive">                                                 
                        <?php endif; ?>
                        <div id="progressbox-side" class="progress progress-striped active" style="margin-bottom: 0; display: none">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" >

                            </div>
                        </div>

                    </div>
                </div>
                <div class="panel-footer">
                    <div class="fileUpload btn btn-u btn-block">
                        <span>Unggah foto</span>
                        <?=
                        FileUpload::widget([
                            'name' => 'file',
                            'plus' => true,
                            'url' => ['/site/member/upload'],
                            'options' => ['accept' => 'image/*', 'title' => 'Ganti Photo'],
                            'clientOptions' => [
                                'dataType' => 'json',
                                'autoUpload' => true,
                                'previewMaxWidth' => 611,
                                'previewMaxHeight' => 850,
                                'previewCrop' => true,
                                'maxFileSize' => 2000000,
                                'formData' => [
                                    Yii::$app->request->csrfParam => Yii::$app->request->getCsrfToken(),
                                    'imagetype' => 'sidephoto',
                                    'id' => $member->id,
                                ]
                            ],
                            'clientEvents' => [
                                'fileuploadprogressall' => ' function (e, data) {'
                                . 'var progress = parseInt(data.loaded / data.total * 100, 10);'
                                . 'jQuery("#progressbox-side").css("display","block");'
                                . 'jQuery("#progressbox-side .progress-bar").css("width",progress + "%");'
                                . '}',
                                'fileuploaddone' => 'function (e, data){'
                                . 'jQuery("#progressbox-side").css("display","none");'
                                . '}',
                                'fileuploadprocessalways' => 'function (e, data) {'
                                . 'var index = data.index,file = data.files[index];'
                                . 'if (file.preview) {'
                                . "jQuery('#add-side-image').find('canvas').css('display','none');"
                                . "jQuery('#add-side-image').find('img').css('display','none');"
                                . "jQuery('#add-side-image').prepend(file.preview);"
                                . "jQuery('#add-side-image').find('canvas').addClass('img-responsive');"
                                . '}'
                                . '}',
                            ]
                        ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-picture-o"></i> Scann KTP</h3>
                </div>
                <div class="panel-body">
                    <div id="add-image-identitycard">
                        <?php if ($member->identity_card !== null): ?>
                            <img src="<?= Yii::getAlias('@web') . "/resources/images/member/identitycard/" . $member->identity_card ?>" style="width: 1024px" class="img-responsive">                            
                        <?php endif; ?>  
                        <div id="progressbox-identitycard" class="progress progress-striped active" style="margin-bottom: 0; display: none">
                            <div id="progress" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="fileUpload btn btn-u btn-block">
                        <span>Unggah foto</span>
                        <?=
                        FileUpload::widget([
                            'name' => 'file',
                            'plus' => true,
                            'url' => ['/site/member/upload'],
                            'options' => ['accept' => 'image/*', 'title' => 'Ganti Photo'],
                            'clientOptions' => [
                                'dataType' => 'json',
                                'autoUpload' => true,
                                'previewMaxWidth' => 1024,
                                'previewMaxHeight' => 1024,
                                'previewCrop' => true,
                                'maxFileSize' => 2000000,
                                'formData' => [
                                    Yii::$app->request->csrfParam => Yii::$app->request->getCsrfToken(),
                                    'imagetype' => 'identitycard',
                                    'id' => $member->id,
                                ]
                            ],
                            'clientEvents' => [
                                'fileuploadprogressall' => ' function (e, data) {'
                                . 'var progress = parseInt(data.loaded / data.total * 100, 10);'
                                . 'jQuery("#progressbox-identitycard").css("display","block");'
                                . 'jQuery("#progressbox-identitycard .progress-bar").css("width",progress + "%");'
                                . '}',
                                'fileuploaddone' => 'function (e, data){'
                                . 'jQuery("#progressbox-identitycard").css("display","none");'
                                . '}',
                                'fileuploadprocessalways' => 'function (e, data) {'
                                . 'var index = data.index,file = data.files[index];'
                                . 'if (file.preview) {'
                                . "jQuery('#add-image-identitycard').find('canvas').css('display','none');"
                                . "jQuery('#add-image-identitycard').find('img').css('display','none');"
                                . "jQuery('#add-image-identitycard').prepend(file.preview);"
                                . "jQuery('#add-image-identitycard').find('canvas').addClass('img-responsive');"
                                . '}'
                                . '}',
                            ]
                        ]);
                        ?>
                    </div>                    
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-picture-o"></i> Scann Sertifikat Organisasi</h3>
                </div>
                <div class="panel-body">
                    <div id="add-image-certificateoforganization">
                        <?php if ($member->certificate_of_organization !== null): ?>
                            <img src="<?= Yii::getAlias('@web') . "/resources/images/member/certificate/" . $member->certificate_of_organization ?>" style="width: 1024px" class="img-responsive">                            
                        <?php endif; ?>  
                        <div id="progressbox-certificateoforganization" class="progress progress-striped active" style="margin-bottom: 0; display: none">
                            <div id="progress" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="fileUpload btn btn-u btn-block">
                        <span>Unggah foto</span>
                        <?=
                        FileUpload::widget([
                            'name' => 'file',
                            'plus' => true,
                            'url' => ['/site/member/upload'],
                            'options' => ['accept' => 'image/*', 'title' => 'Ganti Photo'],
                            'clientOptions' => [
                                'dataType' => 'json',
                                'autoUpload' => true,
                                'previewMaxWidth' => 1024,
                                'previewMaxHeight' => 1024,
                                'previewCrop' => true,
                                'maxFileSize' => 2000000,
                                'formData' => [
                                    Yii::$app->request->csrfParam => Yii::$app->request->getCsrfToken(),
                                    'imagetype' => 'certificateoforganization',
                                    'id' => $member->id,
                                ]
                            ],
                            'clientEvents' => [
                                'fileuploadprogressall' => ' function (e, data) {'
                                . 'var progress = parseInt(data.loaded / data.total * 100, 10);'
                                . 'jQuery("#progressbox-certificateoforganization").css("display","block");'
                                . 'jQuery("#progressbox-certificateoforganization .progress-bar").css("width",progress + "%");'
                                . '}',
                                'fileuploaddone' => 'function (e, data){'
                                . 'jQuery("#progressbox-certificateoforganization").css("display","none");'
                                . '}',
                                'fileuploadprocessalways' => 'function (e, data) {'
                                . 'var index = data.index,file = data.files[index];'
                                . 'if (file.preview) {'
                                . "jQuery('#add-image-certificateoforganization').find('canvas').css('display','none');"
                                . "jQuery('#add-image-certificateoforganization').find('img').css('display','none');"
                                . "jQuery('#add-image-certificateoforganization').prepend(file.preview);"
                                . "jQuery('#add-image-certificateoforganization').find('canvas').addClass('img-responsive');"
                                . '}'
                                . '}',
                            ]
                        ]);
                        ?>
                    </div>                    
                </div>
            </div>
        </div>

    </div>
</div>
