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
    <div class="row">
        <div class="col-sm-8">
            <?php if ($other['imgsliderstatus'] == "Enable"): ?>
                <div class="shadow-wrapper margin-bottom-30">
                    <div class="carousel slide carousel-v1 box-shadow shadow-effect-2" id="myCarousel">
                        <ol class="carousel-indicators">
                            <li class="rounded-x active" data-target="#myCarousel" data-slide-to="0"></li>
                            <li class="rounded-x" data-target="#myCarousel" data-slide-to="1"></li>
                            <li class="rounded-x" data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="item active">
                                <img class="img-responsive" src="<?php echo Yii::getAlias('@web') . "/resources/images/pageslider/page/" . $other['imgslider'][0]; ?>" alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive" src="<?php echo Yii::getAlias('@web') . "/resources/images/pageslider/page/" . $other['imgslider'][1]; ?>" alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive" src="<?php echo Yii::getAlias('@web') . "/resources/images/pageslider/page/" . $other['imgslider'][2]; ?>" alt="">
                            </div>
                        </div>

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
        <div class="col-sm-4"></div>
    </div>

</div>
