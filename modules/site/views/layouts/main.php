<?php

use app\modules\site\assets\SiteAsset;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
SiteAsset::register($this);
$this->registerJs(
        'jQuery(document).ready(function() {'.
        'App.init();' .
        'Index.initRevolutionSlider();' .
        'OwlCarousel.initOwlCarousel();'.      
        '});'
, View::POS_END);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="<?= Yii::$app->language ?>" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="<?= Yii::$app->language ?>" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="<?= Yii::$app->language ?>"> <!--<![endif]-->  
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="header-fixed boxed-layout container">
        <?php $this->beginBody() ?>
        <div class="wrapper">
            <?php
            /* Header */
            echo $this->render('header');
            
            /* Content Part */
            echo $content;
            /* Footer */
            echo $this->render('footer');
            /*copyright*/
            echo $this->render('copyright');
            ?>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>