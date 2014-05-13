<?php

namespace app\modules\member\searchs;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\modules\member\models\AreaModel;
use app\modules\member\models\BrevetAwardModel;
use app\modules\member\models\LanguageSkillModel;
use app\modules\member\models\LifeSkillModel;
use app\modules\member\models\PpiModel;
use app\modules\member\models\SchoolModel;
use app\modules\member\models\YearModel;


/**
 * PpiSerch represents the model behind the search form about `app\modules\dao\ar\PpiModel`.
 */
class PpiSerch extends PpiModel
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
            [['id', 'taxonomy_id', 'school_id', 'user_id', 'age', 'number_of_brothers', 'number_of_sisters', 'number_of_children'], 'integer'],
            [['nra', 'name', 'nickname', 'front_photo', 'side_photo', 'address', 'birth', 'nationality', 'religion', 'gender', 'marital_status', 'job', 'income_member', 'blood_group', 'father_name', 'mother_name', 'father_work', 'mother_work', 'income_father', 'income_mothers', 'educational_status', 'zip_code', 'phone_number', 'other_phone_number', 'relationship_phone_number', 'email', 'organizational_experience', 'year', 'illness', 'height_body', 'weight_body', 'dress_size', 'pants_size', 'shoe_size', 'hat_size', 'brevetaward', 'lifeskill', 'languageskill', 'membership_status', 'status_organization', 'type_member', 'tribal_members', 'identity_card', 'certificate_of_organization', 'identity_card_number', 'names_recommended', 'note', 'other_content', 'save_status', 'create_et', 'update_et'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = PpiModel::find();
        $query->onCondition(['type_member' => MEMBER_TYPE_PPI]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if (isset($params['PpiSerch']['status_filtr1'])) {
            $ss1 = $params['PpiSerch']['status_filtr1'];
            $query->orFilterWhere(['like', 'save_status', $ss1]);
        }

        if (isset($params['PpiSerch']['status_filtr2'])) {
            $ss2 = $params['PpiSerch']['status_filtr2'];
            $query->orFilterWhere(['like', 'save_status', $ss2]);
        }

        if (isset($params['PpiSerch']['year_filtr1'])) {
            $this->year_filtr1 = $params['PpiSerch']['year_filtr1'];
        }

        if (isset($params['PpiSerch']['year_filtr2'])) {
            $this->year_filtr2 = $params['PpiSerch']['year_filtr2'];
        }

        if (isset($params['PpiSerch']['year_opsi'])) {
            $this->year_opsi = $params['PpiSerch']['year_opsi'];
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


        if (isset($params['PpiSerch']['year_filtr3'])) {
            $this->year_filtr3 = $params['PpiSerch']['year_filtr3'];
        }

        if (isset($params['PpiSerch']['year_filtr4'])) {
            $this->year_filtr4 = $params['PpiSerch']['year_filtr4'];
        }

        if (isset($params['PpiSerch']['year_opsi1'])) {
            $this->year_opsi1 = $params['PpiSerch']['year_opsi1'];
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

        if (isset($params['PpiSerch']['keyword'])) {
            $this->keyword = $params['PpiSerch']['keyword'];
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
                ->orFilterWhere(['like', 'brevetaward', $this->keyword])
                ->orFilterWhere(['like', 'lifeskill', $this->keyword])
                ->orFilterWhere(['like', 'languageskill', $this->keyword])
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
            ->andFilterWhere(['like', 'income_member', $this->income_member])
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
            ->andFilterWhere(['like', 'brevetaward', $this->brevetaward])
            ->andFilterWhere(['like', 'lifeskill', $this->lifeskill])
            ->andFilterWhere(['like', 'languageskill', $this->languageskill])
            ->andFilterWhere(['like', 'membership_status', $this->membership_status])
            ->andFilterWhere(['like', 'status_organization', $this->status_organization])
            ->andFilterWhere(['like', 'type_member', $this->type_member])
            ->andFilterWhere(['like', 'tribal_members', $this->tribal_members])
            ->andFilterWhere(['like', 'identity_card', $this->identity_card])
            ->andFilterWhere(['like', 'certificate_of_organization', $this->certificate_of_organization])
            ->andFilterWhere(['like', 'identity_card_number', $this->identity_card_number])
            ->andFilterWhere(['like', 'names_recommended', $this->names_recommended])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'other_content', $this->other_content])
            ->andFilterWhere(['like', 'save_status', $this->save_status]);

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
        return ArrayHelper::merge(['' => $none], $data);
    }

    public static function getLifeSkills($none = 'None')
    {
        $models = LifeSkillModel::find();
        $models->where(['term_id' => MEMBER_SKILL]);
        $group = [];
        foreach ($models->asArray()->all() as $v) {
            if ($v['parent_id'] !== null) {
                $group[] = ['id' => $v['id'], 'name' => $v['name'], 'group' => self::getSkillNameByid($v['parent_id'])];
            } else {
//                $group[] = ['id' => $v['id'], 'name' => $v['name'], 'group' => 'General'];
            }
        }
        return ArrayHelper::map($group, 'id', 'name', 'group');
    }

    public static function getSkillNameByid($id)
    {
        $query = LanguageSkillModel::findBySql("SELECT * FROM taxonomy WHERE id='" . $id . "'")->one();
        return $query['name'];
    }


    public static function getLangSkills($none = 'None')
    {
        $models = LanguageSkillModel::find();
        $models->where(['term_id' => MEMBER_LANG_SKILL]);
        $group = [];

        foreach ($models->asArray()->all() as $v) {
            if ($v['parent_id'] !== null) {
                $group[] = ['id' => $v['id'], 'name' => $v['name'], 'group' => self::getLangSkillNameById($v['parent_id'])];
            } else {
//                $group[] = ['id' => $v['id'], 'name' => $v['name'], 'group' => 'General'];
            }
        }
        return ArrayHelper::map($group, 'id', 'name', 'group');
    }

    public static function getLangSkillNameByid($id)
    {
        $query = LanguageSkillModel::findBySql("SELECT * FROM taxonomy WHERE id='" . $id . "'")->one();
        return $query['name'];
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
