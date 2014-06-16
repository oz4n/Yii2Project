<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\guestbook\models;

use app\modules\dao\ar\Guestbook;

/**
 * Description of GuestbookModel
 *
 * @author melengo
 */
class GuestbookModel extends Guestbook
{

    public function findAllByParentId($id)
    {
        $model = self::find();
        return $model->onCondition(['parent_id' => $id])->all();
    }

}
