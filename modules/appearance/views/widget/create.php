<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Widget $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Widget',
]);
$this->registerJs(
    "$('ul.navigation > li.mm-dropdown > ul > li#widget').addClass('active').parent().parent().addClass('active open');"
    , View::POS_READY);
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?php echo Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?php echo Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard-list']); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute(['/appearance/widget/index', 'action' => 'appearance-widget-list']); ?>"><?php echo Yii::t('app', 'Widget'); ?></a>
    </li>
    <li class="active">
       Tambah Widget
    </li>
</ul>


<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa  fa-sitemap page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Widget') ?>
            </h1>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-6">

        <?php
        switch ($model->type) {
            case "PostSerch":
                echo $this->render('_serch_post_form', [
                    'model' => $model,
                    'new' => $new,
                ]);
                break;
            case "RecentPosts";
                echo $this->render('_recent_post_form', [
                    'model' => $model,
                    'new' => $new
                ]);
                break;
            case "RecentPostsHome";
                echo $this->render('_recent_post_form', [
                    'model' => $model,
                    'new' => $new
                ]);
                break;
            case "Contact";
                echo $this->render('_contact_form', [
                    'model' => $model,
                    'new' => $new
                ]);
                break;
            case "GuestBook";
                echo $this->render('_guest_book_form', [
                    'model' => $model,
                    'new' => $new
                ]);
                break;
            case "SosialNetwork";
                echo $this->render('_sosial_network_form', [
                    'model' => $model,
                    'new' => $new
                ]);
                break;
            case "HTML";
                echo $this->render('_html_text_form', [
                    'model' => $model,
                ]);
                break;
        }
        ?>
    </div>
</div>
