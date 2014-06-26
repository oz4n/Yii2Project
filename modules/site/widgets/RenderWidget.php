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
use yii\helpers\Json;

class RenderWidget extends Widget
{

    public $layoute_position;
    public $tax;
    public $colClass;

    public function run()
    {
        if($this->layoute_position == "footer"){
            $this->renderFooterItem();
        }else{
            $this->renderSidebarItem();
        }
        parent::run();
    }

    protected function renderFooterItem()
    {
        foreach ($this->findAllWidget() as $value) {
            switch ($value->type) {
                case "RecentPostsHome";
                    $param = Json::decode($value->content);
                    echo Html::beginTag('div', ['class' => $this->colClass]);
                    echo \app\modules\site\widgets\RecentPostsHome::widget([
                        'title' => $value->name,
                        'limit' => $param['limit'],
                        'category' => $param['category']
                    ]);
                    echo Html::endTag('div');
                    break;
                case "PostSerch";
                    echo Html::beginTag('div', ['class' => $this->colClass]);
                    echo \app\modules\site\widgets\PostSerch::widget([
                        'action' => ['/site/site/tax', 'tax' => $this->tax],
                    ]);
                    echo Html::endTag('div');
                    break;
                case "RecentPosts";
                    $param = Json::decode($value->content);
                    echo Html::beginTag('div', ['class' => $this->colClass]);
                    echo \app\modules\site\widgets\RecentPosts::widget([
                        'title' => $value->name,
                        'limit' => $param['limit'],
                        'category' => $param['category']
                    ]);
                    echo Html::endTag('div');
                    break;
                case "Contact";
                    echo Html::beginTag('div', ['class' => $this->colClass]);
                    echo \app\modules\site\widgets\Contact::widget([
                        'title' => $value->name,
                        'param' => Json::decode($value->content)
                    ]);
                    echo Html::endTag('div');
                    break;
                case "SosialNetwork";
                    echo Html::beginTag('div', ['class' => $this->colClass]);
                    echo \app\modules\site\widgets\SosialNetwork::widget([
                        'title' => $value->name,
                        'param' => Json::decode($value->content)
                    ]);
                    echo Html::endTag('div');
                    break;
                case "GuestBook";
                    echo Html::beginTag('div', ['class' => $this->colClass]);
                    echo \app\modules\site\widgets\GuestBookList::widget([
                        'title' => $value->name,
                        'param' => Json::decode($value->content)
                    ]);
                    echo Html::endTag('div');
                    break;
                case "HTML";
                    echo Html::beginTag('div', ['class' => $this->colClass]);
                    echo Html::beginTag('div', ['class' => 'magazine-sb-categories']);
                    echo Html::tag('div', Html::tag('H2', $value->name), ['class' => 'headline']);
                    echo Html::tag('div', $value->content);
                    echo Html::endTag('div');
                    echo Html::endTag('div');
                    break;
            }
        }
    }

    protected function renderSidebarItem()
    {
        foreach ($this->findAllWidget() as $value) {
            switch ($value->type) {
                case "RecentPostsHome";
                    $param = Json::decode($value->content);
                    echo Html::beginTag('div', ['class' => $this->colClass, 'style' => $value->position == 0 ? 'margin-top:-18px' : '']);
                    echo \app\modules\site\widgets\RecentPostsHome::widget([
                        'title' => $value->name,
                        'limit' => $param['limit'],
                        'category' => $param['category']
                    ]);
                    echo Html::endTag('div');
                    break;
                case "PostSerch";
                    echo Html::beginTag('div', ['class' => $this->colClass]);
                    echo \app\modules\site\widgets\PostSerch::widget([
                        'action' => ['/site/site/tax', 'tax' => $this->tax],
                    ]);
                    echo Html::endTag('div');
                    break;
                case "RecentPosts";
                    $param = Json::decode($value->content);
                    echo Html::beginTag('div', ['class' => $this->colClass, 'style' => $value->position == 0 ? 'margin-top:-18px' : '']);
                    echo \app\modules\site\widgets\RecentPosts::widget([
                        'title' => $value->name,
                        'limit' => $param['limit'],
                        'category' => $param['category']
                    ]);
                    echo Html::endTag('div');
                    break;
                case "Contact";
                    echo Html::beginTag('div', ['class' => $this->colClass, 'style' => $value->position == 0 ? 'margin-top:-18px' : '']);
                    echo \app\modules\site\widgets\Contact::widget([
                        'title' => $value->name,
                        'param' => Json::decode($value->content)
                    ]);
                    echo Html::endTag('div');
                    break;
                case "SosialNetwork";
                    echo Html::beginTag('div', ['class' => $this->colClass, 'style' => $value->position == 0 ? 'margin-top:-18px' : '']);
                    echo \app\modules\site\widgets\SosialNetwork::widget([
                        'title' => $value->name,
                        'param' => Json::decode($value->content)
                    ]);
                    echo Html::endTag('div');
                    break;
                case "GuestBook";
                    echo Html::beginTag('div', ['class' => $this->colClass, 'style' => $value->position == 0 ? 'margin-top:-18px' : '']);
                    echo \app\modules\site\widgets\GuestBookList::widget([
                        'title' => $value->name,
                        'param' => Json::decode($value->content)
                    ]);
                    echo Html::endTag('div');
                    break;
                case "HTML";
                    echo Html::beginTag('div', ['class' => $this->colClass, 'style' => $value->position == 0 ? 'margin-top:-18px' : '']);
                    echo Html::beginTag('div', ['class' => 'magazine-sb-categories']);
                    echo Html::tag('div', Html::tag('H2', $value->name), ['class' => 'headline']);
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
