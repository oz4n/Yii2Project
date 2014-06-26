<?php

namespace app\modules\dao\ar;

use Yii;

/**
 * This is the model class for table "setting".
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 * @property string $name
 * @property string $status
 * @property string $create_et
 * @property string $update_et
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['value'], 'string'],
            [['create_et', 'update_et'], 'safe'],
            [['key', 'name'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
            'create_et' => Yii::t('app', 'Create Et'),
            'update_et' => Yii::t('app', 'Update Et'),
        ];
    }
}
