<?php

namespace app\modules\ActiveRecord;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $slug
 * @property string $tags
 * @property string $status
 * @property string $create_time
 * @property string $update_time
 * @property string $comment_status
 * @property string $post_status
 * @property integer $parent
 * @property integer $account_id
 *
 * @property Comment[] $comments
 * @property Post $parent0
 * @property Post[] $posts
 * @property Account $account
 * @property Relationships $relationships
 * @property TermTaxonomy[] $termTaxonomies
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
			[['title', 'content', 'slug', 'create_time', 'update_time', 'account_id'], 'required'],
			[['content', 'slug', 'tags'], 'string'],
			[['create_time', 'update_time'], 'safe'],
			[['parent', 'account_id'], 'integer'],
			[['title'], 'string', 'max' => 255],
			[['status', 'comment_status'], 'string', 'max' => 5],
			[['post_status'], 'string', 'max' => 25]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'title' => 'Title',
			'content' => 'Content',
			'slug' => 'Slug',
			'tags' => 'Tags',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'comment_status' => 'Comment Status',
			'post_status' => 'Post Status',
			'parent' => 'Parent',
			'account_id' => 'Account ID',
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
	public function getParent0()
	{
		return $this->hasOne(Post::className(), ['id' => 'parent']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPosts()
	{
		return $this->hasMany(Post::className(), ['parent' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAccount()
	{
		return $this->hasOne(Account::className(), ['id' => 'account_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRelationships()
	{
		return $this->hasOne(Relationships::className(), ['post_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTermTaxonomies()
	{
		return $this->hasMany(TermTaxonomy::className(), ['id' => 'term_taxonomy_id'])->viaTable('relationships', ['post_id' => 'id']);
	}
}
