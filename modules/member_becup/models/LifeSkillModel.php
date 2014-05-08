<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\member\models;

use app\modules\dao\ar\Taxonomy;
use app\modules\member\models\query\LifeSkillQuery;
use creocoder\behaviors\NestedSet;

/**
 * Description of LifeSkillModel
 *
 * @author melengo
 */
class LifeSkillModel extends Taxonomy
{

    public function behaviors()
    {
        return [
            [
                'class' => NestedSet::className(),
            ],
        ];
    }

    public static function createQuery()
    {
        return new LifeSkillQuery(['modelClass' => get_called_class()]);
    }

    public function getParentName()
    {
        $m = Taxonomy::findBySql("SELECT * FROM " . $this->tableName() . " WHERE term_id=1 && id='" . $this->parent_id . "'")->one();
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
