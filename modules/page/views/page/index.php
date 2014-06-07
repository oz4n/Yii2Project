<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use app\modules\page\Page;
use app\modules\site\helpers\TextHelper;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\word\searchs\PostSerch $searchModel
 */
$this->title = Yii::t('app', 'Halaman');

$this->registerJs(''
//    . '$("td").css({"padding-top": "20px"});'           
        . '$("td > select").select2({ allowClear: true, placeholder: "Filter item"});'
        . '$("select.select-year").select2({ allowClear: true, placeholder: "Tahun"});'
        . '$("select.opsi").select2({ allowClear: true, placeholder: "Tahun"});'
        . '$("select.save-status").select2({ allowClear: true, placeholder: "Tahun"});'
        . '$("select.action-bulk").select2({ allowClear: true, placeholder: "Tindakan Masal"});'
        . "init.push(function () { $('td#birth-input input').datepicker({language:'id',format: 'dd MM yyyy'});});"
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
        <a href="<?= Url::toRoute(['/page/page/index', 'action' => 'page-list']); ?>"><?= Yii::t('app', Html::encode('Halaman')); ?></a>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa fa-files-o page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Halaman') ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass}', [
                            'modelClass' => 'Halaman',
                        ]), Url::toRoute(['/page/page/create', 'action' => 'page-create']))
                ?>
            </h1>
        </div>
        <div class="col-xs-4">
            <div class="pull-right">
                <?php
                $form = ActiveForm::begin([
                            'action' => ['/page/page/index', 'action' => 'page-list'],
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
                    'action' => ['/page/page/index', 'action' => 'page-list'],
                    'method' => 'get'
        ]);
        ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'filterUrl' => ['/page/page/index', 'action' => 'page-list'],
            'pager' => ['maxButtonCount' => 3],
            'tableOptions' => ['class' => 'table'],
            'layout' => Html::beginTag('div', ['class' => 'row'])
            . Html::beginTag('div', ['class' => 'col-xs-8'])
            . Html::beginTag('div', ['class' => 'form-inline'])
            . Html::dropDownList('bulk_action1', '', ['' => 'Tindakan Massal', 'delete' => 'Hapus', 'trash' => 'Tongsampah'], ['class' => 'form-control action-bulk'])
            . '&nbsp;&nbsp;'
//        . Html::dropDownList('PostSerch[year_filtr1]', '', PostSerch::getYears('Tahun'), ['class' => 'form-control select-year'])
//        . '&nbsp;&nbsp;'
//        . Html::dropDownList('PostSerch[year_opsi]', '', ['and' => 'dan', 's/d' => 's/d'], ['class' => 'form-control opsi'])
//        . '&nbsp;&nbsp;'
//        . Html::dropDownList('PostSerch[year_filtr2]', '', PostSerch::getYears('Tahun'), ['class' => 'form-control select-year'])
//        . '&nbsp;&nbsp;'
            . Html::dropDownList('PostSerch[status_filtr1]', '', ['Status', 'Publish' => 'Publish', 'Draft' => 'Draft', 'Trash' => 'Trash'], ['class' => 'form-control save-status'])
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
//        . Html::dropDownList('PostSerch[year_filtr3]', '', PostSerch::getYears('Tahun'), ['class' => 'form-control select-year'])
//        . '&nbsp;&nbsp;'
//        . Html::dropDownList('PostSerch[year_opsi1]', '', ['and' => 'dan', 's/d' => 's/d'], ['class' => 'form-control opsi'])
//        . '&nbsp;&nbsp;'
//        . Html::dropDownList('PostSerch[year_filtr4]', '', PostSerch::getYears('Tahun'), ['class' => 'form-control select-year'])
//        . '&nbsp;&nbsp;'
            . Html::dropDownList('PostSerch[status_filtr2]', '', ['Status', 'Publish' => 'Publish', 'Draft' => 'Draft', 'Trash' => 'Trash'], ['class' => 'form-control save-status'])
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
                [
                    'class' => 'yii\grid\CheckboxColumn',               
                ],

                [
                    'attribute' => 'title',
                    'label' => 'Judul'
                ],
                [
                    'attribute' => 'content',
                    'label' => 'Isi',
                    'format' => 'raw',
                    'value' => function($data){
                        return TextHelper::word_limiter(strip_tags($data->content), 9);
                    }
                ],
                'layout',
                [
                    'attribute' => 'create_et',
                    'label' => 'Ditambahkan'
                ],
                [
                    'attribute' => 'update_et',
                    'label' => 'Diubah'
                ],
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => function ($data) {
                switch ($data->status) {
                    case 'Publish':
                        return Html::tag('span', Html::tag('i', null, ['class' => 'fa  fa-check-circle-o']) . '&nbsp&nbsp' . $data->status, ['style' => 'width:120px', 'class' => 'badge badge-success']);
                        break;
                    case 'Draft':
                        return Html::tag('span', Html::tag('i', null, ['class' => 'fa fa-bookmark-o']) . '&nbsp&nbsp' . $data->status, ['style' => 'width: 120px', 'class' => 'badge badge-info']);
                        break;
                    case 'Trash':
                        return Html::tag('span', Html::tag('i', null, ['class' => 'fa fa-trash-o']) . '&nbsp&nbsp' . $data->status, ['style' => 'width: 120px', 'class' => 'badge badge-danger']);
                        break;
                    case null;
                        break;
                }
            },
                    'filter' => [
                        'Publish' => 'Publish',
                        'Draft' => 'Draft',
                        'Trash' => 'Trash'
                    ]
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '<div class="text-center" style="width: 80px">Aksi</div>',
                    'template' => '{update}&nbsp{delete}&nbsp{trash}',
                    'buttons' => [
                        'update' => function ($url, $data) {
                    if ($data->type === Page::POST_TYPE_PAGE_HELPER) {
                        return Html::a('<i class="fa fa-pencil"></i>', Url::toRoute(["/page/page/update", 'action' => 'page-update', 'id' => $data->id]), [
                                    'class' => 'select-tooltip btn btn-primary btn-xs',
                                    'data-toggle' => "tooltip",
                                    'data-original-title' => "Perbaharui",
                                    'style'=>'width:81px',
                                    'title' => Yii::t('yii', 'Perbaharui'),
                        ]);
                    } else {
                        return Html::a('<i class="fa fa-pencil"></i>', Url::toRoute(["/page/page/update", 'action' => 'page-update', 'id' => $data->id]), [
                                    'class' => 'select-tooltip btn btn-primary btn-xs',
                                    'data-toggle' => "tooltip",
                                    'data-original-title' => "Perbaharui",
                                    'title' => Yii::t('yii', 'Perbaharui'),
                        ]);
                    }
                },
                        'delete' => function ($url, $data) {
                    if ($data->type !== Page::POST_TYPE_PAGE_HELPER) {
                        return Html::a('<i class="fa   fa-times"></i>', Url::toRoute(["/page/page/delete", 'action' => 'page-delete', 'id' => $data->id]), [
                                    'class' => 'select-tooltip btn btn-danger btn-xs',
                                    'data-toggle' => "tooltip",
                                    'data-original-title' => "Hapus",
                                    'data-confirm' => 'Apakah Anda yakin ingin menghapus item ini?',
                                    'data-method' => 'post',
                                    'data-pjax' => 0,
                                    'title' => Yii::t('yii', 'Hapus'),
                        ]);
                    }
                },
                        'trash' => function ($url, $data) {
                    if ($data->type !== Page::POST_TYPE_PAGE_HELPER) {
                        return Html::a('<i class="fa  fa-trash-o"></i>', Url::toRoute(['/page/page/trash', 'action' => 'page-trash', 'id' => $data->id]), [
                                    'class' => 'select-tooltip btn btn-warning btn-xs',
                                    'data-toggle' => "tooltip",
                                    'data-original-title' => "Tong sampah",
                                    'data-confirm' => 'Apakah Anda yakin ingin membuang ke tong sampah?',
                                    'data-method' => 'post',
                                    'data-pjax' => 0,
                                    'title' => Yii::t('yii', 'Tong Sampah'),
                        ]);
                    }
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


