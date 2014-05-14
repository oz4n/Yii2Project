<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\userlog\searchs\UserLogSerch $searchModel
 */

$this->title = Yii::t('app', 'User Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'User Log',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'create_at',
            'url:ntext',
            'content:ntext',
            // 'contry',
            // 'ip_address',
            // 'sistem_oprasi',
            // 'city',
            // 'browser',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
