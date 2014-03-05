<?php

namespace app\modules\ActiveRecord;

/**
 * This is the model class for table "relationships".
 *
 * @property integer $post_id
 * @property integer $term_taxonomy_id
 *
 * @property Post $post
 * @property TermTaxonomy $termTaxonomy
 */
class Relationships extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'relationships';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['post_id', 'term_taxonomy_id'], 'required'],
			[['post_id', 'term_taxonomy_id'], 'integer']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'post_id' => 'Post ID',
			'term_taxonomy_id' => 'Term Taxonomy ID',
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
	public function getTermTaxonomy()
	{
		return $this->hasOne(TermTaxonomy::className(), ['id' => 'term_taxonomy_id']);
	}
}
