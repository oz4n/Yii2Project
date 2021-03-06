<?php

use app\modules\site\widgets\RenderWidget;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = "Anggota Purna Paskibraka Indonesia";
$this->registerMetaTag(['name' => 'keywords', 'content' => 'ppi, paskibra, capas']);
?>

<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
    <div class="container">       
        <ul class="pull-right breadcrumb">
            <li><a href="<?= Url::toRoute(['/site/site/index']) ?>">Beranda</a></li>   
            <li class="active">Anggota PPI</li>
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
                    RenderWidget::widget(['colClass' => 'col-sm-12 margin-bottom-20 ', 'layoute_position' => 'memberppisidebar', 'tax' => $param['tax']]);
                    ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="<?= $model->layout === 'full' ? 'col-sm-12' : 'col-sm-8' ?> magazine-page">
            <div class="headline" style="margin-top: -7.5px"><h2>Anggota PPI</h2></div>
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
            return $this->render('_view_ppi', [
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
                    RenderWidget::widget(['colClass' => 'col-sm-12 margin-bottom-20 ', 'layoute_position' => 'memberppisidebar', 'tax' => $param['tax']]);
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </div>    
</div>