<?php

namespace app\modules\member\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\member\models\MemberModel;
use app\modules\member\models\SchoolModel;
use app\modules\member\models\ProvinceModel;
use app\modules\member\models\LifeSkillModel;
use app\modules\member\models\LanguageSkillModel;
use app\modules\member\models\YearModel;
use yii\helpers\ArrayHelper;

/**
 * MemberSerch represents the model behind the search form about `app\modules\dao\ar\Member`.
 */
class MemberSerch extends MemberModel
{

    private static $_items = array();
    private static $_list = array(NULL => 'None');
    private static $_school_items = array();
    private static $_school_list = array(NULL => 'None');
    private static $_life_skills_items = array();
    private static $_life_skills_list = array(NULL => 'Lainya');
    private static $_lang_skills_items = array();
    private static $_lang_skills_list = array(NULL => 'Lainya');
    private static $_year_items = array();
    private static $_year_list = array(NULL => 'None');

    public function rules()
    {
        return [
            [['id', 'province_id', 'school_id', 'user_id', 'number_of_brothers', 'number_of_sisters', 'number_of_children'], 'integer'],
            [['nra', 'name', 'nickname', 'unit', 'front_photo', 'side_photo', 'address', 'birth', 'nationality', 'religion', 'gender', 'marital_status', 'job', 'blood_group', 'father_name', 'mother_name', 'father_work', 'mother_work', 'income_father', 'income_mothers', 'educational_status', 'zip_code', 'phone_number', 'other_phone_number', 'relationship_phone_number', 'email', 'organizational_experience', 'year', 'illness', 'height_body', 'weight_body', 'dress_size', 'pants_size', 'shoe_size', 'hat_size', 'membership_status', 'status_organization', 'identity_card', 'identity_card_number', 'certificate_of_organization', 'names_recommended', 'note', 'create_et', 'update_et'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = MemberModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

//        $query->andFilterWhere([
//            'id' => $this->id,
//            'province_id' => $this->province_id,
//            'school_id' => $this->school_id,
//            'user_id' => $this->user_id,
//            'number_of_brothers' => $this->number_of_brothers,
//            'number_of_sisters' => $this->number_of_sisters,
//            'number_of_children' => $this->number_of_children,
//            'create_et' => $this->create_et,
//            'update_et' => $this->update_et,
//        ]);

        if (isset($params['MemberSerch']['keyword'])) {
            $keyword = $params['MemberSerch']['keyword'];
            $query->orFilterWhere(['like', 'nra', $keyword])
                ->orFilterWhere(['like', 'name', $keyword])
                ->orFilterWhere(['like', 'nickname', $keyword])
                ->orFilterWhere(['like', 'unit', $keyword])
                ->orFilterWhere(['like', 'front_photo', $keyword])
                ->orFilterWhere(['like', 'side_photo', $keyword])
                ->orFilterWhere(['like', 'address', $keyword])
                ->orFilterWhere(['like', 'birth', $keyword])
                ->orFilterWhere(['like', 'nationality', $keyword])
                ->orFilterWhere(['like', 'religion', $keyword])
                ->orFilterWhere(['like', 'gender', $keyword])
                ->orFilterWhere(['like', 'marital_status', $keyword])
                ->orFilterWhere(['like', 'job', $keyword])
                ->orFilterWhere(['like', 'blood_group', $keyword])
                ->orFilterWhere(['like', 'father_name', $keyword])
                ->orFilterWhere(['like', 'mother_name', $keyword])
                ->orFilterWhere(['like', 'father_work', $keyword])
                ->orFilterWhere(['like', 'mother_work', $keyword])
                ->orFilterWhere(['like', 'income_father', $keyword])
                ->orFilterWhere(['like', 'income_mothers', $keyword])
                ->orFilterWhere(['like', 'educational_status', $keyword])
                ->orFilterWhere(['like', 'zip_code', $keyword])
                ->orFilterWhere(['like', 'phone_number', $keyword])
                ->orFilterWhere(['like', 'other_phone_number', $keyword])
                ->orFilterWhere(['like', 'relationship_phone_number', $keyword])
                ->orFilterWhere(['like', 'email', $this->email])
                ->orFilterWhere(['like', 'organizational_experience', $keyword])
                ->orFilterWhere(['like', 'year', $keyword])
                ->orFilterWhere(['like', 'illness', $keyword])
                ->orFilterWhere(['like', 'height_body', $keyword])
                ->orFilterWhere(['like', 'weight_body', $keyword])
                ->orFilterWhere(['like', 'dress_size', $keyword])
                ->orFilterWhere(['like', 'pants_size', $keyword])
                ->orFilterWhere(['like', 'shoe_size', $keyword])
                ->orFilterWhere(['like', 'hat_size', $keyword])
                ->orFilterWhere(['like', 'membership_status', $keyword])
                ->orFilterWhere(['like', 'status_organization', $keyword])
                ->orFilterWhere(['like', 'identity_card', $keyword])
                ->orFilterWhere(['like', 'identity_card_number', $keyword])
                ->orFilterWhere(['like', 'certificate_of_organization', $keyword])
                ->orFilterWhere(['like', 'names_recommended', $keyword])
                ->orFilterWhere(['like', 'note', $keyword]);
        }

        $query->andFilterWhere(['like', 'nra', $this->nra])
                ->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'nickname', $this->nickname])
                ->andFilterWhere(['like', 'unit', $this->unit])
                ->andFilterWhere(['like', 'front_photo', $this->front_photo])
                ->andFilterWhere(['like', 'side_photo', $this->side_photo])
                ->andFilterWhere(['like', 'address', $this->address])
                ->andFilterWhere(['like', 'birth', $this->birth])
                ->andFilterWhere(['like', 'nationality', $this->nationality])
                ->andFilterWhere(['like', 'religion', $this->religion])
                ->andFilterWhere(['like', 'gender', $this->gender])
                ->andFilterWhere(['like', 'marital_status', $this->marital_status])               
                ->andFilterWhere(['like', 'job', $this->job])
                ->andFilterWhere(['like', 'blood_group', $this->blood_group])
                ->andFilterWhere(['like', 'father_name', $this->father_name])
                ->andFilterWhere(['like', 'mother_name', $this->mother_name])
                ->andFilterWhere(['like', 'father_work', $this->father_work])
                ->andFilterWhere(['like', 'mother_work', $this->mother_work])
                ->andFilterWhere(['like', 'income_father', $this->income_father])
                ->andFilterWhere(['like', 'income_mothers', $this->income_mothers])
                ->andFilterWhere(['like', 'educational_status', $this->educational_status])
                ->andFilterWhere(['like', 'zip_code', $this->zip_code])
                ->andFilterWhere(['like', 'phone_number', $this->phone_number])
                ->andFilterWhere(['like', 'other_phone_number', $this->other_phone_number])
                ->andFilterWhere(['like', 'relationship_phone_number', $this->relationship_phone_number])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'organizational_experience', $this->organizational_experience])
                ->andFilterWhere(['like', 'year', $this->year])
                ->andFilterWhere(['like', 'illness', $this->illness])
                ->andFilterWhere(['like', 'height_body', $this->height_body])
                ->andFilterWhere(['like', 'weight_body', $this->weight_body])
                ->andFilterWhere(['like', 'dress_size', $this->dress_size])
                ->andFilterWhere(['like', 'pants_size', $this->pants_size])
                ->andFilterWhere(['like', 'shoe_size', $this->shoe_size])
                ->andFilterWhere(['like', 'hat_size', $this->hat_size])
                ->andFilterWhere(['like', 'membership_status', $this->membership_status])
                ->andFilterWhere(['like', 'status_organization', $this->status_organization])
                ->andFilterWhere(['like', 'identity_card', $this->identity_card])
                ->andFilterWhere(['like', 'identity_card_number', $this->identity_card_number])
                ->andFilterWhere(['like', 'certificate_of_organization', $this->certificate_of_organization])
                ->andFilterWhere(['like', 'names_recommended', $this->names_recommended])
                ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }

    public static function loadSchools()
    {
        $type = 'name';
        if (!isset(self::$_school_items[$type])) {
            self::loadSchoolItems($type);
        }
        return ArrayHelper::merge(self::$_school_list, self::$_school_items[$type]);
    }

    private static function loadSchoolItems($type)
    {
        self::$_school_items[$type] = array();
        $models = SchoolModel::find();
        foreach ($models->all() as $model) {
            self::$_school_items[$type][$model->id] = ucwords($model->name);
        }
    }

    public static function loadProvinces()
    {
        $type = 'name';
        if (!isset(self::$_items[$type])) {
            self::loadProvinceItems($type);
        }

        return ArrayHelper::merge(self::$_list, self::$_items[$type]);
    }

    private static function loadProvinceItems($type)
    {
        self::$_items[$type] = array();
        $models = ProvinceModel::find();
        foreach ($models->all() as $model) {
            self::$_items[$type][$model->id] = ucwords($model->name);
        }
    }

    public static function loadLifeSkills()
    {
        $type = 'name';
        if (!isset(self::$_life_skills_items[$type])) {
            self::loadLifeSkillItems($type);
        }

        return ArrayHelper::merge(self::$_life_skills_items[$type], self::$_life_skills_list);
    }

    private static function loadLifeSkillItems($type)
    {
        self::$_life_skills_items[$type] = array();
        $models = LifeSkillModel::find();
        $models->where(['term_id' => 1]);
        foreach ($models->all() as $model) {
            self::$_life_skills_items[$type][$model->id] = ucwords($model->name);
        }
    }

    public static function loadLangSkills()
    {
        $type = 'name';
        if (!isset(self::$_lang_skills_items[$type])) {
            self::loadLangSkillItems($type);
        }

        return ArrayHelper::merge(self::$_lang_skills_items[$type], self::$_lang_skills_list);
    }

    private static function loadLangSkillItems($type)
    {
        self::$_lang_skills_items[$type] = array();
        $models = LanguageSkillModel::find();
        $models->where(['term_id' => 2]);
        foreach ($models->all() as $model) {
            self::$_lang_skills_items[$type][$model->id] = ucwords($model->name);
        }
    }

    public static function loadYears()
    {
        $type = 'name';
        if (!isset(self::$_year_items[$type])) {
            self::loadYearItems($type);
        }

        return ArrayHelper::merge(self::$_year_list, self::$_year_items[$type]);
    }

    private static function loadYearItems($type)
    {
        self::$_year_items[$type] = array();
        $models = YearModel::find();
        $models->where(['term_id' => 5]);
        foreach ($models->all() as $model) {
            self::$_year_items[$type][$model->name] = ucwords($model->name);
        }
    }

}
