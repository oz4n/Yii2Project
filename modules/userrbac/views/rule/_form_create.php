<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var app\modules\dao\ar\AuthItem $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerJs(
    "$('ul.navigation > li#user > ul.mm-dropdown > li#rule-account').addClass('active').parent().addClass('open').parent().addClass('active open');"
    , View::POS_READY);
$this->registerJs(
    'init.push(function () { '
//    . '$("body").on("click",".switcher-state-on",function(){'
//    . '$("#img-slider").fadeOut();'
//    . '});'
//    . '$("body").on("click",".switcher-state-off",function(){'
//    . '$("#img-slider").fadeIn();'
//    . '});'
//    . '$(".rules-list").switcher({'
//        . 'theme: "square",'
//        . 'on_state_content: "<span class=\"fa fa-check\"></span>",'
//	    .'off_state_content: "<span class=\"fa fa-times\"></span>"'
//    . '});'
    . '});'
    , View::POS_READY);
?>

<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'options' => ['novalidate' => 'novalidate', 'id' => 'member-form'],
    'fieldConfig' => [
        // 'template' => "{label}\n{input}\n{hint}\n{error}",
        'horizontalCssClasses' => [
            'label' => 'col-sm-4',
            'offset' => 'col-sm-offset-4',
            'wrapper' => 'col-sm-8',
            'error' => '',
            'hint' => '',
        ],
    ],
]); ?>
<div class="panel">
    <div class="panel-body">
        <?= $form->field($model, 'description')->textInput(['rows' => 6])->label("Nama Rule") ?>
        <?php foreach(\app\modules\userrbac\search\RuleSerch::find()->andFilterWhere(['not in','type',1])->andFilterWhere(['not in','type',2])->all() as $value):?>
        <div class="form-group field-rulemodel-rules">
            <label class="control-label col-sm-4" for="rulemodel-rules"><?= $value->description ?></label>
            <div class="col-sm-8">
                <div class="checkbox">
                    <label>
                        <?= Html::checkbox('RuleModel[rules][]',false,['value'=>$value->name,'name'=>'RuleModel[rules][]','class'=>'rules-list']) ?>
                    </label>
                </div>
                <div class="help-block "></div>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="form-group">
            <div class="col-sm-8 col-sm-offset-4">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>

    </div>
</div>

<?php ActiveForm::end(); ?>


