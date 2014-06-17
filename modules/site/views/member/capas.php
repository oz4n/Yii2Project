<?php

use app\modules\site\widgets\RenderWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = "Calon Anggota Paskibraka Indonesia";
$this->registerMetaTag(['name' => 'keywords', 'content' => 'ppi, paskibra, capas, calon anggota']);
?>

<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
    <div class="container">
        <h1 class="pull-left">Anggota Capas</h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?= Url::toRoute(['/site/site/index']) ?>">Beranda</a></li>              
            <li class="active">Anggota Capas</li>
        </ul>
    </div>
</div>
<!--/breadcrumbs-->
<div class="container content">
    <div class="row">

        <?php if ($model->layout === 'left'): ?>
            <div class="col-md-4 magazine-page">
                <div class="row">
                    <?=
                    RenderWidget::widget(['colClass' => 'col-sm-12 margin-bottom-20 ', 'layoute_position' => 'membercapassidebar', 'tax' => $param['tax']]);
                    ?>
                </div>
            </div>
        <?php endif; ?>
        <!-- Bordered Funny Boxes -->
        <div class="<?= $model->layout === 'full' ? 'col-sm-12': 'col-sm-8' ?>">
            <?php
            echo ListView::widget([

                'dataProvider' => $dataProvider,
                'layout' => '{items}<div class="text-center">{pager}</div>',
                'options' => [
                    'class' => ''
                ],
                'pager' => [
                    'nextPageLabel' => 'Next',
                    'prevPageLabel' => 'Prev',
                ],
                'itemOptions' => ['class' => 'timeline-list'],
                'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_view_capas', [
                        'model' => $model,
                        'index' => $index,
            ]);
        },
            ]);
            ?>
        </div>
        <?php if ($model->layout === 'right'): ?>
            <div class="col-md-4 magazine-page">
                <div class="row">
                    <?=
                    RenderWidget::widget(['colClass' => 'col-sm-12 margin-bottom-20 ', 'layoute_position' => 'membercapassidebar', 'tax' => $param['tax']]);
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </div>    
</div>