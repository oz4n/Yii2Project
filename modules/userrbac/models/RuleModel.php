<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/8/14
 * Time: 5:31 PM
 */

namespace app\modules\userrbac\models;

use app\modules\dao\ar\AuthItemChild;
use app\modules\dao\ar\AuthItem;

class RuleModel extends AuthItem
{
    public $rules;

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
                'source_attribute' => 'description',
                'slug_attribute' => 'name',
                // optional params
                'translit' => false,
                'replacement' => '',
                'lowercase' => true,
                'unique' => true
            ]
        ];
    }

    public function chekRuleByParentAndChild($parent, $child)
    {
        $model = AuthItemChild::find()->onCondition([
            'parent' => $parent,
            'child' => $child
        ])->one();
        if ($model != null) {
            return true;
        } else {
            return false;
        }
    }

    public function saveRuleRelation($data, $parent)
    {
        if (count($data) !== 0) {
            foreach ($data as $v) {
                $new = new AuthItemChild();
                $new->parent = $parent;
                $new->child = $v;
                $new->save();
            }
        }

        return true;
    }

    public function deleteRuleRelation($parent)
    {
        return AuthItemChild::deleteAll([
            'parent' => $parent,
        ]);
    }
} 