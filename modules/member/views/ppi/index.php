<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use app\modules\member\searchs\PpiSerch;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\member\searchs\PpiSerch $searchModel
 * @var app\modules\dao\ar\Member $data
 */

$this->title = Yii::t('app', 'Anggota');

$this->registerJs(
    "$('ul.navigation > li#database > ul.mm-dropdown > li#member > ul.mm-dropdown > li#ppi').addClass('active').parent().parent().addClass('open').parent().parent().addClass('active open');"
    . '$("td > select").select2({ allowClear: true, placeholder: "Filter item"});'
    . '$("select.select-year").select2({ allowClear: true, placeholder: "Tahun"});'
    . '$("select.opsi").select2({ allowClear: true, placeholder: "Tahun"});'
    . '$("select.save-status").select2({ allowClear: true, placeholder: "Tahun"});'
    . '$("select.action-bulk").select2({ allowClear: true, placeholder: "Tindakan Masal"});'
    , View::POS_READY);
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?php echo Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?php echo Url::toRoute('/dashboard/dashboard/index'); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute('/member/ppi/index'); ?>"><?php echo Yii::t('app', Html::encode('Anggota PPI')); ?></a>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa fa-users page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Anggota PPI') ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass}', [
                    'modelClass' => 'Anggota',
                ]), ['create'])
                ?>
            </h1>
        </div>
        <div class="col-xs-4">
            <div class="pull-right">
                <?php
                $form = ActiveForm::begin([
                    'action' => ['/member/ppi/index'],
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
    'action' => ['/member/ppi/index'],
    'method' => 'get'
]);
?>
<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'filterUrl' => ['/member/ppi/index'],
    'pager' => ['maxButtonCount' => 3],
    'tableOptions' => ['class' => 'table'],
    'layout' => Html::beginTag('div', ['class' => 'row'])

        . Html::beginTag('div', ['class' => 'col-xs-8'])
        . Html::beginTag('div', ['class' => 'form-inline'])
        . Html::dropDownList('bulk_action1', null, ['' => 'Tindakan Massal', 'delete' => 'Hapus', 'trash' => 'Tongsampah'], ['class' => 'form-control action-bulk'])
        . '&nbsp;&nbsp;'
        . Html::dropDownList('PpiSerch[year_filtr1]', null, PpiSerch::getYears('Tahun'), ['class' => 'form-control select-year'])
        . '&nbsp;&nbsp;'
        . Html::dropDownList('PpiSerch[year_opsi]', null, ['Opsi','and' => 'dan', 's/d' => 's/d'], ['class' => 'form-control opsi'])
        . '&nbsp;&nbsp;'
        . Html::dropDownList('PpiSerch[year_filtr2]', null, PpiSerch::getYears('Tahun'), ['class' => 'form-control select-year'])
        . '&nbsp;&nbsp;'
        . Html::dropDownList('PpiSerch[status_filtr1]', null, ['Status','Publish'=>'Publish','Draft'=>'Draft','Trash'=>'Trash'], ['class' => 'form-control save-status'])
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
        . Html::dropDownList('bulk_action2', null, ['' => 'Tindakan Massal', 'delete' => 'Hapus', 'trash' => 'Tongsampah'], ['class' => 'form-control action-bulk'])
        . '&nbsp;&nbsp;'
        . Html::dropDownList('PpiSerch[year_filtr3]', null, PpiSerch::getYears('Tahun'), ['class' => 'form-control select-year'])
        . '&nbsp;&nbsp;'
        . Html::dropDownList('PpiSerch[year_opsi1]', null, ['and' => 'dan', 's/d' => 's/d'], ['class' => 'form-control opsi'])
        . '&nbsp;&nbsp;'
        . Html::dropDownList('PpiSerch[year_filtr4]', null, PpiSerch::getYears('Tahun'), ['class' => 'form-control select-year'])
        . '&nbsp;&nbsp;'
        . Html::dropDownList('PpiSerch[status_filtr2]', null, ['Status','Publish'=>'Publish','Draft'=>'Draft','Trash'=>'Trash'], ['class' => 'form-control save-status'])
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
        'nra',
        'name',
        'nickname',
        //                'front_photo:ntext',
        //                'side_photo',
        'address',
        'birth',
        [
            'attribute' => 'taxonomy_id',
            'value' => function ($data) {
                    return $data->getAreaName();
                }
        ],
        [
            'attribute' => 'school_id',
            'value' => function ($data) {
                    return $data->getSchollName();
                }
        ],
        'nationality',
        [
            'attribute' => 'religion',
            'filterOptions' => ['id'=>'select-religion'],
            'filter' => [
                'Islam' => 'Islam',
                'Katholik' => 'Katholik',
                'Protestan' => 'Protestan',
                'Hindu' => 'Hindu',
                'Budha' => 'Budha',
                'Konghucu' => 'Konghucu'
            ]
        ],
        [
            'attribute' => 'gender',
            'filterOptions' => ['id'=>'select-gender'],
            'filter' => [
                'Laki-Laki' => 'Laki-Laki',
                'Perempuan' => 'Perempuan'
            ]
        ],
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
        [
            'attribute' => 'blood_group',
            'filter' => [
                'Golongan Darah O' => 'O',
                'Golongan Darah A' => 'A',
                'Golongan Darah B' => 'B',
                'Golongan Darah AB' => 'AB'
            ]
        ],
        'father_name',
        'mother_name',
        'father_work',
        'mother_work',
        'income_father',
        'income_mothers',
        'number_of_brothers',
        'number_of_sisters',
        'number_of_children',
        'educational_status',
        'zip_code',
        'phone_number',
        'other_phone_number',
        'relationship_phone_number',
        'email:email',
        'organizational_experience',

        [
            'attribute' => 'year',
            'filter' => PpiSerch::getYears()
        ],
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
        'membership_status',
        'status_organization',
        //                'identity_card',
        'identity_card_number',
        //                'certificate_of_organization:ntext',
        'names_recommended',
        'note',
        [
            'attribute' => 'brevetaward',
            'label' => 'Brevet Penghargaan',
        ],
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
                            return Html::tag('span', Html::tag('i', null, ['class' => 'fa  fa-check-circle-o']) . '&nbsp&nbsp' . $data->save_status, ['class' => 'badge badge-success']);
                            break;
                        case 'Draft':
                            return Html::tag('span', Html::tag('i', null, ['class' => 'fa fa-bookmark-o']) . '&nbsp&nbsp' . $data->save_status, ['class' => 'badge badge-info']);
                            break;
                        case 'Trash':
                            return Html::tag('span', Html::tag('i', null, ['class' => 'fa fa-trash-o']) . '&nbsp&nbsp' . $data->save_status, ['class' => 'badge badge-danger']);
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
            'header' => '<div class="text-center">Aksi</div>',
            'template' => '<div class="text-center">{view}&nbsp;{update}&nbsp{delete}&nbsp{trash}</div>',
            'buttons' => [
                'view' => function ($url) {
                        return Html::a('<i class="fa fa-eye"></i>', [$url], [
                            'class' => 'btn btn-success btn-xs',
                            'title' => Yii::t('yii', 'Lihat Detail'),
                        ]);
                    },
                'update' => function ($url) {
                        return Html::a('<i class="fa fa-pencil"></i>', [$url], [
                            'class' => 'btn btn-primary btn-xs',
                            'title' => Yii::t('yii', 'Memperbarui'),
                        ]);
                    },
                'delete' => function ($url) {
                        return Html::a('<i class="fa   fa-times"></i>', [$url], [
                            'class' => 'btn btn-danger btn-xs',
                            'data-confirm' => 'Apakah Anda yakin ingin menghapus item ini?',
                            'data-method' => 'post',
                            'data-pjax' => 0,
                            'title' => Yii::t('yii', 'Hapus'),
                        ]);
                    },
                'trash' => function ($url) {
                        return Html::a('<i class="fa  fa-trash-o"></i>', [$url], [
                            'class' => 'btn btn-warning btn-xs',
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
<?php ActiveForm::end(); ?>
</div>
</div>
