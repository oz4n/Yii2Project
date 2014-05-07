<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\modules\member\models\LifeSkillModel $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Life Skill Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="life-skill-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
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
            'lvl',
            'create_et',
            'update_et',
        ],
    ]) ?>

</div>
