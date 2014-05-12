<?php

namespace app\modules\member\controllers;

use app\modules\dao\ar\Taxmemberrelations;
use Yii;
use app\modules\member\models\MemberModel;
use app\modules\member\searchs\MemberSerch;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MemberController implements the CRUD actions for MemberModel model.
 */
class MemberController extends Controller
{
    public $life_skills = [];
    public $language_skills = [];
    public $brevet_award = [];

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
     * Lists all MemberModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MemberSerch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        if ((Yii::$app->request->get('bulk_action1') == 'delete' || Yii::$app->request->get('bulk_action2') == 'delete')) {
//            echo "<pre>";
//            print_r(Yii::$app->request->get('selection'));
//            exit();
            $this->deleteAll(Yii::$app->request->get('selection'));
        }
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single MemberModel model.
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
     * Creates a new MemberModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MemberModel;
        $model->setAttribute('create_et', date("Y-m-d H:i:s"));
        $model->setAttribute('update_et', date("Y-m-d H:i:s"));
        if ($model->load(Yii::$app->request->post()) ) {
            echo '<pre>';
            print_r(Yii::$app->request->post());
            exit();
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MemberModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setAttribute('update_et', date("Y-m-d H:i:s"));
        if ($model->load(Yii::$app->request->post())) {
//            $life_skills = Yii::$app->request->post('MemberModel')['life_skills'];
//            $language_skills = Yii::$app->request->post('MemberModel')['language_skills'];
//            $brevet_award = Yii::$app->request->post('MemberModel')['brevet_award'];
//            $data = '';
//
//            if (null != $life_skills) {
//                $data = $life_skills;
//                $model->setAttribute('other_content', implode(', ', $model->getAllSkillById($data)));
//            }
//
//            if (null != $language_skills) {
//                $data = $language_skills;
//                $model->setAttribute('other_content', implode(', ', $model->getAllSkillById($data)));
//            }
//
//            if (null != $brevet_award) {
//                $data = $brevet_award;
//                $model->setAttribute('other_content', implode(', ', $model->getAllSkillById($data)));
//            }
//
//            if (null != $life_skills && null != $language_skills) {
//                $data = ArrayHelper::merge(
//                    $this->life_skills,
//                    $language_skills
//                );
//                $model->setAttribute('other_content', implode(', ', $data));
//            }
//
//            if (null != $life_skills && null != $brevet_award) {
//                $data = ArrayHelper::merge(
//                    $this->life_skills,
//                    $brevet_award
//                );
//                $model->setAttribute('other_content', implode(', ', $data));
//            }
//
//            if (null != $language_skills && null != $brevet_award) {
//                $data = ArrayHelper::merge(
//                    $this->language_skills,
//                    $brevet_award
//                );
//                $model->setAttribute('other_content', implode(', ', $data));
//            }
//
//            if ((null != $life_skills && null != $language_skills) && null != $brevet_award) {
//                $data = ArrayHelper::merge(
//                    $this->life_skills,
//                    ArrayHelper::merge(
//                        $this->language_skills,
//                        $this->brevet_award
//                    )
//                );
//                $model->setAttribute('other_content', implode(', ', $data));
//            }
//
//            if ($data == null) {
//                $model->save();
//            } else {
//                $model->setAttribute('other_content', implode(', ', $model->getAllSkillById($data)));
//                $model->save();
//                $model->saveSkillRelation($data);
//            }
            exit();
//            $model->save();
//            $model->saveSkillRelation($language_skills, $model->id);
//            $model->saveSkillRelation($brevet_award, $model->id);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MemberModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

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
                $this->findModel($id)->delete();
            }
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the MemberModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MemberModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MemberModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
