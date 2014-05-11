<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/8/14
 * Time: 5:57 PM
 */

namespace app\modules\member\models;


use Yii;
use app\modules\dao\ar\Member;
use app\modules\member\models\AreaModel;
use app\modules\member\models\SchoolModel;
use app\modules\dao\ar\Taxmemberrelations;

class MemberModel extends Member
{
    public $language_skills;
    public $life_skill;
    public $brevet_award;
    public $keyword;

    public function attributeLabels()
    {
        if (parent::attributeLabels()) {
            return [
                'id' => Yii::t('app', 'ID'),
                'taxonomy_id' => Yii::t('app', 'Asal Daerah'),
                'school_id' => Yii::t('app', 'Asal Sekolah'),
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
                'year' => Yii::t('app', 'Tahun Angkatan'),
                'illness' => Yii::t('app', 'Penyakit Yang diderita'),
                'height_body' => Yii::t('app', 'Tinggi Badan'),
                'weight_body' => Yii::t('app', 'Berat Badan'),
                'dress_size' => Yii::t('app', 'Ukuran Baju'),
                'pants_size' => Yii::t('app', 'Ukuran Celana'),
                'shoe_size' => Yii::t('app', 'Ukuran Sepatu'),
                'hat_size' => Yii::t('app', 'Ukuran Topi'),
                'membership_status' => Yii::t('app', 'Status Keanggotaan'),
                'status_organization' => Yii::t('app', 'Status Organisasi'),
                'identity_card' => Yii::t('app', 'Identity Card'),
                'identity_card_number' => Yii::t('app', 'Nomor Kartu Tanda Penduduk (KTP)'),
                'certificate_of_organization' => Yii::t('app', 'Sertifikat Organisasi'),
                'names_recommended' => Yii::t('app', 'Nama Angkatan Yang merekomendasi'),
                'save_status' => Yii::t('app', 'Status'),
                'note' => Yii::t('app', 'Catatan'),

                'language_skills' => Yii::t('app', 'Keterampilan Bahasa Asing'),
                'life_skill' => Yii::t('app', 'Keterampilan Personal'),
                'brevet_award' => Yii::t('app', 'Brevet Penghargaan'),

//                'language_skills' => Yii::t('app', 'Language Skills'),
//                'life_skill' => Yii::t('app', 'Life Skill'),
//                'brevet_award' => Yii::t('app', 'Brevet Award'),
            ];
        }
    }

    public function getAreaName()
    {
        $m = AreaModel::findBySql("SELECT * FROM taxonomy WHERE id='" . $this->taxonomy_id . "'")->one();
        return $m["name"];
    }

    public function getSchollName()
    {
        $m = SchoolModel::findBySql("SELECT * FROM school WHERE id='" . $this->school_id . "'")->one();
        return $m["name"];
    }

    public function getSkillNamaById($id)
    {
        $query = LifeSkillModel::findOne($id);
        return $query->name;
    }

    public function getAllSkillById($data = [])
    {
        $_list = [];
        foreach ($data as $id) {
            $_list[] = $this->getSkillNamaById($id);
        }
        return $_list;
    }

    public function saveSkillRelation($data = [], $member_id)
    {
        foreach ($data as $id) {
            Taxmemberrelations::deleteAll([
                'taxonomy_id' => $id,
                'member_id' => $member_id
            ]);
            $new = new Taxmemberrelations;
            $new->member_id = $member_id;
            $new->taxonomy_id = $id;
            $new->save();
        }
        return true;
    }
} 