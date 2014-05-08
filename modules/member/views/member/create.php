<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\member\models\MemberModel $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'Member Model',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Member Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
