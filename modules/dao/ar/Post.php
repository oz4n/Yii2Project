<?php

namespace app\modules\dao\ar;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $content
 * @property string $type
 * @property string $slug
 * @property string $status
 * @property string $layout
 * @property string $image
 * @property string $other_content
 * @property string $comment_status
 * @property string $create_et
 * @property string $update_et
 *
 * @property Comment[] $comments
 * @property User $user
 * @property Postrelations $postrelations
 * @property Taxpostrelations $taxpostrelations
 * @property Taxonomy[] $taxes
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['title', 'slug', 'create_et', 'update_et'], 'required'],
            [['content', 'slug', 'image', 'other_content'], 'string'],
            [['create_et', 'update_et'], 'safe'],
            [['title'], 'string', 'max' => 225],
            [['type', 'layout'], 'string', 'max' => 45],
            [['status', 'comment_status'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'type' => Yii::t('app', 'Type'),
            'slug' => Yii::t('app', 'Slug'),
            'status' => Yii::t('app', 'Status'),
            'layout' => Yii::t('app', 'Layout'),
            'image' => Yii::t('app', 'Image'),
            'other_content' => Yii::t('app', 'Other Content'),
            'comment_status' => Yii::t('app', 'Comment Status'),
            'create_et' => Yii::t('app', 'Create Et'),
            'update_et' => Yii::t('app', 'Update Et'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostrelations()
    {
        return $this->hasOne(Postrelations::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxpostrelations()
    {
        return $this->hasOne(Taxpostrelations::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxes()
    {
        return $this->hasMany(Taxonomy::className(), ['id' => 'tax_id'])->viaTable('taxpostrelations', ['post_id' => 'id']);
    }
}
