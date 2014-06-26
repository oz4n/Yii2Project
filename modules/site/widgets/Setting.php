<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\site\widgets;

use yii\base\Widget;
use app\modules\site\models\SettingModel;

/**
 * Description of Setting
 *
 * @author melengo
 */
class Setting extends Widget
{

    public $key;
    public $name = false;
    public $value = false;

    public function run()
    {
        if ($this->name == true) {
            echo $this->getName();
        }
        if ($this->value == true) {
            echo $this->getValue();
        }
        parent::run();
    }

    public function getName()
    {
        $model = new SettingModel;
        echo $model->getSettingNameByKey($this->key);
    }

    public function getValue()
    {
        $model = new SettingModel;
        echo $model->getSettingValueByKey($this->key);
    }

}
