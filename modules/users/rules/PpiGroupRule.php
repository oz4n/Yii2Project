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
 * Description of PpiGroupRule
 *
 * @author melengo
 */
class PpiGroupRule extends Rule
{

    /**
     * @inheritdoc
     */
    public $name = 'PpiGroupRule';

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {        
       return isset($params['ppi']) ? $params['ppi']->createdBy == $user : false;
    }

}
