<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use app\modules\word\searchs\PostSerch;
use yii\helpers\Url;
//use yii\imperavi\Widget as ImperaviWidget;
/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Post $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerJsFile('PixelAdmin/js/filesize.min.js', '', ['position' => View::POS_END]);
//$this->registerCssFile('redactor/redactor.css', '', ['position' => View::POS_BEGIN]);
$this->registerJs(
    "$('ul.navigation > li.mm-dropdown > ul > li#post').addClass('active').parent().parent().addClass('active open');"
    . '$("#select-tag").select2({ allowClear: true, placeholder: "Tag ..."}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    . '$("#select-status").select2({ allowClear: true, placeholder: "Tag ..."}).change(function(){ if($(this).valid()){ $(this).parent().parent().addClass("has-success"); } });'
    , View::POS_READY);

$this->registerJs(
        '
        $("#post-content").redactor({
        imageUpload:"'.Url::toRoute(['/filemanager/image/uploadredactorimage']).'",
        imageGetJson:"'.Url::toRoute(['/filemanager/image/loadredactorimage']).'",
        imageUploadErrorCallback:function(data){
            $("html,body").animate({ scrollTop: 0 }, 500);
            PixelAdmin.plugins.alerts.add("<strong>Maap!</strong>&nbsp;" + data.error, {
                type:"danger",
                auto_close:9
            });
        },
        fileUpload:"'.Url::toRoute(['/filemanager/document/uploaddredactorfile']).'", 
        fileGetJson:"'.Url::toRoute(['/filemanager/document/loadredactorfile']).'",
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
        imgLoading:"'.Yii::getAlias('@web') . "/PixelAdmin/img/loading.gif".'",
        
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
<?php $form = ActiveForm::begin(); ?>
    <div class="col-sm-8">

        <div class="form-group">
            <?= Html::activetextInput($model, 'title', ['class'=>'form-control','placeholder' => 'Judul . . .', 'maxlength' => 225]) ?>
        </div>
        <div class="form-group">
            <?= Html::activetextarea($model, 'content',['id'=>'post-content','class'=>'form-control','placeholder' => 'Isi . . .', 'rows' => 6]) ?>
        </div> 
    </div>

    <div class="col-sm-4">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">Kategory</span>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?=  Html::activeCheckboxList($model, 'taxes',PostSerch::getCategories(),['name' => 'PostModel[category][]']) ?>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">Tag</span>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <?=  Html::activeDropDownList($model, 'taxes',PostSerch::getTags(),['name' => 'PostModel[tag][]','id'=>'select-tag','multiple'=>'multiple']) ?>
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
                    <?= Html::submitButton(Html::tag('i','',['class'=>'fa  fa-check']).'&nbsp; '.Yii::t('app', 'Simpan'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    <button type="button" id="btn-test" class="btn"><i class="fa  fa-check"></i>&nbsp; test</button>
                </div>
            </div>
        </div>
    </div>

    
<?php ActiveForm::end(); ?>

