<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\member\searchs\PpiSerch;

$this->registerJsFile('PixelAdmin/js/jquery.2.0.3.min.js', [], ['position' => View::POS_HEAD]);
$this->registerJs(''
        . "$('ul.navigation > li#database > ul.mm-dropdown > li#tools > ul.mm-dropdown > li#tools-export').addClass('active').parent().parent().addClass('open').parent().parent().addClass('active open');"
        , View::POS_READY);
$this->title = "Expor Data Anggota";
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?= Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?= Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard-list']); ?>"><?= Yii::t('app', 'Beranda'); ?></a>
    </li>    
    <li class="active">
        Expor
    </li>
</ul>

<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa fa-files-o page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Expor Data Anggota') ?>                            
            </h1>
        </div>
        <div class="col-xs-4">

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <?PHP
        $form = ActiveForm::begin();
        ?>
         <?= $form->field($model, "member_type")->dropDownList([             
             "Capas" => "Anggota Capas",
             "PPI"=> "Aanggota PPI",
             "Paskibra" => "Anggota Paskibra",            
             ])->label("Anggota") ?> 
        <?= $form->field($model, "limit")->dropDownList([            
            50 => "Limit 50",
            100 => "Limit 100",
            200 => "Limit 200",
            300 => "Limit 300",
            400 => "Limit 400",
            500 => "Limit 500",
        ]) ?>        
        <?= $form->field($model, "year_filtr1")->dropDownList(PpiSerch::getYears())->label("Dari Tahun Angkatan") ?> 
        <?= $form->field($model, "year_filtr2")->dropDownList(PpiSerch::getYears())->label("Sampai Dengan Tahun Angkatan") ?> 
        <div class="form-group">
           <?= Html::submitButton(Html::tag('i', '', ['class' => 'fa fa-check']) . '&nbsp;&nbsp;' . Yii::t('app', 'Ekspor') , ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>