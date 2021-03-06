<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Member $model
 */

$this->title = Yii::t('app', 'Tambah {modelClass}', [
    'modelClass' => 'Anggota Paskibra',
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
    . '"PaskibraModel[email]":{required: true,email: true},'
    . '"PaskibraModel[save_status]":{required: true},'
    . '"PaskibraModel[note]":{required: true, maxlength: 255},'
    . '"PaskibraModel[birth]":{required: true},'
    . '"PaskibraModel[year]":{required: true},'
    . '"PaskibraModel[taxonomy_id]":{required: true},'
    . '"PaskibraModel[school_id]":{required: true},'
//            . '"PaskibraModel[front_photo]":{required: true },'
//            . '"PaskibraModel[side_photo]":{required: true },'
//            . '"PaskibraModel[identity_card]":{required: true }'
    . '},'
    . 'messages: {'
    . '"PaskibraModel[front_photo]" : "Tidak boleh Kosong.",'
    . '"PaskibraModel[side_photo]" : "Tidak boleh Kosong.",'
    . '"PaskibraModel[identity_card]" : "Tidak boleh Kosong.",'
    . '"PaskibraModel[school_id]":"Tidak boleh kosong.",'
    . '"PaskibraModel[taxonomy_id]":"Tidak boleh kosong.",'
    . '"PaskibraModel[year]":"Tidak boleh kosong.",'
    . '"PaskibraModel[birth]":"Tidak boleh kosong.",'
    . '"PaskibraModel[note]":"Tidak boleh kosong.",'
    . '"PaskibraModel[save_status]": "Tidak boleh kosong.",'
    . '"PaskibraModel[email]":"Tidak boleh kosong dan masukkan alamat email yang valid."'
    . '}'
    . '});'

    . '$("#front-photo-file-input").change(function(){'
    . 'var input_file = $("#member-form");'
    . 'var s = $(input_file).find(\'input[name="PaskibraModel[front_photo]"]\');'
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
    . 'var s = $(input_file).find(\'input[name="PaskibraModel[side_photo]"]\');'
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
    . 'var s = $(input_file).find(\'input[name="PaskibraModel[identity_card]"]\');'
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
        <a href="<?= Url::toRoute(['/member/paskibra/index', 'action' => 'member-paskibra-list']); ?>"><?= Yii::t('app', Html::encode('Anggota Paskibra')); ?></a>
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