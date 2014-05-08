<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/8/14
 * Time: 6:11 PM
 */

namespace app\modules\member\daos;


use yii\db\ActiveRecord;

interface DaoInterface
{
    public function getModel($ac, $id);
} 