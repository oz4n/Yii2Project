<?php

namespace app\modules\dao\ar;

use Yii;
use yii\db\ActiveQuery as createProvinceQuery;
/**
 * This is the model class for table "province".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $type
 * @property string $create_et
 * @property string $update_et
 *
 * @property Member[] $members
 * @property Province $parent
 * @property Province[] $provinces
 * 
 */
class Province extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name', 'type'], 'required'],
            [['create_et', 'update_et'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 45]
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
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'create_et' => Yii::t('app', 'Create Et'),
            'update_et' => Yii::t('app', 'Update Et'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['province_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Province::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvinces()
    {
        return $this->hasMany(Province::className(), ['parent_id' => 'id']);
    }

   

}
