<?php
/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;
/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $model
 */
$this->title = Yii::t('user', 'Tambah Akun');
$this->registerJs(
        "$('ul.navigation > li#user > ul.mm-dropdown > li#account').addClass('active').parent().addClass('open').parent().addClass('active open');"
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
        <a href="<?= Url::toRoute(['/user/admin/index', 'action' => 'user-list']); ?>"><?= Yii::t('app', 'Akun'); ?></a>
    </li>
    <li class="active">
        Tambah Akun
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa fa-user page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Akun') ?>
                
            </h1>
        </div>
        <div class="col-xs-4">
            
        </div>
    </div>
</div>

<div class="row">

    <div class="col-sm-6">
        <?=
        $this->render("_form", [
            'model' => $model
        ]);
        ?>
    </div>
</div>
