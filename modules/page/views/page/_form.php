<?php

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
$this->registerJsFile('PixelAdmin/js/filesize.min.js', '', ['position' => View::POS_END]);
$this->registerJs(
        '$("#select-tag").select2({ allowClear: true, placeholder: "Tag ..."}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
        . '$("#select-status").select2({ allowClear: true, placeholder: "Tag ..."}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
        , View::POS_READY);

//add image slider to input value
$this->registerJs(
        '$("#save-page").on("click",function(){'
        . 'var img = $("#img-slider").find("img");'
        . 'var inputimg = $("#img-slider-value");'
        . 'var data = [];'
        . 'for(var i =0; i < img.length; i++){'
        . 'var strinput = $(img[i]).attr("src");'
        . 'data[i]=$(img[i]).attr("data-unique");'
        . '}'
        . 'inputimg.attr("value");'
        . 'inputimg.attr("value",data.toString());'
        . '});'
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
?>
<?php $form = ActiveForm::begin(['id' => 'page-form']); ?>
<div class="col-sm-8"> 
    <div class="row" style="margin-bottom: 15px; <?= isset($other->imgsliderstatus ) ? $other->imgsliderstatus == "Disable" ? 'display: none;' : '' : 'display: none;'?>" id="img-slider">
        <?= Html::activeHiddenInput($model, 'type') ?>
        <?= Html::activeHiddenInput($model, 'imgslider', ['id' => 'img-slider-value', 'value' => isset($other->imgslider) ? json_encode($other->imgslider) : ""]) ?>
        <?php if (isset($other->imgslider)): ?>  
            <?php
            $image = $other->imgslider;
            echo isset($image->img0) ? Html::tag("div", Html::img(Yii::getAlias('@web') . '/resources/images/thumbnail/191x128/' . $image->img0, [
                                "class" => 'img-responsive'
                                , 'data-unique' => $image->img0,
                                'data-original' => Yii::getAlias('@web') . '/resources/images/original/' . $image->img0,
                                'style' => 'cursor: pointer; width: 1024px'
                            ]), [
                        'id' => 'add-image',
                        'class' => 'col-sm-4'
                    ]) : Html::tag("div", Html::tag('div', Html::tag('div', Html::tag('i', '', [
                                                'class' => 'fa fa-plus',
                                                'style' => 'color:#C0C0C0; font-size: 30px; margin-top: 25%; margin-bottom: 50%'
                                            ]), [
                                        'class' => 'text-center'
                                    ]), [
                                'style' => 'cursor: pointer; height: 141px; border: 2px dashed #ddd;'
                            ]), [
                        'id' => 'add-image',
                        'class' => 'col-sm-4'
            ]);
            echo isset($image->img1) ? Html::tag("div", Html::img(Yii::getAlias('@web') . '/resources/images/thumbnail/191x128/' . $image->img1, [
                                "class" => 'img-responsive'
                                , 'data-unique' => $image->img1,
                                'data-original' => Yii::getAlias('@web') . '/resources/images/original/' . $image->img1,
                                'style' => 'cursor: pointer; width: 1024px'
                            ]), [
                        'id' => 'add-image',
                        'class' => 'col-sm-4'
                    ]) : Html::tag("div", Html::tag('div', Html::tag('div', Html::tag('i', '', [
                                                'class' => 'fa fa-plus',
                                                'style' => 'color:#C0C0C0; font-size: 30px; margin-top: 25%; margin-bottom: 50%'
                                            ]), [
                                        'class' => 'text-center'
                                    ]), [
                                'style' => 'cursor: pointer; height: 141px; border: 2px dashed #ddd;'
                            ]), [
                        'id' => 'add-image',
                        'class' => 'col-sm-4'
            ]);

            echo isset($image->img2) ? Html::tag("div", Html::img(Yii::getAlias('@web') . '/resources/images/thumbnail/191x128/' . $image->img2, [
                                "class" => 'img-responsive'
                                , 'data-unique' => $image->img2,
                                'data-original' => Yii::getAlias('@web') . '/resources/images/original/' . $image->img2,
                                'style' => 'cursor: pointer; width: 1024px'
                            ]), [
                        'id' => 'add-image',
                        'class' => 'col-sm-4'
                    ]) : Html::tag("div", Html::tag('div', Html::tag('div', Html::tag('i', '', [
                                                'class' => 'fa fa-plus',
                                                'style' => 'color:#C0C0C0; font-size: 30px; margin-top: 25%; margin-bottom: 50%'
                                            ]), [
                                        'class' => 'text-center'
                                    ]), [
                                'style' => 'cursor: pointer; height: 141px; border: 2px dashed #ddd;'
                            ]), [
                        'id' => 'add-image',
                        'class' => 'col-sm-4'
            ]);
            ?>
        <?php else: ?>
            <div id="add-image" class="col-sm-4" >            
                <div style="cursor: pointer; height: 141px; border: 2px dashed #ddd;">
                    <div class="text-center">
                        <i class="fa fa-plus" style="color:#C0C0C0; font-size: 30px; margin-top: 25%; margin-bottom: 50%"></i>                                    
                    </div>
                </div>
            </div>
            <div id="add-image" class="col-sm-4" >            
                <div style="cursor: pointer; height: 141px; border: 2px dashed #ddd;">
                    <div class="text-center">
                        <i class="fa fa-plus" style="color:#C0C0C0; font-size: 30px; margin-top: 25%; margin-bottom: 50%"></i>                          
                    </div>
                </div>
            </div>

            <div id="add-image" class="col-sm-4" >            
                <div style="cursor: pointer; height: 141px; border: 2px dashed #ddd;">
                    <div class="text-center">
                        <i class="fa fa-plus" style="color:#C0C0C0; font-size: 30px; margin-top: 25%; margin-bottom: 50%"></i>                                    
                    </div>
                </div>
            </div> 
        <?php endif; ?>   
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <?= Html::activetextInput($model, 'title', ['class' => 'form-control', 'placeholder' => 'Judul . . .', 'maxlength' => 225]) ?>           
            </div>
            <div class="form-group">
                <?= Html::activetextarea($model, 'content', ['id' => 'post-content', 'class' => 'form-control', 'placeholder' => 'Isi . . .', 'rows' => 6]) ?>
            </div>
        </div>
    </div> 
</div>

<div class="col-sm-4">       

    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">Halaman Default</span>
        </div>
        <div class="panel-body">
            <div class="form-group">

            </div>                
        </div>
    </div>

    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">Layout</span>
        </div>
        <div class="panel-body">
            <?=
            $form->field($model, 'layout')->dropDownList([
                'full' => 'Full',
                'right' => 'Kanan',
                'left' => 'Kiri'
                    ], ['id' => 'select-status', 'maxlength' => 15]);
            ?> 
            <div class="form-group">
                <label class="control-label" for="pagemodel-imgsliderstatus">Gambar Slider</label>
                <div id="switchers-colors-default" class="form-group-margin">
                    <?= Html::checkbox('PageModel[imgsliderstatus]', isset($other->imgsliderstatus) ? $other->imgsliderstatus == "Enable" ? true : false : false, ['id' => 'imgsliderstatus-id', 'value' => 'Enable', 'data-class' => "switcher-primary", 'class' => 'switcher-primary']) ?>                                               
                </div>

            </div>
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

