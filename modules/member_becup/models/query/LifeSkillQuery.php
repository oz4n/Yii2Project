<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/8/14
 * Time: 1:17 PM
 */

namespace app\modules\member\models\query;


use creocoder\behaviors\NestedSetQuery;
use yii\db\ActiveQuery;

class LifeSkillQuery extends ActiveQuery
{
    public function behaviors()
    {
        return [
            [
                'class' => NestedSetQuery::className(),
            ],
        ];
    }
} 