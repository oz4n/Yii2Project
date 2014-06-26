<?php
use app\modules\site\widgets\RenderWidget;
$this->title = Yii::$app->name;
$this->registerMetaTag(['name' => 'keywords', 'content' =>  str_replace(" ", ', ', $this->title)]);

/* Slider */
echo $this->render('slider',[
    'image'=>$image,     
     'slider_title1' => $other->slider_title1,
     'slider_title2' => $other->slider_title2,
     'slider_title3' => $other->slider_title3,
]);
?>


<div class="container content">
    <!--<div class="clearfix margin-bottom-20"></div>-->
    <div class="shadow-wrapper">
        <div class="tag-box tag-box-v1 box-shadow shadow-effect-2">
            <h2>Kata mutiara hari ini</h2>
            <p><?= $other->quotes_today ?></p>
        </div>      
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6">
                    <?=
                    RenderWidget::widget(['colClass'=>'col-sm-12 margin-bottom-20 ','layoute_position' => 'homeleft']);
                    ?>
                </div>
                <!--Info Block-->
                <div class="col-md-6">
                    <?=
                    RenderWidget::widget(['colClass'=>'col-sm-12 margin-bottom-20 ','layoute_position' => 'homeright']);
                    ?>
                </div>
                <!--End Info Block-->
            </div>
        </div>
        <div class="col-md-3">
            <?=
            RenderWidget::widget(['colClass'=>'col-sm-12 margin-bottom-20 ','layoute_position' => 'homesidebar']);
            ?>
        </div>
    </div>
</div>
