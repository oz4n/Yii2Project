<?php

namespace app\modules\dao\ar;

use Yii;

/**
 * This is the model class for table "taxonomy".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $term_id
 * @property string $name
 * @property string $description
 * @property string $count
 * @property string $slug
 * @property string $status
 * @property integer $position
 * @property integer $lft
 * @property integer $rgt
 * @property integer $root
 * @property integer $lvl
 * @property string $create_et
 * @property string $update_et
 *
 * @property MemberHasTaxonomy $memberHasTaxonomy
 * @property Member[] $members
 * @property Taxfilerelations $taxfilerelations
 * @property File[] $files
 * @property Terminologi $term
 * @property Taxonomy $parent
 * @property Taxonomy[] $taxonomies
 * @property Taxpostrelations $taxpostrelations
 * @property Post[] $posts
 * @property UserLogHasTaxonomy $userLogHasTaxonomy
 * @property UserLog[] $userLogs
 */
class Taxonomy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'taxonomy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'term_id', 'position', 'lft', 'rgt', 'root', 'lvl'], 'integer'],
            [['term_id', 'name', 'slug'], 'required'],
            [['create_et', 'update_et'], 'safe'],
            [['name', 'description', 'slug'], 'string', 'max' => 255],
            [['count', 'status'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'term_id' => Yii::t('app', 'Term ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'count' => Yii::t('app', 'Count'),
            'slug' => Yii::t('app', 'Slug'),
            'status' => Yii::t('app', 'Status'),
            'position' => Yii::t('app', 'Position'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'root' => Yii::t('app', 'Root'),
            'lvl' => Yii::t('app', 'Lvl'),
            'create_et' => Yii::t('app', 'Create Et'),
            'update_et' => Yii::t('app', 'Update Et'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberHasTaxonomy()
    {
        return $this->hasOne(MemberHasTaxonomy::className(), ['taxonomy_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['id' => 'member_id'])->viaTable('member_has_taxonomy', ['taxonomy_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxfilerelations()
    {
        return $this->hasOne(Taxfilerelations::className(), ['tax_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['id' => 'file_id'])->viaTable('taxfilerelations', ['tax_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerm()
    {
        return $this->hasOne(Terminologi::className(), ['id' => 'term_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxonomies()
    {
        return $this->hasMany(Taxonomy::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxpostrelations()
    {
        return $this->hasOne(Taxpostrelations::className(), ['tax_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'post_id'])->viaTable('taxpostrelations', ['tax_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLogHasTaxonomy()
    {
        return $this->hasOne(UserLogHasTaxonomy::className(), ['taxonomy_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLogs()
    {
        return $this->hasMany(UserLog::className(), ['id' => 'user_log_id'])->viaTable('user_log_has_taxonomy', ['taxonomy_id' => 'id']);
    }
}
