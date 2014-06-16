<?php

use yii\helpers\Html;
use app\modules\userrbac\search\RuleSerch;
?>
<?php foreach (RuleSerch::find()->onCondition(['type' => 29])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
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
<!--post--> 
<?php foreach (RuleSerch::find()->onCondition(['type' => 12])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
    <div class="tl-entry">                   
        <div class="tl-icon bg-default"><i class="fa  fa-pencil"></i></div>
        <div class="panel tl-body">
            <h4 class="text-default"><?= $value->description ?></h4>
            <div class="checkbox">
                <label>
    <?= $model->isNewRecord ? Html::checkbox('RuleModel[rules][]', false, ['value' => $value->name, 'name' => 'RuleModel[rules][]', 'class' => 'rules-list']) : Html::checkbox('RuleModel[rules][]', $value->chekRuleByParentAndChild($ruleparent, $value->name) ? true : false, ['value' => $value->name, 'name' => 'RuleModel[rules][]', 'class' => 'rules-list']) ?>
                    Centang
                </label>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!--category--> 
<?php foreach (RuleSerch::find()->onCondition(['type' => 13])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
    <div class="tl-entry">                   
        <div class="tl-icon bg-warning"><i class="fa  fa-sitemap"></i></div>
        <div class="panel tl-body">
            <h4 class="text-warning"><?= $value->description ?></h4>
            <div class="checkbox">
                <label>
    <?= $model->isNewRecord ? Html::checkbox('RuleModel[rules][]', false, ['value' => $value->name, 'name' => 'RuleModel[rules][]', 'class' => 'rules-list']) : Html::checkbox('RuleModel[rules][]', $value->chekRuleByParentAndChild($ruleparent, $value->name) ? true : false, ['value' => $value->name, 'name' => 'RuleModel[rules][]', 'class' => 'rules-list']) ?>
                    Centang
                </label>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!--tag--> 
<?php foreach (RuleSerch::find()->onCondition(['type' => 14])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
    <div class="tl-entry">                   
        <div class="tl-icon bg-primary"><i class="fa  fa-tags"></i></div>
        <div class="panel tl-body">
            <h4 class="text-primary"><?= $value->description ?></h4>
            <div class="checkbox">
                <label>
    <?= $model->isNewRecord ? Html::checkbox('RuleModel[rules][]', false, ['value' => $value->name, 'name' => 'RuleModel[rules][]', 'class' => 'rules-list']) : Html::checkbox('RuleModel[rules][]', $value->chekRuleByParentAndChild($ruleparent, $value->name) ? true : false, ['value' => $value->name, 'name' => 'RuleModel[rules][]', 'class' => 'rules-list']) ?>
                    Centang
                </label>
            </div>
        </div>
    </div>
<?php endforeach; ?>