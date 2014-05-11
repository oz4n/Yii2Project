<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/8/14
 * Time: 5:52 PM
 */

namespace app\modules\member\models;

use app\modules\dao\ar\Taxonomy;


class LifeSkillModel extends Taxonomy
{

    public function getParentName()
    {
        $query = self::findBySql("SELECT * FROM " . $this->tableName() . " WHERE id='" . $this->parent_id . "'")->one();
        return $query['name'];
    }
} 