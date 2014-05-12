<?php
use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Member $model
 */

$this->title = $model->name;
$this->registerJsFile('PixelAdmin/js/jquery.2.0.3.min.js', [], ['position' => View::POS_HEAD]);
$this->registerJs(
    "$('ul.navigation > li#database > ul.mm-dropdown > li#member > ul.mm-dropdown > li#ppi').addClass('active').parent().parent().addClass('open').parent().parent().addClass('active open');"
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
        <a href="<?php echo Url::toRoute('/member/ppi/index'); ?>"><?php echo Yii::t('app', Html::encode('Anggota')); ?></a>
    </li>
    <li class="active">
        <?php echo Yii::t('app', 'Lihat Detail') . ' : ' . $this->title; ?>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="menu-icon fa fa-users page-header-icon"> </i>
                &nbsp;
                <?= Html::encode(Yii::t('app', 'Lihat Detail')) ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass} Baru', [
                    'modelClass' => 'Anggota',
                ]), ['create'])
                ?>
            </h1>
        </div>
        <div class="col-xs-4">

        </div>
    </div>
</div>


<div class="row">
<div class="col-sx-12 col-sm-3 text-center">
        <span class="profile-picture">
            <?=
            Html::img(Yii::getAlias('@web') . '/resources/member/' . $model->front_photo, ['id' => 'avatar', 'class' => 'editable img-responsive', 'alt' => $model->name]);
            ?>
		</span>


    <div class="space-4"></div>
    <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
        <div class="inline position-relative">
            <i class="fa fa-circle-o"></i>
            <?= $model->name; ?>
        </div>
    </div>
    <div class="space-8"></div>
    <div class="profile-contact-info">
        <div class="profile-contact-links align-left">
            <?= Html::a('<i class="fa  fa-pencil"></i>&nbsp;&nbsp;' . Yii::t('app', 'Ubah'), ['update', 'id' => $model->id], ['class' => '']) ?>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <?=
            Html::a('<i class="fa  fa-trash-o"></i>&nbsp;&nbsp;' . Yii::t('app', 'Hapus'), ['delete', 'id' => $model->id], [
                'data' => [
                    'data-confirm' => 'Apakah Anda yakin ingin menghapus item ini?',
                    'data-method' => 'post',
                    'data-pjax' => 0,
                    'title' => Yii::t('yii', 'Hapus'),
                ],
            ])
            ?>
        </div>
    </div>
</div>
<div class="col-sx-12 col-sm-9">
    <div class="profile-user-info">
        <div class="profile-info-row">
            <div class="profile-info-name"> <?= Yii::t('app', 'NRA') ?></div>
            <div class="profile-info-value">
                <span><?= $model->nra ?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> <?= Yii::t('app', 'Nama Lengkap') ?></div>
            <div class="profile-info-value">
                <span>
                     <?= $model->name; ?>
                </span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> <?= Yii::t('app', 'Nama Panggilan') ?></div>
            <div class="profile-info-value">
                <span><?= $model->nickname ?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> <?= Yii::t('app', 'Jenis Kelamin') ?></div>
            <div class="profile-info-value">
                <span><?= $model->gender ?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> <?= Yii::t('app', 'Agama') ?></div>
            <div class="profile-info-value">
                <span><?= $model->religion ?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> <?= Yii::t('app', 'Status Perkawinan') ?></div>
            <div class="profile-info-value">
                <span><?= $model->marital_status ?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> <?= Yii::t('app', 'Kelahiran') ?></div>
            <div class="profile-info-value">
                <span><?= $model->birth ?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> Umur</div>
            <div class="profile-info-value">
                <span>Belum di load</span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> <?= Yii::t('app', 'Kebangsaan') ?> </div>
            <div class="profile-info-value">
                <i class="fa fa-map-marker"></i>
                &nbsp;
                <span><?= $model->nationality ?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> <?= Yii::t('app', 'Asal Daerah') ?></div>
            <div class="profile-info-value">
                <span><?= $model->getAreaName() ?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> <?= Yii::t('app', 'Asal Sekolah') ?></div>
            <div class="profile-info-value">
                <span><?= $model->getSchollName() ?></span>
            </div>
        </div>


        <div class="profile-info-row">
            <div class="profile-info-name"> <?= Yii::t('app', 'Terdaftar') ?></div>
            <div class="profile-info-value">
                <i class="fa fa-calendar"></i>
                &nbsp;
                <span><?= $model->create_et ?></span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name">Login terakhir</div>
            <div class="profile-info-value">
                <span>3 hours ago</span>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name"> Website</div>

            <div class="profile-info-value">
                <a href="profile.html#" target="_blank">www.alexdoe.com</a>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name">
                <i class="fa fa-facebook"></i>
            </div>

            <div class="profile-info-value">
                <a href="profile.html#">Find me on Facebook</a>
            </div>
        </div>

        <div class="profile-info-row">
            <div class="profile-info-name">
                <i class="fa fa-twitter"></i>
            </div>

            <div class="profile-info-value">
                <a href="profile.html#">Follow me on Twitter</a>
            </div>
        </div>
    </div>
    <?php
    /**DetailView::widget([
     * 'model' => $model,
     * 'attributes' => [
     * 'id',
     * 'taxonomy_id',
     * 'school_id',
     * 'user_id',
     * 'nra',
     * 'name',
     * 'nickname',
     * 'front_photo:ntext',
     * 'side_photo:ntext',
     * 'address',
     * 'birth',
     * 'nationality',
     * 'religion',
     * 'gender',
     * 'age',
     * 'marital_status',
     * 'job',
     * 'income_member',
     * 'blood_group',
     * 'father_name',
     * 'mother_name',
     * 'father_work',
     * 'mother_work',
     * 'income_father',
     * 'income_mothers',
     * 'number_of_brothers',
     * 'number_of_sisters',
     * 'number_of_children',
     * 'educational_status',
     * 'zip_code',
     * 'phone_number',
     * 'other_phone_number',
     * 'relationship_phone_number',
     * 'email:email',
     * 'organizational_experience',
     * 'year',
     * 'illness',
     * 'height_body',
     * 'weight_body',
     * 'dress_size',
     * 'pants_size',
     * 'shoe_size',
     * 'hat_size',
     * 'brevetaward',
     * 'lifeskill',
     * 'languageskill',
     * 'membership_status',
     * 'status_organization',
     * 'type_member',
     * 'tribal_members',
     * 'identity_card:ntext',
     * 'certificate_of_organization:ntext',
     * 'identity_card_number',
     * 'names_recommended',
     * 'note',
     * 'other_content:ntext',
     * 'save_status',
     * 'create_et',
     * 'update_et',
     * ],
     * ])*/
    ?>

</div>
</div>


<div class="space-20"></div>

<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-small">
                <h4 class="smaller">
                    <i class="fa fa-bookmark-o"></i>
                    &nbsp;
                    <?= Yii::t('app', 'Catatan') ?>
                </h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <p>
                        <?= $model->note; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-6">
        <div class="widget-box transparent">
            <div class="widget-header widget-header-small header-color-blue2">
                <h4 class="smaller">
                    <i class="fa fa-lightbulb-o"></i>&nbsp;
                    <?= Yii::t('app', 'Keterampilan') ?>
                </h4>
            </div>

            <div class="widget-body">
                <div class="widget-main padding-16">

                    <div class="hr hr-16"></div>

                </div>
            </div>
        </div>
    </div>
</div>

