<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;

//use app\modules\member\searchs\TribeSerch;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\member\searchs\TribeSerch $searchModel
 */

$this->title = Yii::t('app', 'Suku Bangsa');
$this->registerJs(
    "$('ul.navigation > li.mm-dropdown > ul > li#tribe').parent().parent().addClass('active open');"
    , View::POS_READY);
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?php echo Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?php echo Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard-list']); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute(['/member/tribe/index', 'action' => 'member-tribe-list']); ?>"><?php echo Yii::t('app', Html::encode('Suku Bangsa')); ?></a>
    </li>
</ul>


<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa  fa-flag-o page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Suku Bangsa') ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass} Baru', [
                    'modelClass' => 'Suku Bangsa',
                ]), Url::toRoute(['/member/tribe/create', 'action' => 'member-tribe-create']))
                ?>
            </h1>
        </div>
        <div class="col-xs-4">
            <div class="pull-right">
                <?php $form = ActiveForm::begin([
                    'action' => ["/member/tribe/index", 'action' => 'member-tribe-list'],
                    'method' => 'GET',
                    'options' => ['role' => 'form', 'id' => 'search'],
                    'fieldConfig' => [
                        'template' => "{input}\n{hint}\n{error}"
                    ]
                ]); ?>

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
            'action' => ['/member/tribe/bulk', 'action' => 'member-tribe-bulk']
        ]);
        ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'filterUrl' => ['/member/tribe/index', 'action' => 'member-tribe-list'],
            'pager' => ['maxButtonCount' => 3],
            'tableOptions' => ['class' => 'table'],
            'layout' =>
                Html::beginTag('div', ['class' => 'row'])

                . Html::beginTag('div', ['class' => 'col-xs-6'])
                . Html::beginTag('div', ['class' => 'form-inline'])
                . Html::dropDownList('bulk_action1', null, ['' => 'Tindakan Massal', 'delete' => 'Hapus'], ['class' => 'form-control'])
                . '&nbsp;&nbsp;'
                . Html::submitButton('<i class="fa fa-check"></i> &nbsp;' . Yii::t('app', 'Appley'), ['class' => 'btn btn-primary btn-small'])

                . Html::endTag('div')
                . Html::endTag('div')

                . Html::beginTag('div', ['class' => 'col-xs-6'])

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
                . '{items}'
                . Html::endTag('div')
                . Html::endTag('div')

                . Html::beginTag('div', ['class' => 'row'])
                . Html::beginTag('div', ['class' => 'col-xs-6'])
                . Html::beginTag('div', ['class' => 'form-inline'])
                . Html::dropDownList('bulk_action2', null, ['' => 'Tindakan Massal', 'delete' => 'Hapus'], ['class' => 'form-control'])
                . '&nbsp;&nbsp;'
                . Html::submitButton('<i class="fa fa-check"></i> &nbsp;' . Yii::t('app', 'Appley'), ['class' => 'btn btn-primary btn-small'])
                . Html::endTag('div')
                . Html::endTag('div')

                . Html::beginTag('div', ['class' => 'col-xs-6'])

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
                    'class' => 'yii\grid\CheckboxColumn'
                ],
                [
                    'attribute' => 'name',
                    'label' => 'Nama Suku Bangsa',
                    'format' => 'RAW',
//                    'filter' => TribeSerch::getFilterNames(),
//                    'value' => function ($data) {
//                            $line = '';
//                            if ($data->level == 1) {
//                                return $data->name;
//                            } else {
//                                for ($i = 0; $i < $data->level; $i++) {
//                                    $line .= "&HorizontalLine;";
//                                }
//                                return $line . '&nbsp;' . $data->name;
//                            }
//                        }
                ],
                [
                    'attribute' => 'description',
                    'label' => 'Keterangan',
                ],
//                [
//                    'attribute' => 'parent_id',
//                    'label' => 'Induk',
//                    'filter' => TribeSerch::getFilterParens(),
//                    'value' => function ($data) {
//                            return $data->getParentName();
//                        }
//                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '<div class="text-center">Aksi</div>',
                    'template' => '<div class="text-center">{view}&nbsp;{update}&nbsp{delete}</div>',
                    'buttons' => [
                        'view' => function ($url, $data) {
                                return Html::a('<i class="fa fa-eye"></i>', Url::toRoute(['/member/tribe/view', 'action' => 'member-tribe-view', 'id' => $data->id]), [
                                    'class' => 'btn btn-success btn-xs',
                                    'title' => Yii::t('yii', 'Lihat Detail'),
                                ]);
                            },
                        'update' => function ($url, $data) {
                                return Html::a('<i class="fa fa-pencil"></i>', Url::toRoute(["/member/tribe/update", 'action' => 'member-tribe-update', 'id' => $data->id]), [
                                    'class' => 'btn btn-primary btn-xs',
                                    'title' => Yii::t('yii', 'Memperbarui'),
                                ]);
                            },
                        'delete' => function ($url, $data) {
                                return Html::a('<i class="fa   fa-times"></i>', Url::toRoute(["/member/tribe/delete", 'action' => 'member-tribe-delete', 'id' => $data->id]), [
                                    'class' => 'btn btn-danger btn-xs',
                                    'data-confirm' => 'Apakah Anda yakin ingin menghapus item ini?',
                                    'data-method' => 'post',
                                    'data-pjax' => 0,
                                    'title' => Yii::t('yii', 'Hapus'),
                                ]);
                            },
                    ]
                ],
            ],
        ]);
        ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
