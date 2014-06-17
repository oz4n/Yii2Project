<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\site\models;

use app\modules\dao\ar\Taxonomy;
use app\modules\site\Site;
/**
 * Description of MenuModel
 *
 * @author melengo
 */
class MenuModel extends Taxonomy
{

    public static function findMenuByHeaderTerm()
    {
        $model = self::find();
        $model->onCondition([
            'term_id' => Site::MENU_HEADER_TERM
        ]);
        return $model->one();
    }


}
