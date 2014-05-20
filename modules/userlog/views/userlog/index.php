<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\userlog\searchs\UserLogSerch $searchModel
 */

$this->title = Yii::t('app', 'Log Akun');

$this->registerJs(
    "$('ul.navigation > li#user > ul.mm-dropdown > li#log-account').addClass('active').parent().addClass('open').parent().addClass('active open');"
    , View::POS_READY);
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?php echo Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?php echo Url::toRoute(['/dashboard/dashboard/index','action' => 'dashboard']); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute(['/userlog/userlog/index', 'action' => 'user-log-list']); ?>"><?php echo Yii::t('app', Html::encode('Log Akun')); ?></a>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa fa-bookmark-o page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Log Akun') ?>
            </h1>
        </div>
        <div class="col-xs-4">
            <div class="pull-right">
                <?php
                $form = ActiveForm::begin([
                    'action' => ['/userlog/userlog/index', 'action' => 'user-log-list'],
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
            'action' => ['/userlog/userlog/index', 'action' => 'user-log-list'],
            'method' => 'get'
        ]);
        ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'filterUrl' => ['/userlog/userlog/index', 'action' => 'user-log-list'],
            'pager' => ['maxButtonCount' => 3],
            'tableOptions' => ['class' => 'table'],
            'layout' => Html::beginTag('div', ['class' => 'row'])

                . Html::beginTag('div', ['class' => 'col-xs-6'])
                . Html::beginTag('div', ['class' => 'form-inline'])
                . Html::dropDownList('bulk_action1', '', ['' => 'Tindakan Massal', 'delete' => 'Hapus'], ['class' => 'form-control action-bulk'])
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
                . Html::beginTag('div', ['class' => 'table-responsive'])
                . '{items}'
                . Html::endTag('div')
                . Html::endTag('div')
                . Html::endTag('div')

                . Html::beginTag('div', ['class' => 'row'])
                . Html::beginTag('div', ['class' => 'col-xs-6'])
                . Html::beginTag('div', ['class' => 'form-inline'])
                . Html::dropDownList('bulk_action2', '', ['' => 'Tindakan Massal', 'delete' => 'Hapus'], ['class' => 'form-control action-bulk'])
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
                    'label' => 'Nama Pengguna',
                    'attribute' => 'user_id',
                    'value' => function ($data) {
                            return $data->getUserNameByID();
                        }
                ],

                [
                    'label' => 'Keterangan',
                    'attribute' => 'title',
                ],
                [
                    'label' => 'Remot IP',
                    'attribute' => 'user_ip',
                ],
                [
                    'label' => 'Kode Negara',
                    'attribute' => 'country_code',
                ],
                [
                    'label' => 'Nama Negara',
                    'attribute' => 'contry',
                ],
                [
                    'label' => 'Wilayah',
                    'attribute' => 'region',
                ],
                [
                    'label' => 'Kota',
                    'attribute' => 'city',
                ],
                [
                    'label' => 'Kode Post',
                    'attribute' => 'zip_code',
                ],
                [
                    'label' => 'Sistem Oprasi',
                    'attribute' => 'platform',
                ],
                [
                    'label' => 'Nama Browser',
                    'attribute' => 'browser',
                ],
                [
                    'label' => 'Versi Browser',
                    'attribute' => 'browser_version',
                ],
                [
                    'label' => 'Metode Aksi',
                    'attribute' => 'action_method',
                    'filter' => ['POST' => 'POST', 'GET' => 'GET']
                ],
                'user_agent:ntext',
                'latitude',
                'longitude',
                [
                    'label' => 'Zona Waktu',
                    'attribute' =>  'time_zone',
                ],
                [
                    'label' => 'Tercatat',
                    'attribute' => 'create_at',
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '<div class="text-center">Aksi</div>',
                    'template' => '<div class="text-center">{view}&nbsp;{delete}</div>',
                    'buttons' => [
                        'view' => function ($url, $data) {
                                return Html::a('<i class="fa fa-eye"></i>', Url::toRoute(['/userlog/userlog/view', 'action' => 'user-log-view', 'id' => $data->id]), [
                                    'class' => 'btn btn-success btn-xs',
                                    'title' => Yii::t('yii', 'Lihat Detail'),
                                ]);
                            },
                        'delete' => function ($url, $data) {
                                return Html::a('<i class="fa   fa-times"></i>', Url::toRoute(["/userlog/userlog/delete", 'action' => 'user-log-delete', 'id' => $data->id]), [
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
        <?php  ActiveForm::end(); ?>
    </div>
</div>