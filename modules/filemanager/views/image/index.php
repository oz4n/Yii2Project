<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\helpers\Url;
use Yii;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\filemanager\searchs\ImageSearc $searchModel
 */
$this->title = Yii::t('app', 'Files');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs(
        "$('ul.navigation > li.mm-dropdown > ul > li#images').addClass('active').parent().parent().addClass('active open');"
        , View::POS_READY);

//image delte
$this->registerJs(
        '$("body").on("click",".image-delete",function(){'
            . '$($(this).parent().parent()).remove();'
            . '$.ajax({'
                . 'url:"'.Url::toRoute(['/filemanager/image/delete', 'action' => 'filemager-image-delete']) .'",'
                .'dataType: "json",'
                .'autoUpload: true,'
                .'type:"POST",'
                .'data:{"'.Yii::$app->request->csrfParam . '" : "' . Yii::$app->request->getCsrfToken().'","id":$(this).attr("data-id")},'
            . '});'
        . '});'
        , View::POS_READY);

$this->registerJs(
        '$("body").on("click",".image-edit",function(){'
        . '$("#test-popover").popover();'
        . '});'
        , View::POS_READY);
$this->registerJs(
        '$(".select-tooltip").tooltip();'      
        . '$(window).scroll(function() {
            if (document.documentElement.clientHeight + $(document).scrollTop() >= document.body.offsetHeight ){
                var scrl = $("#img-thumbnails");
                var pages = scrl.attr("page-data");
                $("#loading").css({"display":"block"});
                $.ajax({
                url:"' . Url::toRoute(['/filemanager/image/index', 'action' => 'filemager-image-list']) . '",      
                dataType: "json",
                data:{page:pages,album_id:"' . $album_id . '","FormSearch[keyword]":"' . $keyword . '"},       
                cache: false,
                type:"GET",       
                success:$.proxy(function(response){  
                console.log(response.page)
                    $("#img-thumbnails").attr("page-data", response.page);            
                    for (var i = 0; i < response.data.length; i++) {                
                        var original = "' . Yii::getAlias('@web') . "/resources/images/original/" . '";
                        var src_thumb = "' . Yii::getAlias('@web') . "/resources/images/thumbnail/145x145/" . '";
                        if($("#img-thumbnails").find(\'img[data-unique-name="\'+response.data[i].unique_name+\'"]\').length === 0){
                            $("#img-thumbnails").append(\'<div  class="thumbnails-child" style="width: 160px; height: 160px;"><img style="width: 150px;" data-original="\' + original + response.data[i].unique_name +\'" alt="\' + response.data[i].name +\'" src="\' + src_thumb + response.data[i].unique_name +\'" data-unique-name="\' + response.data[i].unique_name +\'" /><div class="tools tools-bottom"><a href="javascript:undefined;" class="image-zoom select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Perbesar" data-id="\' + response.data[i].id +\'"><i class="fa fa-search-plus"></i></a><a href="javascript:undefined;" class="image-delete select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Hapus" data-id="\' + response.data[i].id +\'"><i class="fa fa-times" style="color:#d15b47"></i></a><a href="javascript:undefined;" class="image-edit select-tooltip" data-toggle="tooltip" data-placement="top" data-id="\' + response.data[i].id +\'" data-original-title="Edit"><i class="fa fa-pencil"></i></a></div></div>\');
                        }
                    }
                    var tooltip = $("body").find(".select-tooltip"); 
                    $(tooltip).tooltip();
                    $("#loading").css({"display":"none"});
                 }, this)
               });
            }
        });'
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
    <?php if($album_id != 0): ?>
    <li class="active">
        Album : <?=  $album_name; ?>
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
                    'action' => ['/filemanager/image/index','action'=>'filemanager-image-list','album_id'=>$album_id],
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
        <?php
//        echo "<pre>";
//        print_r(\app\modules\filemanager\models\AlbumModel::getAllAlbums());
//        echo "</pre>";
        ?>
        <div>
            <ul id="album-select-list" style="border-top: 1px solid; border-bottom: 1px solid; border-color:  #ddd">    
                <?php foreach ($album as $data): ?>
                    <li class="clearfix">
                        <a href="<?= Url::toRoute(['/filemanager/image/index','action'=>'filemanager-image-list','album_id'=>$data->id]) ?>"><span class="<?= $data->id == $album_id ? "active" : ""?>"><?= $data->name; ?></span></a>
                    </li>     
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="album-select" class="open"></div>
    </div>
    <div class="col-sm-8 col-sm-pull-4"> 
        
        <div class="ace-thumbnails" id="img-thumbnails" style="margin-top: -5px;" page-data="1">             
            <div id="add-image" class="thumbnails-child" style="width: 160px; height: 160px; border: 2px dashed #ddd;">            
                <div class="text-center">
                    <i class="fa fa-plus" style="color:#C0C0C0; font-size: 34px; margin-top: 40%; margin-bottom: 50%"></i>
                    <input id="fileupload" accept="image/*" placeholder="Pilih file" type="file" name="file" multiple>
                </div>
            </div>   
             
            <?php
            /** @var app\modules\dao\ar\File $v */
            foreach ($model as $v):
                ?>            
            <div class="thumbnails-child" style="width: 160px; height: 160px;">
                    <div>
                        <img width="150" data-original="<?= Yii::getAlias('@web') . "/resources/images/original/" . $v->unique_name ?>" alt="<?= $v->name ?>" src="<?= Yii::getAlias('@web') . "/resources/images/thumbnail/145x145/" . $v->unique_name ?>" data-unique-name="<?= $v->unique_name ?>" />                                            
                    </div>
                    <div class="tools tools-bottom"> 
                        <a href="javascript:undefined;" class="image-zoom select-tooltip" data-id="<?= $v->id ?>" data-toggle="tooltip" data-placement="top" data-original-title="Perbesar">
                            <i class="fa fa-search-plus"></i>
                        </a>
                        <a href="javascript:undefined;" class="image-delete select-tooltip" data-id="<?= $v->id ?>" data-toggle="tooltip" data-placement="top" data-original-title="Hapus">
                            <i class="fa fa-times" style="color:#d15b47"></i>
                        </a>
                        <a href="javascript:undefined;" class="image-edit select-tooltip" data-id="<?= $v->id ?>" data-toggle="tooltip" data-placement="top" data-original-title="Edit">
                            <i class="fa fa-pencil"></i>                            
                        </a>                        
                    </div>                    
                </div>                
            <?php endforeach; ?>
        </div>       

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
    "
    var guid = (function() {
        function s4() {
          return Math.floor((1 + Math.random()) * 0x10000)
                     .toString(16)
                     .substring(1);
        }
        return function() {
          return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
                 s4() + '-' + s4() + s4() + s4();
        };
    })();   
    var uid = guid();
    $('#fileupload').fileupload({
        url: '".Url::toRoute(['/filemanager/image/upload'])."',       
        dataType: 'json',
        autoUpload: true,
        formData:{'" . Yii::$app->request->csrfParam . "' : '" . Yii::$app->request->getCsrfToken() . "','album_id':$album_id},
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB       
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 150,
        previewMaxHeight: 137,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        //data.context =  $('<div/>').appendTo('#files');
    }).on('fileuploadprocessalways', function (e, data) {           
        var index = data.index,
            file = data.files[index];            
        if (file.preview) {           
            $('#add-image').after('<div  style=\"width: 160px; height: 160px;\" id=\"new-image-'+uid+'\" class=\"thumbnails-child\"><div id=\"progress\" class=\"progress progress-striped active\" style=\"margin-top: 0; margin-bottom: 0\"><div class=\"progress-bar\" ></div></div></div>');
            data.context  = $('#new-image-'+uid).prepend('<div><img width=\"150\" height=\"137\" src=\" ". Yii::getAlias('@web') . "/resources/images/thumbnail/145x145/blank.png"."\" /></div>');
        }
//        if (file.error) {
//            node
//                .append('<br>')
//                .append($('<span class=\"text-danger\"/>').text(file.error));
//        }
//        if (index + 1 === data.files.length) {
//            data.context.find('button')
//                .text('Upload')
//                .prop('disabled', !!data.files.error);
//        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        ;
        var response = data.result.files;       
        $('#new-image-'+uid).empty();
        var dataimg= '<div><img width=\"150\" data-original=\"'+response.original+'\" alt=\"'+response.orginal_name+'\" src=\"'+response.thumb+'\" data-unique-name=\"'+response.unique_name+'\" /></div>';
        var imgoptions = '<div class=\"tools tools-bottom\">'
                            + '<a href=\"javascript:undefined;\" class=\"image-zoom select-tooltip\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Perbesar\">'
                                + '<i class=\"fa fa-search-plus\"></i>'
                            +'</a>'
                            +'<a href=\"javascript:undefined;\" class=\"image-delete select-tooltip\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Hapus\">'
                                +'<i class=\"fa fa-times\" style=\"color:#d15b47\"></i>'
                            +'</a>'
                            +'<a href=\"javascript:undefined;\" class=\"image-edit select-tooltip\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Edit\">'
                                +'<i class=\"fa fa-pencil\"></i>' 
                            +'</a>'                        
                         +'</div>';
        $('#new-image-'+uid).append(dataimg + imgoptions);
        $('#new-image-'+uid).attr('id','');
        $('.select-tooltip').tooltip();
        console.log(data.result.files.original);
    }).on('fileuploadfail', function (e, data) {          
        $.each(data.files, function (index, file) {
            var error = $('<span class=\"text-danger\"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');"
        , View::POS_READY);
?>
<?php
//GridView::widget([
//    'dataProvider' => $dataProvider,
//    'filterModel' => $searchModel,
//    'columns' => [
//        ['class' => 'yii\grid\SerialColumn'],
//        'id',
//        'user_id',
//        'name',
//        'orginal_name:ntext',
//        'unique_name:ntext',
//        // 'type',
//        // 'size',
//        // 'file_type',
//        // 'description',
//        // 'create_at',
//        // 'update_et',
//        ['class' => 'yii\grid\ActionColumn'],
//    ],
//]);
?>
