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
 */
$this->title = Yii::t('user', 'Pesan Pemulihan terkirim');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breadcrumbs">
    <div class="container">      
        <ul class="pull-right breadcrumb">
            <li><?= Html::a('Beranda', ['/site/site/index']) ?></li>
            <li class="active">Pesan Pemulihan terkirim</li>
        </ul>
    </div>   
</div>
<div class="container content">
    <div class="row">
        <div class="col-sm-12">

            <div class="alert alert-info">

                <p>
                    <?= Yii::t('user', 'Anda telah mengirim email dengan petunjuk tentang cara untuk mereset password Anda.') ?>
                    <?= Yii::t('user', 'Silakan periksa email Anda dan klik link reset.') ?>
                </p>
                <p>
                <?= Yii::t('user', 'Munkin anda perlu menunggu beberapa menit menunggu email konfirmasi. Tetapi jika Anda mengalami, Anda dapat meminta yang baru.') ?>
                </p>
            </div>
        </div>
    </div>
</div>

