<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use app\modules\word\searchs\CategorySerch;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\word\searchs\CategorySerch $searchModel
 */

$this->title = Yii::t('app', 'Kategori');
$this->registerJs(
    "$('ul.navigation > li.mm-dropdown > ul > li#category').parent().parent().addClass('active open');"
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
        <a href="<?= Url::toRoute(['/word/post/index', 'action' => 'word-post-list']); ?>"><?= Yii::t('app', Html::encode('Post')); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute(['/word/category/index', 'action' => 'word-category-list']); ?>"><?php echo Yii::t('app', Html::encode('Kategori')); ?></a>
    </li>
</ul>


<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa  fa-sitemap page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Kategori') ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass} Baru', [
                    'modelClass' => 'Kategori',
                ]), Url::toRoute(['/word/category/create', 'action' => 'word-category-create']))
                ?>
            </h1>
        </div>
        <div class="col-xs-4">
            <div class="pull-right">
                <?php $form = ActiveForm::begin([
                    'action' => ["/word/category/index", 'action' => 'word-category-list'],
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
            'action' => ['/word/category/bulk', 'action' => 'word-category-bulk']
        ]);
        ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'filterUrl' => ['/word/category/index', 'action' => 'word-category-list'],
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
                    'label' => 'Nama Kategori',
                    'format' => 'RAW',
                    'filter' => CategorySerch::getFilterNames(),
                    'value' => function ($data) {
                            $line = '';
                            if ($data->level == 1) {
                                return $data->name;
                                return $data->name;
                            } else {
                                for ($i = 0; $i < $data->level; $i++) {
                                    $line .= "&HorizontalLine;";
                                }
                                return $line . '&nbsp;' . $data->name;
                            }
                        }
                ],
//                [
//                    'attribute' => 'parent_id',
//                    'label' => 'Induk',
//                    'filter' => CategorySerch::getFilterParens(),
//                    'value' => function ($data) {
//                            return $data->getParentName();
//                        }
//                ],
                [
                    'attribute' => 'description',
                    'label' => 'Keterangan',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '<div class="text-center">Aksi</div>',
                    'template' => '<div class="text-center">{view}&nbsp;{update}&nbsp{delete}</div>',
                    'buttons' => [
                        'view' => function ($url, $data) {
                                return Html::a('<i class="fa fa-eye"></i>', Url::toRoute(['/word/category/view', 'action' => 'word-category-view', 'id' => $data->id]), [
                                    'class' => 'select-tooltip btn btn-success btn-xs',
                                    'data-toggle' => "tooltip",
                                    'data-original-title' => "Lihat Detail",
                                    'title' => Yii::t('yii', 'Lihat Detail'),
                                ]);
                            },
                        'update' => function ($url, $data) {
                                return Html::a('<i class="fa fa-pencil"></i>', Url::toRoute(["/word/category/update", 'action' => 'word-category-update', 'id' => $data->id]), [
                                    'class' => 'select-tooltip btn btn-primary btn-xs',
                                    'data-toggle' => "select-tooltip tooltip",
                                    'data-original-title' => "Perbaharui",
                                    'title' => Yii::t('yii', 'Perbaharui'),
                                ]);
                            },
                        'delete' => function ($url, $data) {
                                return Html::a('<i class="fa   fa-times"></i>', Url::toRoute(["/word/category/delete", 'action' => 'word-category-delete', 'id' => $data->id]), [
                                    'class' => 'select-tooltip btn btn-danger btn-xs',
                                    'data-toggle' => "tooltip",
                                    'data-original-title' => "Hapus",
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
