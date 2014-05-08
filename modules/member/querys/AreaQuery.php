<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/8/14
 * Time: 5:47 PM
 */

namespace app\modules\member\querys;


use creocoder\behaviors\NestedSetQuery;
use yii\db\ActiveQuery;

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