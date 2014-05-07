<?php

namespace app\modules\dao\ar;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property integer $id
 * @property integer $province_id
 * @property integer $school_id
 * @property integer $user_id
 * @property string $nra
 * @property string $name
 * @property string $nickname
 * @property string $unit
 * @property string $front_photo
 * @property string $side_photo
 * @property string $address
 * @property string $birth
 * @property string $nationality
 * @property string $religion
 * @property string $gender
 * @property string $marital_status
 * @property string $job
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
 * @property string $membership_status
 * @property string $status_organization
 * @property string $identity_card
 * @property string $identity_card_number
 * @property string $certificate_of_organization
 * @property string $names_recommended
 * @property string $note
 * @property string $create_et
 * @property string $update_et
 *
 * @property Province $province
 * @property School $school
 * @property User $user
 * @property MemberHasTaxonomy $memberHasTaxonomy
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
            [['province_id', 'school_id', 'user_id', 'number_of_brothers', 'number_of_sisters', 'number_of_children'], 'integer'],
            [['nra', 'name', 'nickname', 'unit', 'address', 'birth', 'nationality', 'religion', 'gender', 'marital_status', 'blood_group', 'educational_status', 'phone_number', 'other_phone_number', 'email', 'year', 'height_body', 'weight_body', 'identity_card_number', 'certificate_of_organization', 'names_recommended', 'note'], 'required'],
            [['front_photo', 'side_photo', 'identity_card_number', 'certificate_of_organization'], 'string'],
            [['create_et', 'update_et'], 'safe'],
            [['nra'], 'string', 'max' => 32],
            [['name', 'nationality', 'job', 'father_name', 'mother_name', 'father_work', 'mother_work', 'income_father', 'income_mothers', 'email', 'organizational_experience', 'year', 'illness'], 'string', 'max' => 45],
            [['nickname', 'birth', 'relationship_phone_number', 'membership_status', 'status_organization', 'identity_card'], 'string', 'max' => 25],
            [['unit', 'blood_group', 'height_body', 'weight_body', 'dress_size', 'pants_size', 'shoe_size', 'hat_size'], 'string', 'max' => 5],
            [['address', 'names_recommended', 'note'], 'string', 'max' => 255],
            [['religion', 'gender', 'marital_status', 'educational_status', 'zip_code', 'phone_number', 'other_phone_number'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
//    public function attributeLabels()
//    {
//        return [
//            'id' => Yii::t('app', 'ID'),
//            'province_id' => Yii::t('app', 'Province ID'),
//            'school_id' => Yii::t('app', 'School ID'),
//            'user_id' => Yii::t('app', 'User ID'),
//            'nra' => Yii::t('app', 'Nra'),
//            'name' => Yii::t('app', 'Name'),
//            'nickname' => Yii::t('app', 'Nickname'),
//            'unit' => Yii::t('app', 'Unit'),
//            'front_photo' => Yii::t('app', 'Front Photo'),
//            'side_photo' => Yii::t('app', 'Side Photo'),
//            'address' => Yii::t('app', 'Address'),
//            'birth' => Yii::t('app', 'Birth'),
//            'nationality' => Yii::t('app', 'Nationality'),
//            'religion' => Yii::t('app', 'Religion'),
//            'gender' => Yii::t('app', 'Gender'),
//            'marital_status' => Yii::t('app', 'Marital Status'),
//            'job' => Yii::t('app', 'Job'),
//            'blood_group' => Yii::t('app', 'Blood Group'),
//            'father_name' => Yii::t('app', 'Father Name'),
//            'mother_name' => Yii::t('app', 'Mother Name'),
//            'father_work' => Yii::t('app', 'Father Work'),
//            'mother_work' => Yii::t('app', 'Mother Work'),
//            'income_father' => Yii::t('app', 'Income Father'),
//            'income_mothers' => Yii::t('app', 'Income Mothers'),
//            'number_of_brothers' => Yii::t('app', 'Number Of Brothers'),
//            'number_of_sisters' => Yii::t('app', 'Number Of Sisters'),
//            'number_of_children' => Yii::t('app', 'Number Of Children'),
//            'educational_status' => Yii::t('app', 'Educational Status'),
//            'zip_code' => Yii::t('app', 'Zip Code'),
//            'phone_number' => Yii::t('app', 'Phone Number'),
//            'other_phone_number' => Yii::t('app', 'Other Phone Number'),
//            'relationship_phone_number' => Yii::t('app', 'Relationship Phone Number'),
//            'email' => Yii::t('app', 'Email'),
//            'organizational_experience' => Yii::t('app', 'Organizational Experience'),
//            'year' => Yii::t('app', 'Year'),
//            'illness' => Yii::t('app', 'Illness'),
//            'height_body' => Yii::t('app', 'Height Body'),
//            'weight_body' => Yii::t('app', 'Weight Body'),
//            'dress_size' => Yii::t('app', 'Dress Size'),
//            'pants_size' => Yii::t('app', 'Pants Size'),
//            'shoe_size' => Yii::t('app', 'Shoe Size'),
//            'hat_size' => Yii::t('app', 'Hat Size'),
//            'membership_status' => Yii::t('app', 'Membership Status'),
//            'status_organization' => Yii::t('app', 'Status Organization'),
//            'identity_card' => Yii::t('app', 'Identity Card'),
//            'identity_card_number' => Yii::t('app', 'Identity Card Number'),
//            'certificate_of_organization' => Yii::t('app', 'Certificate Of Organization'),
//            'names_recommended' => Yii::t('app', 'Names Recommended'),
//            'note' => Yii::t('app', 'Note'),
//            'create_et' => Yii::t('app', 'Create Et'),
//            'update_et' => Yii::t('app', 'Update Et'),
//        ];
//    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'province_id' => Yii::t('app', 'Province ID'),
            'school_id' => Yii::t('app', 'School ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'nra' => Yii::t('app', 'Nomor Registrasi Anggota'),
            'name' => Yii::t('app', 'Nama Lengkap'),
            'nickname' => Yii::t('app', 'Nama Panggilan'),
            'unit' => Yii::t('app', 'Satuan'),
            'front_photo' => Yii::t('app', 'Poto Tampak Depan'),
            'side_photo' => Yii::t('app', 'Poto Tampak Samping'),
            'address' => Yii::t('app', 'Alamat Lengkap'),
            'birth' => Yii::t('app', 'Tanggal Lahir'),
            'nationality' => Yii::t('app', 'Kebangsaan'),
            'religion' => Yii::t('app', 'Agama'),
            'gender' => Yii::t('app', 'Jenis Kelamin'),
            'marital_status' => Yii::t('app', 'Status Perkawinan'),
            'job' => Yii::t('app', 'Pekerjaan'),
            'blood_group' => Yii::t('app', 'Golongan Darah'),
            'father_name' => Yii::t('app', 'Nama Bapak'),
            'mother_name' => Yii::t('app', 'Nama Ibu'),
            'father_work' => Yii::t('app', 'Pekerjaan Bapak'),
            'mother_work' => Yii::t('app', 'Pekerjaan Ibu'),
            'income_father' => Yii::t('app', 'Penghasilan Bapak'),
            'income_mothers' => Yii::t('app', 'Penghasilan Ibu'),
            'number_of_brothers' => Yii::t('app', 'Jumlah Saudara Laki-Laki'),
            'number_of_sisters' => Yii::t('app', 'Jumlah Saudara Perempuan'),
            'number_of_children' => Yii::t('app', 'Jumlah Anak Kandung'),
            'educational_status' => Yii::t('app', 'Status Pendidikan'),
            'zip_code' => Yii::t('app', 'Kode Post'),
            'phone_number' => Yii::t('app', 'Nomor Henpon'),
            'other_phone_number' => Yii::t('app', 'Nomor Henpon Lainya'),
            'relationship_phone_number' => Yii::t('app', 'Status Hubungan Dengan Nomor Henpon'),
            'email' => Yii::t('app', 'Email'),
            'organizational_experience' => Yii::t('app', 'Pengalaman Organisasi'),
            'year' => Yii::t('app', 'Angkatan Tahun'),
            'illness' => Yii::t('app', 'Penyakit Yang diderita'),
            'height_body' => Yii::t('app', 'Tinggi Badan'),
            'weight_body' => Yii::t('app', 'Berat Badan'),
            'dress_size' => Yii::t('app', 'Ukuran Baju'),
            'pants_size' => Yii::t('app', 'Ukuran Celana'),
            'shoe_size' => Yii::t('app', 'Ukuran Sepatu'),
            'hat_size' => Yii::t('app', 'Ukuran Topi'),
            'membership_status' => Yii::t('app', 'Membership Status'),
            'status_organization' => Yii::t('app', 'Status Organization'),
            'identity_card' => Yii::t('app', 'Identity Card'),
            'identity_card_number' => Yii::t('app', 'Nomor Kartu Tanda Penduduk (KTP)'),
            'certificate_of_organization' => Yii::t('app', 'Sertifikat Organisasi'),
            'names_recommended' => Yii::t('app', 'Nama Angkatan Yang merekomendasi'),
            'note' => Yii::t('app', 'Catatan'),
            'create_et' => Yii::t('app', 'Create Et'),
            'update_et' => Yii::t('app', 'Update Et'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['id' => 'province_id']);
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberHasTaxonomy()
    {
        return $this->hasOne(MemberHasTaxonomy::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxonomies()
    {
        return $this->hasMany(Taxonomy::className(), ['id' => 'taxonomy_id'])->viaTable('member_has_taxonomy', ['member_id' => 'id']);
    }

}
