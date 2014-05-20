<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\UserLog $model
 */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
  'modelClass' => 'User Log',
]) . ' ' . $model->title;
?>
<div class="user-log-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
