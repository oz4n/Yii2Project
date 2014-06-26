<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use app\modules\member\searchs\CapasSerch;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\member\searchs\CapasSerch $searchModel
 * @var app\modules\dao\ar\Member $data
 */
$this->title = Yii::t('app', 'Anggota');

$this->registerJs(
        '$("td").css({"padding-top": "20px"});'
        . "$('ul.navigation > li#database > ul.mm-dropdown > li#member > ul.mm-dropdown > li#capas').addClass('active').parent().parent().addClass('open').parent().parent().addClass('active open');"
        . '$("td > select").select2({ allowClear: true, placeholder: "Filter item"});'
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
        <a href="<?= Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard-list']); ?>"><?= Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?= Url::toRoute(['/member/capas/index', 'action' => 'member-capas-list']); ?>"><?= Yii::t('app', Html::encode('Anggota Capas')); ?></a>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa fa-users page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Anggota Capas') ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass}', [
                            'modelClass' => 'Anggota Capas',
                        ]), Url::toRoute(['/member/capas/create', 'action' => 'member-capas-create']))
                ?>
            </h1>
            
<?=
\yii\bootstrap\ButtonDropdown::widget([
      'label' => 'Action',
      'options' => ['class'=>'btn btn-info dropdown-toggle','data-toggle'=>'dropdown'],
      'dropdown' => [
          'items' => [
              ['label' => 'DropdownA', 'url' => '/'],
              ['label' => 'DropdownB', 'url' => '#'],
          ],
      ],
  ]);
?>
            
        </div>
        <div class="col-xs-4">
            <div class="pull-right">
                <?php
                $form = ActiveForm::begin([
                            'action' => ['/member/capas/index', 'action' => 'member-capas-list'],
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
                    'action' => ['/member/capas/index', 'action' => 'member-capas-list'],
                    'method' => 'get'
        ]);
        ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'filterUrl' => ['/member/capas/index', 'action' => 'member-capas-list'],
            'pager' => ['maxButtonCount' => 3],
            'tableOptions' => ['class' => 'table'],
            'layout' => Html::beginTag('div', ['class' => 'row'])
            . Html::beginTag('div', ['class' => 'col-xs-8'])
            . Html::beginTag('div', ['class' => 'form-inline'])
            . Html::dropDownList('bulk_action1', '', ['' => 'Tindakan Massal', 'delete' => 'Hapus', 'trash' => 'Tongsampah'], ['class' => 'form-control action-bulk'])
            . '&nbsp;&nbsp;'
//        . Html::dropDownList('CapasSerch[year_filtr1]', '', CapasSerch::getYears('Tahun'), ['class' => 'form-control select-year'])
//        . '&nbsp;&nbsp;'
//        . Html::dropDownList('CapasSerch[year_opsi]', '', ['and' => 'dan', 's/d' => 's/d'], ['class' => 'form-control opsi'])
//        . '&nbsp;&nbsp;'
//        . Html::dropDownList('CapasSerch[year_filtr2]', '', CapasSerch::getYears('Tahun'), ['class' => 'form-control select-year'])
//        . '&nbsp;&nbsp;'
            . Html::dropDownList('CapasSerch[status_filtr1]', '', ['Status', 'Publish' => 'Publish', 'Draft' => 'Draft', 'Trash' => 'Trash', 'Pending' => 'Pending'], ['class' => 'form-control save-status'])
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
//        . Html::dropDownList('CapasSerch[year_filtr3]', '', CapasSerch::getYears('Tahun'), ['class' => 'form-control select-year'])
//        . '&nbsp;&nbsp;'
//        . Html::dropDownList('CapasSerch[year_opsi1]', '', ['and' => 'dan', 's/d' => 's/d'], ['class' => 'form-control opsi'])
//        . '&nbsp;&nbsp;'
//        . Html::dropDownList('CapasSerch[year_filtr4]', '', CapasSerch::getYears('Tahun'), ['class' => 'form-control select-year'])
//        . '&nbsp;&nbsp;'
            . Html::dropDownList('CapasSerch[status_filtr2]', '', ['Status', 'Publish' => 'Publish', 'Draft' => 'Draft', 'Trash' => 'Trash', 'Pending' => 'Pending'], ['class' => 'form-control save-status'])
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
                    'attribute' => 'front_photo',
                    'label' => '',
                    'format' => 'raw',
                    'value' => function ($data) {
                if ($data->front_photo == null) {
                    return Html::tag('div', Html::img(Yii::getAlias('@web') . "/resources/images/default/user50x50.png", ['class' => 'img-circle']), ['class' => 'member', 'style' => "margin-top: -10px"]);
                } else {
                    return Html::tag('div', Html::img(Yii::getAlias('@web') . "/resources/images/member/frontphoto/42x42/" . $data->front_photo, ['style' => 'width:42px', 'class' => 'img-circle']), ['class' => 'member', 'style' => "margin-top: -10px"]);
                }
            }
                ],
                'name',
                'nickname',
                'nra',
                [
                    'attribute' => 'birth',
                    'filterOptions' => ['id' => 'birth-input']
                ],
                'identity_card_number',
                'age',
                'address',
                [
                    'attribute' => 'gender',
                    'filterOptions' => ['id' => 'select-gender'],
                    'filter' => [
                        'Laki-Laki' => 'Laki-Laki',
                        'Perempuan' => 'Perempuan'
                    ]
                ],
                [
                    'attribute' => 'religion',
                    'filterOptions' => ['id' => 'select-religion'],
                    'filter' => [
                        'Islam' => 'Islam',
                        'Katholik' => 'Katholik',
                        'Protestan' => 'Protestan',
                        'Hindu' => 'Hindu',
                        'Budha' => 'Budha',
                        'Konghucu' => 'Konghucu'
                    ]
                ],
                'nationality',
                [
                    'attribute' => 'taxonomy_id',
                    'value' => function ($data) {
                return $data->getAreaName();
            }
                ],
                'tribal_members',
                [
                    'attribute' => 'school_id',
                    'value' => function ($data) {
                return $data->getSchollName();
            }
                ],
                'zip_code',
                [
                    'attribute' => 'blood_group',
                    'filter' => [
                        'Golongan Darah O' => 'Golongan Darah O',
                        'Golongan Darah A' => 'Golongan Darah A',
                        'Golongan Darah B' => 'Golongan Darah B',
                        'Golongan Darah AB' => 'Golongan Darah AB'
                    ]
                ],
//        [
//            'attribute' => 'brevetaward',
//            'label' => 'Brevet Penghargaan',
//        ],
                'organizational_experience',
                'illness',
                'height_body',
                'weight_body',
                [
                    'attribute' => 'dress_size',
                    'filter' => [
                        'S' => 'S',
                        'M' => 'M',
                        'L' => 'L',
                        'XS' => 'XS',
                        'XL' => 'XL',
                        'XXL' => 'XXL',
                        'XXXL' => 'XXXL'
                    ]
                ],
                'pants_size',
                'shoe_size',
                'hat_size',
//        'membership_status',
//                'status_organization',
//        [
//            'attribute' => 'year',
//            'filter' => CapasSerch::getYears()
//        ],
                'educational_status',
                [
                    'attribute' => 'marital_status',
                    'filter' => [
                        'Belum Menikah' => 'Belum Menikah',
                        'Menikah' => 'Menikah',
                        'Janda' => 'Janda',
                        'Duda' => 'Duda'
                    ]
                ],
                [
                    'attribute' => 'job',
                    'filter' => [
                        'PNS' => 'PNS',
                        'TNI/PORLI' => 'TNI/PORLI',
                        'Karyawan Swasta' => 'Karyawan Swasta',
                        'Pelajar/Mahasiswa' => 'Pelajar/Mahasiswa',
                        'Guru/Dosen' => 'Guru/Dosen',
                        'Wiraswasta' => 'Wiraswasta',
                        'Ibu Rumah Tangga' => 'Ibu Rumah Tangga'
                    ]
                ],
                'email',
                'phone_number',
                'other_phone_number',
                'relationship_phone_number',
                'father_name',
                'mother_name',
                'father_work',
                'mother_work',
                'income_father',
                'income_mothers',
                'number_of_brothers',
                'number_of_sisters',
                'number_of_children',
                /** pause */
//        'identity_card',
//        'certificate_of_organization:ntext',
//        'names_recommended',
                'note',
                [
                    'attribute' => 'languageskill',
                    'label' => 'Keterampilan Bahasa',
                ],
                [
                    'attribute' => 'lifeskill',
                    'label' => 'Keterampilan Personal'
                ],
                [
                    'attribute' => 'create_et',
                    'label' => 'Terdaftar'
                ],
                [
                    'attribute' => 'update_et',
                    'label' => 'Di Ubah'
                ],
                [
                    'attribute' => 'save_status',
                    'format' => 'raw',
                    'value' => function ($data) {
                switch ($data->save_status) {
                    case 'Publish':
                        return Html::a(Html::tag('span', Html::tag('i', null, ['class' => 'fa  fa-check-circle-o']) . '&nbsp&nbsp' . $data->save_status, ['style' => 'width:120px', 'class' => 'badge badge-success']), ['/member/capas/draft', 'action' => 'member-capas-draft', 'id' => $data->id], ['data-confirm' => 'Apakah Anda yakin ingin memindahkan ke draft pada item ini?',
                                    'data-method' => 'post']);
                        break;
                    case 'Draft':
                        return Html::a(Html::tag('span', Html::tag('i', null, ['class' => 'fa fa-bookmark-o']) . '&nbsp&nbsp' . $data->save_status, ['style' => 'width: 120px', 'class' => 'badge badge-info']), ['/member/capas/publish', 'action' => 'member-capas-publish', 'id' => $data->id], ['data-confirm' => 'Apakah Anda yakin ingin mempublikasi item ini?',
                                    'data-method' => 'post']);
                        break;
                    case 'Trash':
                        return Html::a(Html::tag('span', Html::tag('i', null, ['class' => 'fa fa-trash-o']) . '&nbsp&nbsp' . $data->save_status, ['style' => 'width: 120px', 'class' => 'badge badge-danger']), ['/member/capas/publish', 'action' => 'member-capas-publish', 'id' => $data->id], ['data-confirm' => 'Apakah Anda yakin ingin mempublikasi item ini?',
                                    'data-method' => 'post']);
                        break;
                    case 'Pending':
                        return Html::a(Html::tag('span', Html::tag('i', null, ['class' => 'fa   fa-dot-circle-o']) . '&nbsp&nbsp' . $data->save_status, ['style' => 'width: 120px', 'class' => 'badge badge-warning']), ['/member/capas/publish', 'action' => 'member-capas-publish', 'id' => $data->id], ['data-confirm' => 'Apakah Anda yakin ingin mempublikasi item ini?',
                                    'data-method' => 'post']);
                        break;
                    default;
                        return null;
                        break;
                }
            },
                    'filter' => [
                        'Publish' => 'Publish',
                        'Draft' => 'Draft',
                        'Trash' => 'Trash',
                        'Pending' => 'Pending'
                    ]
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '<div class="text-center">Aksi</div>',
                    'template' => '<div class="text-center">{view}&nbsp;{update}&nbsp{delete}&nbsp{trash}</div>',
                    'buttons' => [
                        'view' => function ($url, $data) {
                    return Html::a('<i class="fa fa-eye"></i>', Url::toRoute(['/member/capas/view', 'action' => 'member-capas-view', 'id' => $data->id]), [
                                'class' => 'select-tooltip btn btn-primary btn-xs',
                                'data-toggle' => "tooltip",
                                'data-original-title' => "Lihat Detail",
                                'title' => Yii::t('yii', 'Lihat Detail'),
                    ]);
                },
                        'update' => function ($url, $data) {
                    return Html::a('<i class="fa fa-pencil"></i>', Url::toRoute(["/member/capas/update", 'action' => 'member-capas-update', 'id' => $data->id]), [
                                'class' => 'select-tooltip btn btn-primary btn-xs',
                                'data-toggle' => "tooltip",
                                'data-original-title' => "Perbaharui",
                                'title' => Yii::t('yii', 'Perbaharui'),
                    ]);
                },
                        'delete' => function ($url, $data) {
                    return Html::a('<i class="fa   fa-times"></i>', Url::toRoute(["/member/capas/delete", 'action' => 'member-capas-delete', 'id' => $data->id]), [
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
                    return Html::a('<i class="fa  fa-trash-o"></i>', Url::toRoute(['/member/capas/trash', 'action' => 'member-capas-trash', 'id' => $data->id]), [
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
