<?php

namespace app\modules\dao\ar;

use Yii;

/**
 * This is the model class for table "taxonomyrealation".
 *
 * @property integer $taxonomy_id
 * @property integer $parent_id
 *
 * @property Taxonomy $taxonomy
 * @property Taxonomy $parent
 */
class Taxonomyrealation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'taxonomyrealation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['taxonomy_id', 'parent_id'], 'required'],
            [['taxonomy_id', 'parent_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'taxonomy_id' => Yii::t('app', 'Taxonomy ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxonomy()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'taxonomy_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'parent_id']);
    }
}
