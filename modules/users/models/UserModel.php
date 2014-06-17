<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/8/14
 * Time: 3:44 PM
 */

namespace app\modules\users\models;


use app\modules\dao\ar\AuthItem;
use app\modules\dao\ar\User;
use yii\helpers\ArrayHelper;
use dektrium\user\helpers\Password;
use yii\helpers\Security;

class UserModel extends User
{

    public function getRules()
    {
        $models = AuthItem::find();
        $models->andFilterWhere(['type' => 2]);
        return ArrayHelper::map($models->asArray()->all(), 'name', 'description');
    }
} 