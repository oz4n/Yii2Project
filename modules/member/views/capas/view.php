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
    "$('ul.navigation > li#database > ul.mm-dropdown > li#member > ul.mm-dropdown > li#capas').addClass('active').parent().parent().addClass('open').parent().parent().addClass('active open');"
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
        <a href="<?= Url::toRoute(['/member/capas/index', 'action' => 'member-capas-list']); ?>"><?= Yii::t('app', Html::encode('Anggota')); ?></a>
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
                ]), Url::toRoute(['/member/capas/create', 'action' => 'member-capas-create']))
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
            <?=
            Html::img(Yii::getAlias('@web') . '/resources/images/member/frontphoto/' . $model->front_photo, ['id' => 'avatar', 'class' => 'editable img-responsive', 'alt' => $model->name]);
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
                <?= Html::a('<i class="fa  fa-pencil"></i>&nbsp;&nbsp;' . Yii::t('app', 'Ubah'), Url::toRoute(['/member/capas/update', 'action' => 'member-capas-update', 'id' => $model->id]), ['class' => '']) ?>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <?=
                Html::a('<i class="fa  fa-trash-o"></i>&nbsp;&nbsp;' . Yii::t('app', 'Hapus'), ['delete', 'id' => $model->id], [
                    'data' => [
                        'data-confirm' => 'Apakah Anda yakin ingin menghapus item ini?',
                        'data-method' => 'post',
                        'data-pjax' => 0,
                        'title' => Yii::t('yii', 'Hapus'),
                    ],
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
                            <span><?= $model->nra ?></span>
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
                        <div class="profile-info-name"> <?= Yii::t('app', 'Kelahiran') ?></div>
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
                        <div class="profile-info-name"> <?= Yii::t('app', 'Kebangsaan') ?> </div>
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
                        <div class="profile-info-name"> <?= Yii::t('app', 'Nomor KTP') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->identity_card_number ?></span>
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
                        <div class="profile-info-name"> <?= Yii::t('app', 'Brevet Penghargaan') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->brevetaward ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Status Perkawinan') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->organizational_experience ?></span>
                        </div>
                    </div>


                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Terdaftar') ?></div>
                        <div class="profile-info-value">
                            <i class="fa fa-calendar"></i>
                            &nbsp;
                            <span><?= $model->create_et ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Diperbaharui') ?></div>
                        <div class="profile-info-value">
                            <i class="fa fa-calendar"></i>
                            &nbsp;
                            <span><?= $model->update_et ?></span>
                        </div>
                    </div>


                </div>
            </div>
        </div>


    </div>
</div>


<div class="space-10"></div>

<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-small">
                <h4 class="smaller">
                    <i class="fa fa-bookmark-o"></i>
                    &nbsp;
                    <?= Yii::t('app', 'Catatan') ?>
                </h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <p>
                        <?= $model->note; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-6">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-small header-color-blue2">
                <h4 class="smaller">
                    <i class="fa fa-lightbulb-o"></i>&nbsp;
                    <?= Yii::t('app', 'Keterampilan') ?>
                </h4>
            </div>

            <div class="widget-body">
                <div class="widget-main padding-16">

                    <div class="hr hr-16"></div>

                </div>
            </div>
        </div>
    </div>
</div>

