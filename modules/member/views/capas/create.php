<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Member $model
 */

$this->title = Yii::t('app', 'Tambah {modelClass}', [
    'modelClass' => 'Anggota Capas',
]);
//$this->registerJs('
//function readImage(file ,e) {
//    var reader = new FileReader();
//    var image  = new Image();
//    reader.readAsDataURL(file);
//    reader.onload = function(_file) {
//        image.src    = _file.target.result;
//        image.onload = function() {
//           isize = this.width + "x" +this.height;
//           //if(isize === "734x1024"){
//           if(isize !== "215x300"){
//             e.parent().append(\'<div id="front-photo-image-size"  image-size="\'+isize+\'" class="jquery-validate-error help-block" style="color:#a94442">Maksimum ukuran photo 215x300.</div>\');
//             $(e).attr("value","");
//           }
//        };
//    };
//}
//
//function getImageSize(f , s){
//  if(f && f[0]){
//    for(var i=0; i<f.length; i++){
//       readImage(f[i],s);
//    }
//  }
//}
//
//', View::POS_END);
$this->registerJs(
    'init.push(function () { '
    . 'var member_form = $("#member-form");'
    . 'member_form.validate({'
    . 'ignore: ".ignore",'
    . 'focusInvalid: true,'
    . 'rules:{'
    . '"CapasModel[email]":{required: true,email: true},'
    . '"CapasModel[save_status]":{required: true},'
    . '"CapasModel[note]":{required: true, maxlength: 255},'
    . '"CapasModel[birth]":{required: true},'
    . '"CapasModel[year]":{required: true},'
    . '"CapasModel[taxonomy_id]":{required: true},'
    . '"CapasModel[school_id]":{required: true},'
//            . '"CapasModel[front_photo]":{required: true },'
//            . '"CapasModel[side_photo]":{required: true },'
//            . '"CapasModel[identity_card]":{required: true }'
    . '},'
    . 'messages: {'
    . '"CapasModel[front_photo]" : "Tidak boleh Kosong.",'
    . '"CapasModel[side_photo]" : "Tidak boleh Kosong.",'
    . '"CapasModel[identity_card]" : "Tidak boleh Kosong.",'
    . '"CapasModel[school_id]":"Tidak boleh kosong.",'
    . '"CapasModel[taxonomy_id]":"Tidak boleh kosong.",'
    . '"CapasModel[year]":"Tidak boleh kosong.",'
    . '"CapasModel[birth]":"Tidak boleh kosong.",'
    . '"CapasModel[note]":"Tidak boleh kosong.",'
    . '"CapasModel[save_status]": "Tidak boleh kosong.",'
    . '"CapasModel[email]":"Tidak boleh kosong dan masukkan alamat email yang valid."'
    . '}'
    . '});'

    . '$("#front-photo-file-input").change(function(){'
    . 'var input_file = $("#member-form");'
    . 'var s = $(input_file).find(\'input[name="CapasModel[front_photo]"]\');'
    . '$(s).attr("value","ozan rock");'
    . 'var d = $("#front-photo-file-input").parent().find("a.pfi-clear");'
    . 's.parent().find("div.jquery-validate-error").remove();'
    . '$(d).click("click",function(){'
    . '$(s).attr("value","");'
    . 's.parent().find("div.jquery-validate-error").remove();'
    . 's.parent().append("<div class=\'jquery-validate-error help-block\' style=\'color:#a94442\'>Tidak boleh Kosong.</div>");'
    . '});'
    . '});'

    . '$("#side-photo-file-input").change(function(){'
    . 'var input_file = $("#member-form");'
    . 'var s = $(input_file).find(\'input[name="CapasModel[side_photo]"]\');'
    . '$(s).attr("value","ozan rock");'
    . 'var d = $("#side-photo-file-input").parent().find("a.pfi-clear");'
    . 's.parent().find("div.jquery-validate-error").remove();'
    . '$(d).click("click",function(){'
    . '$(s).attr("value","");'
    . 's.parent().find("div.jquery-validate-error").remove();'
    . 's.parent().append("<div class=\'jquery-validate-error help-block\' style=\'color:#a94442\'>Tidak boleh Kosong.</div>");'
    . '});'
    . '});'

    . '$("#identity_card-file-input").change(function(){'
    . 'var input_file = $("#member-form");'
    . 'var s = $(input_file).find(\'input[name="CapasModel[identity_card]"]\');'
    . '$(s).attr("value","ozan rock");'
    . 'var d = $("#identity_card-file-input").parent().find("a.pfi-clear");'
    . 's.parent().find("div.jquery-validate-error").remove();'
    . '$(d).click("click",function(){'
    . '$(s).attr("value","");'
    . 's.parent().find("div.jquery-validate-error").remove();'
    . 's.parent().append("<div class=\'jquery-validate-error help-block\' style=\'color:#a94442\'>Tidak boleh Kosong.</div>");'
    . '});'
    . '});'
    . '});'
    , View::POS_END);
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?= Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?= Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard-list']); ?>"><?= Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?= Url::toRoute(['/member/capas/index', 'action' => 'member-capas-list']); ?>"><?= Yii::t('app', Html::encode('Anggota Capas')); ?></a>
    </li>
    <li class="active">
        <?= $this->title; ?>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="menu-icon fa fa-users page-header-icon"> </i>
                &nbsp;
                <?= Html::encode($this->title) ?>
            </h1>
        </div>
        <div class="col-xs-4">

        </div>
    </div>
</div>
<div class="row">

    <?=
    $this->render('_form', [
        'model' => $model
    ])
    ?>

</div>