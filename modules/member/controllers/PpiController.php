<?php

namespace app\modules\member\controllers;

use Yii;
use app\modules\member\models\PpiModel;
use app\modules\member\searchs\PpiSerch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PpiController implements the CRUD actions for PpiModel model.
 */
class PpiController extends Controller
{
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
        if ($model->load(Yii::$app->request->post())) {
            $langskill = Yii::$app->request->post('PpiModel')['language_skill'];
            $lifeskill = Yii::$app->request->post('PpiModel')['life_skill'];
            $brevetaward = Yii::$app->request->post('PpiModel')['brevet_award'];

            if (null != $langskill) {
                $data_lang = $model->getAllLangSkillNameById($langskill);
                $model->setAttribute('languageskill', implode(', ', $data_lang));
            }

            if (null != $lifeskill) {
                $data_skill = $model->getAllSkillNameById($lifeskill);
                $model->setAttribute('lifeskill', implode(', ', $data_skill));
            }

            if (null != $brevetaward) {
                $data_brevet = $model->getAllBrevetNameById($brevetaward);
                $model->setAttribute('brevetaward', implode(', ', $data_brevet));
            }

            $front_photo = UploadedFile::getInstance($model, 'front_photo');
            $side_photo = UploadedFile::getInstance($model, 'side_photo');
            $identity_card = UploadedFile::getInstance($model, 'identity_card');
            $certificate_of_organization = UploadedFile::getInstance($model, 'certificate_of_organization');

            if ($front_photo->name == null) {
                Yii::$app->session->setFlash('front_photo_error', 'Tidak boleh kosong.');
            }

            if ($side_photo->name == null) {
                Yii::$app->session->setFlash('side_photo_error', 'Tidak boleh kosong.');
            }

            if ($identity_card->name == null) {
                Yii::$app->session->setFlash('identity_card_error', 'Tidak boleh kosong.');
            }

            if (($front_photo->name == null || $side_photo == null) || $identity_card == null) {
                return $this->render('create', [
                    'model' => $model,
                ]);
            } else {
                $front_photo_name = preg_replace('/\s+/', '-', 'photo-tampak-depan' . date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $front_photo->name);
                $side_photo_name = preg_replace('/\s+/', '-', 'photo-tampak-samping' . date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $side_photo->name);
                $identity_card_name = preg_replace('/\s+/', '-', 'ktp' . date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $identity_card->name);
                $certificate_of_organization_name = preg_replace('/\s+/', '-', 'sertifikat-' . date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $certificate_of_organization->name);

                $model->setAttribute('front_photo', $front_photo_name);
                $model->setAttribute('side_photo', $side_photo_name);
                $model->setAttribute('identity_card', $identity_card_name);
                if ($model->save()) {
                    $path = Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'member' . DIRECTORY_SEPARATOR;
                    if (null != $lifeskill) {
                        $model->saveTaxRelation($lifeskill, $model->id);
                    }

                    if (null != $langskill) {
                        $model->saveTaxRelation($langskill, $model->id);
                    }

                    if (null != $brevetaward) {
                        $model->saveTaxRelation($brevetaward, $model->id);
                    }

                    $front_photo->saveAs($path . $front_photo_name);
                    $side_photo->saveAs($path . $side_photo_name);
                    $identity_card->saveAs($path . $identity_card_name);
                    $certificate_of_organization->saveAs($path . $certificate_of_organization_name);
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
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
        if ($model->load(Yii::$app->request->post())) {
            $langskill = Yii::$app->request->post('PpiModel')['language_skill'];
            $lifeskill = Yii::$app->request->post('PpiModel')['life_skill'];
            $brevetaward = Yii::$app->request->post('PpiModel')['brevet_award'];


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
                $model->setAttribute('lifeskill', implode(', ', $data_skill));
            }


            $front_photo = UploadedFile::getInstance($model, 'front_photo');
            $side_photo = UploadedFile::getInstance($model, 'side_photo');
            $identity_card = UploadedFile::getInstance($model, 'identity_card');
            $certificate_of_organization = UploadedFile::getInstance($model, 'certificate_of_organization');

//            $front_photo_name = preg_replace('/\s+/', '-', date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $front_photo->name);
//            $side_photo_name = preg_replace('/\s+/', '-', date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $side_photo->name);
//            $identity_card_name = preg_replace('/\s+/', '-', date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $identity_card->name);
//            $certificate_of_organization_name = preg_replace('/\s+/', '-', date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $certificate_of_organization->name);

            $front_photo_name = preg_replace('/\s+/', '-', 'photo-tampak-depan-' . date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $front_photo->name);
            $side_photo_name = preg_replace('/\s+/', '-', 'photo-tampak-samping-' . date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $side_photo->name);
            $identity_card_name = preg_replace('/\s+/', '-', 'ktp' . date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $identity_card->name);
            $certificate_of_organization_name = preg_replace('/\s+/', '-', 'sertifikat-' . date("Y-m-d-H:i:s") . '-' . rand(0, 999999999) . '-' . $certificate_of_organization->name);

            $load = $this->findModel($id);
            $front_photo->name == null ? $model->setAttribute('front_photo', $load->front_photo) : $model->setAttribute('front_photo', $front_photo_name);
            $side_photo->name == null ? $model->setAttribute('side_photo', $load->side_photo) : $model->setAttribute('side_photo', $side_photo_name);
            $identity_card->name == null ? $model->setAttribute('identity_card', $load->identity_card) : $model->setAttribute('identity_card', $identity_card_name);
            $certificate_of_organization->name == null ? $model->setAttribute('certificate_of_organization', $load->certificate_of_organization) : $model->setAttribute('certificate_of_organization', $certificate_of_organization_name);

            if ($model->save()) {
                $path = Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'member' . DIRECTORY_SEPARATOR;

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

                if ($front_photo->name != null) {
                    unlink($path . $load->front_photo);
                    $front_photo->saveAs($path . $front_photo_name);
                }

                if ($side_photo->name != null) {
                    unlink($path . $load->side_photo);
                    $side_photo->saveAs($path . $side_photo_name);
                }

                if ($identity_card->name != null) {
                    unlink($path . $load->identity_card);
                    $identity_card->saveAs($path . $identity_card_name);
                }

                if ($certificate_of_organization->name != null) {
                    if ($load->certificate_of_organization == null) {
                        $load->setAttribute('certificate_of_organization', $certificate_of_organization_name);
                        $load->save();
                        $certificate_of_organization->saveAs($path . $certificate_of_organization_name);
                    } else {
                        unlink($path . $load->certificate_of_organization);
                        $certificate_of_organization->saveAs($path . $certificate_of_organization_name);
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionTrash($id)
    {
        $model = $this->findModel($id);
        $model->save_status = 'Trash';
        $model->save();
        return $this->redirect(['index']);
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
        $path = Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'member' . DIRECTORY_SEPARATOR;
        unlink($path . $model->front_photo);
        unlink($path . $model->side_photo);
        unlink($path . $model->identity_card);
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * @param array $data
     * @return \yii\web\Response
     */
    protected function deleteAll($data)
    {
        if (null !== $data) {
            foreach ($data as $id) {
                $model = $this->findModel($id);
                $path = Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'member' . DIRECTORY_SEPARATOR;
                unlink($path . $model->front_photo);
                unlink($path . $model->side_photo);
                unlink($path . $model->identity_card);
                $model->delete();
            }
        } else {
            return $this->redirect(['index']);
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
}
