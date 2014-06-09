<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\site\widgets;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * Description of PostSerch
 *
 * @author melengo
 */
class PostSerch extends Widget
{
   
    public $placeholder = 'Cari';
    public $action = [];
    public $method = 'get';
    
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $this->createForm();
        parent::run();
    }
    
    protected function createForm()
    {
        echo Html::beginForm(\yii\helpers\Url::toRoute($this->action), $this->method);
        echo Html::beginTag('div', ['class' => 'input-group']);
        echo Html::textInput('keyword',null, ['class' => 'form-control', 'placeholder' => $this->placeholder]);
        echo Html::beginTag('span', ['class' => 'input-group-btn']);
        echo Html::button('Cari', ['class'=>'btn-u']);
        echo Html::endTag('span');
        echo Html::endTag('div');
        echo Html::endForm();
    }

}
