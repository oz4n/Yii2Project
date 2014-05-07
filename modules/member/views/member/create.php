<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\Member $model
 */
$this->title = Yii::t('app', 'Create {modelClass}', [
            'modelClass' => 'Member',
        ]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Members'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <div class="row">

        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>

    </div>

</div>
