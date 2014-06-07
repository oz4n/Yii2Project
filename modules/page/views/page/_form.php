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
        . 'var img = $(".ace-thumbnails").find("img");'
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
        thumbnail192:"' . Yii::getAlias('@web') .'/resources/images/thumbnail/191x128/",
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
    <div id="img-slider"  style="display: <?= $other['imgsliderstatus'] == "Enable" ? "block" : 'none' ?>">
        <div class="note note-info">
            <strong>Info!</strong> Maksimum ukuran poto lebar 970 pixel tinggi 384 pixel.
        </div>
        <div class="space-10"></div>
        <div class="img-slider panel" >        
            <div class="panel-body">
                <div class="ace-thumbnails">
                    <?= Html::activeHiddenInput($model, 'imgslider', ['id' => 'img-slider-value', 'value' => isset($other['imgslider']) ? implode(',', $other['imgslider']) : ""]) ?>
                    <?php if (isset($other['imgslider'])): ?>
                        <?php foreach ($other['imgslider'] as $v): ?>
                            <div id="add-image" class="thumbnails-child" style="">
                                <div><img data-unique="<?= $v ?>" data-original="<?= Yii::getAlias('@web') . '/resources/images/original/' . $v ?>" src="<?= Yii::getAlias('@web') . '/resources/images/thumbnail/191x128/' . $v ?>"></div>
                                <div class="tools tools-bottom">
                                    <a  href="javascript:undefined;" class="image-edit select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Ganti gambar">
                                        <i class="fa  fa-arrow-circle-o-up" style="color:#d15b47"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div id="add-image" class="thumbnails-child" style="cursor: pointer; width: 202px; height: 137px; border: 2px dashed #ddd;">            
                            <div class="text-center">
                                <i class="fa fa-plus" style="color:#C0C0C0; font-size: 30px; margin-top: 25%; margin-bottom: 50%"></i>                                    
                            </div>
                        </div>
                        <div id="add-image" data-slide="2" class="thumbnails-child" style="cursor: pointer; width: 202px; height: 137px; border: 2px dashed #ddd;">            
                            <div class="text-center">
                                <i class="fa fa-plus" style="color:#C0C0C0; font-size: 30px; margin-top: 25%; margin-bottom: 50%"></i>                          
                            </div>
                        </div>

                        <div id="add-image" data-slide="3" class="thumbnails-child" style="cursor: pointer; width: 202px; height: 137px; border: 2px dashed #ddd;">            
                            <div class="text-center">
                                <i class="fa fa-plus" style="color:#C0C0C0; font-size: 30px; margin-top: 25%; margin-bottom: 50%"></i>                                    
                            </div>
                        </div> 
                    <?php endif; ?>                               
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::activetextInput($model, 'title', ['class' => 'form-control', 'placeholder' => 'Judul . . .', 'maxlength' => 225]) ?>           
    </div>
    <div class="form-group">
        <?= Html::activetextarea($model, 'content', ['id' => 'post-content', 'class' => 'form-control', 'placeholder' => 'Isi . . .', 'rows' => 6]) ?>
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
                    <?= Html::checkbox('PageModel[imgsliderstatus]',$other['imgsliderstatus'] == "Enable" ? true : false,['id'=>'imgsliderstatus-id','value'=>'Enable','data-class'=>"switcher-primary",'class'=>'switcher-primary']) ?>                                               
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
                <?= Html::submitButton(Html::tag('i', '', ['class' => 'fa  fa-check']) . '&nbsp; ' . Yii::t('app', 'Simpan'), ['id'=>'save-page','class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>                   
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

