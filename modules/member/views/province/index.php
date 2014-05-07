<?php

use Yii;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\modules\member\models\search\ProvinceSerch;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\member\models\ProvinceSerch $searchModel
 */
$this->title = Yii::t('app', 'Tambah {modelClass} Baru', [
    'modelClass' => 'Daerah',
]);
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?php echo Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?php echo Url::toRoute('/dashboard/dashboard/index'); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute('/member/province/index'); ?>"><?php echo Yii::t('app', Html::encode('Daerah')); ?></a>
    </li>
</ul>

<?php // echo $this->render('_search', ['model' => $searchModel]);    ?>


<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa fa-sitemap page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Daerah') ?>
                <?= Yii::t('app', 'atau'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass} Baru', [
                    'modelClass' => 'Daerah',
                ]), ['create'])
                ?>
            </h1>
        </div>
        <div class="col-xs-4">
            <div class="pull-right">
                <?php $form = ActiveForm::begin([
                    'action' => "/member/province/index",
                    'method' => 'GET',
                    'options' => ['role' => 'form', 'id' => 'search'],
                    'fieldConfig' => [
                        'template' => "{input}\n{hint}\n{error}"
                    ]
                ]); ?>

                <div class="input-group input-group-sm">
                    <?= Html::activeTextInput($searchModel, 'keyword', ['class' => 'form-control', 'placeholder' => 'Cari daerah', 'maxlength' => 255]) ?>
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
            'action' => '/member/province/bulk'
        ]);
        ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'filterUrl' => '/member/province/index',
            'tableOptions' => ['class' => 'table'],
            'layout' =>
                Html::beginTag('div', ['class' => 'row'])

                . Html::beginTag('div', ['class' => 'col-xs-6'])
                . Html::beginTag('div', ['class' => 'form-inline'])
                . Html::dropDownList('bulk_action', null, ['' => 'Tindakan Massal', 'delete' => 'Hapus'], ['class' => 'form-control'])
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
                . Html::dropDownList('bulk_action', null, ['' => 'Tindakan Massal', 'delete' => 'Hapus'], ['class' => 'form-control'])
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
                    'filter' => ProvinceSerch::loadFilterNames()
                ],
                [
                    'attribute' => 'type',
                    'filter' => ['Provinsi' => 'Provinsi', 'Kabupaten' => 'Kabupaten', 'Kota' => 'Kota']
                ],
                [
                    'attribute' => 'parent_id',
                    'filter' => ProvinceSerch::loadFilterParens(),
                    'value' => function ($data) {
                            return $data->getParentName();
                        }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '<div class="text-center">Aksi</div>',
                    'template' => '<div class="text-center">{view}&nbsp;{update}&nbsp{delete}</div>',
                    'buttons' => [
                        'view' => function ($url) {
                                return Html::a('<i class="fa fa-eye"></i>', $url, [
                                    'class' => 'btn btn-success btn-xs',
                                    'title' => Yii::t('yii', 'Lihat Detail'),
                                ]);
                            },
                        'update' => function ($url) {
                                return Html::a('<i class="fa fa-pencil"></i>', $url, [
                                    'class' => 'btn btn-primary btn-xs',
                                    'title' => Yii::t('yii', 'Memperbarui'),
                                ]);
                            },
                        'delete' => function ($url) {
                                return Html::a('<i class="fa  fa-trash-o"></i>', $url, [
                                    'class' => 'btn btn-danger btn-xs',
                                    'data-confirm' => 'Apakah Anda yakin ingin menghapus item ini?',
                                    'data-method' => 'post',
                                    'data-pjax' => 0,
                                    'title' => Yii::t('yii', 'Hapus'),
                                ]);
                            }
                    ]
                ],
            ],
        ]);
        ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>

