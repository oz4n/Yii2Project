<?php

namespace app\modules\dao\ar;

use Yii;

/**
 * This is the model class for table "member_has_taxonomy".
 *
 * @property integer $member_id
 * @property integer $taxonomy_id
 *
 * @property Member $member
 * @property Taxonomy $taxonomy
 */
class MemberHasTaxonomy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member_has_taxonomy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'taxonomy_id'], 'required'],
            [['member_id', 'taxonomy_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'member_id' => Yii::t('app', 'Member ID'),
            'taxonomy_id' => Yii::t('app', 'Taxonomy ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxonomy()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'taxonomy_id']);
    }
}
