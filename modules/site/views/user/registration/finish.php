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
$this->title = Yii::t('user', 'Akun Anda telah dikonfirmasi');
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
            <div class="alert alert-success">   
<?= Yii::t('user', 'Anda telah berhasil mengkonfirmasi alamat email Anda. Anda dapat masuk menggunakan kredensial Anda sekarang.') ?>
            </div>
        </div>
    </div>
</div>

