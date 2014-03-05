<?php

namespace app\modules\ActiveRecord;

/**
 * This is the model class for table "term_taxonomy".
 *
 * @property integer $id
 * @property string $type
 * @property string $description
 * @property string $count
 * @property string $status
 * @property integer $position
 * @property integer $parent
 * @property integer $term_taxonomy_id
 *
 * @property Relationships $relationships
 * @property Post[] $posts
 * @property Terminologi $parent0
 * @property TermTaxonomy $termTaxonomy
 * @property TermTaxonomy[] $termTaxonomies
 */
class TermTaxonomy extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'term_taxonomy';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['type', 'term_taxonomy_id'], 'required'],
			[['position', 'parent', 'term_taxonomy_id'], 'integer'],
			[['type', 'description'], 'string', 'max' => 255],
			[['count', 'status'], 'string', 'max' => 45]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'type' => 'Type',
			'description' => 'Description',
			'count' => 'Count',
			'status' => 'Status',
			'position' => 'Position',
			'parent' => 'Parent',
			'term_taxonomy_id' => 'Term Taxonomy ID',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRelationships()
	{
		return $this->hasOne(Relationships::className(), ['term_taxonomy_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPosts()
	{
		return $this->hasMany(Post::className(), ['id' => 'post_id'])->viaTable('relationships', ['term_taxonomy_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getParent0()
	{
		return $this->hasOne(Terminologi::className(), ['id' => 'parent']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTermTaxonomy()
	{
		return $this->hasOne(TermTaxonomy::className(), ['id' => 'term_taxonomy_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTermTaxonomies()
	{
		return $this->hasMany(TermTaxonomy::className(), ['term_taxonomy_id' => 'id']);
	}
}
