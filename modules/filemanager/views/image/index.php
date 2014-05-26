<?php

use yii\helpers\Html;
use yii\grid\GridView;
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
$this->registerJs(
'$(window).scroll(function() {
    if (document.documentElement.clientHeight + $(document).scrollTop() >= document.body.offsetHeight ){ 
        $.ajax({
         url:"' . Url::toRoute(['/filemanager/image/loads', 'action' => 'filemager-image-load']) . '",
         data:{"data":"data"},
//         dataType:"json",
         success:function(response){  
//            $(scrl).attr("page-data", response.page);
//            var tooltip = $("body").find(".select-tooltip");
//            $(tooltip).tooltip();
//            $("#loading").css({"display":"none"});
//            for (var i = 0; i < response.data.length; i++) {
//                var thumb = "' . Yii::getAlias('@web') . "/resources/member/thumbnail/" . '";
//                var src_thumb = "' . Yii::getAlias('@web') . "/resources/member/thumbnail/150x150/" . '";
//                if($("#img-thumbnails").find(\'img[alt="\'+response.data[i].name+\'"]\').length === 0){
//                    $("#img-thumbnails").append(\'<li><img style="width: 145px; height: 145px;" data-thumb="\' + thumb + response.data[i].unique_name +\'" alt="\' + response.data[i].name +\'" src="\' + src_thumb + response.data[i].unique_name +\'" data-unique-name="\' + response.data[i].unique_name +\'" /><div class="tools tools-bottom"><a href="javascript:undefined;" class="select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Perbesar"><i class="fa fa-search-plus"></i></a><a href="javascript:undefined;" class="select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Hapus"><i class="fa fa-times" style="color:#d15b47"></i></a><a href="javascript:undefined;" class="select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Pilih"><i class="fa fa-share"></i></a></div></li>\');
//                }else{
//                    console.log(1);
//                }
//            }
//            $("#modal-loading").modal("hide");
//            $("#modal-images").modal();
//            $("#modal-images").css({"overflow-y":"hidden"});
         }
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
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="text-center text-left-sm">
                <i class="fa  fa-picture-o  page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Foto') ?>                
            </h1>
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
                <?php foreach (\app\modules\filemanager\models\AlbumModel::getAllAlbums() as $data):?>
                <li class="clearfix">
                    <span><?= $data->name; ?></span>
                </li>     
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="album-select" class="open"></div>
    </div>
    <div class="col-sm-8 col-sm-pull-4">
        <ul class="ace-thumbnails" id="img-thumbnails" style="margin-top: -5px;"> 
            <li style="width: 160px; height: 160px; border: 2px dashed #ddd;">
                <div class="text-center">
                    <i class="fa fa-plus" style="color:#C0C0C0; font-size: 34px; margin-top: 40%; margin-bottom: 50%"></i>
                </div>
            </li>   
            <?php
            /** @var app\modules\dao\ar\File $v */
            foreach ($model as $v):
                ?>
                <li>
                    <div>
                        <img width="150" data-thumb="<?= Yii::getAlias('@web') . "/resources/member/thumbnail/" . $v->unique_name ?>" alt="<?= $v->name ?>" src="<?= Yii::getAlias('@web') . "/resources/images/thumbnail/145x145/" . $v->unique_name ?>" data-unique-name="<?= $v->unique_name ?>" />                                            
                    </div>
                    <div class="tools tools-bottom"> 
                        <a href="javascript:undefined;" class="select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Perbesar">
                            <i class="fa fa-search-plus"></i>
                        </a>
                        <a href="javascript:undefined;" class="select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Hapus">
                            <i class="fa fa-times" style="color:#d15b47"></i>
                        </a>
                        <a href="javascript:undefined;" class="select-tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Pilih">
                            <i class="fa fa-share"></i>
                        </a>
                    </div>
                </li>   
            <?php endforeach; ?>
        </ul>
        <div class="text-center"><img src="<?= Yii::getAlias('@web') . "/PixelAdmin/img/loading-3.gif"?>"/></div>
    </div>
</div>
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
