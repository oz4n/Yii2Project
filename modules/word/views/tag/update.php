<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var \app\modules\dao\ar\Taxonomy $model
 */

$this->title = Yii::t('app', 'Perbaharui {modelClass} ', [
    'modelClass' => 'Tag',
]);
?>

<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?php echo Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?php echo Url::toRoute(['/dashboard/dashboard/index', 'action' => 'dashboard-list']); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?= Url::toRoute(['/word/post/index', 'action' => 'word-post-list']); ?>"><?= Yii::t('app', Html::encode('Post')); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute(['/word/tag/index', 'action' => 'word-tag-list']); ?>"><?php echo Yii::t('app', Html::encode('Tag')); ?></a>
    </li>
    <li class="active">
        <?php echo Yii::t('app', Html::encode($this->title . ' : ' . $model->name)); ?>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="text-center text-left-sm">
                <i class="fa  fa-tags page-header-icon"> </i>
                &nbsp;
                <?= Html::encode($this->title) ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass} Baru', [
                    'modelClass' => 'Tag',
                ]), Url::toRoute(['/word/tag/create', 'action' => 'word-tag-create']))
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

