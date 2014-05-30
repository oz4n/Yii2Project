<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\appearance\models;

use app\modules\dao\ar\Taxonomy;
use app\modules\appearance\Appearance;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Description of MenuModel
 *
 * @author melengo
 */
class MenuModel extends Taxonomy
{
//    public function behaviors()
//    {
//        return [
//            'slug' => [
//                'class' => 'Zelenin\yii\behaviors\Slug',
//                'source_attribute' => 'name',
//                'slug_attribute' => 'slug',
//
//                // optional params
//                'translit' => false,
//                'replacement' => '-',
//                'lowercase' => true,
//                'unique' => true
//            ]
//        ];
//    }
    
    public function getTermMenus()
    {
        $models = self::find();
        $models->onCondition(['term_id' => Appearance::APPEARANCE_MENU_TERM]);
        $data = ArrayHelper::map($models->asArray()->all(), 'id', 'name');
        return $data;
    }
    
    public function countMenuItem($taxmenu){
        $models = self::find();
        $models->onCondition([
            'term_id' => Appearance::APPEARANCE_MENU_TERM_ITEM,
            'taxmenu'=>$taxmenu
            ]);
        return count($models->all());
    }

    public function dataMenuTreeStore($taxmenu)
    {
        $model = self::find();
        $query = $model->onCondition(['taxmenu' => $taxmenu])
                        ->orderBy(['position' => SORT_ASC])->all();
        return $this->generateMenuTree($query);
    }

    private function generateMenuTree($array, $parent = null, $level = 0)
    {
        $has_children = false;
        foreach ($array as $model) {
            if ($model->parent_id == $parent) {
                if ($has_children === false) {
                    $has_children = true;
                    echo '<ol class="dd-list">';
                    $level++;
                }
                echo '<li class="dd-item" data-id="' . $model->id . '" data-position="' . $model->position . '" data-parent="' . $model->parent_id . '">';
                echo '<div class="dd-handle">' . $model->name . '</div>';
                $this->generateMenuTree($array, $model->id, $level);
                echo '</li>';
            }
        }
        if ($has_children === true) {
            echo '</ol>';
        }
    }

    public function dataCategoryTreeStore()
    {
        $model = self::find();
        $query = $model->onCondition(['term_id' => \app\modules\word\Word::WORD_CATEGORY])
                        ->orderBy(['position' => SORT_ASC])
                        ->asArray()->all();
        return $this->generateCategoryTree($query);
    }

    private function generateCategoryTree($array, $parent = null, $level = 0)
    {
        $has_children = false;
        foreach ($array as $value) {
            if ($value['parent_id'] == $parent) {
                if ($has_children === false) {
                    $has_children = true;
                    echo '<ul class="dd-list">';
                    $level++;
                }
                echo '<li class="dd-item" data-id="' . $value['id'] . '" data-position="' . $value['position'] . '" data-parent="' . $value['parent_id'] . '">';
                echo '<div class="checkbox"><label>' . Html::checkbox('Category[]', false, ['value' => $value['id']]) . $value['name'] . '</label></div>';
                $this->generateCategoryTree($array, $value['id'], $level);
                echo '</li>';
            }
        }
        if ($has_children === true) {
            echo '</ul>';
        }
    }

}
