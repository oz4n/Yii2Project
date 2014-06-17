<?php

use app\modules\dashboard\assets\ErrorAsset;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
ErrorAsset::register($this);

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
    <body class="page-500">
        <?php $this->beginBody() ?>
        <div class="header">
            <a href="<?= Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard-list']) ?>" class="logo">                
                Purna Pakibraka Indonesia
            </a> 
        </div>
        <?php echo $content; ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>