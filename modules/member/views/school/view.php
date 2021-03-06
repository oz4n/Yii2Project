<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var \app\modules\dao\ar\School $model
 */
$this->title = $model->name;
$this->registerJs(
    "$('ul.navigation > li.mm-dropdown > ul > li#school').addClass('active').parent().parent().addClass('active open');"
    , View::POS_READY);
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?php echo Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?php echo Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard-list']); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute(['/member/school/index', 'action' => 'member-school-list']); ?>"><?php echo Yii::t('app', Html::encode('Sekolah')); ?></a>
    </li>
    <li class="active">
        <?= Yii::t('app', 'Lihat Detail Sekolah'); ?>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="fa fa-home page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Lihat Detail Sekolah') ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass} Baru', [
                    'modelClass' => 'Sekolah',
                ]), Url::toRoute(['/member/school/create', 'action' => 'member-school-create']));
                ?>
            </h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-body">
                <?=
                DetailView::widget([
                    'model' => $model,
                    'options' => ['class' => 'table'],
                    'attributes' => [
                        'id',
                        'taxonomy_id',
                        'name',
                        'type',
                        'address',
                        'email:email',
                        'zip_code',
                        'phone_number',
                        'create_et',
                        'update_et',
                    ],
                ])
                ?>

            </div>
        </div>
    </div>

</div>
