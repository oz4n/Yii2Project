<?php

namespace app\modules\member\controllers;

define("DS", DIRECTORY_SEPARATOR);

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\HttpException;
use app\modules\member\models\LifeSkillModel;
use app\modules\member\models\PaskibraModel;
use app\modules\member\searchs\PaskibraSerch;
use app\modules\member\helpers\PhotoHelper;

/**
 * PaskibraController implements the CRUD actions for PaskibraModel model.
 */
class PaskibraController extends Controller
{

    public $langskill;
    public $lifeskill;
    public $otherlifeskill;
    public $brevetaward;
    public $other_skill;
    public $otherlifeskillid;
    public $photo;

    public function init()
    {
        $this->photo = new PhotoHelper;
        parent::init();
    }

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
     * Lists all PaskibraModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('paskibraindex')) {
            $searchModel = new PaskibraSerch;
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
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Displays a single PaskibraModel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->can('paskibraview')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Creates a new PaskibraModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('paskibracreate')) {
            $model = new PaskibraModel;
            $model->setAttribute('create_et', date("Y-m-d H:i:s"));
            $model->setAttribute('update_et', date("Y-m-d H:i:s"));
            $model->setAttribute('type_member', MEMBER_TYPE_PASKIBRA);
            $model->setAttribute('user_id', Yii::$app->user->identity->getId());

            $param = Yii::$app->request->post('PaskibraModel');
            $this->langskill = $param['language_skill'];
            $this->lifeskill = $param['life_skill'];
            $this->otherlifeskill = $param['otherlifeskill'];
            $this->brevetaward = $param['brevet_award'];

            $this->photo->copyProntPhoto($param['front_photo']);
            $this->photo->copyProntPhotoThumb($param['front_photo']);
            $this->photo->copySidePhoto($param['side_photo']);
            $this->photo->copyCertificatePhoto($param['certificate_of_organization']);
            $this->photo->copyIdentityCardPhoto($param['identity_card']);


            if (null != $this->otherlifeskill) {
                $this->saveOtherLifeSkill($this->otherlifeskill);
                $this->other_skill = [$this->otherlifeskill];
                $other_skill_id = [(count($this->lifeskill) + 1) => $this->otherlifeskillid];
                array_push($this->lifeskill, $other_skill_id[(count($this->lifeskill) + 1)]);
            }

            if (null != $this->langskill) {
                $data_lang = $model->getAllLangSkillNameById($this->langskill);
                $model->setAttribute('languageskill', implode(', ', $data_lang));
            }

            if (null != $this->lifeskill) {
                $data_skill = $model->getAllSkillNameById($this->lifeskill);
                if (isset($this->other_skill[0])) {
                    array_push($data_skill, $this->other_skill[0]);
                }
                $model->setAttribute('lifeskill', implode(', ', $data_skill));
            }


            if (null != $this->brevetaward) {
                $data_brevet = $model->getAllBrevetNameById($this->brevetaward);
                $model->setAttribute('brevetaward', implode(', ', $data_brevet));
            }

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                if (null != $this->lifeskill) {
                    $model->saveTaxRelation($this->lifeskill, $model->id);
                }

                if (null != $this->langskill) {
                    $model->saveTaxRelation($this->langskill, $model->id);
                }

                if (null != $this->brevetaward) {
                    $model->saveTaxRelation($this->brevetaward, $model->id);
                }
                return $this->redirect(['view', 'action' => 'member-paskibra-view', 'id' => $model->id]);
            } else {

                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Updates an existing PaskibraModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('paskibraupdate')) {
            $model = $this->findModel($id);
            $model->setAttribute('update_et', date("Y-m-d H:i:s"));
            $model->setAttribute('user_id', Yii::$app->user->identity->getId());
            $param = Yii::$app->request->post('PaskibraModel');

            //skill
            $this->langskill = $param['language_skill'];
            $this->lifeskill = $param['life_skill'];
            $this->otherlifeskill = $param['otherlifeskill'];
            $this->brevetaward = $param['brevet_award'];

            if (null != $this->otherlifeskill) {
                $this->saveOtherLifeSkill($this->otherlifeskill);
                $this->other_skill = [$this->otherlifeskill];
                $other_skill_id = [(count($this->lifeskill) + 1) => $this->otherlifeskillid];
                array_push($this->lifeskill, $other_skill_id[(count($this->lifeskill) + 1)]);
            }

            if (null != $this->brevetaward) {
                $data_brevet = $model->getAllBrevetNameById($this->brevetaward);
                $model->setAttribute('brevetaward', implode(', ', $data_brevet));
            }


            if (null != $this->langskill) {
                $data_lang = $model->getAllLangSkillNameById($this->langskill);
                $model->setAttribute('languageskill', implode(', ', $data_lang));
            }

            if (null != $this->lifeskill) {
                $data_skill = $model->getAllSkillNameById($this->lifeskill);
                if (isset($this->other_skill[0])) {
                    array_push($data_skill, $this->other_skill[0]);
                }
                $model->setAttribute('lifeskill', implode(', ', $data_skill));
            }

            //photo
            if (($model->front_photo != $param['front_photo']) && $param['front_photo'] != null) {
                //delte old photo
                $this->photo->deleteProntPhoto($model->front_photo);
                $this->photo->deleteProntPhotoThumb($model->front_photo);

                //save new photo
                $this->photo->copyProntPhoto($param['front_photo']);
                $this->photo->copyProntPhotoThumb($param['front_photo']);
            }

            if (($model->side_photo != $param['side_photo']) && $param['side_photo'] != null) {
                $this->photo->deleteSidePhoto($model->side_photo);
                $this->photo->copySidePhoto($param['side_photo']);
            }

            if (($model->identity_card != $param['identity_card']) && $param['identity_card'] != null) {
                $this->photo->deleteIdentityCardPhoto($model->identity_card);
                $this->photo->copyIdentityCardPhoto($param['identity_card']);
            }

            if (($model->certificate_of_organization != $param['certificate_of_organization']) && $param['certificate_of_organization'] != null) {
                $this->photo->deleteCertificatePhoto($model->certificate_of_organization);
                $this->photo->copyCertificatePhoto($param['certificate_of_organization']);
            }



            //save database
            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                if (null != $this->lifeskill) {
                    $model->saveTaxRelation($this->lifeskill, $model->id);
                } else {
                    $data = ArrayHelper::map($model->getTaxonomiesBySkill()->all(), 'id', 'id');
                    $model->deleteAllTaxRelationByMemberId($data, $model->id);
                }

                if (null != $this->langskill) {
                    $model->saveTaxRelation($this->langskill, $model->id);
                } else {
                    $data = ArrayHelper::map($model->getTaxonomiesByLangSkill()->all(), 'id', 'id');
                    $model->deleteAllTaxRelationByMemberId($data, $model->id);
                }

                if (null != $this->brevetaward) {
                    $model->saveTaxRelation($this->brevetaward, $model->id);
                } else {
                    $data = ArrayHelper::map($model->getTaxonomiesByBrevet()->all(), 'id', 'id');
                    $model->deleteAllTaxRelationByMemberId($data, $model->id);
                }

                return $this->redirect(['view', 'action' => 'member-ppi-view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                            'model' => $model
                ]);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionTrash($id)
    {
        if (Yii::$app->user->can('paskibratrash')) {
            $model = $this->findModel($id);
            $model->save_status = 'Trash';
            $model->save();
            return $this->redirect(['index', 'action' => 'member-paskibra-list']);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * Deletes an existing PaskibraModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('paskibradelete')) {
            $model = $this->findModel($id);
            $model->delete();
            return $this->redirect(['index', 'action' => 'member-paskibra-list']);
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    protected function trashAll($data)
    {
        if (null != $data) {
            foreach ($data as $id) {
                $model = $this->findModel($id);
                $model->save_status = 'Trash';
                $model->save();
            }
            return $this->redirect(['index', 'action' => 'member-paskibra-list']);
        } else {
            return $this->redirect(['index', 'action' => 'member-paskibra-list']);
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
                $model->delete();
            }
            return $this->redirect(['index', 'action' => 'member-paskibra-list']);
        } else {
            return $this->redirect(['index', 'action' => 'member-paskibra-list']);
        }
    }

    /**
     * Finds the PaskibraModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PaskibraModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PaskibraModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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
