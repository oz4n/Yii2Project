<?php

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Member $model
 */
$this->title = $model->name;
$this->registerJsFile('PixelAdmin/js/jquery.2.0.3.min.js', [], ['position' => View::POS_HEAD]);
$this->registerJs(
    "$('ul.navigation > li#database > ul.mm-dropdown > li#member > ul.mm-dropdown > li#paskibra').addClass('active').parent().parent().addClass('open').parent().parent().addClass('active open');"
    , View::POS_READY);
?>

<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?= Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?= Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard-list']); ?>"><?= Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?= Url::toRoute(['/member/paskibra/index', 'action' => 'member-paskibra-list']); ?>"><?= Yii::t('app', Html::encode('Anggota')); ?></a>
    </li>
    <li class="active">
        <?= Yii::t('app', 'Lihat Detail') . ' : ' . $this->title; ?>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="menu-icon fa fa-users page-header-icon"> </i>
                &nbsp;
                <?= Html::encode(Yii::t('app', 'Lihat Detail')) ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass} Baru', [
                    'modelClass' => 'Anggota',
                ]), Url::toRoute(['/member/paskibra/create', 'action' => 'member-paskibra-create']))
                ?>
            </h1>
        </div>
        <div class="col-xs-4">

        </div>
    </div>
</div>


<div class="row">
    <div class="col-sx-12 col-sm-3 text-center">
        <span class="profile-picture">
            <?php
            if ($model->front_photo != null) {
                echo Html::img(Yii::getAlias('@web') . '/resources/images/member/frontphoto/' . $model->front_photo, ['id' => 'avatar', 'class' => 'editable img-responsive', 'alt' => $model->name]);
            }else{
                echo Html::img(Yii::getAlias('@web') . '/resources/images/default/user200x200.png' . $model->front_photo, ['id' => 'avatar', 'class' => 'editable img-responsive', 'alt' => $model->name]);            }
            ?>
        </span>


        <div class="space-4"></div>
        <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
            <div class="inline position-relative">
                <i class="fa fa-circle-o"></i>
                <?= $model->name; ?>
            </div>
        </div>
        <div class="space-8"></div>
        <div class="profile-contact-info">
            <div class="profile-contact-links align-left">
                <?= Html::a('<i class="fa  fa-pencil"></i>&nbsp;&nbsp;' . Yii::t('app', 'Ubah'), Url::toRoute(['/member/paskibra/update', 'action' => 'member-paskibra-update', 'id' => $model->id]), ['class' => '']) ?>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <?=
                Html::a('<i class="fa  fa-trash-o"></i>&nbsp;&nbsp;' . Yii::t('app', 'Hapus'), ['delete', 'id' => $model->id], [
                        'data-confirm' => 'Apakah Anda yakin ingin menghapus item ini?',
                        'data-method' => 'post',
                        'title' => Yii::t('yii', 'Hapus'),
                ])
                ?>
            </div>
        </div>
    </div>
    <div class="col-sx-12 col-sm-9">
        <div class="panel">
            <div class="panel-body">
                <div class="profile-user-info">
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'NRA') ?></div>
                        <div class="profile-info-value">
                            <span><?= !empty($model->nra) ? $model->nra : "none" ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Nama Lengkap') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->name; ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Nama Panggilan') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->nickname ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Nomor KTP') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->identity_card_number ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Tanggal Lahir') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->birth ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Umur</div>
                        <div class="profile-info-value">
                            <span><?= $model->age ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Alamat Lengkap</div>
                        <div class="profile-info-value">
                            <span><?= $model->address ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Jenis Kelamin') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->gender ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Agama') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->religion ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Kewarganegaraan') ?> </div>
                        <div class="profile-info-value">
                            <i class="fa fa-map-marker"></i>
                            &nbsp;
                            <span><?= $model->nationality ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Asal Daerah') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->getAreaName() ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Asal Sekolah') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->getSchollName() ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Suku Bangsa') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->tribal_members ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Kode Pos') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->zip_code ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Golongan Darah') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->blood_group ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Brevet Penghargaan') ?></div>
                        <div class="profile-info-value">
                            <span><?= !empty($model->brevetaward) ? $model->brevetaward : "none" ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Pengalaman organisasi') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->organizational_experience ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Penyakit yang di derita') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->illness ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Tinggi badan') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->height_body ?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Berat badan') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->weight_body ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Ukuran baju') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->dress_size ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Ukuran celana') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->pants_size ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Ukuran sepatu') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->shoe_size ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Ukuran topi') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->hat_size ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Status Keanggotaan') ?></div>
                        <div class="profile-info-value">
                            <span><?= !empty($model->membership_status) ? $model->membership_status : "none" ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Status Organisasi') ?></div>
                        <div class="profile-info-value">
                            <span><?= !empty($model->status_organization) ? $model->status_organization : 'none' ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Tahun Angkatan') ?></div>
                        <div class="profile-info-value">
                            <span><?= !empty($model->year) ? $model->year : "none" ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Status Pendidikan') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->educational_status ?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Status Perkawinan') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->marital_status ?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Pekerjaan') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->job ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Email') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->email ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Nomor HP') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->phone_number ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Nomor HP Lainnya') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->other_phone_number ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Status dg HP') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->relationship_phone_number ?></span>
                        </div>
                    </div>
                    
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Nama Bapak') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->father_name ?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Nama Ibu') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->mother_name ?></span>
                        </div>
                    </div>
                    
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Pekerjaan bapak') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->father_work ?></span>
                        </div>
                    </div>
                    
                     <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Pekerjaan ibu') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->mother_work ?></span>
                        </div>
                    </div>
                    
                     <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Penghasilan bapak') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->income_father ?></span>
                        </div>
                    </div>
                    
                     <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Penghasilan ibu') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->income_mothers ?></span>
                        </div>
                    </div>
                    
                     <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Jumlah saudara laki-laki') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->number_of_brothers ?></span>
                        </div>
                    </div>
                    
                     <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Jumlah saudara perempuan') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->number_of_sisters ?></span>
                        </div>
                    </div>
                    
                     <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Jumlah anak kandung') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->number_of_children ?></span>
                        </div>
                    </div>
                    
                     <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Keterampilan bahasa asing') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->languageskill ?></span>
                        </div>
                    </div>
                    
                     <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Keterampilan personal') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->lifeskill ?></span>
                        </div>
                    </div>
                    
                     <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Catatan') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->note ?></span>
                        </div>
                    </div>
                    
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Terdaftar') ?></div>
                        <div class="profile-info-value">
                            <i class="fa fa-calendar"></i>
                            &nbsp;
                            <span><?= date("F d, Y",strtotime($model->create_et)) ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Diperbaharui') ?></div>
                        <div class="profile-info-value">
                            <i class="fa fa-calendar"></i>
                            &nbsp;                          
                             <span><?= date("F d, Y",strtotime($model->update_et)) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>