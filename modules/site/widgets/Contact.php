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

class Contact extends Widget
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
        echo Html::tag('div', Html::tag('h2',$this->title), ['class' => 'headline']);
        echo Html::beginTag('ul', ['class' => 'list-unstyled who','style'=>'padding-left: 0']);
        echo Html::tag('li', '<i class="fa fa-home"></i>'.$this->param['city']);
        echo Html::tag('li', '<i class="fa fa-road"></i>'.$this->param['address']);
        echo Html::tag('li', '<i class="fa fa-envelope"></i>'.$this->param['email']);
        echo Html::tag('li', '<i class="fa fa-phone"></i>'.$this->param['phone']);
        echo Html::endTag('ul');
    }
}
