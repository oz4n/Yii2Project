<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\filemanager\models;

use app\modules\dao\ar\Taxonomy;
use app\modules\dao\ar\File;
use app\modules\filemanager\FileManager;
use yii\helpers\ArrayHelper;
use app\modules\filemanager\models\ImageModel;

/**
 * Description of AlbumModel
 *
 * @author melengo
 */
class AlbumModel extends Taxonomy
{
   
    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
                'source_attribute' => 'name',
                'slug_attribute' => 'slug',
                // optional params
                'translit' => false,
                'replacement' => '-',
                'lowercase' => true,
                'unique' => true
            ]
        ];
    }

    public function getParentName()
    {
        $m = self::findBySql("SELECT * FROM " . $this->tableName() . " WHERE id='" . $this->parent_id . "'")->one();
        return $m["name"];
    }

    public function getAlbumNameById($id)
    {
        $m = self::findBySql("SELECT * FROM " . $this->tableName() . " WHERE id='" . $id . "'")->one();
        return $m["name"];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagesByAlbum()
    {
        return $this->hasMany(File::className(), ['id' => 'file_id'])
                        ->onCondition(['type' => FileManager::FILE_TYPE_IMAGE])                
                        ->viaTable('taxfilerelations', ['tax_id' => 'id']);
    }

    public function getImageByAlbumId($id, $limit, $offset)
    {
        $image = self::findOne($id);
        $query = $image->getImagesByAlbum()
                ->orderBy(['create_at' => SORT_DESC])
                ->limit($limit)
                ->offset($offset)
                ->all();
        return $query;
    }

    public function getAllImages($limit, $offset, $key = null)
    {
        $image = ImageModel::find();
        $query = $image->onCondition(['type' => FileManager::FILE_TYPE_IMAGE])
                ->orFilterWhere(['like', 'name', $key])
                ->orFilterWhere(['like', 'orginal_name', $key])
                ->orFilterWhere(['like', 'unique_name', $key])
                ->orFilterWhere(['like', 'description', $key])
                ->orderBy(['create_at' => SORT_DESC])
                ->limit($limit)
                ->offset($offset)
                ->all();
        return $query;
    }

    public function getAllAlbums()
    {
        $models = self::find();
        $query = $models->onCondition(['term_id' => FileManager::FILE_IMAGE_TERM])
                ->all();
        return $query;
    }

    public static function getAlbums($none = 'None')
    {
        $models = self::find();
        $models->onCondition(['term_id' => FileManager::FILE_IMAGE_TERM]);
        $data = ArrayHelper::map($models->asArray()->all(), 'id', 'name');
//        return $data;
        return ArrayHelper::merge([0 => $none], $data);
    }

}
