<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\users\rules;

use Yii;
use yii\rbac\Rule;

/**
 * Description of UserGroupRule
 *
 * @author melengo
 */
class UserGroupRule extends Rule
{

    /**
     * @inheritdoc
     */
    public $name = 'UserGroupRule';

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $role = Yii::$app->user->identity->role;

            if ($item->name === 'administrator') {
                return $role === $item->name;
            } elseif ($item->name === 'admin') {
                return $role === $item->name || $role === 'administrator';
            }
        }
        return false;
        
//        if (!Yii::$app->user->isGuest) {
//            $group = Yii::$app->user->identity->role;
//            if ($item->name === 'adminppe') {
//                return $group == 1;
//            } elseif ($item->name === 'subadminppe') {
//                return $group == 1 || $group == 2;
//            }
//        }
//        return false;
    }

}
