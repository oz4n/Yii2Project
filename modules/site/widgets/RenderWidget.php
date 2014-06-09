<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/10/14
 * Time: 12:32 AM
 */

namespace app\modules\site\widgets;

use yii\base\Widget;
use app\modules\site\models\WidgetModel;
use yii\helpers\Html;

class RenderWidget extends Widget
{

    public $layoute_position;
    public $tax;
    public $colClass;

    public function run()
    {
        $this->renderItem();
        parent::run();
    }

    protected function renderItem()
    {
        foreach ($this->findAllWidget() as $value) {
            switch ($value->type) {
                case "PostSerch":
                    echo Html::beginTag('div', ['class' => $this->colClass]);
                    echo \app\modules\site\widgets\PostSerch::widget([
                        'action' => ['/site/site/tax', 'tax' => $this->tax],
                    ]);
                    echo Html::endTag('div');
                    break;
                case "RecentPosts";
                    echo Html::beginTag('div', ['class' => $this->colClass]);
                    echo \app\modules\site\widgets\RecentPosts::widget([
                        'title' => $value->name
                    ]);
                    echo Html::endTag('div');
                    break;
                case "HTML";
                    echo Html::beginTag('div', ['class' => $this->colClass]);
                    echo Html::beginTag('div', ['class' => 'magazine-sb-categories']);
                    echo Html::tag('div', Html::tag('H2', $value->name), ['class' => 'headline headline-md']);
                    echo Html::tag('div', $value->content);
                    echo Html::endTag('div');
                    echo Html::endTag('div');
                    break;
            }
        }
    }

    protected function findAllWidget()
    {
        $model = WidgetModel::find();
        $query = $model->onCondition([
            'status' => 'Publish',
            'layoute_position' => $this->layoute_position
        ])->orderBy(['position' => SORT_ASC])->all();
        return $query;
    }
} 