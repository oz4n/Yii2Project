<?php

namespace app\modules\ActiveRecord;

/**
 * This is the model class for table "terminologi".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 *
 * @property TermTaxonomy[] $termTaxonomies
 */
class Terminologi extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'terminologi';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['slug'], 'required'],
			[['slug'], 'string'],
			[['name'], 'string', 'max' => 255]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Name',
			'slug' => 'Slug',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTermTaxonomies()
	{
		return $this->hasMany(TermTaxonomy::className(), ['parent' => 'id']);
	}
}
