<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;
$other = Json::decode($model->other_content);
?>
<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
    <div class="container">
        <h1 class="pull-left">Berita</h1>
        <ul class="pull-right breadcrumb">
            <li><a href="#">Home</a></li>              
            <li class="active">Berita</li>
        </ul>
    </div>
</div>
<!--/breadcrumbs-->
<div class="container content">
    <div class="row blog-page blog-item">
        <!-- Bordered Funny Boxes -->
        <div class="col-sm-8" style="margin-top: -14px">
            <div class="blog">
                <h2><?= $model->title ?></h2>
                <div class="blog-post-tags">
                    <ul class="list-unstyled list-inline blog-info">
                        <li><i class="fa fa-calendar"></i>&nbsp;&nbsp;<?= date('F j, Y',strtotime($model->create_et)); ?></li>
                        <li><i class="fa fa-user"></i>&nbsp;&nbsp;Administrator</li>
                        <li><i class="fa fa-bullhorn"></i>&nbsp;&nbsp; <?= $tax ?></li>
                    </ul>                                     
                </div>
                <?= $model->content ?>                
                <?php if(isset($other['tag'])): ?>
                <div class="blog-post-tags">                  
                    <ul class="list-unstyled list-inline blog-tags">
                        <li>
                            <i class="fa fa-tags"></i> 
                            <?= implode(' ', $model->getTagLinks($other['tag'])) ?>
                        </li>
                    </ul>                                                
                </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- End Bordered Funny Boxes -->
        <div class="col-sm-4 magazine-page">
        </div>
    </div>    
</div>