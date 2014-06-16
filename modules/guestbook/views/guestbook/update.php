<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Guestbook $model
 */
$this->title = "Buku Tamu: " . $model->name;
$this->registerJs(
        "$('ul.navigation > li#guestbook').addClass('active');"
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
        <a href="<?= Url::toRoute(['/guestbook/guestbook/index', 'action' => 'guestbook-list']); ?>"><?= Yii::t('app', Html::encode('Buku Tamu')); ?></a>
    </li>
    <li class="active">
        Perbaharui
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa  fa-comments-o page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Buku Tamu') ?>                
            </h1>
        </div>        
    </div>
</div>
<div class="row">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
