<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Post $model
 */
$this->title = Yii::t('app', 'Tambah {modelClass}', [
            'modelClass' => 'Halaman',
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
        <a href="<?php echo Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard']); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute(['/page/page/index', 'action' => 'page-list']); ?>"><?php echo Yii::t('app', Html::encode('Halaman')); ?></a>
    </li>
    <li class="active">
        <?php echo Yii::t('app', Html::encode($this->title)); ?>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="text-center text-left-sm">
                <i class="fa fa-files-o page-header-icon"> </i>
                &nbsp;
                <?= Html::encode($this->title) ?>
            </h1>
        </div>
    </div>
</div>
<div class="row">

    <?=
    $this->render('_form', [
        'model' => $model,
        'other' => $other
    ])
    ?>
</div>
