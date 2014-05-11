<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/8/14
 * Time: 5:47 PM
 */

namespace app\modules\member\querys;


use yii\db\ActiveQuery;
use creocoder\behaviors\NestedSetQuery;

class AreaQuery extends ActiveQuery
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