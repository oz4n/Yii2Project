<?php

namespace app\modules\dao\ar;

use Yii;

/**
 * This is the model class for table "taxpostrelations".
 *
 * @property integer $post_id
 * @property integer $tax_id
 *
 * @property Post $post
 * @property Taxonomy $tax
 */
class Taxpostrelations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'taxpostrelations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'tax_id'], 'required'],
            [['post_id', 'tax_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => Yii::t('app', 'Post ID'),
            'tax_id' => Yii::t('app', 'Tax ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTax()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'tax_id']);
    }
}
