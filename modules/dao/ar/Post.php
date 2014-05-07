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
 * @property string $slug
 * @property string $status
 * @property string $comment_status
 * @property integer $like
 * @property integer $unlike
 * @property string $created
 * @property string $updated
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
            [['user_id', 'title', 'content', 'slug', 'created', 'updated'], 'required'],
            [['user_id', 'like', 'unlike'], 'integer'],
            [['content'], 'string'],
            [['created', 'updated'], 'safe'],
            [['title'], 'string', 'max' => 225],
            [['slug'], 'string', 'max' => 255],
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
            'slug' => Yii::t('app', 'Slug'),
            'status' => Yii::t('app', 'Status'),
            'comment_status' => Yii::t('app', 'Comment Status'),
            'like' => Yii::t('app', 'Like'),
            'unlike' => Yii::t('app', 'Unlike'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
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
