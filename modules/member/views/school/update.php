<?php

use yii\helpers\Html;
use yii\helpers\Url;
/**
 * @var yii\web\View $this
 * @var \app\modules\dao\ar\School $model
 */

$this->title = Yii::t('app', 'Perbaharui {modelClass} ', [
  'modelClass' => 'Sekolah',
]);
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?php echo Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?php echo Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard']); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute(['/member/school/index', 'action' => 'member-school-list']); ?>"><?php echo Yii::t('app', Html::encode('Sekolah')); ?></a>
    </li>
    <li class="active">
        <?= Yii::t('app','Perbaharui Sekolah'); ?>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="text-center text-left-sm">
                <i class="fa fa-home page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Perbaharui Sekolah') ?>
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
    <div class="col-sm-6">
        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>
    </div>
    <div class="col-sm-6">

    </div>
</div>

