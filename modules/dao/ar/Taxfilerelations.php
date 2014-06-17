<?php

namespace app\modules\dao\ar;

use Yii;

/**
 * This is the model class for table "taxfilerelations".
 *
 * @property integer $tax_id
 * @property integer $file_id
 *
 * @property File $file
 * @property Taxonomy $tax
 */
class Taxfilerelations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'taxfilerelations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tax_id', 'file_id'], 'required'],
            [['tax_id', 'file_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tax_id' => Yii::t('app', 'Tax ID'),
            'file_id' => Yii::t('app', 'File ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(File::className(), ['id' => 'file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTax()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'tax_id']);
    }
}
