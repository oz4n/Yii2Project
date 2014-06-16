<?php

use yii\helpers\Url;
?>
<!--=== Breadcrumbs ===-->
<div class="breadcrumbs">
    <div class="container">
        <?php if ($other['imgsliderstatus'] == "Enable"): ?>
            <h1 class="pull-left"><?= $tax ?></h1>
<?php endif; ?>
        <ul class="pull-right breadcrumb">
            <li><a href="<?= Url::toRoute(['/site/site/index']) ?>">Beranda</a></li>         
            <li class="active"><?= $tax ?></li>
        </ul>
    </div>
</div>
<!--/breadcrumbs-->
<div class="container content">
<?php if ($other['imgsliderstatus'] == "Enable"): ?>
        <div class="shadow-wrapper margin-bottom-30">
            <div class="carousel slide carousel-v1 box-shadow shadow-effect-2" id="myCarousel">
                <ol class="carousel-indicators">
                    <li class="rounded-x active" data-target="#myCarousel" data-slide-to="0"></li>
                    <li class="rounded-x" data-target="#myCarousel" data-slide-to="1"></li>
                    <li class="rounded-x" data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <?php
                $image = ((object) $other['imgslider']);
                echo Html::beginTag('div', ['class' => 'carousel-inner']);
                echo isset($image->img0) ? Html::tag('div', Html::img(Yii::getAlias('@web') . "/resources/images/pageslider/page/" . $image->img0, ['class' => 'img-responsive']), ['class' => 'item active']) : "";
                echo isset($image->img1) ? Html::tag('div', Html::img(Yii::getAlias('@web') . "/resources/images/pageslider/page/" . $image->img1, ['class' => 'img-responsive']), ['class' => 'item']) : "";
                echo isset($image->img2) ? Html::tag('div', Html::img(Yii::getAlias('@web') . "/resources/images/pageslider/page/" . $image->img2, ['class' => 'img-responsive']), ['class' => 'item']) : "";
                echo Html::endTag('div');
                ?>

                <div class="carousel-arrow">
                    <a data-slide="prev" href="#myCarousel" class="left carousel-control">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a data-slide="next" href="#myCarousel" class="right carousel-control">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>            
        </div>
<?php endif; ?>
    <div class="headline" <?= $other['imgsliderstatus'] == "Enable" ? "" : "style='margin-top:-15px'" ?>>
        <h2><?= $model->title ?></h2>
    </div>
    <div>
<?= $model->content ?>
    </div>
</div>
