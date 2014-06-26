<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\helpers\Url;
use dosamigos\fileupload\FileUpload;
use Yii;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\filemanager\searchs\ImageSearc $searchModel
 */
$this->title = Yii::t('app', 'Photo');
$this->registerJs(
        "$('ul.navigation > li.mm-dropdown > ul > li#images').addClass('active').parent().parent().addClass('active open');"
        , View::POS_READY);

//image delte
$this->registerJs(
        '$("body").on("click",".image-delete",function(){'
        . '$($(this).parent().parent().parent()).remove();'
        . '$.ajax({'
        . 'url:"' . Url::toRoute(['/filemanager/image/delete', 'action' => 'filemager-image-delete']) . '",'
        . 'dataType: "json",'
        . 'autoUpload: true,'
        . 'type:"POST",'
        . 'data:{"' . Yii::$app->request->csrfParam . '" : "' . Yii::$app->request->getCsrfToken() . '","id":$(this).attr("data-id")},'
        . '});'
        . '});'
        , View::POS_READY);

$this->registerJs(
        '$("body").on("click",".image-edit",function(){'
        . 'if($($(this).parent()).find(".popover").attr("style") == "display: block;"){'
        . '$($(this).parent()).find(".popover").fadeOut();'
        . '}else{'
        . '$(".popover").fadeOut();'
        . '$($(this).parent()).find(".popover").fadeIn();'
        . '}'
        . '});'
        , View::POS_READY);
$this->registerJs(
        '$(".select-tooltip").tooltip();'
        . '$(window).scroll(function() {
            if (document.documentElement.clientHeight + $(document).scrollTop() >= document.body.offsetHeight ){
                var scrl = $("#images-thumbnail");
                var pages = scrl.attr("page-data");
                $("#loading").css({"display":"block"});
                $.ajax({
                url:"' . Url::toRoute(['/filemanager/image/index', 'action' => 'filemager-image-list']) . '",      
                dataType: "json",
                data:{page:pages,albumid:"' . $albumid . '","FormSearch[keyword]":"' . $keyword . '"},       
                cache: false,
                type:"GET",       
                success:$.proxy(function(response){  
                console.log(response.page)
                    $("#images-thumbnail").attr("page-data", response.page);            
                    for (var i = 0; i < response.data.length; i++) {                
                        var original = "' . Yii::getAlias('@web') . "/resources/images/original/" . '";
                        var src_thumb = "' . Yii::getAlias('@web') . "/resources/images/thumbnail/145x145/" . '";
                        if($("#images-thumbnail").find(\'img[data-unique-name="\'+response.data[i].unique_name+\'"]\').length === 0){
                            var formaction = "' . Url::toRoute(['/filemanager/image/update', 'action' => 'filemanager-image-update']) . '&id="+response.data[i].id;
                            var popover = \'<div class="popover bottom"> <div class="arrow"></div> <h3 class="popover-title">Perbaharui</h3> <div class="popover-content"> <form class="form-image-edit" method="post" action="\'+formaction+\'"> <input type="hidden" name="_csrf" value="bDdQMVhMLko8BjsCCjVsLykEAl0UOUQgOVtlABdhSRkYQCgJFQYYeA=="><input type="hidden" id="imagemodel-id" name="ImageModel[id]" value="\'+response.data[i].id+\'"> <div class="form-group field-imagemodel-name"> <label class="control-label" for="imagemodel-name">Nama</label> <input type="text" id="imagemodel-name" class="form-control" name="ImageModel[name]" placeholder="Nama..." value="\'+response.data[i].name+\'"> <div class="help-block"></div> </div> <div class="form-group field-imagemodel-description"> <label class="control-label" for="imagemodel-description">Keterangan</label> <textarea id="imagemodel-description" class="form-control" name="ImageModel[description]" rows="6" placeholder="Keterangan..." style="resize:none">\'+response.data[i].description+\'</textarea> <div class="help-block"></div> </div> <div class="form-group"> <button  type="button" id="save-image" class="btn btn-xs btn-primary"><i class="fa fa-check"></i>&nbsp; Simpan</button> </div> </form></div> </div>\';
                            $("#images-thumbnail").append(\'<div class="col-md-3 col-sm-6"><div  class="thumbnail"><img style="width: 1024px;" data-original="\' + original + response.data[i].unique_name +\'"  src="\' + src_thumb + response.data[i].unique_name +\'" data-unique-name="\' + response.data[i].unique_name +\'" /><div class="img-tools tools-bottom"><a href="javascript:undefined;" class="image-zoom select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Perbesar" data-id="\' + response.data[i].id +\'"><i class="fa fa-search-plus"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:undefined;" class="image-delete select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Hapus" data-id="\' + response.data[i].id +\'"><i class="fa fa-times" style="color:#d15b47"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:undefined;" class="image-edit select-tooltip" data-toggle="tooltip" data-placement="top" data-id="\' + response.data[i].id +\'" data-original-title="Edit"><i class="fa fa-pencil"></i></a>\'+popover+\'</div></div></div>\');
                        }
                    }
                    var tooltip = $("body").find(".select-tooltip"); 
                    $(tooltip).tooltip();
                    $("#loading").css({"display":"none"});
                 }, this)
               });
            }
        });
       
        '
        , View::POS_READY);
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?php echo Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?php echo Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard']); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute(['/filemanager/image/index', 'action' => 'filemanager-image-list']); ?>"><?php echo Yii::t('app', Html::encode('Foto')); ?></a>
    </li>
    <?php if ($albumid != 0): ?>
        <li class="active">
            Album : <?= $album_name; ?>
        </li>
    <?php endif; ?>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa  fa-picture-o  page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Foto') ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass}', [
                            'modelClass' => 'Album',
                        ]), Url::toRoute(['/filemanager/album/create', 'action' => 'filemanager-album-create']))
                ?>
            </h1>
        </div>
        <div class="col-xs-4">
            <div class="pull-right">
                <?php
                $form = ActiveForm::begin([
                            'action' => ['/filemanager/image/index', 'action' => 'filemanager-image-list', 'albumid' => $albumid],
                            'method' => 'GET',
                            'options' => ['role' => 'form', 'id' => 'search'],
                            'fieldConfig' => [
                                'template' => "{input}\n{hint}\n{error}"
                            ]
                ]);
                ?>

                <div class="input-group input-group-sm">
                    <?= Html::activeTextInput($searchModel, 'keyword', ['class' => 'form-control', 'placeholder' => 'Cari', 'maxlength' => 255]) ?>
                    <span class="input-group-btn">
                        <?= Html::submitButton('<span class="fa fa-search"></span>', ['class' => 'btn btn-primary']) ?>
                    </span>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4 col-sm-push-8">

        <div class="panel">
            <div class="panel-body text-center">
                <h3>
                    Album List
                </h3>
            </div>
        </div>
        <div class="list-group">
            <?php foreach ($album as $data): ?>
                <div class="<?= $data->id == $albumid ? "list-group-item  active" : "list-group-item" ?>">
                    <?= Html::a('<i class="fa fa-pencil"></i>', ["/filemanager/album/update", 'action' => 'filemanager-album-update', 'id' => $data->id], ['class' => 'select-tooltip', 'data-original-title' => 'Perbaharui']) ?>&nbsp;&nbsp;
                    <?= Html::a('<i class="fa fa-trash-o"></i>', ["/filemanager/album/delete", 'action' => 'filemanager-album-delete', 'id' => $data->id], ['data-method' => 'post', 'data-confirm' => Yii::t('user', 'Apakah Anda yakin akan menghapus item ini?'), 'class' => 'select-tooltip', 'data-original-title' => 'Hapus']) ?>&nbsp;&nbsp;
                    <?= Html::a($data->name, ['/filemanager/image/index', 'action' => 'filemanager-image-list', 'albumid' => $data->id]) ?>
                    <span class="badge badge-info"><?= $data->getImageLengthByAlbum($data->id) ?></span>
                </div>                
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-sm-8 col-sm-pull-4">
        <div class="row" id="images-thumbnail" page-data="1">  
            <div id="add-image" class="col-md-3 col-sm-6">
                <div  style="border: 3px dashed #ddd;">
                    <img src="<?= Yii::getAlias('@web') . "/resources/images/thumbnail/145x145/plus.png" ?>" style="width: 1024px" class="img-responsive">                   
                    <?=
                    FileUpload::widget([
                        'name' => 'file',
                        'plus' => true,
                        'url' => ['/filemanager/image/upload'],
                        'options' => ['accept' => 'image/*', 'title' => 'Tambah foto', 'multiple' => 'multiple'],
                        'clientOptions' => [
                            'dataType' => 'json',
                            'autoUpload' => true,
                            'previewMaxWidth' => 150,
                            'previewMaxHeight' => 137,
                            'previewCrop' => true,
                            'maxFileSize' => 2000000,
                            'formData' => [
                                Yii::$app->request->csrfParam => Yii::$app->request->getCsrfToken(),
                                'albumid' => $albumid
                            ]
                        ],
                        'clientEvents' => [
                            'fileuploadprogressall' => ' function (e, data) {'
                            . 'var progress = parseInt(data.loaded / data.total * 100, 10);'
                            . 'jQuery("#progressbox-identitycard").css("display","block");'
                            . 'jQuery("#progressbox-identitycard .progress-bar").css("width",progress + "%");'
                            . '}',
                            'fileuploaddone' => 'function (e, data){'
                            . " var response = data.result.files; 
                                    $('#new-image-'+uid).empty();
                                    var dataimg= '<img class=\"img-responsive\" style=\"width:1024px\" data-unique-name=\"'+response.unique_name+'\"  src=\"'+response.thumb+'\" />';
                                    var formaction = '" . Url::toRoute(['/filemanager/image/update', 'action' => 'filemanager-image-update']) . "&id='+response.id;
                                    " . 'var popover = \'<div class="popover bottom"> <div class="arrow"></div> <h3 class="popover-title">Perbaharui</h3> <div class="popover-content"> <form class="form-image-edit" method="post" action="\'+formaction+\'"> <input type="hidden" name="_csrf" value="bDdQMVhMLko8BjsCCjVsLykEAl0UOUQgOVtlABdhSRkYQCgJFQYYeA=="><input type="hidden" id="imagemodel-id" name="ImageModel[id]" value="\'+response.id+\'"> <div class="form-group field-imagemodel-name"> <label class="control-label" for="imagemodel-name">Nama</label> <input type="text" id="imagemodel-name" class="form-control" name="ImageModel[name]" placeholder="Nama..." value="\'+response.name+\'"> <div class="help-block"></div> </div> <div class="form-group field-imagemodel-description"> <label class="control-label" for="imagemodel-description">Keterangan</label> <textarea id="imagemodel-description" class="form-control" name="ImageModel[description]" rows="6" placeholder="Keterangan..." style="resize:none">\'+response.description+\'</textarea> <div class="help-block"></div> </div> <div class="form-group"> <button  type="button" id="save-image" class="btn btn-xs btn-primary"><i class="fa fa-check"></i>&nbsp; Simpan</button> </div> </form></div> </div>\';' . "
                                    var imgoptions = '<div class=\"img-tools tools-bottom text-center\">'
                                                        + '<a href=\"javascript:undefined;\" class=\"image-zoom select-tooltip\" data-toggle=\"tooltip\" data-id=\"'+response.id+'\" data-placement=\"top\" data-original-title=\"Perbesar\">'
                                                            + '<i class=\"fa fa-search-plus\"></i>'
                                                        +'</a>&nbsp;&nbsp;&nbsp;&nbsp;'
                                                        +'<a href=\"javascript:undefined;\" class=\"image-delete select-tooltip\" data-toggle=\"tooltip\" data-id=\"'+response.id+'\" data-placement=\"top\" data-original-title=\"Hapus\">'
                                                            +'<i class=\"fa fa-times\" style=\"color:#d15b47\"></i>'
                                                        +'</a>&nbsp;&nbsp;&nbsp;&nbsp;'
                                                        +'<a href=\"javascript:undefined;\" class=\"image-edit select-tooltip\" data-toggle=\"tooltip\" data-id=\"'+response.id+'\" data-placement=\"top\" data-original-title=\"Edit\">'
                                                            +'<i class=\"fa fa-pencil\"></i>' 
                                                        +'</a>' 
                                                        +popover
                                                     +'</div>';
                                    $('#new-image-'+uid).append(dataimg + imgoptions);
                                    $('#new-image-'+uid).attr('id','');
                                    $('.select-tooltip').tooltip();"
                            . '}',
                            'fileuploadprocessalways' => 'function (e, data) {'
                            . "var index = data.index,file = data.files[index];            
                                    if (file.preview) {           
                                        $('#add-image').after('<div class=\"col-md-3 col-sm-6\"><div id=\"new-image-'+uid+'\" class=\"thumbnail\"></div></div>');
                                        data.context  = $('#new-image-'+uid).prepend('<img class=\"img-responsive\" style=\"width:1024px\"  src=\" " . Yii::getAlias('@web') . "/PixelAdmin/img/blank.png" . "\" />' + '<div style=\"bottom: 80px\" class=\"img-tools tools-bottom text-center\"><img src=".Yii::getAlias('@web')."/PixelAdmin/img/fb/loading.gif" ."></div>');
                                    }"
                            . '}',
                        ]
                    ]);
                    ?>
                </div>                                                                              
            </div>
           
            <?php foreach ($model as $v): ?>
                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail">                   
                        <img alt="<?= $v->name ?>" src="<?= Yii::getAlias('@web') . "/resources/images/thumbnail/145x145/" . $v->unique_name ?>" data-unique-name="<?= $v->unique_name ?>" style="width: 1024px" class="img-responsive">                                      
                        <div class="img-tools tools-bottom text-center">
                            <a href="javascript:undefined;" class=" fancybox-button zoomer image-zoom select-tooltip" data-id="<?= $v->id ?>"
                               data-toggle="tooltip" data-placement="top" data-original-title="Perbesar">
                                <i class="fa fa-search-plus"></i>
                            </a>&nbsp;&nbsp;
                            <a href="javascript:undefined;" class="image-delete select-tooltip" data-id="<?= $v->id ?>"
                               data-toggle="tooltip" data-placement="top" data-original-title="Hapus">
                                <i class="fa fa-times" style="color:#d15b47"></i>
                            </a>&nbsp;&nbsp;
                            <a href="javascript:undefined;" class="image-edit select-tooltip" data-id="<?= $v->id ?>"
                               data-toggle="tooltip" data-placement="top" data-original-title="Perbaharui">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <div class="popover bottom">
                                <div class="arrow"></div>
                                <h3 class="popover-title">Perbaharui</h3>
                                <div class="popover-content">
                                    <?php
                                    $formimage = ActiveForm::begin(['id' => 'form-image' + $v->id, 'options' => ['class' => 'form-image-edit'], 'action' => Url::toRoute(['/filemanager/image/update', 'action' => 'filemanager-image-update', 'id' => $v->id])]);
                                    ?> 
                                    <?= Html::activeHiddenInput($image, 'id', ['value' => $v->id]) ?>
                                    <?= $formimage->field($image, 'name')->textInput(['placeholder' => 'Nama...', 'value' => $v->name])->label("Nama") ?>
                                    <?= $image->setAttribute('description', $v->description) ?>
                                    <?= $formimage->field($image, 'description')->textarea(['placeholder' => 'Keterangan...', 'rows' => 6, 'style' => 'resize:none'])->label("Keterangan") ?>
                                    <div class="form-group">
                                        <?= Html::button('<i class="fa fa-check"></i>&nbsp; ' . Yii::t('app', 'Simpan'), ['type' => 'button', 'id' => 'save-image', 'class' => 'btn btn-xs btn-primary']) ?>
                                    </div>
                                    <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            endforeach;
            ?>            
        </div>

        <?php
        $this->registerJs(
                '$("#images-thumbnail").on("click","#save-image",function(){'
                . 'var form = $(this).parent().parent();'
                . '$.ajax({'
                . 'url:$(form).attr("action"),'
                . 'dataType: "json",'
                . 'autoUpload: true,'
                . 'type:"POST",'
                . 'data:$(form).serialize(),'
                . 'success  : function(data) {'
                . '$($(form).parent().parent()).fadeOut();'
                . 'console.log("melengo")'
                . '}'
                . '});'
                . 'return false;'
                . '});'
                , View::POS_READY);
        ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="text-center" id="loading" style="display: none">
                    <img src="<?= Yii::getAlias('@web') . "/PixelAdmin/img/loading-3.gif" ?>"/>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs(
        "var guid = (function() {"
        . "function s4() {"
        . "return Math.floor((1 + Math.random()) * 0x10000)"
        . ".toString(16)"
        . ".substring(1);"
        . "}"
        . "return function() {"
        . "return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();"
        . "};"
        . "})();"
        . "var uid = guid();"
        , View::POS_END);
?>

