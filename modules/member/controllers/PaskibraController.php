<?php

namespace app\modules\member\controllers;
define("DS", DIRECTORY_SEPARATOR);

use Yii;
use app\modules\dao\ar\Member;

use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\filemanager\librarys\Image;
use app\modules\member\models\LifeSkillModel;
use app\modules\member\models\PaskibraModel;
use app\modules\member\searchs\PaskibraSerch;

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

    public $path;
    public $original;
    public $certificate;
    public $identitycard;
    public $frontphoto;
    public $sidephoto;

    public function init()
    {
        $this->path = Yii::$app->getBasePath() . DS . 'web' . DS . 'resources' . DS . 'images' . DS;
        $this->original = $this->path . 'original' . DS;
        $this->frontphoto = $this->path . 'member' . DS . 'frontphoto' . DS;
        $this->sidephoto = $this->path . 'member' . DS . 'sidephoto' . DS;
        $this->certificate = $this->path . 'member' . DS . 'certificate' . DS;
        $this->identitycard = $this->path . 'member' . DS . 'identitycard' . DS;
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
    }

    /**
     * Displays a single PaskibraModel model.
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
     * Creates a new PaskibraModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PaskibraModel;
        $model->setAttribute('create_et', date("Y-m-d H:i:s"));
        $model->setAttribute('update_et', date("Y-m-d H:i:s"));
        $model->setAttribute('type_member', MEMBER_TYPE_PASKIBRA);
        $model->setAttribute('user_id', Yii::$app->user->identity->getId());

        if ($model->load(Yii::$app->request->post())) {

            $form = Yii::$app->request->post('PaskibraModel');
            $this->langskill = $form['language_skill'];
            $this->lifeskill = $form['life_skill'];
            $this->otherlifeskill = $form['otherlifeskill'];
            $this->brevetaward = $form['brevet_award'];

            $this->copyProntPhoto($form['front_photo']);
            $this->copySidePhoto($form['side_photo']);
            $this->copyCertificatePhoto($form['certificate_of_organization']);
            $this->copyIdentityCardPhoto($form['identity_card']);

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
            if ($model->save()) {
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

            return $this->render('create', [
                'model' => $model,
            ]);
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
        $model = $this->findModel($id);
        $model->setAttribute('update_et', date("Y-m-d H:i:s"));
        $model->setAttribute('user_id', Yii::$app->user->identity->getId());
        if ($model->load(Yii::$app->request->post())) {
            $form = Yii::$app->request->post('PaskibraModel');
            $this->langskill = $form['language_skill'];
            $this->lifeskill = $form['life_skill'];
            $this->otherlifeskill = $form['otherlifeskill'];
            $this->brevetaward = $form['brevet_award'];

            $this->copyProntPhoto($form['front_photo']);
            $this->copySidePhoto($form['side_photo']);
            $this->copyCertificatePhoto($form['certificate_of_organization']);
            $this->copyIdentityCardPhoto($form['identity_card']);

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

            if ($model->save()) {

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

                return $this->redirect(['view', 'action' => 'member-paskibra-view', 'id' => $model->id]);
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
        return $this->redirect(['index', 'action' => 'member-paskibra-list']);
    }

    /**
     * Deletes an existing PaskibraModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['index', 'action' => 'member-paskibra-list']);
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

    protected function copyProntPhoto($name)
    {
        if (null != $name) {
//            return \yii\imagine\Image::thumbnail($this->original . $name, 215, 300)
//            ->save($this->frontphoto . $name , ['quality' => 100]);
            $img = new Image();
            return $img->adaptiveResize($this->original . $name, $this->frontphoto . $name, 215, 300);
        }
    }

    protected function copySidePhoto($name)
    {
        if (null != $name) {
//            return \yii\imagine\Image::thumbnail($this->original . $name, 215, 300)
//                ->save($this->sidephoto . $name, ['quality' => 100]);
            $img = new Image();
            return $img->adaptiveResize($this->original . $name, $this->sidephoto . $name, 215, 300);
        }
    }

    protected function copyCertificatePhoto($name)
    {
        if (null != $name) {
            return copy($this->original . $name, $this->certificate . $name);
        }
    }

    protected function copyIdentityCardPhoto($name)
    {
        if (null != $name) {
            return copy($this->original . $name, $this->identitycard . $name);
        }
    }


    protected function deleteProntPhoto($name)
    {
        if (null != $name) {
            return unlink($this->frontphoto . $name);
        }
    }

    protected function deleteSidePhoto($name)
    {
        if (null != $name) {
            return unlink($this->sidephoto . $name);
        }
    }

    protected function deleteCertificatePhoto($name)
    {
        if (null != $name) {
            return unlink($this->certificate . $name);
        }
    }

    protected function deleteIdentityCardPhoto($name)
    {
        if (null != $name) {
            return unlink($this->identitycard . $name);
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
