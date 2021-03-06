<?php

use app\modules\site\widgets\RenderWidget;
use yii\widgets\ListView;
use yii\helpers\Url;

$this->title = "Anggota Paskibra Indonesia";
$this->registerMetaTag(['name' => 'keywords', 'content' => 'ppi, paskibra, capas']);
?>

<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
    <div class="container">     
        <ul class="pull-right breadcrumb">
            <li><a href="<?= Url::toRoute(['/site/site/index']) ?>">Beranda</a></li>          
            <li class="active">Anggota Paskibra</li>
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
                    RenderWidget::widget(['colClass' => 'col-sm-12 margin-bottom-20 ', 'layoute_position' => 'memberpaskibrasidebar', 'tax' => $param['tax']]);
                    ?>
                </div>
            </div>
        <?php endif; ?>
         <div class="<?= $model->layout === 'full' ? 'col-sm-12': 'col-sm-8' ?>">
              <div class="headline" style="margin-top: -7.5px"><h2>Anggota Paskibra</h2></div>
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
            return $this->render('_view_paskibra', [
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
                    RenderWidget::widget(['colClass' => 'col-sm-12 margin-bottom-20 ', 'layoute_position' => 'memberpaskibrasidebar', 'tax' => $param['tax']]);
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </div>    
</div>