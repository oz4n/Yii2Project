<?php

namespace app\modules\dao\ar;

use Yii;

/**
 * This is the model class for table "postrelations".
 *
 * @property integer $post_id
 * @property integer $parent_id
 *
 * @property Post $post
 * @property Post $parent
 */
class Postrelations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'postrelations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'parent_id'], 'required'],
            [['post_id', 'parent_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => Yii::t('app', 'Post ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
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
    public function getParent()
    {
        return $this->hasOne(Post::className(), ['id' => 'parent_id']);
    }
}
