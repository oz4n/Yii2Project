<?php

use Yii;
use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;
use app\modules\filemanager\searchs\ImageSearc;
use app\modules\filemanager\forms\FormSearch;
use yii\widgets\ActiveForm;
$model = new FormSearch;

$this->registerJsFile('PixelAdmin/js/filesize.min.js', '', ['position' => View::POS_END]);
$this->registerJs(''
        . 'var phototarget , photoinput, photopreview ,photoselect = "";'      
        . 'init.push(function () { '
        . '$(".select-image").on("click", function() {'
            . 'var photo = $(this).parent().find("#img-target-photo");'
            . 'var input = $(this).parent().parent().find("#input-file");'
            . 'var preview = $(this).parent().find("#preview-front-photo");'
            . 'var select = $(this).parent().find("#select-front-photo");'
            . 'phototarget = $(photo);'
            . 'photoinput = $(input);'           
            . 'photopreview = $(preview);'
            . 'photoselect = $(select);'
            . '$("#modal-loading").modal("show");'
            . '$("#modal-loading").css({"overflow-y":"hidden"});'
            . 'var scrl = $("#img-thumbnails");'
            . 'var pages = scrl.attr("page-data");'
            . '$.ajax({
                 url:"' . Url::toRoute(['/filemanager/image/loads', 'action' => 'filemager-image-load']) . '",
                 data:{page:pages},
                 dataType:"json",
                 success:function(response){  
                    $(scrl).attr("page-data", response.page);
                    var tooltip = $("body").find(".select-tooltip");
                    $(tooltip).tooltip();
                    $("#loading").css({"display":"none"});
                    for (var i = 0; i < response.data.length; i++) {
                        var thumb = "' . Yii::getAlias('@web') . "/resources/member/thumbnail/" . '";
                        var src_thumb = "' . Yii::getAlias('@web') . "/resources/member/thumbnail/150x150/" . '";
                        if($("#img-thumbnails").find(\'img[alt="\'+response.data[i].name+\'"]\').length === 0){
                            $("#img-thumbnails").append(\'<li><img style="width: 145px; height: 145px;" data-thumb="\' + thumb + response.data[i].unique_name +\'" alt="\' + response.data[i].name +\'" src="\' + src_thumb + response.data[i].unique_name +\'" data-unique-name="\' + response.data[i].unique_name +\'" /><div class="tools tools-bottom"><a href="javascript:undefined;" class="select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Perbesar"><i class="fa fa-search-plus"></i></a><a href="javascript:undefined;" class="select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Hapus"><i class="fa fa-times" style="color:#d15b47"></i></a><a href="javascript:undefined;" class="select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Pilih"><i class="fa fa-share"></i></a></div></li>\');
                        }else{
                            console.log(1);
                        }
                    }
                    $("#modal-loading").modal("hide");
                    $("#modal-images").modal();
                    $("#modal-images").css({"overflow-y":"hidden"});
                 }
               });'
        . '});'
        . '$("#select-album-photo").select2({ allowClear: true, placeholder: "Album"});'
        . '$("#select-list-album-photo").select2({ allowClear: true, placeholder: "Album"}).change(function(){'
        . '});'
        . '});'
        /** input data ke Photo Tampak Depan*/
        . '$("#image-select").on("click",function(){'
        
            . 'var img_select = $("#img-select").attr("data-thumb");'
            . 'var img_unique = $("#img-select").attr("data-unique-name");'
        
            . 'phototarget.attr("src",img_select);'
            . 'photoinput.attr("value",img_unique);'
            . 'console.log(photoinput.attr("value"));'        
            . 'photopreview.css({"display":"block"});'
            . 'photoselect.css({"display":"none"});'
        . '});'
        , View::POS_READY);


$this->registerJs(''
        . '$("#form-search").on("submit",function(){'
            . '$("#loading").css({"display":"block"});'
            . '$.ajax({'
                    . 'url: $(this).attr("action"),'
                    . 'type: $(this).attr("method"),'
                    . 'data: $(this).serialize(),'
                    . 'dataType:"json",'
                    . 'success: function (response) {'
                        . 'console.log(response);'
                        . '$("#loading").css({"display":"none"});'
                    . '}'
            . '});'
            . 'return false;'
        . '});',  View::POS_READY);
$this->registerJs(''
        . '$("#form-album").on("submit",function(){'
            . '$("#loading").css({"display":"block"});'
            . '$.ajax({'
                    . 'url: $(this).attr("action"),'
                    . 'type: $(this).attr("method"),'
                    . 'data: $(this).serialize(),'
                    . 'dataType:"json",'
                    . 'success: function (response) {'
                        . 'console.log(response);'
                        . '$("#loading").css({"display":"none"});'
                    . '}'
            . '});'
            . 'return false;'
        . '});',  View::POS_READY);
$this->registerJs('init.push(function () {   
    $(".select-tooltip").tooltip();
    $("body").on("click",".select-tooltip",function(){   
        $(".select-tooltip").tooltip();
        var img = $(this).parent().parent().find("img");
        $("img#img-select").attr("src",img.attr("src"));
        $("img#img-select").attr("data-thumb",img.attr("data-thumb"));
        $("img#img-select").attr("data-unique-name",img.attr("data-unique-name"));
//        console.log(img.attr("src"));
    });
    $("#img-thumbnails").slimScroll({
        height: 316,
        allowPageScroll:true
    }).bind("slimscroll", function(e, pos){       
        if(pos === "bottom"){ 
           $("#loading").css({"display":"block"});
           var scrl = $("#img-thumbnails");
           var pages = scrl.attr("page-data");
           $.ajax({
             url:"' . Url::toRoute(['/filemanager/image/loads', 'action' => 'filemanager-image-load']) . '",
             data:{page:pages},
             dataType:"json",
             success:function(response){  
                $(scrl).attr("page-data", response.page);  
                if(response.data.length === 0){
                    $("#loading").css({"display":"none"});
                    console.log(response.data.length);
                }else{
                    var tooltip = $("body").find(".select-tooltip");
                    $(tooltip).tooltip();
                    $("#loading").css({"display":"none"});
                    for (var i = 0; i < response.data.length; i++) {
                        var thumb = "' . Yii::getAlias('@web') . "/resources/member/thumbnail/" . '";
                        var src_thumb = "' . Yii::getAlias('@web') . "/resources/member/thumbnail/150x150/" . '";                            
                        $("#img-thumbnails").append(\'<li><img style="width: 145px; height: 145px;" data-thumb="\' + thumb + response.data[i].unique_name +\'" alt="\' + response.data[i].name +\'" src="\' + src_thumb + response.data[i].unique_name +\'" data-unique-name="\' + response.data[i].unique_name +\'" /><div class="tools tools-bottom"><a href="javascript:undefined;" class="select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Perbesar"><i class="fa fa-search-plus"></i></a><a href="javascript:undefined;" class="select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Hapus"><i class="fa fa-times" style="color:#d15b47"></i></a><a href="javascript:undefined;" class="select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Pilih"><i class="fa fa-share"></i></a></div></li>\')
                    }
                    console.log(response.data.length);
                }
             }
           });
        }  
    });    
    $("#front-photo-drpopzon").slimScroll({height: 356 });
    
    var term_id = "";
    $("#select-album-photo").change(function(){
        term_id = $("#select-album-photo :selected").attr("value");
         console.log($("#select-album-photo :selected").attr("value"));
    });
    $("#front-photo-drpopzon").dropzone({
            url: "' . Url::toRoute(['/filemanager/image/upload', 'action' => "filemanager-image-upload"]) . '",
            paramName: "ModalForm[file]",            
            maxFilesize: 10.5,
            acceptedFiles:"image/*",
            addRemoveLinks : true,
            dictResponseError: "Tidak busa di unggah",
            autoProcessQueue: true,
            autoDiscover:true,
            thumbnailWidth: 150,
            maxFiles:12,
            thumbnailHeight: 150,
            previewTemplate: \'<div class="dz-preview dz-file-preview" style="width: 155px; margin:7px 0 0 7px;"><div class="dz-details"><div class="dz-size">File size: <span data-dz-size></span></div><div class="dz-thumbnail-wrapper"><div class="dz-thumbnail"><img data-dz-thumbnail><span class="dz-nopreview">No preview</span><div class="dz-success-mark"><i class="fa fa-check-circle-o"></i></div><div class="dz-error-mark"><i class="fa fa-times-circle-o"></i></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div></div></div><div class="progress progress-striped active"><div class="progress-bar progress-bar-success" data-dz-uploadprogress></div></div></div>\',
      
            sending:function(file, xhr, formData){
                formData.append(
                    "' . Yii::$app->request->csrfParam . '","' . Yii::$app->request->getCsrfToken() . '"
                );
                formData.append(
                    "ModalForm[size]",filesize(file.size)
                );
                formData.append(
                    "ModalForm[term_id]",term_id
                );
            },                       
            init:function(){
                var dropZone = this;
                dropZone.on("success",function(file, response){
                   var data = JSON.parse(response);                   
                   var img = $(".dz-thumbnail").find(\'img[alt="\'+file.name+\'"]\');
                   img.attr("alt",data.orginal_name);
                   img.attr("src",data.thumb_path_150x150 + data.unique_name);
                   var pr = img.parent().parent().parent().parent().find(".progress-bar");
                   pr.css({"display":"none"});
                   $("#img-thumbnails").prepend(\'<li><img style="width: 145px; height: 145px;" data-thumb="\' + data.thumb_path + data.unique_name +\'" alt="\' + data.name +\'" src="\' + data.thumb_path_150x150 + data.unique_name +\'" data-unique-name="\' + data.unique_name +\'" /><div class="tools tools-bottom"><a href="javascript:undefined;" class="select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Perbesar"><i class="fa fa-search-plus"></i></a><a href="javascript:undefined;" class="select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Hapus"><i class="fa fa-times" style="color:#d15b47"></i></a><a href="javascript:undefined;" class="select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Pilih"><i class="fa fa-share"></i></a></div></li>\');
                });
            },
            
    });
});', View::POS_READY);
?>
<div id="modal-loading" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-sm animated bounceIn" style="margin-top: 15%">
        <div class="modal-content">           
            <div class="modal-body">
                <div class="text-center"><img src="<?= Yii::getAlias('@web') . "/PixelAdmin/img/loading-2.gif" ?>"></div>
            </div>
        </div><!-- / .modal-content -->
    </div><!-- / .modal-dialog -->
</div>
<div id="modal-images" class="modal fade modal-blur" tabindex="-1" role="dialog" style="display: none;">
    <div id="modal-photo-ppi" class="modal-dialog animated bounceIn" style="width: 1035px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Photo</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-8">
                        <ul id="uidemo-tabs-default-demo" class="nav nav-tabs" style="margin-bottom: 5px;">
                            <li class="active">
                                <a href="#upload-photo" data-toggle="tab">Unggah Photo</a>
                            </li>
                            <li class="">
                                <a href="#list-photo" data-toggle="tab">List Photo</a>
                            </li>                               
                        </ul>
                        <div class="tab-content tab-content-bordered" style="padding: 0; border: none">
                            <div class="tab-pane fade active in" id="upload-photo">

<!--                                <div class="form-group">
                                    <?php //Html::dropDownList('album', '', ImageSearc::getAlbums('Pilih Album'), ['id' => 'select-album-photo', 'class' => 'select-album-photo form-control', 'placeholder' => 'Pilih album']) ?>
                                </div>-->                                
                                <div id="front-photo-drpopzon" class="dropzone-box dz-clickable" style="border: none; margin-left: -7px;">
                                    <div class="dz-default dz-message">
                                        <i class="fa fa-cloud-upload"></i>
                                        Drop file disini <br>
                                        <span class="dz-text-small">Atau klik untuk mengunggah</span>
                                    </div>                                    
                                </div>  
                                
                            </div> 

                            <div class="tab-pane fade" id="list-photo">    
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?php ActiveForm::begin(['action' => ['/filemanager/image/loads', 'action' => 'filemanager-image-load'], "method" => "get", "id" => 'form-album']) ?>                                     
                                        <?= Html::activeDropDownList($model, 'album', ImageSearc::getAlbums('Pilih Album'), ['id' => 'select-list-album-photo', 'class' => 'select-album-photo form-control', 'placeholder' => 'Pilih album']) ?>                                                                          
                                        <?php ActiveForm::end() ?>
                                    </div>
                                    <div class="col-sm-4" >
                                        <img id="loading" style="margin-left: -10px; margin-top: 8px" src="<?= Yii::getAlias('@web') . "/PixelAdmin/img/loading.gif" ?>" />                                       
                                    </div>
                                    <div class="col-sm-4">
                                        <?php ActiveForm::begin(['action' => ['/filemanager/image/loads', 'action' => 'filemanager-image-load'], "method" => "get", "id" => 'form-search']) ?>                                     
                                        <div class="input-group input-group-sm">                                                             
                                            <?= Html::activetextInput($model, 'keyword', ['class' => 'form-control', 'placeholder' => 'Cari']) ?>
                                            <?= Html::activehiddenInput($model, 'page', ["value" => 0]) ?>
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary">
                                                    <span class="fa fa-search"></span>
                                                </button>                    
                                            </span>
                                        </div>
                                        <?php ActiveForm::end() ?>
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <ul class="ace-thumbnails" id="img-thumbnails" style="margin-left: -3px;" page-data="0">                                    
                                   
                                </ul>                                                                
                            </div>                                
                        </div>  
                        <!--/ .tab-content -->
                        <!--</div>-->                        
                    </div>

                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-12">                               
                                <div class="text-center">
                                    <img id="img-select" style="width: 143px; height: 143px" class="img-thumbnail" src="http://www.yii2.loc/resources/member/thumbnail/150x150/2014-05-18-04:06:42-962730499-photo-tampak-depan2014-05-17-01:59:16-813118288-DSCN0441.JPG" alt="">
                                </div>
                                <br>
                                <?= Html::beginForm() ?>
                                <div class="form-group">
                                    <?= Html::hiddenInput('id', '') ?>
                                    <?=
                                    Html::textInput('name', '', ['class' => 'form-control', 'placeholder' => 'Nama photo'])
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?= Html::textarea('description', '', ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'Keterangan photo']) ?>                        
                                </div>   
                                <div class="form-group">
                                    <?= Html::button("<i class='fa fa-check'></i>&nbsp; Appley", ['id' => 'image-select', 'type' => 'button', 'class' => 'btn btn-success', "data-dismiss" => "modal"]) ?>                        
                                </div>
                                <?= Html::endForm() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?= Html::button("<i class='fa fa-times'></i>&nbsp; Batalkan", ['class' => 'btn btn-primary', "data-dismiss" => "modal"]) ?>               
            </div>
        </div>
    </div> 
</div> 