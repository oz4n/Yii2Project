<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/8/14
 * Time: 6:10 PM
 */

namespace app\modules\member\daos;


use yii\db\ActiveRecord;
use yii\base\Exception;

class Dao implements DaoInterface
{
    /**
     * @param $ac
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function getModel($ac, $id)
    {
        if (($model = $ac::findOne($id)) !== null) {
            return $model;
        } else {
            throw new Exception('Model dost not exist.');
        }
    }
} 