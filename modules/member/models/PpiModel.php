<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/12/14
 * Time: 2:56 PM
 */

namespace app\modules\member\models;

use Yii;
use app\modules\dao\ar\Member;
use app\modules\dao\ar\Taxmemberrelations;

class PpiModel extends Member
{
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
                'front_photo' => Yii::t('app', 'Photo Tampak Depan'),
                'side_photo' => Yii::t('app', 'Photo Tampak Samping'),
                'address' => Yii::t('app', 'Alamat Lengkap'),
                'birth' => Yii::t('app', 'Tanggal Lahir'),
                'nationality' => Yii::t('app', 'Kewarganegaraan'),
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
                'phone_number' => Yii::t('app', 'Nomor HP'),
                'other_phone_number' => Yii::t('app', 'Nomor HP Lainya'),
                'relationship_phone_number' => Yii::t('app', 'Status Hubungan Dengan Nomor HP Lainnya'),
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
                'identity_card_number' => Yii::t('app', 'Nomor KTP'),
                'certificate_of_organization' => Yii::t('app', 'Sertifikat Organisasi'),
                'names_recommended' => Yii::t('app', 'Nama Angkatan Yang merekomendasi'),
                'save_status' => Yii::t('app', 'Status'),
                'note' => Yii::t('app', 'Catatan'),
                'tribal_members' => Yii::t('app', 'Suku Bangsa'),
                'brevetaward' => Yii::t('app', 'Brevet Penghargaan'),
                'lifeskill' => Yii::t('app', 'Keterampilan Personal'),
                'languageskill' => Yii::t('app', 'Keterampilan Bahasa Asing'),
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
        if (null != $data) {
            $_list = [];
            foreach ($data as $id) {
                $_list[] = $this->getSkillNamaById($id);
            }
            return $_list;
        }
    }


} 