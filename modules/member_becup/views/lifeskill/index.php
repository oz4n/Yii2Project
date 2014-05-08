<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\member\models\search\LifeSkillSerch $searchModel
 */
$this->title = Yii::t('app', 'Life Skill Models');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="life-skill-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?=
        Html::a(Yii::t('app', 'Create {modelClass}', [
            'modelClass' => 'Life Skill Model',
        ]), ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'format' => 'RAW',
                'value' => function ($data) {
                        $line = '';
                        if ($data->level == 1) {
                            return $data->name;
                        } else {
                            for ($i = 0; $i < $data->level; $i++) {
                                $line .= "&HorizontalLine;";
                            }
                            return $line . '&nbsp;' . $data->name;
                        }
                    }
            ],
            [
                'attribute' => 'parent_id',
                'value' => function ($data) {
                        return $data->getParentName();
                    }
            ],
            'description',

            // 'count',
            // 'slug',
            // 'status',
            // 'position',
            // 'lft',
            // 'rgt',
            // 'root',
//            'level',
            // 'create_et',
            // 'update_et',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
