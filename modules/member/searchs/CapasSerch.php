<?php

namespace app\modules\member\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\member\models\CapasModel;

/**
 * CapasSerch represents the model behind the search form about `app\modules\member\models\CapasModel`.
 */
class CapasSerch extends CapasModel
{
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
        $query = CapasModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'taxonomy_id' => $this->taxonomy_id,
            'school_id' => $this->school_id,
            'user_id' => $this->user_id,
            'age' => $this->age,
            'number_of_brothers' => $this->number_of_brothers,
            'number_of_sisters' => $this->number_of_sisters,
            'number_of_children' => $this->number_of_children,
            'create_et' => $this->create_et,
            'update_et' => $this->update_et,
        ]);

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
}
