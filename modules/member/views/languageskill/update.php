<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\member\models\LanguageSkillModel $model
 */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
  'modelClass' => 'Language Skill Model',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Language Skill Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="language-skill-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
