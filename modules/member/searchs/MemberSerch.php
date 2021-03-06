<?php

namespace app\modules\member\searchs;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\modules\member\models\MemberModel;
use app\modules\member\models\AreaModel;
use app\modules\member\models\LanguageSkillModel;
use app\modules\member\models\LifeSkillModel;
use app\modules\member\models\SchoolModel;
use app\modules\member\models\YearModel;
use app\modules\member\models\BrevetAwardModel;

/**
 * MemberSerch represents the model behind the search form about `app\modules\member\models\MemberModel`.
 */
class MemberSerch extends MemberModel
{
    private static $_items = array();
    private static $_list = array(NULL => 'None');

    private $year_filtr1;
    private $year_filtr2;
    private $year_filtr3;
    private $year_filtr4;
    private $year_opsi;
    private $year_opsi1;

    public $keyword;

    public function rules()
    {
        return [
            [['id', 'taxonomy_id', 'school_id', 'user_id', 'number_of_brothers', 'number_of_sisters', 'number_of_children'], 'integer'],
            [['nra', 'name', 'nickname', 'front_photo', 'side_photo', 'address', 'birth', 'nationality', 'religion', 'gender', 'marital_status', 'job', 'blood_group', 'father_name', 'mother_name', 'father_work', 'mother_work', 'income_father', 'income_mothers', 'educational_status', 'zip_code', 'phone_number', 'other_phone_number', 'relationship_phone_number', 'email', 'organizational_experience', 'year', 'illness', 'height_body', 'weight_body', 'dress_size', 'pants_size', 'shoe_size', 'hat_size', 'membership_status', 'status_organization', 'identity_card', 'identity_card_number', 'certificate_of_organization', 'names_recommended','brevetaward', 'lifeskill', 'languageskill', 'tribal_members', 'save_status', 'note', 'create_et', 'update_et', 'other_content'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params, $pageSize = 20)
    {
        $query = MemberModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if (isset($params['MemberSerch']['year_filtr1'])) {
            $this->year_filtr1 = $params['MemberSerch']['year_filtr1'];
        }

        if (isset($params['MemberSerch']['year_filtr2'])) {
            $this->year_filtr2 = $params['MemberSerch']['year_filtr2'];
        }

        if (isset($params['MemberSerch']['year_opsi'])) {
            $this->year_opsi = $params['MemberSerch']['year_opsi'];
        }

        switch ($this->year_opsi) {
            case "and":
                $query->orFilterWhere(['like', 'year', $this->year_filtr1]);
                $query->orFilterWhere(['like', 'year', $this->year_filtr2]);
                break;
            case "s/d":
                if ((int)$this->year_filtr1 <= (int)$this->year_filtr2) {
                    $con = (int)$this->year_filtr2 - (int)$this->year_filtr1;
                    for ($i = 0; $i <= $con; $i++) {
                        $query->orFilterWhere(['like', 'year', (int)$this->year_filtr1 + $i]);
                    }
                } elseif ((int)$this->year_filtr2 <= (int)$this->year_filtr1) {
                    $con = (int)$this->year_filtr1 - (int)$this->year_filtr2;
                    for ($i = 0; $i <= $con; $i++) {
                        $query->orFilterWhere(['like', 'year', (int)$this->year_filtr2 + $i]);
                    }
                } elseif ((int)$this->year_filtr1 == (int)$this->year_filtr2) {
                    $query->orFilterWhere(['like', 'year', $this->year_filtr1]);
                }
                break;
            case null:
                break;
        }


        if (isset($params['MemberSerch']['year_filtr3'])) {
            $this->year_filtr3 = $params['MemberSerch']['year_filtr3'];
        }

        if (isset($params['MemberSerch']['year_filtr4'])) {
            $this->year_filtr4 = $params['MemberSerch']['year_filtr4'];
        }

        if (isset($params['MemberSerch']['year_opsi1'])) {
            $this->year_opsi1 = $params['MemberSerch']['year_opsi1'];
        }

        switch ($this->year_opsi1) {
            case "and":
                $query->orFilterWhere(['like', 'year', $this->year_filtr3]);
                $query->orFilterWhere(['like', 'year', $this->year_filtr4]);
                break;
            case "s/d":
                if ((int)$this->year_filtr3 <= (int)$this->year_filtr4) {
                    $con = (int)$this->year_filtr4 - (int)$this->year_filtr3;
                    for ($i = 0; $i <= $con; $i++) {
                        $query->orFilterWhere(['like', 'year', (int)$this->year_filtr3 + $i]);
                    }
                } elseif ((int)$this->year_filtr4 <= (int)$this->year_filtr3) {
                    $con = (int)$this->year_filtr3 - (int)$this->year_filtr4;
                    for ($i = 0; $i <= $con; $i++) {
                        $query->orFilterWhere(['like', 'year', (int)$this->year_filtr4 + $i]);
                    }
                } elseif ((int)$this->year_filtr3 == (int)$this->year_filtr4) {
                    $query->orFilterWhere(['like', 'year', $this->year_filtr3]);
                }
                break;
            case null:
                break;
        }

        if (isset($params['MemberSerch']['keyword'])) {
            $this->keyword = $params['MemberSerch']['keyword'];
            $query->orFilterWhere(['like', 'nra', $this->keyword])
                ->orFilterWhere(['like', 'name', $this->keyword])
                ->orFilterWhere(['like', 'nickname', $this->keyword])
                ->orFilterWhere(['like', 'front_photo', $this->keyword])
                ->orFilterWhere(['like', 'side_photo', $this->keyword])
                ->orFilterWhere(['like', 'address', $this->keyword])
                ->orFilterWhere(['like', 'birth', $this->keyword])
                ->orFilterWhere(['like', 'nationality', $this->keyword])
                ->orFilterWhere(['like', 'religion', $this->keyword])
                ->orFilterWhere(['like', 'gender', $this->keyword])
                ->orFilterWhere(['like', 'marital_status', $this->keyword])
                ->orFilterWhere(['like', 'job', $this->keyword])
                ->orFilterWhere(['like', 'blood_group', $this->keyword])
                ->orFilterWhere(['like', 'father_name', $this->keyword])
                ->orFilterWhere(['like', 'mother_name', $this->keyword])
                ->orFilterWhere(['like', 'father_work', $this->keyword])
                ->orFilterWhere(['like', 'mother_work', $this->keyword])
                ->orFilterWhere(['like', 'income_father', $this->keyword])
                ->orFilterWhere(['like', 'income_mothers', $this->keyword])
                ->orFilterWhere(['like', 'educational_status', $this->keyword])
                ->orFilterWhere(['like', 'zip_code', $this->keyword])
                ->orFilterWhere(['like', 'phone_number', $this->keyword])
                ->orFilterWhere(['like', 'other_phone_number', $this->keyword])
                ->orFilterWhere(['like', 'relationship_phone_number', $this->keyword])
                ->orFilterWhere(['like', 'email', $this->email])
                ->orFilterWhere(['like', 'organizational_experience', $this->keyword])
                ->orFilterWhere(['like', 'year', $this->keyword])
                ->orFilterWhere(['like', 'illness', $this->keyword])
                ->orFilterWhere(['like', 'height_body', $this->keyword])
                ->orFilterWhere(['like', 'weight_body', $this->keyword])
                ->orFilterWhere(['like', 'dress_size', $this->keyword])
                ->orFilterWhere(['like', 'pants_size', $this->keyword])
                ->orFilterWhere(['like', 'shoe_size', $this->keyword])
                ->orFilterWhere(['like', 'hat_size', $this->keyword])
                ->orFilterWhere(['like', 'membership_status', $this->keyword])
                ->orFilterWhere(['like', 'status_organization', $this->keyword])
                ->orFilterWhere(['like', 'identity_card', $this->keyword])
                ->orFilterWhere(['like', 'identity_card_number', $this->keyword])
                ->orFilterWhere(['like', 'certificate_of_organization', $this->keyword])
                ->orFilterWhere(['like', 'names_recommended', $this->keyword])
                ->orFilterWhere(['like', 'other_content', $this->keyword])
                ->orFilterWhere(['like', 'save_status', $this->keyword])
                ->orFilterWhere(['like', 'create_et', $this->keyword])
                ->orFilterWhere(['like', 'update_et', $this->keyword])
                ->orFilterWhere(['like', 'note', $this->keyword]);
        }

        $query->andFilterWhere(['like', 'nra', $this->nra])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
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
            ->andFilterWhere(['like', 'other_content', $this->other_content])
            ->andFilterWhere(['like', 'save_status', $this->save_status])
            ->andFilterWhere(['like', 'other_content', $this->language_skills])
            ->andFilterWhere(['like', 'create_et', $this->create_et])
            ->andFilterWhere(['like', 'update_et', $this->update_et])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }

    public static function getSchools($none = 'None')
    {
        $models = SchoolModel::find();
        $data = ArrayHelper::map($models->asArray()->all(), 'id', 'name');
        return ArrayHelper::merge(['' => $none], $data);
    }


    public static function getAreas()
    {
        self::getAreaItems();
        return ArrayHelper::merge(self::$_list, self::$_items);
    }

    protected static function getAreaItems()
    {

        $models = AreaModel::find();
        $models->where(['term_id' => MEMBER_AREA]);

//        $models->orderBy([
//            'root' => SORT_ASC,
//            'lft' => SORT_ASC
//        ]);
        $models->where(['term_id' => MEMBER_AREA]);
        foreach ($models->all() as $model) {
            if ($model->level == 1) {
                self::$_items[$model->id] = $model->name;
            } else {
                self::$_items[$model->id] = html_entity_decode(self::getLine($model->level)) . $model->name;
            }
        }
    }

    public static function getBrevetAwards($none = 'None')
    {
        $models = BrevetAwardModel::find();
        $models->where(['term_id' => MEMBER_BREVET]);
        $data = ArrayHelper::map($models->asArray()->all(), 'id', 'name');
//        return $data;
        return ArrayHelper::merge($data, ['' => $none]);
    }

    public static function getLifeSkills($none = 'None')
    {
        $models = LifeSkillModel::find();
        $models->where(['term_id' => MEMBER_SKILL]);
        $data = ArrayHelper::map($models->asArray()->all(), 'id', 'name');
//        return $data;
        return ArrayHelper::merge($data, ['' => $none]);
    }


    public static function getLangSkills($none = 'None')
    {
        $models = LanguageSkillModel::find();
        $models->where(['term_id' => MEMBER_LANG_SKILL]);
        $data = ArrayHelper::map($models->asArray()->all(), 'id', 'name');
//        return $data;
        return ArrayHelper::merge($data, ['' => $none]);
    }


    public static function getYears($none = 'None')
    {
        $models = YearModel::find();
        $models->where(['term_id' => MEMBER_YEAR]);
        $models->orderBy(['name' => SORT_DESC]);
        $data = ArrayHelper::map($models->asArray()->all(), 'name', 'name');
        return ArrayHelper::merge(['' => $none], $data);
    }

    protected static function getLine($model)
    {
        $line = '';
        for ($i = 0; $i < $model; $i++) {
            $line .= "&nbsp;";
        }
        return $line;
    }

}
