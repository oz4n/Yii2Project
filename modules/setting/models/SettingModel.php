<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\setting\models;

use app\modules\dao\ar\Setting;

/**
 * Description of SettingModel
 *
 * @author melengo
 */
class SettingModel extends Setting
{

    public function getSettingNameByKey($key)
    {
        $model = self::find();
        $query = $model->onCondition(['key' => $key])->one();
        return $query->name;
    }

    public function getSettingValueByKey($key)
    {
        $model = self::find();
        $query = $model->onCondition(['key' => $key])->one();
        return $query->value;
    }

}
