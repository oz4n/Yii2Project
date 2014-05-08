<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\member\models\LanguageSkillModel $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
  'modelClass' => 'Language Skill Model',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Language Skill Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="language-skill-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
