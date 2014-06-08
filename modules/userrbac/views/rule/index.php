<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\web\View;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\userrbac\search\RuleSerch $searchModel
 */
$this->registerJs(
    "$('ul.navigation > li#user > ul.mm-dropdown > li#rule-account').addClass('active').parent().addClass('open').parent().addClass('active open');"
    , View::POS_READY);
$this->title = Yii::t('app', 'Auth Items');
?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class'=>'table'],
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
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'rule_name',
            'type',
            'description:ntext',
            'data:ntext',
            // 'created_at',
            // 'updated_at',

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

