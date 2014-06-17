<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/11/14
 * Time: 1:56 AM
 */

namespace app\modules\page\models;

use app\modules\dao\ar\Widget;
use app\modules\page\Page;

class WidgetModel extends Widget
{

    public function loadAllPpiSidebarWidget()
    {
        $model = self::find();
        $query = $model->onCondition(['layoute_position' => Page::WIDGET_MEMBER_PPI_SIDEBAR_POSITION]);
        return $query->orderBy(['position' => SORT_ASC])->all();
    }

    public function loadAllPaskibraSidebarWidget()
    {
        $model = self::find();
        $query = $model->onCondition(['layoute_position' => Page::WIDGET_MEMBER_PASKIBRA_SIDEBAR_POSITION]);
        return $query->orderBy(['position' => SORT_ASC])->all();
    }
    
    public function loadAllCapasSidebarWidget()
    {
        $model = self::find();
        $query = $model->onCondition(['layoute_position' => Page::WIDGET_MEMBER_CAPAS_SIDEBAR_POSITION]);
        return $query->orderBy(['position' => SORT_ASC])->all();
    }

    public function loadAllContactSidebarWidget()
    {
        $model = self::find();
        $query = $model->onCondition(['layoute_position' => Page::WIDGET_CONTACT_SIDEBAR_POSITION]);
        return $query->orderBy(['position' => SORT_ASC])->all();
    }

    public function loadAllHomeLeftWidget()
    {
        $model = self::find();
        $query = $model->onCondition(['layoute_position' => Page::WIDGET_HOME_LEFT_POSITION]);
        return $query->orderBy(['position' => SORT_ASC])->all();
    }

    public function loadAllHomeRightWidget()
    {
        $model = self::find();
        $query = $model->onCondition(['layoute_position' => Page::WIDGET_HOME_RIGHT_POSITION]);
        return $query->orderBy(['position' => SORT_ASC])->all();
    }

    public function loadAllHomeSidebarWidget()
    {
        $model = self::find();
        $query = $model->onCondition(['layoute_position' => Page::WIDGET_HOME_SIDEBAR_POSITION]);
        return $query->orderBy(['position' => SORT_ASC])->all();
    }

    public function loadAllDefaultWidget()
    {
        $model = self::find();
        $query = $model->onCondition(['status' => Page::WIDGET_DEFAULT_HOME]);
        return $query->orderBy(['position' => SORT_ASC])->all();
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
            $data = ['category' => null, 'limit' => $param['limit']];
            ;
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
