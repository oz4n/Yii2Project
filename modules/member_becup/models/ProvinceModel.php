<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\member\models;

use app\modules\dao\ar\Province;

/**
 * Description of ProvinceModel
 *
 * @author melengo
 */
class ProvinceModel extends Province
{

    public function getParentName()
    {
        $m = Province::findBySql("SELECT * FROM " . $this->tableName() . " WHERE id='" . $this->parent_id . "'")->one();
//        $m = $this->createProvinceQuery()->where(['id' => $this->parent_id])->one();
        return $m["name"];
    }

}
