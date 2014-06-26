<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\File $model
 */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
  'modelClass' => 'File',
]) . ' ' . $model->name;
?>
<div class="file-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
