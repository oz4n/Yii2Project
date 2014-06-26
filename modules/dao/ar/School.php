<?php

namespace app\modules\dao\ar;

use Yii;

/**
 * This is the model class for table "school".
 *
 * @property integer $id
 * @property integer $taxonomy_id
 * @property string $name
 * @property string $type
 * @property string $address
 * @property string $email
 * @property string $zip_code
 * @property string $phone_number
 * @property string $create_et
 * @property string $update_et
 *
 * @property Member[] $members
 * @property Taxonomy $taxonomy
 */
class School extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['taxonomy_id'], 'integer'],
            [['name', 'type', 'address'], 'required', 'message' => 'Tidak boleh kosong.'],
            [['name'], 'unique', 'message' => 'Item yang anda inputkan sudah ada.'],
            [['create_et', 'update_et'], 'safe'],
            [['name', 'type', 'email', 'zip_code'], 'string', 'max' => 45],
            [['address'], 'string', 'max' => 255],
            [['phone_number'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'taxonomy_id' => Yii::t('app', 'Taxonomy ID'),
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'address' => Yii::t('app', 'Address'),
            'email' => Yii::t('app', 'Email'),
            'zip_code' => Yii::t('app', 'Zip Code'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'create_et' => Yii::t('app', 'Create Et'),
            'update_et' => Yii::t('app', 'Update Et'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['school_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxonomy()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'taxonomy_id']);
    }
}
