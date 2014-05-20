<?php

namespace app\modules\member\controllers;

use Yii;
use app\modules\member\models\PpiModel;
use app\modules\member\searchs\PpiSerch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\member\models\LifeSkillModel;

/**
 * PpiController implements the CRUD actions for PpiModel model.
 */
class PpiController extends Controller
{

    public $langskill;
    public $lifeskill;
    public $otherlifeskill;
    public $brevetaward;
    public $other_skill;
    public $otherlifeskillid;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all PpiModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PpiSerch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        if ((Yii::$app->request->get('bulk_action1') == 'delete' || Yii::$app->request->get('bulk_action2') == 'delete')) {
            $this->deleteAll(Yii::$app->request->get('selection'));
        }
        if ((Yii::$app->request->get('bulk_action1') == 'trash' || Yii::$app->request->get('bulk_action2') == 'trash')) {
            $this->trashAll(Yii::$app->request->get('selection'));
        }
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single PpiModel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PpiModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PpiModel;
        $model->setAttribute('create_et', date("Y-m-d H:i:s"));
        $model->setAttribute('update_et', date("Y-m-d H:i:s"));
        $model->setAttribute('type_member', MEMBER_TYPE_PPI);
        $model->setAttribute('user_id', Yii::$app->user->identity->getId());

        if ($model->load(Yii::$app->request->post())) {

            $form = Yii::$app->request->post('PpiModel');
            $langskill = $form['language_skill'];
            $lifeskill = $form['life_skill'];
            $otherlifeskill = $form['otherlifeskill'];
            $brevetaward = $form['brevet_award'];


            $other_skill = '';
            if (null != $otherlifeskill) {
                $life = $this->saveOtherLifeSkill($otherlifeskill);
                $other_skill = [$otherlifeskill];
                $other_skill_id = [(count($lifeskill) + 1) => $this->otherlifeskillid];
                array_push($lifeskill, $other_skill_id[(count($lifeskill) + 1)]);
            }

            if (null != $langskill) {
                $data_lang = $model->getAllLangSkillNameById($langskill);
                $model->setAttribute('languageskill', implode(', ', $data_lang));
            }

            if (null != $lifeskill) {
                $data_skill = $model->getAllSkillNameById($lifeskill);
                if (isset($other_skill[0])) {
                    array_push($data_skill, $other_skill[0]);
                }
                $model->setAttribute('lifeskill', implode(', ', $data_skill));
            }


            if (null != $brevetaward) {
                $data_brevet = $model->getAllBrevetNameById($brevetaward);
                $model->setAttribute('brevetaward', implode(', ', $data_brevet));
            }
            if ($model->save()) {
                if (null !== $lifeskill) {
                    $model->saveTaxRelation($lifeskill, $model->id);
                }

                if (null != $langskill) {
                    $model->saveTaxRelation($langskill, $model->id);
                }

                if (null != $brevetaward) {
                    $model->saveTaxRelation($brevetaward, $model->id);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {

            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PpiModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setAttribute('update_et', date("Y-m-d H:i:s"));
        $model->setAttribute('user_id', Yii::$app->user->identity->getId());
        if ($model->load(Yii::$app->request->post())) {

            $form = Yii::$app->request->post('PpiModel');
            $langskill = $form['language_skill'];
            $lifeskill = $form['life_skill'];
            $otherlifeskill = $form['otherlifeskill'];
            $brevetaward = $form['brevet_award'];


            $other_skill = '';
            if (null != $otherlifeskill) {
                $life = $this->saveOtherLifeSkill($otherlifeskill);
                $other_skill = [$otherlifeskill];
                $other_skill_id = [(count($lifeskill) + 1) => $this->otherlifeskillid];
                array_push($lifeskill, $other_skill_id[(count($lifeskill) + 1)]);
            }

            if (null != $brevetaward) {
                $data_brevet = $model->getAllBrevetNameById($brevetaward);
                $model->setAttribute('brevetaward', implode(', ', $data_brevet));
            }


            if (null != $langskill) {
                $data_lang = $model->getAllLangSkillNameById($langskill);
                $model->setAttribute('languageskill', implode(', ', $data_lang));
            }

            if (null != $lifeskill) {
                $data_skill = $model->getAllSkillNameById($lifeskill);
                if (isset($other_skill[0])) {
                    array_push($data_skill, $other_skill[0]);
                }
                $model->setAttribute('lifeskill', implode(', ', $data_skill));
            }

            if ($model->save()) {

                if (null != $lifeskill) {
                    $model->saveTaxRelation($lifeskill, $model->id);
                } else {
                    $data = ArrayHelper::map($model->getTaxonomiesBySkill()->all(), 'id', 'id');
                    $model->deleteAllTaxRelationByMemberId($data, $model->id);
                }

                if (null != $langskill) {
                    $model->saveTaxRelation($langskill, $model->id);
                } else {
                    $data = ArrayHelper::map($model->getTaxonomiesByLangSkill()->all(), 'id', 'id');
                    $model->deleteAllTaxRelationByMemberId($data, $model->id);
                }

                if (null != $brevetaward) {
                    $model->saveTaxRelation($brevetaward, $model->id);
                } else {
                    $data = ArrayHelper::map($model->getTaxonomiesByBrevet()->all(), 'id', 'id');
                    $model->deleteAllTaxRelationByMemberId($data, $model->id);
                }

                return $this->redirect(['view', 'action' => 'member-ppi-view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model
            ]);
        }
    }

    public function actionTrash($id)
    {
        $model = $this->findModel($id);
        $model->save_status = 'Trash';
        $model->save();
        return $this->redirect(['index', 'action' => 'member-ppi-list']);
    }

    /**
     * Deletes an existing PpiModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->deleteMemberImage($model->front_photo);
        $this->deleteMemberImage($model->side_photo);
        $this->deleteMemberImage($model->identity_card);
        $this->deleteMemberImage($model->certificate_of_organization);
        $model->delete();
        return $this->redirect(['index', 'action' => 'member-ppi-list']);
    }

    protected function trashAll($data)
    {
        if (null != $data) {
            foreach ($data as $id) {
                $model = $this->findModel($id);
                $model->save_status = 'Trash';
                $model->save();
            }
            return $this->redirect(['index', 'action' => 'member-ppi-list']);
        } else {
            return $this->redirect(['index', 'action' => 'member-ppi-list']);
        }
    }

    /**
     * @param array $data
     * @return \yii\web\Response
     */
    protected function deleteAll($data)
    {
        if (null != $data) {

            foreach ($data as $id) {
                $model = $this->findModel($id);
                $this->deleteMemberImage($model->front_photo);
                $this->deleteMemberImage($model->side_photo);
                $this->deleteMemberImage($model->identity_card);
                $this->deleteMemberImage($model->certificate_of_organization);
                $model->delete();
            }
            return $this->redirect(['index', 'action' => 'member-ppi-list']);
        } else {
            return $this->redirect(['index', 'action' => 'member-ppi-list']);
        }
    }

    /**
     * Finds the PpiModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PpiModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PpiModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function deleteMemberImage($img)
    {
        $path = Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'member' . DIRECTORY_SEPARATOR;
        $thumb_path = $path . DIRECTORY_SEPARATOR . 'thumbnail' . DIRECTORY_SEPARATOR;
        unlink($path . $img);
        unlink($thumb_path . $img);
    }

    protected function saveOtherLifeSkill($otherlifeskill)
    {
        $life = new LifeSkillModel;
        $life->setAttribute('name', $otherlifeskill);
        $life->setAttribute('term_id', MEMBER_SKILL);
        $life->setAttribute('description', 'Kemampuan ' . $otherlifeskill);
        $life->setAttribute('create_et', date("Y-m-d H:i:s"));
        $life->setAttribute('update_et', date("Y-m-d H:i:s"));
        $life->save();
        $this->otherlifeskillid = $life->id;
    }

}
