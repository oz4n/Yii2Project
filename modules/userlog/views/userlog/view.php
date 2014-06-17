<?php

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;
/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\UserLog $model
 */

$this->title = $model->title;

$this->registerJsFile('PixelAdmin/js/jquery.2.0.3.min.js', [], ['position' => View::POS_HEAD]);
$this->registerJs(
    "$('ul.navigation > li#user > ul.mm-dropdown > li#log-account').addClass('active').parent().addClass('open').parent().addClass('active open');"
    , View::POS_READY);
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?php echo Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?php echo Url::toRoute(['/dashboard/dashboard/index','action' => 'dashboard']); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute(['/userlog/userlog/index', 'action' => 'user-log-list']); ?>"><?php echo Yii::t('app', Html::encode('Log Akun')); ?></a>
    </li>
    <li class="active">
        <?= $this->title ?>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa  fa-male page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Lihat Detail Log Akun') ?>
            </h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-body">
                <div class="profile-user-info">
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Keterangan') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->title; ?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Nama Pengguna') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->getUserNameByID(); ?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Remot IP') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->user_ip; ?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Kode Negara') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->country_code; ?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Nama Negara') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->contry; ?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Wilayah') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->region; ?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Kota') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->city; ?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Kode Post') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->zip_code; ?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Sistem Oprasi') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->platform; ?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Nama Browser') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->browser; ?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Versi Browser') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->browser_version; ?></span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Metode Aksi') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->action_method; ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'User Agent') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->user_agent; ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Latitude') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->latitude; ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Longitude') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->longitude; ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Zona Waktu') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->time_zone; ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Tercatat') ?></div>
                        <div class="profile-info-value">
                            <span><?= $model->create_at; ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Absolute Url') ?></div>
                        <div class="profile-info-value">
                            <div class="highlight">
                                <pre><code class="html"><span class="cm"><?= $model->absolute_url ?></span></code></pre>
                            </div>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> <?= Yii::t('app', 'Content') ?></div>
                        <div class="profile-info-value">
                            <div class="highlight">
                                <pre><code><span class="cm"><?= print_r(json_decode($model->content)) ?></span></code></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


