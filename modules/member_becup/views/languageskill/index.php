<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\member\models\search\LanguageSkillSerch $searchModel
 */
$this->title = Yii::t('app', 'Language Skill Models');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="language-skill-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?=
        Html::a(Yii::t('app', 'Create {modelClass}', [
                    'modelClass' => 'Language Skill Model',
                ]), ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'description',
            [
                'attribute' => 'parent_id',
                'header' => 'Parent',
                'value' => function ($data) {
            return $data->getParentName();
        }
            ],
            // 'count',
            // 'slug',
            // 'status',
            // 'position',
            // 'lft',
            // 'rgt',
            // 'root',
            // 'lvl',
            // 'created',
            // 'updated',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
