<?php
$title1 = explode('%', $slider_title1);
$title2 = explode('%', $slider_title2);
$title3 = explode('%', $slider_title3);
?>
<!--=== Slider ===-->
<div class="fullwidthbanner-container">
    <div class="fullwidthbanner">
        <ul>
            <!-- THE FIRST SLIDE -->
            <li data-transition="3dcurtain-vertical" data-slotamount="10" data-masterspeed="300" >

                <!-- THE MAIN IMAGE IN THE FIRST SLIDE -->
                <img src="<?php echo Yii::getAlias('@web').'/resources/images/pageslider/helperpage/'.$image->imgslide1; ?>">

                <div class="caption randomrotate"
                     data-x="662"
                     data-y="0"
                     data-speed="300"
                     data-start="1900"
                     data-easing="easeOutExpo">
                    <img class="img-border" src="<?php echo Yii::getAlias('@web').'/resources/images/pageslider/helperpage/'.$image->imgslide4; ?>" alt="Image 10">
                </div>
                <div class="caption randomrotate"
                     data-x="807"
                     data-y="0"
                     data-speed="300"
                     data-start="1900"
                     data-easing="easeOutExpo">
                    <img class="img-border" src="<?php echo Yii::getAlias('@web').'/resources/images/pageslider/helperpage/'.$image->imgslide5; ?>" alt="Image 10">
                </div>


                <div class="caption randomrotate"
                     data-x="662"
                     data-y="120"
                     data-speed="300"
                     data-start="2200"
                     data-easing="easeOutExpo">
                    <img class="img-border" src="<?php echo Yii::getAlias('@web').'/resources/images/pageslider/helperpage/'.$image->imgslide6; ?>" alt="Image 13">
                </div>
                <div class="caption randomrotate"
                     data-x="662"
                     data-y="210"
                     data-speed="200"
                     data-start="1700"
                     data-easing="easeOutExpo">
                    <img class="img-border" src="<?php echo Yii::getAlias('@web').'/resources/images/pageslider/helperpage/'.$image->imgslide8; ?>" alt="Image 8">
                </div>
                <div class="caption randomrotate"
                     data-x="750"
                     data-y="210"
                     data-speed="300"
                     data-start="1700"
                     data-easing="easeOutExpo">
                    <img class="img-border" src="<?php echo Yii::getAlias('@web').'/resources/images/pageslider/helperpage/'.$image->imgslide9; ?>" alt="Image 8">
                </div>


                <div class="caption randomrotate"
                     data-x="850"
                     data-y="120"
                     data-speed="300"
                     data-start="1800"
                     data-easing="easeOutExpo">
                    <img class="img-border" src="<?php echo Yii::getAlias('@web').'/resources/images/pageslider/helperpage/'.$image->imgslide7; ?>" alt="Image 9">
                </div>
                <div class="caption large_text sft"
                     data-x="40"
                     data-y="40"
                     data-speed="300"
                     data-start="800"
                     data-easing="easeOutExpo" style="text-shadow: black 0.1em 0.1em 0.2em">
                    <?= isset($title1[0]) ? $title1[0] : "" ?>
                </div>
                <div class="caption large_text sfr"
                     data-x="300"
                     data-y="78"
                     data-speed="300"
                     data-start="1100"
                     data-easing="easeOutExpo">
                    <span style="color: #ffcc00;"><?= isset($title1[1]) ? $title1[1] : "" ?></span>
                </div>              
            </li>

            <!-- THE SECOND SLIDE -->
            <li data-transition="papercut" data-slotamount="15" data-masterspeed="300" data-delay="9400" data-thumb="<?php echo Yii::getAlias('@web'); ?>/unify-v1.4/img/sliders/revolution/thumbs/thumb2.jpg">

                <!-- THE MAIN IMAGE IN THE SECOND SLIDE -->                                               
                <img src="<?php echo Yii::getAlias('@web').'/resources/images/pageslider/helperpage/'.$image->imgslide2; ?>">
                <div class="caption large_text sfb bg-black-opacity"
                     data-x="50"
                     data-y="220"
                     data-speed="300"
                     data-start="800"
                     data-easing="easeOutExpo">

                    <span style="color: red;"><?= isset($title2[0]) ? $title2[0] : "" ?></span> <span style="color: #ffcc00;"><?= isset($title2[1]) ? $title2[1] : "" ?></span> <?= isset($title2[2]) ? $title2[2] : "" ?>
                </div>

            </li>

            <!-- THE THIRD SLIDE -->
            <li data-transition="slideleft" data-slotamount="1" data-masterspeed="300" data-thumb="<?php echo Yii::getAlias('@web'); ?>/unify-v1.4/img/sliders/revolution/thumbs/thumb3.jpg">

                <!-- THE MAIN IMAGE IN THE THIRD SLIDE -->                                               
                <img src="<?php echo Yii::getAlias('@web').'/resources/images/pageslider/helperpage/'.$image->imgslide3; ?>" >

                <div class="caption large_text sft"
                     data-x="10"
                     data-y="44"
                     data-speed="300"
                     data-start="800"
                     data-easing="easeOutExpo">
                     <?= isset($title3[0]) ? $title3[0] : "" ?>
                </div>

                <div class="caption large_text sfr"
                     data-x="88"
                     data-y="78"
                     data-speed="300"
                     data-start="1100"
                     data-easing="easeOutExpo">
                    <span style="color: #ffcc00;"> <?= isset($title3[1]) ? $title3[1] : "" ?></span>
                </div>


            </li>
        </ul>
        <!--<div class="tp-bannertimer tp-bottom"></div>-->
    </div>
</div>
<!--=== End Slider ===-->