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
$this->title = Yii::t('user', 'Sandi pemulihan');
?>
<div class="breadcrumbs">
    <div class="container">      
        <ul class="pull-right breadcrumb">
            <li><?= Html::a('Beranda', ['/site/site/index']) ?></li>
            <li class="active">Sandi pemulihan</li>
        </ul>
    </div>   
</div>
<div class="container content">
    <div class="row">
        <div class="col-sm-12">

            <div class="alert alert-success">               
                <?= Yii::t('user', 'Kata sandi Anda telah berhasil diubah. Anda dapat mencoba login menggunakan password baru anda.') ?>
            </div>
        </div>
    </div>
</div>

