<?php

namespace app\modules\dao\ar;

use Yii;

/**
 * This is the model class for table "file".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $orginal_name
 * @property string $unique_name
 * @property string $type
 * @property string $size
 * @property string $file_type
 * @property string $description
 * @property string $create_at
 * @property string $update_et
 *
 * @property User $user
 * @property Taxfilerelations $taxfilerelations
 * @property Taxonomy[] $taxes
 */
class File extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['orginal_name', 'unique_name', 'type', 'size', 'file_type', 'create_at', 'update_et'], 'required'],
            [['orginal_name', 'unique_name'], 'string'],
            [['create_at', 'update_et'], 'safe'],
            [['name', 'type', 'file_type', 'description'], 'string', 'max' => 255],
            [['size'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'orginal_name' => Yii::t('app', 'Orginal Name'),
            'unique_name' => Yii::t('app', 'Unique Name'),
            'type' => Yii::t('app', 'Type'),
            'size' => Yii::t('app', 'Size'),
            'file_type' => Yii::t('app', 'File Type'),
            'description' => Yii::t('app', 'Description'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_et' => Yii::t('app', 'Update Et'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxfilerelations()
    {
        return $this->hasOne(Taxfilerelations::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxes()
    {
        return $this->hasMany(Taxonomy::className(), ['id' => 'tax_id'])->viaTable('taxfilerelations', ['file_id' => 'id']);
    }
}
