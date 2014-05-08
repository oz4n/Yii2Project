<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\modules\member\searchs\MemberSerch;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\member\searchs\MemberSerch $searchModel
 */

$this->title = Yii::t('app', 'Anggota');
?>
    <ul class="breadcrumb breadcrumb-page">
        <div class="breadcrumb-label text-light-gray">
            <?php echo Yii::t('app', 'Anda di sini:'); ?>
        </div>
        <li>
            <a href="<?php echo Url::toRoute('/dashboard/dashboard/index'); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
        </li>
        <li>
            <a href="<?php echo Url::toRoute('/member/member/index'); ?>"><?php echo Yii::t('app', Html::encode('Anggota')); ?></a>
        </li>
    </ul>
    <div class="page-header">
        <div class="row">
            <div class="col-xs-8">
                <h1 class="text-center text-left-sm">
                    <i class="fa fa-users page-header-icon"> </i>
                    &nbsp;
                    <?= Html::encode('Anggota') ?>
                    <?= Yii::t('app', 'atau'); ?>
                    <?=
                    Html::a(Yii::t('app', 'Tambah {modelClass} Baru', [
                        'modelClass' => 'Anggota',
                    ]), ['create'])
                    ?>
                </h1>
            </div>
            <div class="col-xs-4">
                <div class="pull-right">
                    <?php $form = ActiveForm::begin([
                        'action' => "/member/member/index",
                        'method' => 'GET',
                        'options' => ['role' => 'form', 'id' => 'search'],
                        'fieldConfig' => [
                            'template' => "{input}\n{hint}\n{error}"
                        ]
                    ]); ?>

                    <div class="input-group input-group-sm">
                        <?= Html::activeTextInput($searchModel, 'keyword', ['class' => 'form-control', 'placeholder' => 'Cari Anggota', 'maxlength' => 255]) ?>
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
        'action' => '/member/member/index',
        'method' => 'get'
    ]);
    ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterUrl' => '/member/member/index',
        'tableOptions' => ['class' => 'table'],
        'layout' => Html::beginTag('div', ['class' => 'row'])

            . Html::beginTag('div', ['class' => 'col-xs-7'])
            . Html::beginTag('div', ['class' => 'form-inline'])
            . Html::dropDownList('bulk_action1', null, ['' => 'Tindakan Massal', 'delete' => 'Hapus'], ['class' => 'form-control'])
            . '&nbsp;&nbsp;'
            . Html::dropDownList('MemberSerch[year_filtr1]', null, MemberSerch::loadYears(), ['class' => 'form-control'])
            . '&nbsp;&nbsp;'
            . Html::dropDownList('MemberSerch[year_opsi]', null, ['and' => 'dan', 's/d' => 's/d'], ['class' => 'form-control'])
            . '&nbsp;&nbsp;'
            . Html::dropDownList('MemberSerch[year_filtr2]', null, MemberSerch::loadYears(), ['class' => 'form-control'])
            . '&nbsp;&nbsp;'
            . Html::submitButton('<i class="fa fa-check"></i> &nbsp;' . Yii::t('app', 'Appley'), ['class' => 'btn btn-primary btn-small'])
            . Html::endTag('div')
            . Html::endTag('div')

            . Html::beginTag('div', ['class' => 'col-xs-5'])

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
            . Html::dropDownList('bulk_action2', null, ['' => 'Tindakan Massal', 'delete' => 'Hapus'], ['class' => 'form-control'])
            . '&nbsp;&nbsp;'
            . Html::dropDownList('MemberSerch[year_filtr3]', null, MemberSerch::loadYears(), ['class' => 'form-control'])
            . '&nbsp;&nbsp;'
            . Html::dropDownList('MemberSerch[year_opsi1]', null, ['and' => 'dan', 's/d' => 's/d'], ['class' => 'form-control'])
            . '&nbsp;&nbsp;'
            . Html::dropDownList('MemberSerch[year_filtr4]', null, MemberSerch::loadYears(), ['class' => 'form-control'])
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
            'nra',
            'name',
            'nickname',
            [
                'attribute' => 'unit',
                'filter' => ['SMA' => 'SMA', 'SMK' => 'SMK', 'MA' => 'MA']
            ],
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
                    'O' => 'O',
                    'A' => 'A',
                    'B' => 'B',
                    'AB' => 'AB'
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
                'filter' => MemberSerch::loadYears()
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
            //        'note',
            //                'create_et',
            //                'update_et',
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


<?php
//    GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
//            'taxonomy_id',
//            'school_id',
//            'user_id',
//            'nra',
//            // 'name',
//            // 'nickname',
//            // 'unit',
//            // 'front_photo:ntext',
//            // 'side_photo:ntext',
//            // 'address',
//            // 'birth',
//            // 'nationality',
//            // 'religion',
//            // 'gender',
//            // 'marital_status',
//            // 'job',
//            // 'blood_group',
//            // 'father_name',
//            // 'mother_name',
//            // 'father_work',
//            // 'mother_work',
//            // 'income_father',
//            // 'income_mothers',
//            // 'number_of_brothers',
//            // 'number_of_sisters',
//            // 'number_of_children',
//            // 'educational_status',
//            // 'zip_code',
//            // 'phone_number',
//            // 'other_phone_number',
//            // 'relationship_phone_number',
//            // 'email:email',
//            // 'organizational_experience',
//            // 'year',
//            // 'illness',
//            // 'height_body',
//            // 'weight_body',
//            // 'dress_size',
//            // 'pants_size',
//            // 'shoe_size',
//            // 'hat_size',
//            // 'membership_status',
//            // 'status_organization',
//            // 'identity_card',
//            // 'identity_card_number:ntext',
//            // 'certificate_of_organization:ntext',
//            // 'names_recommended',
//            // 'note',
//            // 'create_et',
//            // 'update_et',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]);
?>