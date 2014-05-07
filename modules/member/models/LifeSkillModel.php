<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\member\models;

use app\modules\dao\ar\Taxonomy;

/**
 * Description of LifeSkillModel
 *
 * @author melengo
 */
class LifeSkillModel extends Taxonomy
{

    public function getParentName()
    {
        $m = Taxonomy::findBySql("SELECT * FROM " . $this->tableName() . " WHERE term_id=1 && id='" . $this->parent_id . "'")->one();
//        $m = $this->createProvinceQuery()->where(['id' => $this->parent_id])->one();
        return $m["name"];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->update_et = date("Y-m-d H:i:s");
            return true;
        } else {
            return false;
        }
    }

}
