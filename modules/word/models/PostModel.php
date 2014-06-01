<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/23/14
 * Time: 12:46 AM
 */

namespace app\modules\word\models;

use app\modules\dao\ar\Post;
use app\modules\dao\ar\Taxpostrelations;

class PostModel extends Post
{

    public $category;
    public $tag;

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
                'source_attribute' => 'title',
                'slug_attribute' => 'slug',
                // optional params
                'translit' => false,
                'replacement' => '-',
                'lowercase' => true,
                'unique' => true
            ]
        ];
    }

    public function findAllCategoryNameById($dataid)
    {
        $data = [];
        foreach ($dataid as $id) {
            $cat = CategoryModel::findOne($id);
            $data[] = $cat->name;
        }
        return $data;
    }

    public function findAllCategoryAttrById($dataid)
    {
        $data = [];
        foreach ($dataid as $id) {
            $cat = CategoryModel::findOne($id);
            $data[] = [
                'id' => $cat->id,
                'name' => $cat->name,
                'slug' => $cat->slug
            ];
        }
        return $data;
    }

    public function findAllTagNameById($dataid)
    {
        $data = [];
        foreach ($dataid as $id) {
            $tag = TagModel::findOne($id);
            $data[] = $tag->name;
        }
        return $data;
    }

    public function findAllTagAttrById($dataid)
    {
        $data = [];
        foreach ($dataid as $id) {
            $tag = TagModel::findOne($id);
            $data[] = [
                'id' => $tag->id,
                'name' => $tag->name,
                'slug' => $tag->slug
            ];
        }
        return $data;
    }

    public function saveCatRelation($data, $post_id)
    {
        foreach ($data as $id) {            
            $new = new Taxpostrelations;
            $new->post_id = $post_id;
            $new->tax_id = $id;
            $new->save();
        }

        return true;
    }

    public function saveTagRelation($data, $post_id)
    {
        foreach ($data as $id) {           
            $new = new Taxpostrelations;
            $new->post_id = $post_id;
            $new->tax_id = $id;
            $new->save();
        }
        return true;
    }
    
    public function deleteTagRelation($data, $post_id)
    {
        foreach ($data as $id) {
            Taxpostrelations::deleteAll([
                'tax_id' => $id,
                'post_id' => $post_id
            ]);
        }
        return true;
    }
    
    public function deleteCatRelation($data, $post_id)
    {
        foreach ($data as $id) {
            Taxpostrelations::deleteAll([
                'tax_id' => $id,
                'post_id' => $post_id
            ]);
        }
         return true;
    }

}
