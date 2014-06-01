<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\site\helpers\TextHelper;
use app\modules\site\helpers\IMachTagHtml;

$img = explode("/", IMachTagHtml::getImgMach($model->content, "blank.png"));
$imgname = $img[count($img) - 1];
?>
<div class="row">
    <div class="col-md-4 funny-boxes-img">
        <img alt="" src="<?php echo Yii::getAlias('@web') . "/resources/images/thumbnail/191x128/" . $imgname; ?>" class="img-responsive">
        <ul class="list-unstyled">
            <li><i class="fa fa-calendar"></i>&nbsp;<?= date('F j, Y',strtotime($model->create_et)); ?></li>            
            <li><i class="fa fa-bullhorn"></i>&nbsp;<?= $model->findTaxNameBySLug($tax) ?></li>
          
        </ul>
    </div>
    <div class="col-md-8">                        
        <h2><?= Html::a($model->title, Url::toRoute(['/site/site/view', 'tax' => $tax, 'slug' => $model->slug])); ?></h2>           
        <p>
            <?= TextHelper::word_limiter(strip_tags($model->content), 45) ?>
        </p>
        <a href="<?= Url::toRoute(['/site/site/view', 'tax' => $tax, 'slug' => $model->slug]) ?>" class="btn btn-success btn-xs">
            <i class="fa fa-dot-circle-o"></i>&nbsp; Selengkapnya
        </a>
    </div>
</div>             
<div class="margin-bottom-30"></div>