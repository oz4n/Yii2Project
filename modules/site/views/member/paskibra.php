<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
$this->title = "Anggota Paskibra Indonesia";
$this->registerMetaTag(['name' => 'keywords', 'content' =>'paskibra']);
?>

<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
    <div class="container">
        <h1 class="pull-left">Anggota Paskibra</h1>
        <ul class="pull-right breadcrumb">
            <li><a href="#">Home</a></li>              
            <li class="active">Anggota Paskibra</li>
        </ul>
    </div>
</div>
<!--/breadcrumbs-->
<div class="container content">
    <div class="row">
        <!-- Bordered Funny Boxes -->
        <div class="col-sm-8">
           <?php 
            echo ListView::widget([

                'dataProvider' => $dataProvider,
                'layout' =>'{items}<div class="text-center">{pager}</div>',                
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
        <div class="col-md-4 magazine-page">   
            <div class="headline margin-bottom-20" style="margin-top: -10px"><h2>Daftar Sebagai Anggota</h2></div>
            <ol>
                <li>Purna Paskibraka Indonesia (PPI)</li>
                <li>Paskibra</li>
                <li>Calon Paskibra (Capas)</li>             
            </ol>
        </div>
    </div>    
</div>