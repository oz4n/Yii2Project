<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\site\widgets;

use app\modules\site\models\GuestbookModel;
use yii\base\Widget;
use yii\helpers\Html;
use app\modules\site\Site;

/**
 * Description of GuestBookList
 *
 * @author melengo
 */
class GuestBookList extends Widget
{
    public $param;
    public $title;

    public function run()
    {
        $this->renderItem();
        parent::run();
    }

    public function renderItem()
    {
        $this->createHtmlTag($this->findAllGuestBook());
    }

    protected function createHtmlTag($model)
    {
        echo Html::beginTag('div', ['class' => 'blog-twitter']);
        echo Html::tag('div', Html::tag('h2',$this->title), ['class' => 'headline']);
        foreach ($model as $v) {
            echo Html::beginTag('div', ['class' => 'blog-twitter-inner']);
            echo Html::tag('i', '', ['class' => 'fa fa-comment-o']);
            echo '&nbsp;@'.$v->name.'&nbsp;';
            echo $v->subject;
            echo Html::tag('p', Html::tag('i',null,['class'=>'fa fa-calendar']).'&nbsp;'. date('F w, Y',strtotime($v->create_et)));
            echo Html::endTag('div');
        }
        echo Html::endTag('div');
    }

    protected function findAllGuestBook()
    {
        $model = GuestbookModel::find();
        $query = $model->onCondition([
            'status' => Site::GUESTBOOK_PUBLISH_STATUS
        ])->limit($this->param['limit'])->orderBy(['create_et' => SORT_DESC])->all();
        return $query;
    }
}
