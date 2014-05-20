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

/**
 * Description of AlbumModel
 *
 * @author melengo
 */
class AlbumModel extends Taxonomy
{

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagesByAlbum()
    {
        return $this->hasMany(File::className(), ['id' => 'file_id'])
                        ->onCondition(['type' => FileManager::FILE_TYPE_IMAGE])
                        ->viaTable('taxfilerelations', ['tax_id' => 'id']);
    }

}
