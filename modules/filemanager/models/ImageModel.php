<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\filemanager\models;

use app\modules\dao\ar\File;
use app\modules\filemanager\FileManager;
use app\modules\dao\ar\Taxfilerelations;
use app\modules\dao\ar\Taxonomy;

/**
 * Description of ImageModel
 *
 * @author melengo
 */
class ImageModel extends File
{

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagefilerelations($tax_id)
    {
        return $this->hasOne(Taxfilerelations::className(), ['file_id' => 'id'])->where(['tax_id' => $tax_id])->with(Taxonomy::className());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxonomiesByImages()
    {
        return $this->hasMany(Taxonomy::className(), ['id' => 'tax_id'])
                ->where(['term_id' => FileManager::FILE_IMAGE_TERM])
                ->viaTable('taxfilerelations', ['file_id' => 'id']);
    }

}
