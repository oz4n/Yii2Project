<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\site\widgets;

use yii\base\Widget;
use app\modules\site\models\PostModel;
use yii\helpers\Html;
use app\modules\site\Site;
use yii\helpers\Json;

/**
 * Description of RecentPosts
 *
 * @author melengo
 */
class RecentPosts extends Widget
{

    public $title;
    public $limit = 6;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $this->renderItem();
        parent::run();
    }

    public function renderItem()
    {
        echo Html::beginTag('div', ['class' => 'posts margin-bottom-40']);
        echo Html::tag('div', Html::tag('H2', $this->title), ['class' => 'headline headline-md']);
        foreach ($this->findAllpost() as $value) {
            $tag = Json::decode($value->other_content);
            $this->createHtmlTag($value->title, ['/site/site/view', 'tax' => $tag['category'][0]['slug'], 'slug' => $value->slug]);
        }
        echo Html::endTag('div');
    }

    protected function createHtmlTag($title, $url)
    {
        $str = "$title";
        echo Html::beginTag('dl', ['class' => 'dl-horizontal']);
        echo Html::beginTag('dt');
        echo Html::a(Html::tag('span', $title[0], ['class' => 'dropcap dropcap-bg bg-color-dark']), $url);
        echo Html::endTag('dt');
        echo Html::beginTag('dd', ['href' => '#']);
        echo Html::tag('p', Html::a($title, $url, ['style' => 'font-size: 13px']));
        echo Html::endTag('dd');
        echo Html::endTag('dl');
    }

    protected function findAllpost()
    {
        $model = PostModel::find();
        $query = $model->onCondition([
                    'type' => Site::POST_POST_TYPE_INFO,
                    'status' => Site::POST_STATUS_PUBLISH
                ])->limit($this->limit)->orderBy(['create_et' => SORT_DESC])->all();
        return $query;
    }

}