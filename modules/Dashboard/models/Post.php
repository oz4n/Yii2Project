<?php

namespace app\modules\Dashboard\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\ActiveRecord\Post as PostModel;

/**
 * Post represents the model behind the search form about `app\modules\ActiveRecord\Post`.
 */
class Post extends Model
{
	public $id;
	public $title;
	public $content;
	public $slug;
	public $tags;
	public $status;
	public $create_time;
	public $update_time;
	public $comment_status;
	public $post_status;
	public $parent;
	public $account_id;

	public function rules()
	{
		return [
			[['id', 'parent', 'account_id'], 'integer'],
			[['title', 'content', 'slug', 'tags', 'status', 'create_time', 'update_time', 'comment_status', 'post_status'], 'safe'],
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

	public function search($params)
	{
		$query = PostModel::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'title', true);
		$this->addCondition($query, 'content', true);
		$this->addCondition($query, 'slug', true);
		$this->addCondition($query, 'tags', true);
		$this->addCondition($query, 'status', true);
		$this->addCondition($query, 'create_time');
		$this->addCondition($query, 'update_time');
		$this->addCondition($query, 'comment_status', true);
		$this->addCondition($query, 'post_status', true);
		$this->addCondition($query, 'parent');
		$this->addCondition($query, 'account_id');
		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		if (($pos = strrpos($attribute, '.')) !== false) {
			$modelAttribute = substr($attribute, $pos + 1);
		} else {
			$modelAttribute = $attribute;
		}

		$value = $this->$modelAttribute;
		if (trim($value) === '') {
			return;
		}
		if ($partialMatch) {
			$query->andWhere(['like', $attribute, $value]);
		} else {
			$query->andWhere([$attribute => $value]);
		}
	}
}
