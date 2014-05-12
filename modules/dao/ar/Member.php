<?php

namespace app\modules\dao\ar;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property integer $id
 * @property integer $taxonomy_id
 * @property integer $school_id
 * @property integer $user_id
 * @property string $nra
 * @property string $name
 * @property string $nickname
 * @property string $front_photo
 * @property string $side_photo
 * @property string $address
 * @property string $birth
 * @property string $nationality
 * @property string $religion
 * @property string $gender
 * @property integer $age
 * @property string $marital_status
 * @property string $job
 * @property string $income_member
 * @property string $blood_group
 * @property string $father_name
 * @property string $mother_name
 * @property string $father_work
 * @property string $mother_work
 * @property string $income_father
 * @property string $income_mothers
 * @property integer $number_of_brothers
 * @property integer $number_of_sisters
 * @property integer $number_of_children
 * @property string $educational_status
 * @property string $zip_code
 * @property string $phone_number
 * @property string $other_phone_number
 * @property string $relationship_phone_number
 * @property string $email
 * @property string $organizational_experience
 * @property string $year
 * @property string $illness
 * @property string $height_body
 * @property string $weight_body
 * @property string $dress_size
 * @property string $pants_size
 * @property string $shoe_size
 * @property string $hat_size
 * @property string $brevetaward
 * @property string $lifeskill
 * @property string $languageskill
 * @property string $membership_status
 * @property string $status_organization
 * @property string $type_member
 * @property string $tribal_members
 * @property string $identity_card
 * @property string $certificate_of_organization
 * @property string $identity_card_number
 * @property string $names_recommended
 * @property string $note
 * @property string $other_content
 * @property string $save_status
 * @property string $create_et
 * @property string $update_et
 *
 * @property School $school
 * @property Taxonomy $taxonomy
 * @property User $user
 * @property Taxmemberrelations $taxmemberrelations
 * @property Taxonomy[] $taxonomies
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['taxonomy_id', 'school_id', 'user_id', 'age', 'number_of_brothers', 'number_of_sisters', 'number_of_children'], 'integer'],
//            [['nra', 'name', 'nickname', 'front_photo', 'side_photo', 'address', 'birth', 'nationality', 'religion', 'gender', 'marital_status', 'blood_group', 'father_name', 'mother_name', 'educational_status', 'phone_number', 'other_phone_number', 'relationship_phone_number', 'email', 'year', 'illness', 'height_body', 'weight_body', 'membership_status', 'status_organization', 'type_member', 'tribal_members', 'identity_card', 'identity_card_number', 'names_recommended', 'note', 'save_status'], 'required', 'message' => 'Tidak boleh kosong.'],
            [['nra', 'name', 'nickname', 'address', 'birth', 'nationality', 'religion', 'gender', 'marital_status', 'blood_group', 'father_name', 'mother_name', 'educational_status', 'phone_number', 'other_phone_number', 'relationship_phone_number', 'email', 'year', 'illness', 'height_body', 'weight_body', 'membership_status', 'status_organization', 'type_member', 'tribal_members',  'identity_card_number', 'note', 'save_status'], 'required', 'message' => 'Tidak boleh kosong.'],

            //[['front_photo'], 'file', 'types' => ['jpg', 'png'], 'skipOnEmpty' => false, 'maxFiles' => 1, 'maxSize' => 450 * 1024, 'message' => 'Tidak boleh kosong.'],
            [['front_photo', 'side_photo', 'identity_card', 'certificate_of_organization', 'other_content'], 'string'],
            [['create_et', 'update_et'], 'safe'],
            [['nra'], 'string', 'max' => 32],
            [['name', 'nationality', 'job', 'income_member', 'father_name', 'mother_name', 'father_work', 'mother_work', 'income_father', 'income_mothers', 'email', 'organizational_experience', 'year', 'illness', 'brevetaward', 'lifeskill', 'languageskill', 'tribal_members', 'save_status'], 'string', 'max' => 45],
            [['nickname', 'birth', 'blood_group', 'relationship_phone_number', 'membership_status', 'status_organization', 'type_member', 'identity_card_number'], 'string', 'max' => 25],
            [['address', 'names_recommended', 'note'], 'string', 'max' => 255],
            [['religion', 'gender', 'marital_status', 'educational_status', 'zip_code', 'phone_number', 'other_phone_number'], 'string', 'max' => 15],
            [['height_body', 'weight_body', 'dress_size', 'pants_size', 'shoe_size', 'hat_size'], 'string', 'max' => 5]
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
            'school_id' => Yii::t('app', 'School ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'nra' => Yii::t('app', 'Nra'),
            'name' => Yii::t('app', 'Name'),
            'nickname' => Yii::t('app', 'Nickname'),
            'front_photo' => Yii::t('app', 'Front Photo'),
            'side_photo' => Yii::t('app', 'Side Photo'),
            'address' => Yii::t('app', 'Address'),
            'birth' => Yii::t('app', 'Birth'),
            'nationality' => Yii::t('app', 'Nationality'),
            'religion' => Yii::t('app', 'Religion'),
            'gender' => Yii::t('app', 'Gender'),
            'age' => Yii::t('app', 'Age'),
            'marital_status' => Yii::t('app', 'Marital Status'),
            'job' => Yii::t('app', 'Job'),
            'income_member' => Yii::t('app', 'Income Member'),
            'blood_group' => Yii::t('app', 'Blood Group'),
            'father_name' => Yii::t('app', 'Father Name'),
            'mother_name' => Yii::t('app', 'Mother Name'),
            'father_work' => Yii::t('app', 'Father Work'),
            'mother_work' => Yii::t('app', 'Mother Work'),
            'income_father' => Yii::t('app', 'Income Father'),
            'income_mothers' => Yii::t('app', 'Income Mothers'),
            'number_of_brothers' => Yii::t('app', 'Number Of Brothers'),
            'number_of_sisters' => Yii::t('app', 'Number Of Sisters'),
            'number_of_children' => Yii::t('app', 'Number Of Children'),
            'educational_status' => Yii::t('app', 'Educational Status'),
            'zip_code' => Yii::t('app', 'Zip Code'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'other_phone_number' => Yii::t('app', 'Other Phone Number'),
            'relationship_phone_number' => Yii::t('app', 'Relationship Phone Number'),
            'email' => Yii::t('app', 'Email'),
            'organizational_experience' => Yii::t('app', 'Organizational Experience'),
            'year' => Yii::t('app', 'Year'),
            'illness' => Yii::t('app', 'Illness'),
            'height_body' => Yii::t('app', 'Height Body'),
            'weight_body' => Yii::t('app', 'Weight Body'),
            'dress_size' => Yii::t('app', 'Dress Size'),
            'pants_size' => Yii::t('app', 'Pants Size'),
            'shoe_size' => Yii::t('app', 'Shoe Size'),
            'hat_size' => Yii::t('app', 'Hat Size'),
            'brevetaward' => Yii::t('app', 'Brevetaward'),
            'lifeskill' => Yii::t('app', 'Lifeskill'),
            'languageskill' => Yii::t('app', 'Languageskill'),
            'membership_status' => Yii::t('app', 'Membership Status'),
            'status_organization' => Yii::t('app', 'Status Organization'),
            'type_member' => Yii::t('app', 'Type Member'),
            'tribal_members' => Yii::t('app', 'Tribal Members'),
            'identity_card' => Yii::t('app', 'Identity Card'),
            'certificate_of_organization' => Yii::t('app', 'Certificate Of Organization'),
            'identity_card_number' => Yii::t('app', 'Identity Card Number'),
            'names_recommended' => Yii::t('app', 'Names Recommended'),
            'note' => Yii::t('app', 'Note'),
            'other_content' => Yii::t('app', 'Other Content'),
            'save_status' => Yii::t('app', 'Save Status'),
            'create_et' => Yii::t('app', 'Create Et'),
            'update_et' => Yii::t('app', 'Update Et'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchool()
    {
        return $this->hasOne(School::className(), ['id' => 'school_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxonomy()
    {
        return $this->hasOne(Taxonomy::className(), ['id' => 'taxonomy_id']);
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
    public function getTaxmemberrelations()
    {
        return $this->hasOne(Taxmemberrelations::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxonomies()
    {
        return $this->hasMany(Taxonomy::className(), ['id' => 'taxonomy_id'])->viaTable('taxmemberrelations', ['member_id' => 'id']);
    }
}
