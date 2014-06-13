<?php
use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Widget $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerJsFile('PixelAdmin/js/filesize.min.js', '', ['position' => View::POS_END]);
$this->registerJs(
    '
    $("#redactor-text").redactor({
    imageUpload:"'.Url::toRoute(['/filemanager/image/uploadredactorimage']).'",
        imageGetJson:"'.Url::toRoute(['/filemanager/image/loadredactorimage']).'",
        albumGetJson:"'.Url::toRoute(['/filemanager/image/loadredactoralbum']).'",
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
        deniedTags: ["div"],
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
        buttons: ["html","unorderedlist", "orderedlist", "outdent", "indent", "bold", "italic","underline","alignment","|","image", "video", "file", "link"]
    });

', View::POS_READY);
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => 45])->label('Judul') ?>
<?= $form->field($model, 'content')->textarea(['id'=>'redactor-text','rows' => 6, 'style' => 'resize:none'])->label('Isi Widget') ?>
<?= $form->field($model, 'layoute_position')->dropDownList(['homeright' => 'Widget Posisi Kanan', 'homeleft' => 'Widget Kiri', 'homesidebar' => 'Sidebar'])->label('Posisi Layout') ?>
<?= $form->field($model, 'status')->dropDownList(['Publish' => 'Publish', 'Draft' => 'Draft']) ?>

<?= Html::activeHiddenInput($model, 'type') ?>

<div class="form-group">
    <?= Html::submitButton('<i class="fa  fa-check"></i>&nbsp; '.Yii::t('app', 'Simpan'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

