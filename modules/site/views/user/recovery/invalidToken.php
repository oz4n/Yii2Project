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
$this->title = Yii::t('user', 'Tanda pemulihan tidak valid');
?>
<div class="breadcrumbs">
    <div class="container">      
        <ul class="pull-right breadcrumb">
            <li><?= Html::a('Beranda', ['/site/site/index']) ?></li>
            <li class="active">Tanda pemulihan tidak valid</li>
        </ul>
    </div>   
</div>
<div class="container content">
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-danger">                
                <?= Yii::t('user', 'Mohon maaf karena tanda konfirmasi tidak valid. Anda dapat mencoba meminta tanda pemulihan baru.') ?>
            </div>
        </div>
    </div>
</div>

