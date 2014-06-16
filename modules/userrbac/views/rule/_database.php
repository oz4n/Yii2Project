<?php

use yii\helpers\Html;
use app\modules\userrbac\search\RuleSerch;
?>
<!--database menu admin-->
<?php foreach (RuleSerch::find()->onCondition(['type' => 28])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
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

<!--Anggota menu admin-->
<?php foreach (RuleSerch::find()->onCondition(['type' => 35])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
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

<!--Anggota menu admin-->
<?php foreach (RuleSerch::find()->onCondition(['type' => 36])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
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

<!--Angota ppi-->
<?php foreach (RuleSerch::find()->onCondition(['type' => 3])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
    <div class="tl-entry">                   
        <div class="tl-icon bg-danger"><i class="fa fa-users"></i></div>
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

<!--Anggota Paskibra-->
<?php foreach (RuleSerch::find()->onCondition(['type' => 4])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
    <div class="tl-entry">                   
        <div class="tl-icon bg-warning"><i class="fa fa-users"></i></div>
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

<!--Anggota Capas--> 
<?php foreach (RuleSerch::find()->onCondition(['type' => 5])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
    <div class="tl-entry">                   
        <div class="tl-icon bg-success"><i class="fa fa-users"></i></div>
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

<!--brevet penghargaan--> 
<?php foreach (RuleSerch::find()->onCondition(['type' => 6])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
    <div class="tl-entry">                   
        <div class="tl-icon bg-default"><i class="fa fa-star-o"></i></div>
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

<!--keterampilan personal--> 
<?php foreach (RuleSerch::find()->onCondition(['type' => 7])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
    <div class="tl-entry">                   
        <div class="tl-icon bg-danger"><i class="fa  fa-stethoscope"></i></div>
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

<!--keterampilan bahasa--> 
<?php foreach (RuleSerch::find()->onCondition(['type' => 8])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
    <div class="tl-entry">                   
        <div class="tl-icon bg-success"><i class="fa  fa-flag"></i></div>
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

<!--skolah--> 
<?php foreach (RuleSerch::find()->onCondition(['type' => 9])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
    <div class="tl-entry">                   
        <div class="tl-icon bg-primary"><i class="fa  fa-home"></i></div>
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

<!--daerah--> 
<?php foreach (RuleSerch::find()->onCondition(['type' => 10])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
    <div class="tl-entry">                   
        <div class="tl-icon bg-default"><i class="fa  fa-map-marker"></i></div>
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

<!--daerah--> 
<?php foreach (RuleSerch::find()->onCondition(['type' => 11])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
    <div class="tl-entry">                   
        <div class="tl-icon bg-warning"><i class="fa  fa-flag-o"></i></div>
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

<!--tools--> 
<?php foreach (RuleSerch::find()->onCondition(['type' => 23])->andFilterWhere(['not in', 'type', 1])->andFilterWhere(['not in', 'type', 2])->all() as $value): ?>
    <div class="tl-entry">                   
        <div class="tl-icon bg-danger"><i class="fa  fa-gears"></i></div>
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