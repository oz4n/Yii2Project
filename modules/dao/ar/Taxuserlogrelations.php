<?php

namespace app\modules\dao\ar;

use Yii;

/**
 * This is the model class for table "taxuserlogrelations".
 *
 * @property integer $user_log_id
 * @property integer $taxonomy_id
 *
 * @property UserLog $userLog
 * @property Taxonomy $taxonomy
 */
class Taxuserlogrelations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'taxuserlogrelations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_log_id', 'taxonomy_id'], 'required'],
            [['user_log_id', 'taxonomy_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_log_id' => Yii::t('app', 'User Log ID'),
            'taxonomy_id' => Yii::t('app', 'Taxonomy ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLog()
    {
        return $this->hasOne(UserLog::className(), ['id' => 'user_log_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxonomy()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'taxonomy_id']);
    }
}
