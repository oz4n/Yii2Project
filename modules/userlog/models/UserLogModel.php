<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/15/14
 * Time: 4:48 AM
 */

namespace app\modules\userlog\models;

use Yii;
use app\modules\dao\ar\UserLog;
use app\modules\userlog\librarys\UserAgent;
use app\modules\dao\ar\User;
use app\modules\userlog\librarys\IpInfo;
use yii\helpers\Json;

class UserLogModel extends UserLog
{

    public function testSave($data)
    {
        $param = Json::decode($data);
        
        $this->user_id = 3;
        $this->user_ip = $param['ipAddress'];
        $this->content = $param['regionName'];
        $this->title = 'Form penambahan data anggota PPI';
        $this->absolute_url = 'asdlj';
        $this->user_agent = 'sdlakjd';
        $this->action_method = 'get';
        $this->platform = 'oasd';
        $this->contry = 'asd';
        $this->country_code = 'asdjkalsd';
        $this->region = 'asdasd';
        $this->city = 'asd';
        $this->zip_code = 'asdas';
        $this->browser = '$user_agent->getBrowser()';
        $this->browser_version = '$user_agent->getVersion()';
        $this->latitude = '$ipinfo->latitude';
        $this->longitude = '$ipinfo->longitude';
        $this->time_zone = '$ipinfo->timeZone';
        $this->create_at = date("Y-m-d H:i:s");
        $this->update_et = date("Y-m-d H:i:s");
        return $this->save();
    }

    public function saveActionLog($getparam, $postparam, $user_id, $username, $ip_info , $useragent)
    {
        $user_agent = Json::decode($useragent);
        $get_param = Json::decode($getparam);
        $post_param = Json::decode($postparam);
        /** @var IpInfo $ipinfo */
        $ipinfo = Json::decode($ip_info);
//        $this->user_id = Yii::$app->user->isGuest ? null : Yii::$app->user->identity->getId();
        $this->user_id = $user_id;
        $this->user_ip = $ipinfo['ipAddress'];

//        $get_param = Yii::$app->request->getQueryParams();
//        $post_param = Yii::$app->request->post();
//        $username = Yii::$app->user->isGuest ? 'none' : Yii::$app->user->identity->username;
        $user_name = ['username' => $username];

        $this->absolute_url = $user_agent['getAbsoluteUrl'];
        $this->user_agent = $user_agent['getUserAgent'];
        $this->action_method = $user_agent['getMethod'];
        $this->platform = $user_agent['getPlatform'];
        $this->contry = ucwords(strtolower($ipinfo['countryName']));
        $this->country_code = $ipinfo['countryCode'];
        $this->region = ucwords(strtolower($ipinfo['regionName']));
        $this->city = ucwords(strtolower($ipinfo['cityName']));
        $this->zip_code = $ipinfo['zipCode'];
        $this->browser = $user_agent['getBrowser'];
        $this->browser_version = $user_agent['getVersion'];
        $this->latitude = $ipinfo['latitude'];
        $this->longitude = $ipinfo['longitude'];
        $this->time_zone = $ipinfo['timeZone'];
        $this->create_at = date("Y-m-d H:i:s");
        $this->update_et = date("Y-m-d H:i:s");
        if (isset($get_param['action'])) {
            switch ($get_param['action']) {
                case "member-ppi-list":
                    $this->content = json_encode(array_merge($user_name, $get_param));
                    $this->title = 'List data anggota PPI';
                    return $this->save();
                    exit;
                case "member-ppi-create":
                    if ($user_agent['getMethod'] == "GET") {
                        $this->content = json_encode(array_merge($user_name, $get_param));
                        $this->title = 'Form penambahan data anggota PPI';
                    } else {
                        $this->content = json_encode(array_merge($user_name, $post_param));
                        $this->title = 'Tambah data anggota PPI';
                    }
                    return $this->save();
                   exit;
                case "member-ppi-update":
                    if ($user_agent['getMethod'] == "GET") {
                        $this->content = json_encode(array_merge($user_name, $get_param));
                        $this->title = 'Form pengubahan data anggota PPI';
                    } else {
                        $this->content = json_encode(array_merge($user_name, $post_param));
                        $this->title = 'Perbaharui data anggota PPI';
                    }
                    return $this->save();
                    exit;
                case "member-ppi-delete":
                    $this->content = json_encode(array_merge($user_name, $post_param));
                    $this->title = 'Hapus data anggota PPI';
                    return $this->save();
                    exit;
                case "member-ppi-view":
                    $this->content = json_encode(array_merge($user_name, $get_param));
                    $this->title = 'Lihat detail data anggota PPI';
                    return $this->save();
                    exit;
                case "member-ppi-trash":
                    $this->content = json_encode(array_merge($user_name, $post_param));
                    $this->title = 'Buang ke tongsampah data anggota PPI';
                    return $this->save();
                    exit;
                case "member-brevet-list":
                    $this->content = json_encode(array_merge($user_name, $get_param));
                    $this->title = 'Lihat data brevet anggota';
                    return $this->save();
                    exit;
                case "member-brevet-view":
                    $this->content = json_encode(array_merge($user_name, $get_param));
                    $this->title = 'Lihat detail data brevet anggota';
                    return $this->save();
                    exit;
                case null:
                    $this->title = 'Aksi lainnya';
                    return $this->save();
                    exit;
            }
        }
        
    }
    
    protected function ppilog($user_name, $get_param, $post_param)
    {
        if (isset($get_param['action'])) {
            switch ($get_param['action']) {
                case "member-ppi-list":
                    $this->content = json_encode(array_merge($user_name, $get_param));
                    $this->title = 'List data anggota PPI';
                    return $this->save();
                    exit;
                case "member-ppi-create":
                    if ($user_agent['getMethod'] == "GET") {
                        $this->content = json_encode(array_merge($user_name, $get_param));
                        $this->title = 'Form penambahan data anggota PPI';
                    } else {
                        $this->content = json_encode(array_merge($user_name, $post_param));
                        $this->title = 'Tambah data anggota PPI';
                    }
                    return $this->save();
                    exit;
                case "member-ppi-update":
                    if ($user_agent['getMethod'] == "GET") {
                        $this->content = json_encode(array_merge($user_name, $get_param));
                        $this->title = 'Form pengubahan data anggota PPI';
                    } else {
                        $this->content = json_encode(array_merge($user_name, $post_param));
                        $this->title = 'Perbaharui data anggota PPI';
                    }
                    return $this->save();
                    exit;
                case "member-ppi-delete":
                    $this->content = json_encode(array_merge($user_name, $post_param));
                    $this->title = 'Hapus data anggota PPI';
                    return $this->save();
                    exit;
                case "member-ppi-view":
                    $this->content = json_encode(array_merge($user_name, $get_param));
                    $this->title = 'Lihat detail data anggota PPI';
                    return $this->save();
                    exit;
                case "member-ppi-trash":
                    $this->content = json_encode(array_merge($user_name, $post_param));
                    $this->title = 'Buang ke tongsampah data anggota PPI';
                    return $this->save();
                    exit;
                case "member-brevet-list":
                    $this->content = json_encode(array_merge($user_name, $get_param));
                    $this->title = 'Lihat data brevet anggota';
                    return $this->save();
                    exit;
                case "member-brevet-view":
                    $this->content = json_encode(array_merge($user_name, $get_param));
                    $this->title = 'Lihat detail data brevet anggota';
                    return $this->save();
                    exit;
//                case null:
//                    $this->title = 'Aksi lainnya';
//                    return $this->save();
//                    exit;
            }
        }
    }

    public function getUserNameByID()
    {
        $m = User::findBySql("SELECT * FROM user WHERE id='" . $this->user_id . "'")->one();
        return $m["username"];
    }

}
