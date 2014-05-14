<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\UserLog $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'User Log',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
