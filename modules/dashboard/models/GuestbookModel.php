<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\dashboard\models;

use app\modules\dao\ar\Guestbook;
use app\modules\dashboard\Dashboard;

/**
 * Description of GuestbookModel
 *
 * @author melengo
 */
class GuestbookModel extends Guestbook
{

    public function getNewMessageLeng()
    {
        $model = self::find();
        $query = $model->onCondition(['status' => Dashboard::MESSAGE_STATUS_UNCONFIRMED])->all();
        return count($query);
    }

    public function getMessage($offset, $limit)
    {
        $model = self::find();        
        $query = $model->onCondition(['parent_id' => null])->offset($offset)->limit($limit)->orderBy([
                    'status' => SORT_DESC,
                    'create_et' => SORT_DESC
                ]);
        return $query;
    }

}
