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

class UserLogModel extends UserLog
{

    public function saveActionLog()
    {
        $user_agent = new UserAgent();

        /** @var IpInfo $ipinfo */
        $ipinfo = json_decode(Yii::$app->ipinfo->getCity('36.75.176.125'));
        $this->user_id = Yii::$app->user->isGuest ? null : Yii::$app->user->identity->getId();
        $this->user_ip = $ipinfo->ipAddress;

        $get_param = Yii::$app->request->getQueryParams();
        $post_param = Yii::$app->request->post();
        $username = Yii::$app->user->isGuest ? 'none' : Yii::$app->user->identity->username;
        $user_name = ['username' => $username];
        if (isset($get_param['action'])) {
            switch ($get_param['action']) {
                case "member-ppi-list":
                    $this->content = json_encode(array_merge($user_name, $get_param));
                    $this->title = 'List data anggota PPI';
                    break;
                case "member-ppi-create":
                    if ($user_agent->getMethod() == "GET") {
                        $this->content = json_encode(array_merge($user_name, $get_param));
                        $this->title = 'Form penambahan data anggota PPI';
                    } else {
                        $this->content = json_encode(array_merge($user_name, $post_param));
                        $this->title = 'Tambah data anggota PPI';
                    }
                    break;
                case "member-ppi-update":
                    if ($user_agent->getMethod() == "GET") {
                        $this->content = json_encode(array_merge($user_name, $get_param));
                        $this->title = 'Form pengubahan data anggota PPI';
                    } else {
                        $this->content = json_encode(array_merge($user_name, $post_param));
                        $this->title = 'Perbaharui data anggota PPI';
                    }
                    break;
                case "member-ppi-delete":
                    $this->content = json_encode(array_merge($user_name, $post_param));
                    $this->title = 'Hapus data anggota PPI';
                    break;
                case "member-ppi-view":
                    $this->content = json_encode(array_merge($user_name, $get_param));
                    $this->title = 'Lihat detail data anggota PPI';
                    break;
                case "member-ppi-trash":
                    $this->content = json_encode(array_merge($user_name, $post_param));
                    $this->title = 'Buang ke tongsampah data anggota PPI';
                    break;
                case "member-brevet-list":
                    $this->content = json_encode(array_merge($user_name, $get_param));
                    $this->title = 'Lihat data brevet anggota';
                    break;
                case "member-brevet-view":
                    $this->content = json_encode(array_merge($user_name, $get_param));
                    $this->title = 'Lihat detail data brevet anggota';
                    break;
                case null:
                    $this->title = 'Aksi lainnya';
                    break;
            }
        }

        $this->absolute_url = $user_agent->getAbsoluteUrl();
        $this->user_agent = $user_agent->getUserAgent();
        $this->action_method = $user_agent->getMethod();
        $this->platform = $user_agent->getPlatform();
        $this->contry = ucwords(strtolower($ipinfo->countryName));
        $this->country_code = $ipinfo->countryCode;
        $this->region = ucwords(strtolower($ipinfo->regionName));
        $this->city = ucwords(strtolower($ipinfo->cityName));
        $this->zip_code = $ipinfo->zipCode;
        $this->browser = $user_agent->getBrowser();
        $this->browser_version = $user_agent->getVersion();
        $this->latitude = $ipinfo->latitude;
        $this->longitude = $ipinfo->longitude;
        $this->time_zone = $ipinfo->timeZone;
        $this->create_at = date("Y-m-d H:i:s");
        $this->update_et = date("Y-m-d H:i:s");
        return $this->save();
    }

    public function getUserNameByID()
    {
        $m = User::findBySql("SELECT * FROM user WHERE id='" . $this->user_id . "'")->one();
        return $m["username"];
    }

}
