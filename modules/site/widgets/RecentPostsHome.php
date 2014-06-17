<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\site\widgets;

use app\modules\site\helpers\TextHelper;
use yii\base\Widget;
use app\modules\site\models\PostModel;
use yii\helpers\Html;
use app\modules\site\Site;
use yii\helpers\Json;
use app\modules\site\helpers\IMachTagHtml;

/**
 * Description of RecentPostsHome
 *
 * @author melengo
 */
class RecentPostsHome extends Widget
{

    public $title;
    public $limit = 6;
    public $category = null;

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
        echo Html::beginTag('div', ['class' => 'posts']);
        echo Html::tag('div', Html::tag('H2', $this->title), ['class' => 'headline headline-md']);
        foreach ($this->findAllpost() as $value) {
            $tag = Json::decode($value->other_content);
            $this->createHtmlTag($value->title, ['/site/site/view', 'tax' => $tag['category'][0]['slug'], 'slug' => $value->slug], $value->content);
        }
        echo Html::endTag('div');
    }

    protected function createHtmlTag($title, $url, $content)
    {
        $img = explode("/", IMachTagHtml::getImgMach($content, "blank.png"));
        $imgname = $img[count($img) - 1];

        echo Html::beginTag('dl', ['class' => 'dl-horizontal']);
        echo Html::beginTag('dt');
        echo Html::a(Html::img(\Yii::getAlias('@web') . "/resources/images/thumbnail/145x145/" . $imgname), $url);
        echo Html::endTag('dt');
        echo Html::beginTag('dd', ['href' => '#']);
        echo Html::tag('b', Html::a($title, $url, ['style' => 'font-size: 13px']));
        echo Html::tag('p', TextHelper::word_limiter(strip_tags($content), 9));
        echo Html::endTag('dd');
        echo Html::endTag('dl');
    }

    protected function findAllpost()
    {
        $model = PostModel::find();
        if ($this->category === null) {
            $query = $model->onCondition([
                'type' => Site::POST_POST_TYPE_INFO,
                'status' => Site::POST_STATUS_PUBLISH
            ])->limit($this->limit)->orderBy(['create_et' => SORT_DESC])->all();
            return $query;
        } else {
            $query = $model->onCondition([
                'type' => Site::POST_POST_TYPE_INFO,
                'status' => Site::POST_STATUS_PUBLISH
            ])->andFilterWhere(['like', 'other_content', $this->category])->limit($this->limit)->orderBy(['create_et' => SORT_DESC])->all();
            return $query;
        }
    }

}
