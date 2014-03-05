<?php

namespace app\modules\ActiveRecord;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $author
 * @property string $email
 * @property string $url
 * @property string $content
 * @property string $status
 * @property string $create_time
 * @property integer $parent
 * @property integer $post_id
 *
 * @property Comment $parent0
 * @property Comment[] $comments
 * @property Post $post
 */
class Comment extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'comment';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['author', 'email', 'content', 'status', 'post_id'], 'required'],
			[['content'], 'string'],
			[['create_time'], 'safe'],
			[['parent', 'post_id'], 'integer'],
			[['author', 'email', 'url'], 'string', 'max' => 128],
			[['status'], 'string', 'max' => 5]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'author' => 'Author',
			'email' => 'Email',
			'url' => 'Url',
			'content' => 'Content',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'parent' => 'Parent',
			'post_id' => 'Post ID',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getParent0()
	{
		return $this->hasOne(Comment::className(), ['id' => 'parent']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getComments()
	{
		return $this->hasMany(Comment::className(), ['parent' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPost()
	{
		return $this->hasOne(Post::className(), ['id' => 'post_id']);
	}
}
