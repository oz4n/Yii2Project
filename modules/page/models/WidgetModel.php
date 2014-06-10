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
    public function loadAllLeftWidget()
    {
        $model = self::find();
        $query = $model->onCondition(['layoute_position' => Page::WIDGET_HOME_LEFT_POSITION]);
        return $query->orderBy(['position' => SORT_ASC])->all();
    }

    public function loadAllRightWidget()
    {
        $model = self::find();
        $query = $model->onCondition(['layoute_position' => Page::WIDGET_HOME_RIGHT_POSITION]);
        return $query->orderBy(['position' => SORT_ASC])->all();
    }

    public function loadAllSidebarWidget()
    {
        $model = self::find();
        $query = $model->onCondition(['layoute_position' => Page::WIDGET_HOME_SIDEBAR_POSITION]);
        return $query->orderBy(['position' => SORT_ASC])->all();
    }
} 