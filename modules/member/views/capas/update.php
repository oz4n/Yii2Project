<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Member $model
 */

$this->title = Yii::t('app', 'Perbaharui {modelClass} ', [
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
//             e.parent().append("<div class=\"jquery-validate-error help-block\" style=\"color:#a94442\">Maksimum ukuran photo 734x1024.</div>");
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
    . '},'
    . 'messages: {'
    . '"CapasModel[school_id]":"Tidak boleh kosong.",'
    . '"CapasModel[taxonomy_id]":"Tidak boleh kosong.",'
    . '"CapasModel[year]":"Tidak boleh kosong.",'
    . '"CapasModel[birth]":"Tidak boleh kosong.",'
    . '"CapasModel[note]":"Tidak boleh kosong.",'
    . '"CapasModel[save_status]": "Tidak boleh kosong.",'
    . '"CapasModel[email]":"Tidak boleh kosong dan masukkan alamat email yang valid."'
    . '}'
    . '});'

    . '});'
    , View::POS_END);
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?= Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?= Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard-list']); ?>"><?= Yii::t('app', 'Beranda') ?></a>
    </li>
    <li>
        <a href="<?= Url::toRoute(['/member/capas/index', 'action' => 'member-capas-list']); ?>"><?= Yii::t('app', Html::encode('Anggota Capas')) ?></a>
    </li>
    <li class="active">
        <?= $this->title . ' : ' . $model->name; ?>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa fa-users page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Anggota Capas') ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass}', [
                    'modelClass' => 'Anggota Capas',
                ]), Url::toRoute(['/member/capas/create', 'action' => 'member-capas-create']))
                ?>
            </h1>
        </div>
        <div class="col-xs-4">

        </div>
    </div>
</div>
<div class="row">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
</div>