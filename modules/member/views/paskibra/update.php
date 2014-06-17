<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Member $model
 */

$this->title = Yii::t('app', 'Perbaharui {modelClass} ', [
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
    . '"PaskibraModel[email]":{required: true,email: true},'
    . '"PaskibraModel[save_status]":{required: true},'
    . '"PaskibraModel[note]":{required: true, maxlength: 255},'
    . '"PaskibraModel[birth]":{required: true},'
    . '"PaskibraModel[year]":{required: true},'
    . '"PaskibraModel[taxonomy_id]":{required: true},'
    . '"PaskibraModel[school_id]":{required: true},'
    . '},'
    . 'messages: {'
    . '"PaskibraModel[school_id]":"Tidak boleh kosong.",'
    . '"PaskibraModel[taxonomy_id]":"Tidak boleh kosong.",'
    . '"PaskibraModel[year]":"Tidak boleh kosong.",'
    . '"PaskibraModel[birth]":"Tidak boleh kosong.",'
    . '"PaskibraModel[note]":"Tidak boleh kosong.",'
    . '"PaskibraModel[save_status]": "Tidak boleh kosong.",'
    . '"PaskibraModel[email]":"Tidak boleh kosong dan masukkan alamat email yang valid."'
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
        <a href="<?= Url::toRoute(['/member/paskibra/index', 'action' => 'member-paskibra-list']); ?>"><?= Yii::t('app', Html::encode('Anggota Paskibra')) ?></a>
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
                <?= Html::encode('Anggota Paskibra') ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass}', [
                    'modelClass' => 'Anggota Paskibra',
                ]), Url::toRoute(['/member/paskibra/create', 'action' => 'member-paskibra-create']))
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