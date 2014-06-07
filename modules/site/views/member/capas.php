<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
?>

<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
    <div class="container">
        <h1 class="pull-left">Anggota Capas</h1>
        <ul class="pull-right breadcrumb">
            <li><a href="#">Home</a></li>              
            <li class="active">Anggota Capas</li>
        </ul>
    </div>
</div>
<!--/breadcrumbs-->
<div class="container content">
    <div class="row">
        <div class="col-md-4 magazine-page">   
            <div class="headline margin-bottom-20" style="margin-top: -10px"><h2>Daftar Sebagai Anggota</h2></div>
            <ol>
                <li>Admin PPE</li>
                <li>Admin Agency</li>
                <li>Helpdesk</li>
                <li>Sub Admin</li>
            </ol>
        </div>

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
            return $this->render('_view_ppi', [
                        'model' => $model,
                        'index' => $index,
            ]);
        },
            ]);
           ?>
        </div>
        <!-- End Bordered Funny Boxes -->
    </div>    
</div>