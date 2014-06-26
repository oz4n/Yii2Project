<?php
/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $model
 */
$this->title = Yii::$app->getModule('user')->confirmable ?
        Yii::t('user', 'Konfirmasi terkirim') :
        Yii::t('user', 'Akun Anda telah dibuat');
?>



<div class="breadcrumbs">
    <div class="container">      
        <ul class="pull-right breadcrumb">
            <li><?= Html::a('Beranda', ['/site/site/index']) ?></li>
            <li class="active">
<?= $this->title ?>
            </li>
        </ul>
    </div>   
</div>
<div class="container content">
    <div class="row">
        <div class="col-sm-12">

            <?php if (Yii::$app->getModule('user')->confirmable): ?>
                <div class="alert alert-info">                    
                    <?= Yii::t('user', 'Silakan periksa email Anda dan klik link konfirmasi untuk menyelesaikan pendaftaran Anda.') ?>
                    <?= Yii::t('user', 'Anda perlu beberapa menit untuk menungu pesan masuk pada email Anda. Tetapi jika Anda mengalami kendala, Anda dapat meminta yang baru.') ?>
                    <?= Html::a(Yii::t('user', 'Meminta pesan konfirmasi baru'), ['/user/registration/resend']) ?>
                </div>
                <?php else: ?>
                <div class="alert alert-success">
                    <h4><?= Html::encode($this->title) ?></h4>
                    <?= Yii::t('user', 'Terima kasih untuk pendaftaran di website kami. Anda dapat masuk menggunakan kredensial Anda.') ?>
                </div>
                <?php endif; ?>
        </div>
    </div>
</div>
