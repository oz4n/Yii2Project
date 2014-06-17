<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\userlog\commands;

use yii\console\Controller;
use app\modules\userlog\models\UserLogModel;

/**
 * Description of LogController
 *
 * @author melengo
 */
class LogController extends Controller
{

    public function actionIndex($getparam, $postparam, $user_id, $username, $ip_info, $useragent)
    {
        $model = new UserLogModel();
        $model->saveActionLog($getparam, $postparam, $user_id, $username, $ip_info, $useragent);
//        echo $get_param[0]."\n".$post_param."\n".$user_id."\n". $username."\n";
    }
    
    public function actionTest($data){
//         echo "\n\n\n\n\n\n\n".$ds ."\n\n\n\n\n\n\n" . $sd."\n\n\n\n\n\n\n".$ad."\n\n\n".$dc."\n\n\n". $qw. "\n\n\n";
         $model = new UserLogModel();
         $model->testSave($data);
    }

}
