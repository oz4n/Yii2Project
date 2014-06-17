<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/10/14
 * Time: 10:31 PM
 */

namespace app\modules\site\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class SosialNetwork extends Widget
{
    public $title;
    public $param = [];

    public function run()
    {
        $this->renderItem();
        parent::run();
    }

    protected function renderItem()
    {
        echo Html::tag('div', Html::tag('h2', $this->title), ['class' => 'headline']);
        echo Html::beginTag('ul', ['class' => 'social-icons','style'=>'padding-left: 0']);
        echo Html::tag('li', Html::a("",$this->param['facebook_link'],['target'=>'_blank','class'=>'social_facebook']));
        echo Html::tag('li', Html::a("",$this->param['google_link'],['target'=>'_blank','class'=>'social_googleplus']));
        echo Html::tag('li', Html::a("",$this->param['twiter_link'],['target'=>'_blank','class'=>'social_twitter']));

        echo Html::endTag('ul');
    }
}