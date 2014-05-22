<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\web\View;
/**
 * @var yii\web\View $this
 * @var \app\modules\dao\ar\Taxonomy $model
 */

$this->title = $model->name;

$this->registerJs(
    "$('ul.navigation > li.mm-dropdown > ul > li#tag').addClass('active').parent().parent().addClass('active open');"
    , View::POS_READY);
?>
<ul class="breadcrumb breadcrumb-page">
    <div class="breadcrumb-label text-light-gray">
        <?php echo Yii::t('app', 'Anda di sini:'); ?>
    </div>
    <li>
        <a href="<?php echo Url::toRoute(['/dashboard/dashboard/index','action'=>'dashboard']); ?>"><?php echo Yii::t('app', 'Beranda'); ?></a>
    </li>
    <li>
        <a href="<?php echo Url::toRoute(['/word/tag/index','action'=>'word-tag-list']); ?>"><?php echo Yii::t('app', Html::encode('Tag')); ?></a>
    </li>
    <li class="active">
        <?php echo Yii::t('app', Html::encode($this->title)); ?>
    </li>
</ul>
<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="text-center text-left-sm">
                <i class="fa  fa-tags  page-header-icon"> </i>
                &nbsp;
                <?= Html::encode('Lihat Detail') ?>
                <?= Yii::t('app', '/'); ?>
                <?=
                Html::a(Yii::t('app', 'Tambah {modelClass} Baru', [
                    'modelClass' => 'Tag',
                ]), Url::toRoute(['/word/tag/create','action'=>'word-tag-create']))
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
                    'options' => ['class'=>'table'],
                    'attributes' => [
                        'id',
                        'parent_id',
                        'term_id',
                        'name',
                        'description',
                        'count',
                        'slug',
                        'status',
                        'position',
                        'lft',
                        'rgt',
                        'root',
                        'level',
                        'create_et',
                        'update_et',
                    ],
                ])
                ?>
            </div>
        </div>
    </div>
</div>


