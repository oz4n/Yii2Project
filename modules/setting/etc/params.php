<?php
use app\modules\setting\models\SettingModel;
$setting = new SettingModel();
return [
    'facebook_link' => $setting->getSettingValueByKey('facebook_link'),
    'google_plus_link' => $setting->getSettingValueByKey('google_plus_link'),
    'twitter_link' => $setting->getSettingValueByKey('twitter_link'),
    'quotes_today' => $setting->getSettingValueByKey('quotes_today'),
    'slider_title1' => $setting->getSettingValueByKey('slider_title1'),
    'slider_title2' => $setting->getSettingValueByKey('slider_title2'),
    'slider_title3' => $setting->getSettingValueByKey('slider_title3'),
];
