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
 * @property integer $level
 * @property string $create_et
 * @property string $update_et
 *
 * @property Member[] $members
 * @property School[] $schools
 * @property Taxfilerelations $taxfilerelations
 * @property File[] $files
 * @property Taxmemberrelations $taxmemberrelations
 * @property Terminologi $term
 * @property Taxonomy $parent
 * @property Taxonomy[] $taxonomies
 * @property Taxpostrelations $taxpostrelations
 * @property Post[] $posts
 * @property Taxuserlogrelations $taxuserlogrelations
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

    public function rules()
    {
        return [
            [['parent_id', 'term_id', 'position', 'lft', 'rgt', 'root', 'level'], 'integer'],
            [['name'], 'required'],
            [['create_et', 'update_et'], 'safe'],
            [['name', 'description', 'slug'], 'string', 'max' => 255],
            [['count', 'status'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
//    public function rules()
//    {
//        return [
//            [['parent_id', 'term_id', 'position', 'lft', 'rgt', 'root', 'level'], 'integer'],
//            [['term_id', 'name', 'slug', 'create_et', 'update_et'], 'required'],
//            [['create_et', 'update_et'], 'safe'],
//            [['name', 'description', 'slug'], 'string', 'max' => 255],
//            [['count', 'status'], 'string', 'max' => 45]
//        ];
//    }

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
            'level' => Yii::t('app', 'Level'),
            'create_et' => Yii::t('app', 'Create Et'),
            'update_et' => Yii::t('app', 'Update Et'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['id' => 'member_id'])->viaTable('taxmemberrelations', ['taxonomy_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchools()
    {
        return $this->hasMany(School::className(), ['taxonomy_id' => 'id']);
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
    public function getTaxmemberrelations()
    {
        return $this->hasOne(Taxmemberrelations::className(), ['taxonomy_id' => 'id']);
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
    public function getTaxuserlogrelations()
    {
        return $this->hasOne(Taxuserlogrelations::className(), ['taxonomy_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLogs()
    {
        return $this->hasMany(UserLog::className(), ['id' => 'user_log_id'])->viaTable('taxuserlogrelations', ['taxonomy_id' => 'id']);
    }
}
