<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/12/14
 * Time: 2:56 PM
 */

namespace app\modules\member\models;

use app\modules\dao\ar\Taxonomy;
use Yii;
use app\modules\dao\ar\Member;
use app\modules\dao\ar\Taxmemberrelations;

class PpiModel extends Member
{
    public $otherlifeskill;

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxonomiesByLangSkill()
    {
        return $this->hasMany(Taxonomy::className(), ['id' => 'taxonomy_id'])
            ->where(['term_id' => MEMBER_LANG_SKILL])
            ->viaTable('taxmemberrelations', ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxonomiesBySkill()
    {
        return $this->hasMany(Taxonomy::className(), ['id' => 'taxonomy_id'])
            ->where(['term_id' => MEMBER_SKILL])
            ->viaTable('taxmemberrelations', ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxonomiesByBrevet()
    {
        return $this->hasMany(Taxonomy::className(), ['id' => 'taxonomy_id'])
            ->where(['term_id' => MEMBER_BREVET])
            ->viaTable('taxmemberrelations', ['member_id' => 'id']);
    }

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
                'age' => Yii::t('app', 'Umur'),
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
                'phone_number' => Yii::t('app', 'No HP'),
                'other_phone_number' => Yii::t('app', 'No HP Lainya'),
                'relationship_phone_number' => Yii::t('app', 'Status Dengan No HP'),
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
                'identity_card' => Yii::t('app', 'KTP'),
                'identity_card_number' => Yii::t('app', 'Nomor KTP'),
                'certificate_of_organization' => Yii::t('app', 'Sertifikat Organisasi'),
                'names_recommended' => Yii::t('app', 'Nama Angkatan Yang merekomendasi'),
                'save_status' => Yii::t('app', 'Status'),
                'note' => Yii::t('app', 'Catatan'),
                'tribal_members' => Yii::t('app', 'Suku Bangsa'),
                'brevetaward' => Yii::t('app', 'Brevet Penghargaan'),
                'lifeskill' => Yii::t('app', 'Keterampilan Personal'),
                'otherlifeskill' => Yii::t('app', 'Keterampilan Personal Lainnya'),
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


    public function saveTaxRelation($data = [], $member_id)
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

    public function deleteAllTaxRelationByMemberId($data = [], $member_id)
    {
        foreach ($data as $id) {
            Taxmemberrelations::deleteAll([
                'taxonomy_id' => $id,
                'member_id' => $member_id
            ]);
        }

        return true;
    }

    public function getAllSkillNameById($data = [])
    {
        if (null != $data) {
            $_list = [];
            foreach ($data as $id) {
                $_list[] = $this->getSkillNamaById($id);
            }
            return $_list;
        }
    }

    public function getSkillNamaById($id)
    {
        $query = LifeSkillModel::findOne($id);
        return $query->name;
    }

    public function getAllLangSkillNameById($data = [])
    {
        if (null != $data) {
            $_list = [];
            foreach ($data as $id) {
                $_list[] = $this->getLangSkillNamaById($id);
            }
            return $_list;
        }
    }

    public function getLangSkillNamaById($id)
    {
        $query = LanguageSkillModel::findOne($id);
        return $query->name;
    }

    public function getAllBrevetNameById($data = [])
    {
        if (null != $data) {
            $_list = [];
            foreach ($data as $id) {
                $_list[] = $this->getBrevetNamaById($id);
            }
            return $_list;
        }
    }

    public function getBrevetNamaById($id)
    {
        $query = BrevetAwardModel::findOne($id);
        return $query->name;
    }

} 