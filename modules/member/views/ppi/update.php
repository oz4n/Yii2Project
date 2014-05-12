<?php

use yii\helpers\Html;
use yii\helpers\Url;
/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Member $model
 */

$this->title = Yii::t('app', 'Perbaharui {modelClass} ', [
  'modelClass' => 'Anggota PPI',
]);
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
    <li class="active">
        <?php echo $this->title . ' : ' . $model->name; ?>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1 class="text-center text-left-sm">
                <i class="menu-icon fa fa-users page-header-icon"> </i>
                &nbsp;
                <?= Html::encode($this->title) ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass}', [
                    'modelClass' => 'Anggota PPI',
                ]), ['create'])
                ?>
            </h1>
        </div>
        <div class="col-xs-4">

        </div>
    </div>
</div>
<div class="row">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
</div>