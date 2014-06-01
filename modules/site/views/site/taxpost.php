<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
?>

<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
    <div class="container">
        <h1 class="pull-left"><?= ucwords($tax) ?></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?= Url::toRoute(['/site/site/index']) ?>">Beranda</a></li>              
            <li class="active"><?= ucwords($tax) ?></li>
        </ul>
    </div>
</div>
<!--/breadcrumbs-->
<div class="container content">
    <div class="row">     
            <?php
            echo ListView::widget([

                'dataProvider' => $dataProvider,
                'layout' => '{items}<div class="text-center">{pager}</div>',
                'options' => [
                    'class' => 'col-md-8'
                ],
                'pager' => [
                    'firstPageLabel' => 'First',
                    'lastPageLabel' => 'Last',
                    'nextPageLabel' => 'Next',
                    'prevPageLabel' => 'Prev',
                ],
                'itemOptions' => ['class' => 'funny-boxes funny-boxes-left-green'],
                'itemView' => function ($model, $key, $index, $widget) {
                    $param = Yii::$app->request->getQueryParams();
                    return $this->render('_tax_view', [
                                'model' => $model,
                                'index' => $index,
                                'tax' => $param['tax']
                    ]);
                },
            ]);
            ?>
      
        <!-- End Bordered Funny Boxes -->
        <div class="col-md-4 magazine-page">           

        </div>
    </div>    
</div>