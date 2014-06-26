<?php

use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\helpers\Url;

//use yii\imperavi\Widget as ImperaviWidget;
/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Post $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerCssFile(Yii::getAlias('@web') . '/jnestable/widgetnestable.css');
$this->registerJs(
        '$("#select-tag").select2({ allowClear: true, placeholder: "Tag ..."}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
        . '$("#select-status").select2({ allowClear: true, placeholder: "Tag ..."}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
        , View::POS_READY);

//fost form validation
$this->registerJs(
        'init.push(function () { '
        . '$("body").on("click",".switcher-state-on",function(){'
        . '$("#img-slider").fadeOut();'
        . '});'
        . '$("body").on("click",".switcher-state-off",function(){'
        . '$("#img-slider").fadeIn();'
        . '});'
        . '$("#imgsliderstatus-id").switcher({'
        . 'theme: "square",'
        . '});'
        . 'var page_form = $("#page-form");'
        . 'page_form.validate({'
        . 'ignore: ".ignore",'
        . 'focusInvalid: true,'
        . 'rules:{'
        . '"PageModel[title]":{required: true, maxlength: 128},'
        . '"PageModel[status]":{required: true},'
        . '},'
        . 'messages: {'
        . '"PageModel[title]" : "Tidak boleh Kosong.",'
        . '"PageModel[status]" : "Tidak boleh Kosong.",'
        . '}'
        . '});'
        . '});'
        , View::POS_READY);
//delte menu item
$this->registerJs(
        '$("body").on("click",".widget-delete",function(){'
        . 'console.log(this);'
        . 'var data_id = $(this).attr("data-id");'
        . '$(this).parent().parent().parent().remove();'
        . '$.ajax({
                url: "' . Url::toRoute(['/page/widget/deletewidgetitem', 'action' => 'appearance-widget-deleteitem']) . '",
                type:"post",
                data:{
                    "dataid":data_id,
                    "' . Yii::$app->request->csrfParam . '" : "' . Yii::$app->request->getCsrfToken() . '"
                },
                dataType:"json",
                success:function(response){
                    $("html,body").animate({ scrollTop: 0 }, 500);
                        PixelAdmin.plugins.alerts.add("<strong>Sukses!</strong>&nbsp;" + response.text, {
                            type:"success",
                            auto_close:9
                       });
                }
            });'
        . 'return false;'
        . '});'
        , View::POS_READY);
$this->registerJs(
        'var nestable_updatesort = function(jsonstring) {
            $.ajax({
                    url: "' . Url::toRoute(['/page/widget/updateposition', 'action' => 'page-widget-updateposition']) . '",
                    type: "POST",
                    dataType: "json",
                    data: {
                        data: jsonstring,
                        "' . Yii::$app->request->csrfParam . '" : "' . Yii::$app->request->getCsrfToken() . '",
                    },
                    success: function(response) {
                        $("html,body").animate({ scrollTop: 0 }, 500);
                        PixelAdmin.plugins.alerts.add("<strong>Sukses!</strong>&nbsp;" + response.text, {
                            type:"success",
                            auto_close:9
                       });
                    }
            });
        };
        
        var updateOutput = function(id)
        {
            var listdata = $(id + " .dd-list").find("li");
            for(var i = 0; i < listdata.length; i++){
                if(id === "#nestable-left"){
                     $(listdata[i]).attr("data-position",i);
                     $(listdata[i]).attr("data-layoute","homeleft");
                }else if(id === "#nestable-right"){
                     $(listdata[i]).attr("data-position",i);
                     $(listdata[i]).attr("data-layoute","homeright");
                }

            }
        };

        var nestableBuilder = function(id) {
            $(id).nestable({
                group: 1,
                handleClass     : "dd-handle",
                listNodeName    : "ol",
                itemNodeName    : "li",
                expandBtnHTML : "",
                collapseBtnHTML : ""
            }).on("change", function(){updateOutput(id);});
            $(".dd-handle a").on("mousedown", function(e){
                    e.stopPropagation();
            });
        };
        nestableBuilder("#nestable-right");
        nestableBuilder("#nestable-left");
        nestableBuilder("#nestable-sidebar");
        $("body").on("click","#btn-right-save",function(){
            var e = $("#nestable-right").data("output", $("#nestableMenu-output"));
            var list = e.length ? e : $(e.target);
            nestable_updatesort(window.JSON.stringify(list.nestable("serialize")));
        });

        $("body").on("click","#btn-left-save",function(){
            var e = $("#nestable-left").data("output", $("#nestableMenu-output"));
            var list = e.length ? e : $(e.target);
            nestable_updatesort(window.JSON.stringify(list.nestable("serialize")));
        });
        $("body").on("click","#btn-sidebar-save",function(){
            var e = $("#nestable-sidebar").data("output", $("#nestableMenu-output"));
            var list = e.length ? e : $(e.target);
            nestable_updatesort(window.JSON.stringify(list.nestable("serialize")));
        });
        '
        , View::POS_READY);
//redactor
$this->registerJs(
        '
        $("#post-content").redactor({
        imageUpload:"' . Url::toRoute(['/filemanager/image/uploadredactorimage']) . '",
        imageGetJson:"' . Url::toRoute(['/filemanager/image/loadredactorimage']) . '",
        albumGetJson:"' . Url::toRoute(['/filemanager/image/loadredactoralbum']) . '",
        thumbnail192:"' . Yii::getAlias('@web') . '/resources/images/thumbnail/191x128/",
        imgoriginal:"' . Yii::getAlias('@web') . '/resources/images/original/",
        imageUploadErrorCallback:function(data){
            $("html,body").animate({ scrollTop: 0 }, 500);
            PixelAdmin.plugins.alerts.add("<strong>Maap!</strong>&nbsp;" + data.error, {
                type:"danger",
                auto_close:9
            });
        },
        fileUpload:"' . Url::toRoute(['/filemanager/document/uploaddredactorfile']) . '", 
        fileGetJson:"' . Url::toRoute(['/filemanager/document/loadredactorfile']) . '",
        fileUploadErrorCallback:function(data){           
            $("html,body").animate({ scrollTop: 0 }, 500);
            PixelAdmin.plugins.alerts.add("<strong>Maap!</strong>&nbsp;" + data.error, {
                type:"danger",
                auto_close:9
            });
        },
        uploadFields:{
            "' . Yii::$app->request->csrfParam . '" : "' . Yii::$app->request->getCsrfToken() . '",
        },
        lang: "id",
        deniedTags: ["div"],
        imgLoading:"' . Yii::getAlias('@web') . "/PixelAdmin/img/loading.gif" . '",
        
        _csrf:"' . Yii::$app->request->getCsrfToken() . '",
        _csrfname:"' . Yii::$app->request->csrfParam . '",
        placeholder:"Isi...",
        toolbarFixedBox: true,
        convertVideoLinks:true,
        convertImageLinks:true,
        observeLinks:true,
        linkAnchor:true,
        linkEmail:true,  
        plugins: ["fullscreen"]
    });
    
', View::POS_READY);
//add image slider to input value
$this->registerJs(
        '$("#save-page").on("click",function(){'
        . 'var dataimage = new Object();'
        . 'var imgslide1 = $(".img-slide1").find("img");'
        . 'var imgslide2 = $(".img-slide2").find("img");'
        . 'var imgslide3 = $(".img-slide3").find("img");'
        . 'var imgslide4 = $(".img-slide4").find("img");'
        . 'var imgslide5 = $(".img-slide5").find("img");'
        . 'var imgslide6 = $(".img-slide6").find("img");'
        . 'var imgslide7 = $(".img-slide7").find("img");'
        . 'var imgslide8 = $(".img-slide8").find("img");'
        . 'var imgslide9 = $(".img-slide9").find("img");'
        . 'if(imgslide1.length !== 0){'
        . 'dataimage["imgslide1"] = $(imgslide1).attr("data-unique");'
        . '}else{'
        . 'dataimage["imgslide1"] = false;'
        . '}'
        . 'if(imgslide2.length !== 0){'
        . 'dataimage["imgslide2"] = $(imgslide2).attr("data-unique");'
        . '}else{'
        . 'dataimage["imgslide2"] = false;'
        . '}'
        . 'if(imgslide3.length !== 0){'
        . 'dataimage["imgslide3"] = $(imgslide3).attr("data-unique");'
        . '}else{'
        . 'dataimage["imgslide3"] = false;'
        . '}'
        . 'if(imgslide4.length !== 0){'
        . 'dataimage["imgslide4"] = $(imgslide4).attr("data-unique");'
        . '}else{'
        . 'dataimage["imgslide4"] = false;'
        . '}'
        . 'if(imgslide5.length !== 0){'
        . 'dataimage["imgslide5"] = $(imgslide5).attr("data-unique");'
        . '}else{'
        . 'dataimage["imgslide5"] = false;'
        . '}'
        . 'if(imgslide6.length !== 0){'
        . 'dataimage["imgslide6"] = $(imgslide6).attr("data-unique");'
        . '}else{'
        . 'dataimage["imgslide6"] = false;'
        . '}'
        . 'if(imgslide7.length !== 0){'
        . 'dataimage["imgslide7"] = $(imgslide7).attr("data-unique");'
        . '}else{'
        . 'dataimage["imgslide7"] = false;'
        . '}'
        . 'if(imgslide8.length !== 0){'
        . 'dataimage["imgslide8"] = $(imgslide8).attr("data-unique");'
        . '}else{'
        . 'dataimage["imgslide8"] = false;'
        . '}'
        . 'if(imgslide9.length !== 0){'
        . 'dataimage["imgslide9"] = $(imgslide9).attr("data-unique");'
        . '}else{'
        . 'dataimage["imgslide9"] = false;'
        . '}'



//        . 'console.log(dataimage);'
//        . 'console.log(JSON.stringify(dataimage));'
        . 'var inputimg = $("#img-slider-value");'
//        . 'var data = [];'
//        . 'for(var i =0; i < img.length; i++){'
//        . 'var strinput = $(img[i]).attr("src");'
//        . 'data[i]=$(img[i]).attr("data-unique");'
//        . '}'
        . 'inputimg.attr("value");'
        . 'inputimg.attr("value",JSON.stringify(dataimage));'
        . '});'
        , View::POS_READY);
?>
<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-8"> 
            <div class="row">                
                <?php
                if (isset($other->imgslider)):
                    $image = $other->imgslider;
                    echo $image->imgslide1 != false ? Html::tag("div", Html::img(Yii::getAlias('@web') . '/resources/images/thumbnail/191x128/' . $image->imgslide1, [
                                        "class" => 'img-responsive'
                                        , 'data-unique' => $image->imgslide1,
                                        'data-original' => Yii::getAlias('@web') . '/resources/images/original/' . $image->imgslide1,
                                        'style' => 'cursor: pointer; width: 1024px'
                                    ]), [
                                'id' => 'add-image',
                                'class' => 'col-sm-4 img-slide1'
                            ]) : Html::tag("div", Html::tag('div', Html::tag('div', Html::tag('i', '&nbsp;1024x300', [
                                                        'class' => 'fa fa-plus',
                                                        'style' => 'color:#C0C0C0; font-size: 20px; margin-top: 30%; margin-bottom: 50%'
                                                    ]), [
                                                'class' => 'text-center'
                                            ]), [
                                        'style' => 'cursor: pointer; height: 142px; border: 2px dashed #ddd;'
                                    ]), [
                                'id' => 'add-image',
                                'class' => 'col-sm-4 img-slide1'
                    ]);
                    echo $image->imgslide2 != false ? Html::tag("div", Html::img(Yii::getAlias('@web') . '/resources/images/thumbnail/191x128/' . $image->imgslide2, [
                                        "class" => 'img-responsive'
                                        , 'data-unique' => $image->imgslide2,
                                        'data-original' => Yii::getAlias('@web') . '/resources/images/original/' . $image->imgslide2,
                                        'style' => 'cursor: pointer; width: 1024px'
                                    ]), [
                                'id' => 'add-image',
                                'class' => 'col-sm-4 img-slide2'
                            ]) : Html::tag("div", Html::tag('div', Html::tag('div', Html::tag('i', '&nbsp;1024x300', [
                                                        'class' => 'fa fa-plus',
                                                        'style' => 'color:#C0C0C0; font-size: 20px; margin-top: 30%; margin-bottom: 50%'
                                                    ]), [
                                                'class' => 'text-center'
                                            ]), [
                                        'style' => 'cursor: pointer; height: 142px; border: 2px dashed #ddd;'
                                    ]), [
                                'id' => 'add-image',
                                'class' => 'col-sm-4 img-slide2'
                    ]);
                    echo $image->imgslide3 != false ? Html::tag("div", Html::img(Yii::getAlias('@web') . '/resources/images/thumbnail/191x128/' . $image->imgslide3, [
                                        "class" => 'img-responsive'
                                        , 'data-unique' => $image->imgslide3,
                                        'data-original' => Yii::getAlias('@web') . '/resources/images/original/' . $image->imgslide3,
                                        'style' => 'cursor: pointer; width: 1024px'
                                    ]), [
                                'id' => 'add-image',
                                'class' => 'col-sm-4 img-slide3'
                            ]) : Html::tag("div", Html::tag('div', Html::tag('div', Html::tag('i', '&nbsp;1024x300', [
                                                        'class' => 'fa fa-plus',
                                                        'style' => 'color:#C0C0C0; font-size: 20px; margin-top: 30%; margin-bottom: 50%'
                                                    ]), [
                                                'class' => 'text-center'
                                            ]), [
                                        'style' => 'cursor: pointer; height: 142px; border: 2px dashed #ddd;'
                                    ]), [
                                'id' => 'add-image',
                                'class' => 'col-sm-4 img-slide3'
                    ]);
                else:
                    ?>

                    <div id="add-image" class="col-sm-4 img-slide1">            
                        <div style="cursor: pointer; width: auto; height: 142px; border: 2px dashed #ddd;">            
                            <div class="text-center">
                                <i class="fa fa-plus" style="color:#C0C0C0; font-size: 20px; margin-top: 30%; margin-bottom: 50%">&nbsp;1024x300</i>                                  
                            </div>
                        </div>
                    </div>
                    <div id="add-image" class="col-sm-4 img-slide2" >      
                        <div style="cursor: pointer; width: auto; height: 142px; border: 2px dashed #ddd;">            
                            <div class="text-center">
                                <i class="fa fa-plus" style="color:#C0C0C0; font-size: 20px; margin-top: 30%; margin-bottom: 50%">&nbsp;1024x300</i>                          
                            </div>
                        </div>
                    </div>
                    <div id="add-image" class="col-sm-4 img-slide3" >  
                        <div style="cursor: pointer; width: auto; height: 142px; border: 2px dashed #ddd;">            
                            <div class="text-center">
                                <i class="fa fa-plus" style="color:#C0C0C0; font-size: 20px; margin-top: 30%; margin-bottom: 50%">&nbsp;1024x300</i>                                    
                            </div>
                        </div>
                    </div> 
                <?php endif; ?>                               

            </div>

        </div>

        <div class="col-sm-4">
            <div class="row">
                <?php
                if (isset($other->imgslider)):
                    $image = $other->imgslider;
                    echo $image->imgslide4 != false ? Html::tag("div", Html::img(Yii::getAlias('@web') . '/resources/images/thumbnail/191x128/' . $image->imgslide4, [
                                        "class" => 'img-responsive'
                                        , 'data-unique' => $image->imgslide4,
                                        'data-original' => Yii::getAlias('@web') . '/resources/images/original/' . $image->imgslide4,
                                        'style' => 'cursor: pointer; width: 1024px'
                                    ]), [
                                'id' => 'add-image',
                                'class' => 'col-sm-4 img-slide4'
                            ]) : Html::tag("div", Html::tag('div', Html::tag('div', Html::tag('i', '&nbsp;150x130', [
                                                        'class' => 'fa fa-plus',
                                                        'style' => 'color:#C0C0C0; font-size: 10px; margin-top: 30%; margin-bottom: 50%'
                                                    ]), [
                                                'class' => 'text-center'
                                            ]), [
                                        'style' => 'cursor: pointer; height: 65px; border: 2px dashed #ddd;'
                                    ]), [
                                'id' => 'add-image',
                                'class' => 'col-sm-4 img-slide4'
                    ]);
                    echo $image->imgslide5 != false ? Html::tag("div", Html::img(Yii::getAlias('@web') . '/resources/images/thumbnail/191x128/' . $image->imgslide5, [
                                        "class" => 'img-responsive'
                                        , 'data-unique' => $image->imgslide5,
                                        'data-original' => Yii::getAlias('@web') . '/resources/images/original/' . $image->imgslide5,
                                        'style' => 'cursor: pointer; width: 1024px'
                                    ]), [
                                'id' => 'add-image',
                                'class' => 'col-sm-4 img-slide5'
                            ]) : Html::tag("div", Html::tag('div', Html::tag('div', Html::tag('i', '&nbsp;200x139', [
                                                        'class' => 'fa fa-plus',
                                                        'style' => 'color:#C0C0C0; font-size: 10px; margin-top: 30%; margin-bottom: 50%'
                                                    ]), [
                                                'class' => 'text-center'
                                            ]), [
                                        'style' => 'cursor: pointer; height: 65px; border: 2px dashed #ddd;'
                                    ]), [
                                'id' => 'add-image',
                                'class' => 'col-sm-4 img-slide5'
                    ]);


                    echo $image->imgslide6 != false ? Html::tag("div", Html::img(Yii::getAlias('@web') . '/resources/images/thumbnail/191x128/' . $image->imgslide6, [
                                        "class" => 'img-responsive'
                                        , 'data-unique' => $image->imgslide6,
                                        'data-original' => Yii::getAlias('@web') . '/resources/images/original/' . $image->imgslide6,
                                        'style' => 'cursor: pointer; width: 1024px'
                                    ]), [
                                'id' => 'add-image',
                                'class' => 'col-sm-4 img-slide6'
                            ]) : Html::tag("div", Html::tag('div', Html::tag('div', Html::tag('i', '&nbsp;200x107', [
                                                        'class' => 'fa fa-plus',
                                                        'style' => 'color:#C0C0C0; font-size: 10px; margin-top: 30%; margin-bottom: 50%'
                                                    ]), [
                                                'class' => 'text-center'
                                            ]), [
                                        'style' => 'cursor: pointer; height: 65px; border: 2px dashed #ddd;'
                                    ]), [
                                'id' => 'add-image',
                                'class' => 'col-sm-4 img-slide6'
                    ]);


                else:
                    ?>     
                    <div id="add-image" class="col-sm-4 img-slide4">
                        <div style="cursor: pointer; width: auto; height: 65px; border: 2px dashed #ddd;">            
                            <div class="text-center">
                                <i class="fa fa-plus" style="color:#C0C0C0; font-size: 10px; margin-top: 30%; margin-bottom: 50%">&nbsp;150x130</i>                                    
                            </div>
                        </div>
                    </div>    
                    <div id="add-image" class="col-sm-4 img-slide5">
                        <div style="cursor: pointer; width: auto; height: 65px; border: 2px dashed #ddd;">            
                            <div class="text-center">
                                <i class="fa fa-plus" style="color:#C0C0C0; font-size: 10px; margin-top: 30%; margin-bottom: 50%">&nbsp;200x139</i>                                    
                            </div>
                        </div>
                    </div>    
                    <div id="add-image" class="col-sm-4 img-slide6">
                        <div style="cursor: pointer; width: auto; height: 65px; border: 2px dashed #ddd;">            
                            <div class="text-center">
                                <i class="fa fa-plus" style="color:#C0C0C0; font-size: 10px; margin-top: 30%; margin-bottom: 50%">&nbsp;200x107</i>                                    
                            </div>
                        </div>
                    </div> 
                <?php endif; ?>
            </div>

            <div class="row" style="margin-top: 13.3px">
                <?php
                if (isset($other->imgslider)):
                    $image = $other->imgslider;

                    echo $image->imgslide7 != false ? Html::tag("div", Html::img(Yii::getAlias('@web') . '/resources/images/thumbnail/191x128/' . $image->imgslide7, [
                                        "class" => 'img-responsive'
                                        , 'data-unique' => $image->imgslide7,
                                        'data-original' => Yii::getAlias('@web') . '/resources/images/original/' . $image->imgslide7,
                                        'style' => 'cursor: pointer; width: 1024px'
                                    ]), [
                                'id' => 'add-image',
                                'class' => 'col-sm-4 img-slide7'
                            ]) : Html::tag("div", Html::tag('div', Html::tag('div', Html::tag('i', '&nbsp;150x180', [
                                                        'class' => 'fa fa-plus',
                                                        'style' => 'color:#C0C0C0; font-size: 10px; margin-top: 30%; margin-bottom: 50%'
                                                    ]), [
                                                'class' => 'text-center'
                                            ]), [
                                        'style' => 'cursor: pointer; height: 65px; border: 2px dashed #ddd;'
                                    ]), [
                                'id' => 'add-image',
                                'class' => 'col-sm-4 img-slide7'
                    ]);

                    echo $image->imgslide8 != false ? Html::tag("div", Html::img(Yii::getAlias('@web') . '/resources/images/thumbnail/191x128/' . $image->imgslide8, [
                                        "class" => 'img-responsive'
                                        , 'data-unique' => $image->imgslide8,
                                        'data-original' => Yii::getAlias('@web') . '/resources/images/original/' . $image->imgslide8,
                                        'style' => 'cursor: pointer; width: 1024px'
                                    ]), [
                                'id' => 'add-image',
                                'class' => 'col-sm-4 img-slide8'
                            ]) : Html::tag("div", Html::tag('div', Html::tag('div', Html::tag('i', '&nbsp;100x100', [
                                                        'class' => 'fa fa-plus',
                                                        'style' => 'color:#C0C0C0; font-size: 10px; margin-top: 30%; margin-bottom: 50%'
                                                    ]), [
                                                'class' => 'text-center'
                                            ]), [
                                        'style' => 'cursor: pointer; height: 65px; border: 2px dashed #ddd;'
                                    ]), [
                                'id' => 'add-image',
                                'class' => 'col-sm-4 img-slide8'
                    ]);

                    echo $image->imgslide9 != false ? Html::tag("div", Html::img(Yii::getAlias('@web') . '/resources/images/thumbnail/191x128/' . $image->imgslide9, [
                                        "class" => 'img-responsive'
                                        , 'data-unique' => $image->imgslide9,
                                        'data-original' => Yii::getAlias('@web') . '/resources/images/original/' . $image->imgslide9,
                                        'style' => 'cursor: pointer; width: 1024px'
                                    ]), [
                                'id' => 'add-image',
                                'class' => 'col-sm-4 img-slide9'
                            ]) : Html::tag("div", Html::tag('div', Html::tag('div', Html::tag('i', '&nbsp;100x100', [
                                                        'class' => 'fa fa-plus',
                                                        'style' => 'color:#C0C0C0; font-size: 10px; margin-top: 30%; margin-bottom: 50%'
                                                    ]), [
                                                'class' => 'text-center'
                                            ]), [
                                        'style' => 'cursor: pointer; height: 65px; border: 2px dashed #ddd;'
                                    ]), [
                                'id' => 'add-image',
                                'class' => 'col-sm-4 img-slide9'
                    ]);

                else:
                    ?> 
                    <div id="add-image"  class="col-sm-4 img-slide7">
                        <div style="cursor: pointer; width: auto; height: 65px; border: 2px dashed #ddd;">            
                            <div class="text-center">
                                <i class="fa fa-plus" style="color:#C0C0C0; font-size: 10px; margin-top: 30%; margin-bottom: 50%">&nbsp;150x180</i>                                    
                            </div>
                        </div>
                    </div>    
                    <div id="add-image"  class="col-sm-4 img-slide8">
                        <div style="cursor: pointer; width: auto; height: 65px; border: 2px dashed #ddd;">            
                            <div class="text-center">
                                <i class="fa fa-plus" style="color:#C0C0C0; font-size: 10px; margin-top: 30%; margin-bottom: 50%">&nbsp;100x100</i>                                    
                            </div>
                        </div>
                    </div>    
                    <div id="add-image" class="col-sm-4 img-slide9">
                        <div style="cursor: pointer; width: auto; height: 65px; border: 2px dashed #ddd;">            
                            <div class="text-center">
                                <i class="fa fa-plus" style="color:#C0C0C0; font-size: 10px; margin-top: 30%; margin-bottom: 50%">&nbsp;100x100</i>                                    
                            </div>
                        </div>
                    </div>  
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="space-10"></div>
</div>

<?php $form = ActiveForm::begin(['id' => 'page-form']); ?>
<div class="col-sm-8">
    <div class="form-group">
        <?= Html::activeHiddenInput($model, 'type') ?>
        <?= Html::activeHiddenInput($model, 'imgslider', ['id' => 'img-slider-value', 'value' => isset($other->imgslider) ? json_encode($other->imgslider) : ""]) ?>
        <?= Html::activetextInput($model, 'title', ['class' => 'form-control', 'placeholder' => 'Judul . . .', 'maxlength' => 225]) ?>       
    </div>
    <div class="form-group">       
        <?= Html::activetextInput($model, 'slider_title1', ['value' => isset($other->slider_title1) ? $other->slider_title1 : null, 'class' => 'form-control', 'placeholder' => 'Judul Gambar Slider 1', 'maxlength' => 225]) ?>        
    </div>
    <div class="form-group">
        <?= Html::activetextInput($model, 'slider_title2', ['value' => isset($other->slider_title2) ? $other->slider_title2 : null, 'class' => 'form-control', 'placeholder' => 'Judul Gambar Slider 2', 'maxlength' => 225]) ?>
    </div>
    <div class="form-group">

        <?= Html::activetextInput($model, 'slider_title3', ['value' => isset($other->slider_title3) ? $other->slider_title3 : null, 'class' => 'form-control', 'placeholder' => 'Judul Gambar Slider 3', 'maxlength' => 225]) ?>
    </div>
    <div class="form-group">        
    <?= Html::textarea('PageModel[quotes_today]', isset($other->quotes_today) ? $other->quotes_today : null, ['content'=>'asdasd','style' => 'resize:none', 'rows' => 6, 'class' => 'form-control', 'placeholder' => 'Kata Mutiara Hari ini', 'maxlength' => 225]) ?>   
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel widget-followers">
                <div class="panel-heading">
                    <span class="panel-title">Widget yang tersedia</span>
                </div>
                <div class="panel-body">
<?php foreach ($defaultwidget as $value): ?>
                        <div class="follower">
                            <div class="body">
                                <div class="follower-controls">
    <?= Html::a('<i class="fa fa-plus"></i><span>&nbsp;&nbsp;Tambahkan</span>', ['/page/widget/create', 'action' => 'page-widget-crete', 'id' => $value->id, 'page' => $page, 'pagename' => $pagename, 'pagetype' => $pagetype], ['class' => 'btn btn-xs btn-primary']) ?>
                                </div>
                                <p>
                                    <span class="follower-name"><?= $value->name ?></span><br>
                                    <span class="follower-username"><?= $value->content ?></span>
                                </p>
                            </div>
                        </div>
<?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="col-sm-4">

    <!--posisikanan-->
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">Widget Posisi Kanan</span>
        </div>
        <div class="panel-body padding-sm" >
            <div class="dd" id="nestable-right">
                <ol class="dd-list">
<?php foreach ($widgetright as $right): ?>
                        <li class="dd-item" data-id="<?= $right->id ?>" data-position="<?= $right->position ?>" data-layoute="<?= $right->layoute_position ?>">
                            <div class="dd-handle"><?= $right->name ?>
                                <div class="pull-right action-buttons">
                                    <a class="select-tooltip" data-id="<?= $right->id ?>"
                                       data-toggle="tooltip" data-original-title="Perbaharui" href="<?= Url::toRoute(['/page/widget/update', 'action' => 'page-widget-update', 'id' => $right->id, 'page' => $page, 'pagename' => $pagename, 'pagetype' => $pagetype]) ?>">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a style="color: #a94442 " class="widget-delete select-tooltip" data-id="<?= $right->id ?>"
                                       data-toggle="tooltip" data-original-title="Hapus" href="javascript:undefined;">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
    <?php endforeach; ?>
                </ol>
            </div>
        </div>
        <div class="panel-footer">
            <button type="button" class="btn btn-xs btn-primary" id="btn-right-save"><i class="fa fa-check"></i>&nbsp; Simpan</button>
        </div>
    </div>

    <!--start posisi kiri-->
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">Widget Posisi Kiri</span>
        </div>
        <div class="panel-body padding-sm" >
            <div class="dd" id="nestable-left">
                <ol class="dd-list">
<?php foreach ($widgetleft as $left): ?>
                        <li class="dd-item" data-id="<?= $left->id ?>" data-position="<?= $left->position ?>" data-layoute="<?= $left->layoute_position ?>">
                            <div class="dd-handle"><?= $left->name ?>
                                <div class="pull-right action-buttons">
                                    <a class="select-tooltip" data-id="<?= $left->id ?>"
                                       data-toggle="tooltip" data-original-title="Perbaharui" href="<?= Url::toRoute(['/page/widget/update', 'action' => 'page-widget-update', 'id' => $left->id, 'page' => $page, 'pagename' => $pagename, 'pagetype' => $pagetype]) ?>">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a style="color: #a94442 " class="widget-delete select-tooltip" data-id="<?= $left->id ?>"
                                       data-toggle="tooltip" data-original-title="Hapus" href="javascript:undefined;">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
    <?php endforeach; ?>
                </ol>
            </div>
        </div>
        <div class="panel-footer">
            <button type="button" class="btn btn-xs btn-primary" id="btn-left-save"><i class="fa fa-check"></i>&nbsp; Simpan</button>
        </div>
    </div>

    <!--start sidebar-->
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">Sidebar</span>
        </div>
        <div class="panel-body">
            <div class="dd" id="nestable-sidebar">
                <ol class="dd-list">
<?php
foreach ($widgetsidebar as $sidebar):
    ?>
                        <li class="dd-item" data-id="<?= $sidebar->id ?>" data-position="<?= $sidebar->position ?>" data-layoute="<?= $sidebar->layoute_position ?>">
                            <div class="dd-handle"><?= $sidebar->name ?>
                                <div class="pull-right action-buttons">
                                    <a class="select-tooltip" data-id="<?= $sidebar->id ?>"
                                       data-toggle="tooltip" data-original-title="Perbaharui" href="<?= Url::toRoute(['/page/widget/update', 'action' => 'page-widget-update', 'id' => $sidebar->id, 'page' => $page, 'pagename' => $pagename, 'pagetype' => $pagetype]) ?>">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a style="color: #a94442 " class="widget-delete select-tooltip" data-id="<?= $sidebar->id ?>"
                                       data-toggle="tooltip" data-original-title="Hapus" href="javascript:undefined;">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
    <?php
endforeach;
?>
                </ol>
            </div>
        </div>
        <div class="panel-footer">
            <button type="button" class="btn btn-xs btn-primary" id="btn-sidebar-save"><i class="fa fa-check"></i>&nbsp; Simpan</button>
        </div>
    </div>
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">Aksi</span>
        </div>
        <div class="panel-body">
<?=
$form->field($model, 'status')->dropDownList([
    '' => 'None',
    'Publish' => 'Publish',
    'Draft' => 'Draft',
    'Trash' => 'Trash'
        ], ['id' => 'select-status', 'maxlength' => 15]);
?>
        </div>
        <div class="panel-footer">
            <div class="form-group">
            <?= Html::submitButton(Html::tag('i', '', ['class' => 'fa  fa-check']) . '&nbsp; ' . Yii::t('app', 'Simpan'), ['id' => 'save-page', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</div>
            <?php ActiveForm::end(); ?>

<div class="row" style="display: none">
    <div class="col-sm-12">
        <textarea id="redactor"></textarea>
    </div>
</div>

<?php
$this->registerJs(
        '$("#redactor").redactor({
    imageUpload:"' . Url::toRoute(['/filemanager/image/uploadredactorimage']) . '",
        imageGetJson:"' . Url::toRoute(['/filemanager/image/loadredactorimage']) . '",
        albumGetJson:"' . Url::toRoute(['/filemanager/image/loadredactoralbum']) . '",
            thumbnail192:"' . Yii::getAlias('@web') . '/resources/images/thumbnail/191x128/",
        buttons:["html"],
        imageUploadErrorCallback:function(data){
            $("html,body").animate({ scrollTop: 0 }, 500);
            PixelAdmin.plugins.alerts.add("<strong>Maap!</strong>&nbsp;" + data.error, {
                type:"danger",
                auto_close:9
            });
        },
        buttons: ["italic"],
        fileUpload:"' . Url::toRoute(['/filemanager/document/uploaddredactorfile']) . '",
        fileGetJson:"' . Url::toRoute(['/filemanager/document/loadredactorfile']) . '",
        fileUploadErrorCallback:function(data){           
            $("html,body").animate({ scrollTop: 0 }, 500);
            PixelAdmin.plugins.alerts.add("<strong>Maap!</strong>&nbsp;" + data.error, {
                type:"danger",
                auto_close:9
            });
        },
        uploadFields:{
            "' . Yii::$app->request->csrfParam . '" : "' . Yii::$app->request->getCsrfToken() . '",
        },
        lang: "id",
        imgLoading:"' . Yii::getAlias('@web') . "/PixelAdmin/img/loading.gif" . '",
        _csrf:"' . Yii::$app->request->getCsrfToken() . '",
        _csrfname:"' . Yii::$app->request->csrfParam . '",
    });
    $(".redactor_box").css({"display":"none"});
', View::POS_READY);
?>