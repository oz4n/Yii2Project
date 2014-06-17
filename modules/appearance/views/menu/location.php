<?php

use Yii;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->registerJs(
        "$('ul.navigation > li.mm-dropdown > ul > li#menu').addClass('active').parent().parent().addClass('active open');"
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
        <a href="<?= Url::toRoute(['/appearance/menu/index', 'action' => 'appearance-menu-list']); ?>"><?= Yii::t('app', Html::encode('Menu')); ?></a>
    </li>   

    <li class="active">
        Pebaharui Lokasi
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa  fa-sitemap page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Menu') ?>  
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass}', [
                            'modelClass' => 'Menu',
                        ]), Url::toRoute(['/appearance/menu/create', 'action' => 'appearance-menu-create']))
                ?>
            </h1>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs nav-tabs-xs">
            <li>
                <a href="<?= Url::toRoute(['/appearance/menu/index', 'action' => 'appearance-menu-list']) ?>" >Perbaharui Menu</a>
            </li>
            <li class="active">
                <a href="<?= Url::toRoute(['/appearance/menu/location', 'action' => 'appearance-menu-location']) ?>" >Perbaharui Lokasi</a>
            </li>         
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-sm-12" >
        <div class="panel">
            <div class="panel-body">                
                <table class="table">
                    <thead>
                        <tr>
                            <th width="25%">Posisi Menu</th>
                            <td ></td>
                            <th width="75%">Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="25%">Menu Pertama ('Header')</td>
                            <td >:</td>
                            <td width="75%">
                                <?php ActiveForm::begin() ?>
                                <?= Html::activeDropDownList($model, 'name', $termmenu, ['class' => 'select-menu']) ?>
                                <?php ActiveForm::end() ?>
                            </td>
                        </tr>   
                        <tr>
                            <td width="25%">Menu Kedua ('Footer')</td>
                            <td >:</td>
                            <td width="75%">
                                <?php ActiveForm::begin() ?>
                                <?= Html::activeDropDownList($model, 'name', $termmenu, ['class' => 'select-menu']) ?>
                                <?php ActiveForm::end() ?>
                            </td>
                        </tr> 
                        <tr>
                            <td width="25%">Sosial Menu</td>
                            <td >:</td>
                            <td width="75%">
                                <?php ActiveForm::begin() ?>
                                <?=
                                Html::activeDropDownList($model, 'name', $termmenu, ['options' =>
                                    [
                                        4 => ['selected ' => true]
                                    ], 'class' => 'select-menu'])
                                ?>
                                <?php ActiveForm::end() ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>