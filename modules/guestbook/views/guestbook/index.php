<?php

use Yii;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use cebe\gravatar\Gravatar;
use yii\web\View;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\guestbook\searchs\GuestbookSerch $searchModel
 */
$this->title = Yii::t('app', 'Guestbooks');
$this->registerJs(''
    . '$("td").css({"padding-top": "20px"});'   
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
        <a href="<?= Url::toRoute(['/guestbook/guestbook/index', 'action' => 'guestbook-list']); ?>"><?= Yii::t('app', Html::encode('Buku Tamu')); ?></a>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa  fa-comments-o page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Buku Tamu') ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass}', [
                            'modelClass' => 'Buku Tamu',
                        ]), Url::toRoute(['/guestbook/guestbook/create', 'action' => 'guestbook-create']))
                ?>
            </h1>
        </div>
        <div class="col-xs-4">
            <div class="pull-right">
                <?php
                $form = ActiveForm::begin([
                            'action' => ['/guestbook/guestbook/index', 'action' => 'guestbook-list'],
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
                    'action' => ['/guestbook/guestbook/index', 'action' => 'guestbook-list'],
                    'method' => 'get'
        ]);
        ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'filterUrl' => ['/guestbook/guestbook/index', 'action' => 'guestbook-list'],
            'pager' => ['maxButtonCount' => 3],
            'tableOptions' => ['class' => 'table'],
            'layout' => Html::beginTag('div', ['class' => 'row'])
            . Html::beginTag('div', ['class' => 'col-xs-8'])
            . Html::beginTag('div', ['class' => 'form-inline'])
            . Html::dropDownList('bulk_action1', '', ['' => 'Tindakan Massal', 'delete' => 'Hapus', 'trash' => 'Tongsampah'], ['class' => 'form-control action-bulk'])
            . '&nbsp;&nbsp;'
            . Html::dropDownList('Buku TamuSerch[status_filtr1]', '', ['Status', 'Publish' => 'Publish', 'Draft' => 'Draft', 'Trash' => 'Trash'], ['class' => 'form-control save-status'])
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
            . Html::dropDownList('Buku TamuSerch[status_filtr2]', '', ['Status', 'Publish' => 'Publish', 'Draft' => 'Draft', 'Trash' => 'Trash'], ['class' => 'form-control save-status'])
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
                [
                    'label' => '',
                    'format' => 'RAW',
                    'value' => function($data){
                         
                        return  Html::beginTag('div', ['class' => 'member','style'=>'margin-top: -10px']). Gravatar::widget([
                                            'email' => $data->email,
                                            'size' => 42,
                                            'defaultImage' => 'mm',
                                            'options' => [
                                                'class' => 'member-avatar'
                                            ]
                                ]).Html::endTag('div');                        
                            }                            
                ],
                [
                    'attribute' => 'name',
                    'label' => 'Nama'
                ],
                'email:email',
                [
                    'attribute' => 'subject',
                    'label' => 'Subjek'
                ],
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
                    case 'Unconfirmed':
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
                    'header' => '<div class="text-center" style="width: 120px">Aksi</div>',
                    'template' => '<div class="text-center">{update}&nbsp{delete}&nbsp{trash}</div>',
                    'buttons' => [
//                'view' => function ($url, $data) {
//                        return Html::a('<i class="fa fa-eye"></i>', Url::toRoute(['/guestbook/guestbook/view', 'action' => 'guestbook-view', 'id' => $data->id]), [
//                            'class' => 'btn btn-success btn-xs',
//                            'title' => Yii::t('yii', 'Lihat Detail'),
//                        ]);
//                    },
                        'update' => function ($url, $data) {
                    return Html::a('<i class="fa fa-pencil"></i>', Url::toRoute(["/guestbook/guestbook/update", 'action' => 'guestbook-update', 'id' => $data->id]), [
                                'class' => 'select-tooltip btn btn-primary btn-xs',
                                'data-toggle' => "tooltip",
                                'data-original-title' => "Perbaharui",
                                'title' => Yii::t('yii', 'Perbaharui'),
                    ]);
                },
                        'delete' => function ($url, $data) {
                    return Html::a('<i class="fa   fa-times"></i>', Url::toRoute(["/guestbook/guestbook/delete", 'action' => 'guestbook-delete', 'id' => $data->id]), [
                                'class' => 'select-tooltip btn btn-danger btn-xs',
                                'data-toggle' => "tooltip",
                                'data-original-title' => "Hapus",
                                'data-confirm' => 'Apakah Anda yakin ingin menghapus item ini?',
                                'data-method' => 'post',
                                'data-pjax' => 0,
                                'title' => Yii::t('yii', 'Hapus'),
                    ]);
                },
                        'trash' => function ($url, $data) {
                    return Html::a('<i class="fa  fa-trash-o"></i>', Url::toRoute(['/guestbook/guestbook/trash', 'action' => 'guestbook-trash', 'id' => $data->id]), [
                                'class' => 'select-tooltip btn btn-warning btn-xs',
                                'data-toggle' => "tooltip",
                                'data-original-title' => "Tong sampah",
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
//            'parent_id',
//            'name',
//            'email:email',
//            // 'web_site',
//            // 'subject',
//            // 'content',
//            // 'create_at',
//            // 'update_et',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); 
        ?>