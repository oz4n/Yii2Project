<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\appearance\models;

use app\modules\appearance\Appearance;
use app\modules\dao\ar\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Description of WidgetModel
 *
 * @author melengo
 */
class WidgetModel extends Widget
{
    public $category;
    public $limit;

    public $city;
    public $address;
    public $email;
    public $phone;

    public $google_link;
    public $facebook_link;
    public $twiter_link;

    public function getCategory()
    {
        $model = TaxonomyModel::find();
        $query = $model->onCondition(['term_id' => Appearance::APPEARANCE_CATEGORY_TERM]);
        return ArrayHelper::merge([null => 'None'], ArrayHelper::map($query->asArray()->all(), 'name', 'name'));
    }

    public function setPostAttr($model, $param)
    {
        if ($param['category'] !== null) {
            $data = [
                'category' => $param['category'],
                'limit' => $param['limit']
            ];
            return $model->setAttribute('content', Json::encode($data));

        } else {
            $data = ['category' => null, 'limit' => $param['limit']];;
            return $model->setAttribute('content', Json::encode($data));
        }
    }

    public function setContactAttr($model, $param)
    {

        $data = [
            'city' => $param['city'],
            'address' => $param['address'],
            'email' => $param['email'],
            'phone' => $param['phone']
        ];
        return $model->setAttribute('content', Json::encode($data));
    }

    public function setSosialNetworkAttr($model, $param)
    {

        $data = [
            'google_link' => $param['google_link'],
            'facebook_link' => $param['facebook_link'],
            'twiter_link' => $param['twiter_link']
        ];
        return $model->setAttribute('content', Json::encode($data));
    }

    public function setGuestBookAttr($model, $param)
    {
        $data = [
            'limit' => $param['limit']
        ];
        return $model->setAttribute('content', Json::encode($data));
    }
}
