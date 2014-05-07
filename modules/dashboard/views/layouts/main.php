<?php

use app\modules\dashboard\assets\DashboardAsset;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
DashboardAsset::register($this);
$this->registerJs(
        'var init = [];'
        , View::POS_HEAD);
$this->registerJsFile('PixelAdmin/js/demo.js', [], ['position' => View::POS_BEGIN]);
$this->registerJs(
        'init.push(function () {});'.
        'window.PixelAdmin.start(init);'
        , View::POS_END);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="<?= Yii::$app->language ?>" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="<?= Yii::$app->language ?>" class="ie9 gt-ie8"> <![endif]-->  
<!--[if !IE]><!--> <html lang="<?= Yii::$app->language ?>" class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->  
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="theme-default main-menu-animated">
        <?php $this->beginBody() ?>
        <div id="main-wrapper">
            <?php 
            echo $this->render('navbar'); 
            echo $this->render('sidebar'); 
            ?>
            <div id="content-wrapper">
                <?php  echo $content; ?>
            </div>    
            <div id="main-menu-bg"></div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>