<?php

namespace app\modules\userlog;

//use app\modules\userlog\models\UserLogModel;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module;
use yii\helpers\Json;
use Yii;
use app\modules\userlog\librarys\UserAgent;

class UserLog extends Module implements BootstrapInterface
{

    public $controllerNamespace = 'app\modules\userlog\controllers';
    public $log_tatus = false;

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function getUserAgent()
    {
        $user_agent = new UserAgent();
        $data = [
            'getAbsoluteUrl' => $user_agent->getAbsoluteUrl(),
            'getUserAgent' => $user_agent->getUserAgent(),
            'getPlatform' => $user_agent->getPlatform(),
            'getBrowser' => $user_agent->getBrowser(),
            'getVersion' => $user_agent->getVersion(),
            'getMethod' => $user_agent->getMethod()
        ];
        return $data;
    }

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if ($this->log_tatus == true && !Yii::$app->user->isGuest) {
            $app->on(Application::EVENT_AFTER_ACTION, function () use ($app) {
                $get_param = Json::encode(Yii::$app->request->getQueryParams());
                $post_param = Json::encode(Yii::$app->request->post());
                $user_id = Yii::$app->user->isGuest ? null : Yii::$app->user->identity->getId();
                $username = Yii::$app->user->isGuest ? 'none' : Yii::$app->user->identity->username;
                $ipinfo = Yii::$app->ipinfo->getCity('36.75.176.125');
                $useragent = Json::encode($this->getUserAgent());
                $app_path = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'yii';
                exec("php $app_path log '$get_param' '$post_param' $user_id $username '$ipinfo' '$useragent' > /dev/null 2>/dev/null &");
//                exec('php /var/www/Yii2Project/yii log \'{"action":"member-ppi-list"}\' \'[]\' 1 administrator \'{ "statusCode" : "OK", "statusMessage" : "", "ipAddress" : "36.75.176.125", "countryCode" : "ID", "countryName" : "INDONESIA", "regionName" : "NUSA TENGGARA BARAT", "cityName" : "MATARAM", "zipCode" : "-", "latitude" : "-8.58333", "longitude" : "116.117", "timeZone" : "+08:00" }\' \'{"getAbsoluteUrl":"http:\/\/www.ppi-lomboktengah.org\/dashboard\/member\/ppi\/index\/member-ppi-list","getUserAgent":"Mozilla\/5.0 (X11; Linux x86_64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/35.0.1916.114 Safari\/537.36","getPlatform":"Linux","getBrowser":"Chrome","getVersion":"35.0.1916.114","getMethod":"GET"}\' > /dev/null 2> /dev/null');
            });
        }
        $app->getUrlManager()->addRules([
            'dashboard/userlog/index' => 'userlog/userlog/index'
                ], false);
    }

}
