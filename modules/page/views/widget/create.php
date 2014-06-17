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
        "$('ul.navigation > li#pages').addClass('active');"
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
        <a href="<?php echo Url::toRoute(['/page/page/index', 'action' => 'page-list']); ?>"><?php echo Yii::t('app', Html::encode('Halaman')); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute(['/page/page/update', 'action' => 'page-update', 'id' => $page]); ?>"><?php echo Yii::t('app', Html::encode($pagename)); ?></a>
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
                    "page" => $page,
                    'pagetype' => $pagetype
                ]);
                break;
            case "RecentPosts";
                echo $this->render('_recent_post_form', [
                    'model' => $model,
                    'new' => $new,
                    "page" => $page,
                    'pagetype' => $pagetype
                ]);
                break;
            case "RecentPostsHome";
                echo $this->render('_recent_post_form', [
                    'model' => $model,
                    'new' => $new,
                    "page" => $page,
                    'pagetype' => $pagetype
                ]);
                break;
            case "Contact";
                echo $this->render('_contact_form', [
                    'model' => $model,
                    'new' => $new,
                    "page" => $page,
                    'pagetype' => $pagetype
                ]);
                break;
            case "GuestBook";
                echo $this->render('_guest_book_form', [
                    'model' => $model,
                    'new' => $new,
                    "page" => $page,
                    'pagetype' => $pagetype
                ]);
                break;
            case "SosialNetwork";
                echo $this->render('_sosial_network_form', [
                    'model' => $model,
                    'new' => $new,
                    "page" => $page,
                    'pagetype' => $pagetype
                ]);
                break;
            case "HTML";
                echo $this->render('_html_text_form', [
                    'model' => $model,
                    "page" => $page,
                    'pagetype' => $pagetype
                ]);
                break;
        }
        ?>
    </div>
</div>
