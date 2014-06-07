<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\filemanager\searchs\DocumentSearc $searchModel
 */

$this->title = Yii::t('app', 'Dokumen');
$this->registerJs(
        "$('ul.navigation > li.mm-dropdown > ul > li#document').addClass('active').parent().parent().addClass('active open');"
        , View::POS_READY);
?>

<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?= Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?= Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard']); ?>"><?= Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?= Url::toRoute(['/filemanager/document/index', 'action' => 'filemanager-document-list']); ?>"><?= Yii::t('app', Html::encode('Dokumen')); ?></a>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa  fa-pencil page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Dokumen') ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass}', [
                    'modelClass' => 'Dokumen',
                ]), Url::toRoute(['/filemanager/document/create', 'action' => 'filemanager-document-create']))
                ?>
            </h1>
        </div>
        <div class="col-xs-4">
            <div class="pull-right">
                <?php
                $form = ActiveForm::begin([
                    'action' => ['/filemanager/document/index', 'action' => 'filemanager-document-list'],
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
<div class="col-sm-12">
<?php


$form = ActiveForm::begin([
    'action' => ['/filemanager/document/index', 'action' => 'filemanager-document-list'],
    'method' => 'get'
]);

?>
<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'filterUrl' => ['/filemanager/document/index', 'action' => 'filemanager-document-list'],
    'pager' => ['maxButtonCount' => 3],
    'tableOptions' => ['class' => 'table'],
    'layout' => Html::beginTag('div', ['class' => 'row'])

        . Html::beginTag('div', ['class' => 'col-xs-8'])
        . Html::beginTag('div', ['class' => 'form-inline'])
        . Html::dropDownList('bulk_action1', '', ['' => 'Tindakan Massal', 'delete' => 'Hapus', 'trash' => 'Tongsampah'], ['class' => 'form-control action-bulk'])
        . '&nbsp;&nbsp;'
//        . Html::dropDownList('DokumenSerch[year_filtr1]', '', DokumenSerch::getYears('Tahun'), ['class' => 'form-control select-year'])
//        . '&nbsp;&nbsp;'
//        . Html::dropDownList('DokumenSerch[year_opsi]', '', ['and' => 'dan', 's/d' => 's/d'], ['class' => 'form-control opsi'])
//        . '&nbsp;&nbsp;'
//        . Html::dropDownList('DokumenSerch[year_filtr2]', '', DokumenSerch::getYears('Tahun'), ['class' => 'form-control select-year'])
//        . '&nbsp;&nbsp;'
        . Html::dropDownList('DokumenSerch[status_filtr1]', '', ['Status', 'Publish' => 'Publish', 'Draft' => 'Draft', 'Trash' => 'Trash'], ['class' => 'form-control save-status'])
        . '&nbsp;&nbsp;'
        . Html::submitButton('<i class="fa fa-check"></i> &nbsp;' . Yii::t('app', 'Appley'), ['class' => 'btn btn-primary btn-small'])
        . Html::endTag('div')
        . Html::endTag('div')

        . Html::beginTag('div', ['class' => 'col-xs-4'])

        . Html::beginTag('div', ['class' => 'pull-right'])
        . '{pager}'
        . Html::endTag('div')

        . Html::beginTag('div', ['class' => 'pull-right', 'style' => 'padding-right: 10px; margin-top: 6px'])
        . '{summary}'
        . Html::endTag('div')

        . Html::endTag('div')

        . Html::endTag('div')

        . Html::beginTag('div', ['class' => 'panel', 'style' => 'margin-bottom: 15px; margin-top: 10px'])
        . Html::beginTag('div', ['class' => 'panel-body'])
        . Html::beginTag('div', ['class' => 'table-responsive'])
        . '{items}'
        . Html::endTag('div')
        . Html::endTag('div')
        . Html::endTag('div')

        . Html::beginTag('div', ['class' => 'row'])
        . Html::beginTag('div', ['class' => 'col-xs-8'])
        . Html::beginTag('div', ['class' => 'form-inline'])
        . Html::dropDownList('bulk_action2', '', ['' => 'Tindakan Massal', 'delete' => 'Hapus', 'trash' => 'Tongsampah'], ['class' => 'form-control action-bulk'])
        . '&nbsp;&nbsp;'
//        . Html::dropDownList('DokumenSerch[year_filtr3]', '', DokumenSerch::getYears('Tahun'), ['class' => 'form-control select-year'])
//        . '&nbsp;&nbsp;'
//        . Html::dropDownList('DokumenSerch[year_opsi1]', '', ['and' => 'dan', 's/d' => 's/d'], ['class' => 'form-control opsi'])
//        . '&nbsp;&nbsp;'
//        . Html::dropDownList('DokumenSerch[year_filtr4]', '', DokumenSerch::getYears('Tahun'), ['class' => 'form-control select-year'])
//        . '&nbsp;&nbsp;'
        . Html::dropDownList('DokumenSerch[status_filtr2]', '', ['Status', 'Publish' => 'Publish', 'Draft' => 'Draft','Trash' => 'Trash'], ['class' => 'form-control save-status'])
        . '&nbsp;&nbsp;'
        . Html::submitButton('<i class="fa fa-check"></i> &nbsp;' . Yii::t('app', 'Appley'), ['class' => 'btn btn-primary btn-small'])
        . Html::endTag('div')
        . Html::endTag('div')

        . Html::beginTag('div', ['class' => 'col-xs-4'])

        . Html::beginTag('div', ['class' => 'pull-right'])
        . '{pager}'
        . Html::endTag('div')

        . Html::beginTag('div', ['class' => 'pull-right', 'style' => 'padding-right: 10px; margin-top: 6px'])
        . '{summary}'
        . Html::endTag('div')

        . Html::endTag('div')
        . Html::endTag('div'),
    'columns' => [
        ['class' => 'yii\grid\CheckboxColumn'],
//        [
//            'attribute' => 'user_id',
//            'label' => ''
//        ],
        [
            'attribute' => 'name',
            'label' => 'Nama'
        ],
        
        [
            'attribute' => 'file_type',
            'label' => 'Tipe File'
        ],
        
         [
            'attribute' => 'size',
            'label' => 'Ukuran'
        ],
        
        [
            'attribute' => 'create_at',
            'label' => 'Ditambahkan'
        ],
        [
            'attribute' => 'update_et',
            'label' => 'Diubah'
        ],
               

        [
            'class' => 'yii\grid\ActionColumn',
            'header' => '<div class="text-center" style="width: 120px">Aksi</div>',
            'template' => '<div class="text-center">{update}&nbsp{delete}&nbsp{trash}</div>',
            'buttons' => [
//                'view' => function ($url, $data) {
//                        return Html::a('<i class="fa fa-eye"></i>', Url::toRoute(['/filemanager/document/view', 'action' => 'filemanager-document-view', 'id' => $data->id]), [
//                            'class' => 'btn btn-success btn-xs',
//                            'title' => Yii::t('yii', 'Lihat Detail'),
//                        ]);
//                    },
                'update' => function ($url, $data) {
                        return Html::a('<i class="fa fa-pencil"></i>', Url::toRoute(["/filemanager/document/update", 'action' => 'filemanager-document-update', 'id' => $data->id]), [
                            'class' => 'select-tooltip btn btn-primary btn-xs',
                             'data-toggle'=>"tooltip",
                            'data-original-title'=>"Perbaharui",
                            'title' => Yii::t('yii', 'Perbaharui'),
                        ]);
                    },
                'delete' => function ($url, $data) {
                        return Html::a('<i class="fa   fa-times"></i>', Url::toRoute(["/filemanager/document/delete", 'action' => 'filemanager-document-delete', 'id' => $data->id]), [
                            'class' => 'select-tooltip btn btn-danger btn-xs',
                            'data-toggle'=>"tooltip",
                            'data-original-title'=>"Hapus",
                            'data-confirm' => 'Apakah Anda yakin ingin menghapus item ini?',
                            'data-method' => 'post',
                            'data-pjax' => 0,
                            'title' => Yii::t('yii', 'Hapus'),
                        ]);
                    },
                'trash' => function ($url, $data) {
                        return Html::a('<i class="fa  fa-trash-o"></i>', Url::toRoute(['/filemanager/document/trash', 'action' => 'filemanager-document-trash', 'id' => $data->id]), [
                            'class' => 'select-tooltip btn btn-warning btn-xs', 
                            'data-toggle'=>"tooltip",
                            'data-original-title'=>"Tong sampah",
                            'data-confirm' => 'Apakah Anda yakin ingin membuang ke tong sampah?',
                            'data-method' => 'post',
                            'data-pjax' => 0,
                            'title' => Yii::t('yii', 'Tong Sampah'),
                        ]);
                    }
            ]
        ],
    ],
]);
?>
<?php

ActiveForm::end();
?>
</div>
</div>


 <?php
//            GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
//            'user_id',
//            'name',
//            'orginal_name:ntext',
//            'unique_name:ntext',
//            'type',
//            'size',
//            'file_type',
//            'description',
//            'create_at',
//            'update_et',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); 
    ?>