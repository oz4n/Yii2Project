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
$this->title = Yii::t('user', 'Akun');
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
                            'action' => ['/user/admin/index', 'action' => 'user-list'],
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
<?php
ActiveForm::begin([
    'action' => ['/user/admin/bulk', 'action' => 'user-bulk'],
]);
?>

<?php
echo GridView::widget([
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
            'label' => '',
            'format' => 'raw',
            'value' => function ($model) {
        return Html::beginTag('div', ['class' => 'member', 'style' => 'margin-top: -10px']) . Gravatar::widget([
                    'email' => $model->email,
                    'size' => 42,
                    'defaultImage' => 'mm',
                    'options' => [
                       'class' => 'img-circle',
                        'alt' => $model->username
                    ]
                ]) . Html::endTag('div');
    }
        ],
        'username',
        'email:email',
        [
            'attribute' => 'role',
            'label' => 'Hak Akses',
        ],
        [
            'header' => Yii::t('user', 'Konfirmasi'),
            'value' => function ($model, $index, $widget) {
        if ($model->isConfirmed) {
            return '<div class="text-center"><span class="text-success">' . Yii::t('user', 'Terkonfirmasi') . '</span></div>';
        } else {
            return Html::a(Yii::t('user', 'Konfirmasi'), ['confirm', 'id' => $model->id], [
                        'class' => 'btn btn-xs btn-success btn-block',
                        'data-method' => 'post',
                        'data-confirm' => Yii::t('user', 'Apakah anda ingin mengkonfirmasi akun ini?'),
            ]);
        }
    },
            'format' => 'raw',
            'visible' => Yii::$app->getModule('user')->confirmable
        ],
        [
            'header' => Yii::t('user', 'Status'),
            'value' => function ($model, $index, $widget) {
        if ($model->isBlocked) {
            return Html::a(Yii::t('user', 'Non Aktif'), ['/user/admin/block', 'action' => 'user-unblock', 'id' => $model->id], [
                        'class' => 'btn btn-xs btn-danger btn-block',
                        'data-method' => 'post',
                        'data-confirm' => Yii::t('user', 'Apaka anda ingin mengaktifkan akun ini?')
            ]);
        } else {
            return Html::a(Yii::t('user', 'Aktif'), ['/user/admin/block', 'action' => 'user-block', 'id' => $model->id], [
                        'class' => 'btn btn-xs  btn-success btn-block',
                        'data-method' => 'post',
                        'data-confirm' => Yii::t('user', 'Apaakah anda ingin menonaktifkan Akun ini?')
            ]);
        }
    },
            'format' => 'raw',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => '<div class="text-center" style="width: 80px">Aksi</div>',
            'template' => '{update}&nbsp{delete}',
            'buttons' => [
                'update' => function ($url, $data) {
            return Html::a('<i class="fa fa-pencil"></i>', Url::toRoute(["/user/admin/update", 'action' => 'user-update', 'id' => $data->id]), [
                        'class' => 'select-tooltip btn btn-primary btn-xs',
                        'data-toggle' => "tooltip",
                        'data-original-title' => "Perbaharui",
                        'title' => Yii::t('yii', 'Perbaharui'),
            ]);
        },
                'delete' => function ($url, $data) {
            return Html::a('<i class="fa   fa-times"></i>', Url::toRoute(["/user/admin/delete", 'action' => 'user-delete', 'id' => $data->id]), [
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