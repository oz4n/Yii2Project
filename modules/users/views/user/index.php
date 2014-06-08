<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use cebe\gravatar\Gravatar;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var dektrium\user\models\UserSearch $searchModel
 */

$this->title = Yii::t('user', 'Manage users');
$this->registerJs(''
    . '$("td").css({"padding-top": "20px"});'
    , View::POS_READY);
$this->registerJs(
    "$('ul.navigation > li#user > ul.mm-dropdown > li#account').addClass('active').parent().addClass('open').parent().addClass('active open');"
    , View::POS_READY);
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?= Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?= Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard-list']); ?>"><?= Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li class="active">
        Akun
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa fa-user page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Akun') ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass}', [
                    'modelClass' => 'Akun',
                ]), Url::toRoute(['/user/admin/create', 'action' => 'user-create']))
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

<?php if (Yii::$app->getSession()->hasFlash('admin_user')): ?>
    <div class="alert alert-success">
        <p><?= Yii::$app->getSession()->getFlash('admin_user') ?></p>
    </div>
<?php endif; ?>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
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
            'label' => '',
            'format' => 'raw',
            'value' => function ($model) {
                    return  Html::beginTag('div', ['class' => 'member','style'=>'margin-top: -10px']). Gravatar::widget([
                        'email' => $model->email,
                        'size' => 42,
                        'defaultImage' => 'mm',
                        'options' => [
                            'class' => 'member-avatar'
                        ]
                    ]).Html::endTag('div');
                }
        ],
        'username',
        'email:email',
        [
            'attribute' =>  'role',
            'label' => 'Hak Akses',
        ],
        [
            'attribute' => 'registered_from',
            'label' => 'IP Registrasi',
            'value' => function ($model, $index, $widget) {
                    return $model->registered_from == null ? '<span class="not-set">' . Yii::t('user', '(not set)') . '</span>' : long2ip($model->registered_from);
                },
            'format' => 'html',
        ],
        [
            'label' => 'Waktu Registrasi',
            'attribute' => 'created_at',
            'value' => function ($model, $index, $widget) {
                    return Yii::t('user', '{0, date, MMMM dd, YYYY HH:mm}', [$model->created_at]);
                }
        ],
        [
            'header' => Yii::t('user', 'Confirmation'),
            'value' => function ($model, $index, $widget) {
                    if ($model->isConfirmed) {
                        return '<div class="text-center"><span class="text-success">' . Yii::t('user', 'Confirmed') . '</span></div>';
                    } else {
                        return Html::a(Yii::t('user', 'Confirm'), ['confirm', 'id' => $model->id], [
                            'class' => 'btn btn-xs btn-success btn-block',
                            'data-method' => 'post',
                            'data-confirm' => Yii::t('user', 'Are you sure to confirm this user?'),
                        ]);
                    }
                },
            'format' => 'raw',
            'visible' => Yii::$app->getModule('user')->confirmable
        ],
        [
            'header' => Yii::t('user', 'Block status'),
            'value' => function ($model, $index, $widget) {
                    if ($model->isBlocked) {
                        return Html::a(Yii::t('user', 'Unblock'), ['block', 'id' => $model->id], [
                            'class' => 'btn btn-xs btn-success btn-block',
                            'data-method' => 'post',
                            'data-confirm' => Yii::t('user', 'Are you sure to unblock this user?')
                        ]);
                    } else {
                        return Html::a(Yii::t('user', 'Block'), ['block', 'id' => $model->id], [
                            'class' => 'btn btn-xs btn-danger btn-block',
                            'data-method' => 'post',
                            'data-confirm' => Yii::t('user', 'Are you sure to block this user?')
                        ]);
                    }
                },
            'format' => 'raw',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'buttons' => [
                'update' => function ($url, $model) {
                        return Html::a('<i class="glyphicon glyphicon-wrench"></i>', $url, [
                            'class' => 'btn btn-xs btn-info',
                            'title' => Yii::t('yii', 'Update'),
                        ]);
                    },
                'delete' => function ($url, $model) {
                        return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, [
                            'class' => 'btn btn-xs btn-danger',
                            'data-method' => 'post',
                            'data-confirm' => Yii::t('user', 'Are you sure to delete this user?'),
                            'title' => Yii::t('yii', 'Delete'),
                        ]);
                    },
            ]
        ],
    ],
]);
?>
