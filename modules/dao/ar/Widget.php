<?php

namespace app\modules\dao\ar;

use Yii;

/**
 * This is the model class for table "widget".
 *
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $status
 * @property integer $position
 * @property string $type
 * @property string $create_et
 * @property string $update_et
 */
class Widget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'widget';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'create_et', 'update_et'], 'required'],
            [['content'], 'string'],
            [['position'], 'integer'],
            [['create_et', 'update_et'], 'safe'],
            [['name', 'status', 'type'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
            'position' => Yii::t('app', 'Position'),
            'type' => Yii::t('app', 'Type'),
            'create_et' => Yii::t('app', 'Create Et'),
            'update_et' => Yii::t('app', 'Update Et'),
        ];
    }
}
