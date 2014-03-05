<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\Dashboard\models\Post $searchModel
 */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			'title',
			'content:ntext',
			'slug:ntext',
			'tags:ntext',
			// 'status',
			// 'create_time',
			// 'update_time',
			// 'comment_status',
			// 'post_status',
			// 'parent',
			// 'account_id',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
