<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 6/8/14
 * Time: 2:40 PM
 */

namespace app\modules\users\controllers;

use Yii;
use dektrium\user\controllers\AdminController as BaseAdminController;
use app\modules\users\searchs\UserSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\HttpException;

class UserController extends BaseAdminController
{

    public $layout = '@app/modules/dashboard/views/layouts/main';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'confirm' => ['post'],
                    'delete-tokens' => ['post'],
                    'block' => ['post']
                ],
            ],
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'actions' => ['index', 'create', 'update', 'delete', 'block', 'confirm', 'delete-tokens'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                        'matchCallback' => function ($rule, $action) {
//                    return in_array(Yii::$app->user->identity->username, $this->module->admins);
//                }
//                    ],
//                ]
//            ]
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($_GET);

        return $this->render('@app/modules/users/views/user/index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = $this->module->manager->createUser(['scenario' => 'create']);
        if (Yii::$app->request->post('UserModel')){
            $param = (object) Yii::$app->getRequest()->post('UserModel');
            $model->setRole($param->role);
            if ($model->load(Yii::$app->request->post()) && $model->create()) {
                Yii::$app->getSession()->setFlash('admin_user', Yii::t('user', 'User has been created'));
                return $this->redirect(['update', 'action' => 'user-update', 'id' => $model->id]);
            }
        }


        return $this->render('@app/modules/users/views/user/create', [
                    'model' => $model
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param  integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('admin_user', Yii::t('user', 'User has been updated'));
            return $this->refresh();
        }

        return $this->render('@app/modules/users/views/user/update', [
                    'model' => $model
        ]);
    }

    /**
     * Confirms the User.
     * @param $id
     * @return \yii\web\Response
     */
    public function actionConfirm($id)
    {
        $this->findModel($id)->confirm(false);
        Yii::$app->getSession()->setFlash('admin_user', Yii::t('user', 'Akun Sudah di konfirmasi'));

        return $this->redirect(['index', 'action' => 'user-lisst']);
    }

    /**
     * Deletes recovery tokens.
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDeleteTokens($id)
    {
        $model = $this->findModel($id);
        $model->recovery_token = null;
        $model->recovery_sent_at = null;
        $model->save(false);
        Yii::$app->getSession()->setFlash('admin_user', Yii::t('user', 'User toke sudah terhapus'));

        return $this->redirect(['index', 'action' => 'user-lisst']);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param  integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->getSession()->setFlash('admin_user', Yii::t('user', 'User has been deleted'));

        return $this->redirect(['index', 'action' => 'user-list']);
    }

    public function actionBulk()
    {
        if (Yii::$app->user->can('userbulk')) {
            if (Yii::$app->request->post() && (Yii::$app->request->post('bulk_action1') == 'delete' || Yii::$app->request->post('bulk_action2') == 'delete')) {
                $this->deleteAll(Yii::$app->request->post('selection'));
                return $this->redirect(['index', 'action' => 'user-list']);
            } else {
                return $this->redirect(['index', 'action' => 'user-list']);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    /**
     * @param array $data
     * @return \yii\web\Response
     */
    private function deleteAll($data)
    {
        if (null !== $data) {
            foreach ($data as $id) {
                $this->findModel($id)->delete();
            }
        } else {
            return $this->redirect(['index', 'action' => 'user-list']);
        }
    }

    /**
     * Blocks the user.
     *
     * @param $id
     * @return \yii\web\Response
     */
    public function actionBlock($id)
    {
        $user = $this->findModel($id);
        if ($user->getIsBlocked()) {
            $user->unblock();
            Yii::$app->getSession()->setFlash('admin_user', Yii::t('user', 'User has been unblocked'));
        } else {
            $user->block();
            Yii::$app->getSession()->setFlash('admin_user', Yii::t('user', 'User has been blocked'));
        }

        return $this->redirect(['index', 'action' => 'user-list']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param  integer                    $id
     * @return \dektrium\user\models\User the loaded model
     * @throws NotFoundHttpException      if the model cannot be found
     */
    protected function findModel($id)
    {
        /** @var \dektrium\user\models\User $user */
        $user = $this->module->manager->findUserById($id);
        if ($id !== null && $user !== null) {
            return $user;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
