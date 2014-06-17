<?php

use yii\helpers\Html;
use app\modules\userrbac\search\RuleSerch;
?>
<?php foreach (RuleSerch::find()->onCondition(['type' => 32])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
    <div class="tl-entry">                   
        <div class="tl-icon bg-success"><i class="fa fa-sitemap"></i></div>
        <div class="panel tl-body">
            <h4 class="text-success"><?= $value->description ?></h4>
            <div class="checkbox">
                <label>
    <?= $model->isNewRecord ? Html::checkbox('RuleModel[rules][]', false, ['value' => $value->name, 'name' => 'RuleModel[rules][]', 'class' => 'rules-list']) : Html::checkbox('RuleModel[rules][]', $value->chekRuleByParentAndChild($ruleparent, $value->name) ? true : false, ['value' => $value->name, 'name' => 'RuleModel[rules][]', 'class' => 'rules-list']) ?>
                    Centang
                </label>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php foreach (RuleSerch::find()->onCondition(['type' => 19])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
    <div class="tl-entry">                   
        <div class="tl-icon bg-success"><i class="fa fa-sitemap"></i></div>
        <div class="panel tl-body">
            <h4 class="text-success"><?= $value->description ?></h4>
            <div class="checkbox">
                <label>
    <?= $model->isNewRecord ? Html::checkbox('RuleModel[rules][]', false, ['value' => $value->name, 'name' => 'RuleModel[rules][]', 'class' => 'rules-list']) : Html::checkbox('RuleModel[rules][]', $value->chekRuleByParentAndChild($ruleparent, $value->name) ? true : false, ['value' => $value->name, 'name' => 'RuleModel[rules][]', 'class' => 'rules-list']) ?>
                    Centang
                </label>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php foreach (RuleSerch::find()->onCondition(['type' => 20])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
    <div class="tl-entry">                   
        <div class="tl-icon bg-danger"><i class="fa fa fa-flask"></i></div>
        <div class="panel tl-body">
            <h4 class="text-danger"><?= $value->description ?></h4>
            <div class="checkbox">
                <label>
    <?= $model->isNewRecord ? Html::checkbox('RuleModel[rules][]', false, ['value' => $value->name, 'name' => 'RuleModel[rules][]', 'class' => 'rules-list']) : Html::checkbox('RuleModel[rules][]', $value->chekRuleByParentAndChild($ruleparent, $value->name) ? true : false, ['value' => $value->name, 'name' => 'RuleModel[rules][]', 'class' => 'rules-list']) ?>
                    Centang
                </label>
            </div>
        </div>
    </div>
<?php endforeach; ?>