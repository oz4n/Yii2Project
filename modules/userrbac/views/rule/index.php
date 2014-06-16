<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\userrbac\search\RuleSerch $searchModel
 */
$this->registerJs(
        "$('ul.navigation > li#user > ul.mm-dropdown > li#rule-account').addClass('active').parent().addClass('open').parent().addClass('active open');"
        , View::POS_READY);
$this->title = Yii::t('app', 'Hak Akses');
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?php echo Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?php echo Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard-list']); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute(['/user/admin/index', 'action' => 'user-list']); ?>"><?php echo Yii::t('app', Html::encode('Pengguna')); ?></a>
    </li>
    <li class="active">
        <?php echo Yii::t('app', Html::encode($this->title)); ?>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm">
            <i class="fa  fa-barcode page-header-icon"> </i>
            &nbsp;
            <?= Html::encode('Hak Akses') ?>
            <?= Yii::t('app', '/'); ?>
            <?=
            Html::a(Yii::t('app', 'Tambah {modelClass}', [
                        'modelClass' => 'Hak Akses',
                    ]), Url::toRoute(['/userrbac/rule/create', 'action' => 'user-rule-create']))
            ?>
        </h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <div class="visible-xs clearfix form-group-margin"></div>
                <?php
                $form = ActiveForm::begin([
                            'action' => ['/userrbac/rule/index', 'action' => 'user-rule-list'],
                            'method' => 'GET',
                            'options' => [
                                'class' => ' pull-right col-xs-12 col-sm-6',
                                'role' => 'form',
                                'id' => 'search'
                            ],
                            'fieldConfig' => [
                                'template' => "{input}\n{hint}\n{error}"
                            ]
                ]);
                ?>

                <div class="input-group no-margin">

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
                    'action' => ['/userrbac/rule/bulk', 'action' => 'user-rule-bulk'],
        ]);
        ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table'],
            'layout' => Html::beginTag('div', ['class' => 'row'])
            . Html::beginTag('div', ['class' => 'col-xs-8'])
            . Html::beginTag('div', ['class' => 'form-inline'])
            . Html::dropDownList('bulk_action1', '', ['' => 'Tindakan Massal', 'delete' => 'Hapus'], ['class' => 'form-control action-bulk'])
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
            . Html::dropDownList('bulk_action2', '', ['' => 'Tindakan Massal', 'delete' => 'Hapus'], ['class' => 'form-control action-bulk'])
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
                    'class' => 'yii\grid\CheckboxColumn'
                ],
                [
                    'label' => 'Nama Hak Akses',
                    'value' => function($data) {
                return $data->description;
            }
                ],
                [
                    'label' => 'Ditambahkan',
                    'value' => function($data) {
                return date('F d, Y', $data->created_at);
            }
                ],
                [
                    'label' => 'Diubah',
                    'value' => function($data) {
                return date('F d, Y', $data->updated_at);
            }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '<div class="text-center" style="width: 80px">Aksi</div>',
                    'template' => '{update}&nbsp{delete}&nbsp{trash}',
                    'buttons' => [
                        'update' => function ($url, $data) {
                    return Html::a('<i class="fa fa-pencil"></i>', Url::toRoute(["/userrbac/rule/update", 'action' => 'user-rule-update', 'id' => $data->name]), [
                                'class' => 'select-tooltip btn btn-primary btn-xs',
                                'data-toggle' => "tooltip",
                                'data-original-title' => "Perbaharui",
                                'title' => Yii::t('yii', 'Perbaharui'),
                    ]);
                },
                        'delete' => function ($url, $data) {
                    return Html::a('<i class="fa   fa-times"></i>', Url::toRoute(["/userrbac/rule/delete", 'action' => 'user-rule-delete', 'id' => $data->name]), [
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


