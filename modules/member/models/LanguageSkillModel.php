<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\member\models;

use app\modules\dao\ar\Taxonomy;

/**
 * Description of LanguageSkillModel
 *
 * @author melengo
 */
class LanguageSkillModel extends Taxonomy
{

    public function getParentName()
    {
        $m = Taxonomy::findBySql("SELECT * FROM " . $this->tableName() . " WHERE term_id=2 && id='" . $this->parent_id . "'")->one();
//        $m = $this->createProvinceQuery()->where(['id' => $this->parent_id])->one();
        return $m["name"];
    }

}
