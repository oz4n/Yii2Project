<?php

namespace app\modules\site\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\site\searchs\MemberSearch;
use app\modules\site\searchs\PostSerch;
use app\modules\site\models\UserModel;
use app\modules\site\models\MemberModel;
use app\modules\site\models\MemberImageModel;
use app\modules\member\helpers\PhotoHelper;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;

class MemberController extends Controller
{

    public $langskill;
    public $lifeskill;
    public $otherlifeskill;
    public $brevetaward;
    public $other_skill;
    public $otherlifeskillid;
    public $path;
    public $original;
    public $thumb_145x145;
    public $thumb_191x128;
    public $thumb_original;
    public $photo;

    public function init()
    {
        $this->photo = new PhotoHelper;
        $this->path = Yii::$app->getBasePath() . DS . 'web' . DS . 'resources' . DS . 'images' . DS;
        $this->original = $this->path . 'original' . DS;
        $this->thumb_145x145 = $this->path . 'thumbnail' . DS . '145x145' . DS;
        $this->thumb_191x128 = $this->path . 'thumbnail' . DS . '191x128' . DS;
        $this->thumb_original = $this->path . 'thumbnail' . DS . 'original' . DS;

        parent::init();
    }

    public function actionIndex($slug)
    {
        if (Yii::$app->user->can('sitememberindex')) {
            $user = $this->findUserBySlug($slug);
            $member = $this->findMemberByUserId($user->id);
            $member->setAttribute('update_et', date("Y-m-d H:i:s"));
            $param = Yii::$app->request->post('MemberModel');
            //skill
            $this->langskill = $param['language_skill'];
            $this->lifeskill = $param['life_skill'];
            $this->otherlifeskill = $param['otherlifeskill'];
            if ($member->type_member != MEMBER_TYPE_CAPAS) {
                $this->brevetaward = $param['brevet_award'];
            }

            if (null != $this->otherlifeskill) {
                $this->saveOtherLifeSkill($this->otherlifeskill);
                $this->other_skill = [$this->otherlifeskill];
                $other_skill_id = [(count($this->lifeskill) + 1) => $this->otherlifeskillid];
                array_push($this->lifeskill, $other_skill_id[(count($this->lifeskill) + 1)]);
            }


            if (null != $this->langskill) {
                $data_lang = $member->getAllLangSkillNameById($this->langskill);
                $member->setAttribute('languageskill', implode(', ', $data_lang));
            }

            if (null != $this->lifeskill) {
                $data_skill = $member->getAllSkillNameById($this->lifeskill);
                if (isset($this->other_skill[0])) {
                    array_push($data_skill, $this->other_skill[0]);
                }
                $member->setAttribute('lifeskill', implode(', ', $data_skill));
            }

            if ($member->type_member != MEMBER_TYPE_CAPAS) {
                if (null != $this->brevetaward) {
                    $data_brevet = $member->getAllBrevetNameById($this->brevetaward);
                    $member->setAttribute('brevetaward', implode(', ', $data_brevet));
                }
            }


            if ($member->load(Yii::$app->getRequest()->post()) && $member->save()) {
                if (null != $this->lifeskill) {
                    $data = ArrayHelper::map($member->getTaxonomiesBySkill()->all(), 'id', 'id');
                    $member->deleteAllTaxRelationByMemberId($data, $member->id);
                    $member->saveTaxRelation($this->lifeskill, $member->id);
                } else {
                    $data = ArrayHelper::map($member->getTaxonomiesBySkill()->all(), 'id', 'id');
                    $member->deleteAllTaxRelationByMemberId($data, $member->id);
                }

                if (null != $this->langskill) {
                    $data = ArrayHelper::map($member->getTaxonomiesByLangSkill()->all(), 'id', 'id');
                    $member->deleteAllTaxRelationByMemberId($data, $member->id);
                    $member->saveTaxRelation($this->langskill, $member->id);
                } else {
                    $data = ArrayHelper::map($member->getTaxonomiesByLangSkill()->all(), 'id', 'id');
                    $member->deleteAllTaxRelationByMemberId($data, $member->id);
                }

                if ($member->type_member != MEMBER_TYPE_CAPAS) {
                    if (null != $this->brevetaward) {
                        $data = ArrayHelper::map($member->getTaxonomiesByBrevet()->all(), 'id', 'id');
                        $member->deleteAllTaxRelationByMemberId($data, $member->id);
                        $member->saveTaxRelation($this->brevetaward, $member->id);
                    } else {
                        $data = ArrayHelper::map($member->getTaxonomiesByBrevet()->all(), 'id', 'id');
                        $member->deleteAllTaxRelationByMemberId($data, $member->id);
                    }
                }

                return $this->redirect(['index', 'role' => $user->role, 'slug' => $user->slug]);
            } else {
                $params = Yii::$app->request->getQueryParams();
                return $this->render('index', [
                            'user' => $user,
                            'member' => $member,
                            'slug' => $slug,
                            'role' => $params['role']
                ]);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionUpload()
    {
        if (Yii::$app->user->can('sitememberupload')) {
            if (Yii::$app->request->isAjax) {
                $file = UploadedFile::getInstanceByName('file');
                $unique_name = preg_replace('/\s+/', '-', date("YmdHis") . '-' . rand(0, 999999999) . '-' . $file->name);
                $file->saveAs($this->original . $unique_name);

                /**
                 * Resize Image
                 */
                $img = new \app\modules\filemanager\librarys\Image();
                $img->adaptiveResize($this->original . $unique_name, $this->thumb_145x145 . $unique_name, 145, 145);
                $img->adaptiveResize($this->original . $unique_name, $this->thumb_191x128 . $unique_name, 191, 128);
                $img->resize($this->original . $unique_name, $this->thumb_original . $unique_name, 256);
                $img->resize($this->original . $unique_name, $this->original . $unique_name, 1080);

                $model = new \app\modules\dao\ar\File();
                $model->user_id = Yii::$app->user->identity->getId();
                $model->name = $file->name;
                $model->orginal_name = $file->name;
                $model->unique_name = $unique_name;
                $model->type = 'image';
                $model->size = "$file->size";
                $model->file_type = $file->type;
                $model->description = "Photo Anggota";
                $model->create_at = date("Y-m-d H:i:s");
                $model->update_et = date("Y-m-d H:i:s");
                $model->save();

                $params = Yii::$app->getRequest()->post();
                $member = MemberImageModel::findOne($params['id']);
                switch ($params['imagetype']) {
                    case "frontphoto":
                        $this->photo->deleteProntPhoto($member->front_photo);
                        $this->photo->deleteProntPhotoThumb($member->front_photo);
                        //save new photo
                        $this->photo->copyProntPhoto($unique_name);
                        $this->photo->copyProntPhotoThumb($unique_name);
                        $member->front_photo = $unique_name;
                        $member->save();
                        break;
                    case "sidephoto";
                        $this->photo->deleteSidePhoto($member->side_photo);
                        //save new photo
                        $this->photo->copySidePhoto($unique_name);
                        $member->side_photo = $unique_name;
                        $member->save();
                        break;
                    case "identitycard";
                        $this->photo->deleteIdentityCardPhoto($member->identity_card);
                        //save new photo
                        $this->photo->copyIdentityCardPhoto($unique_name);
                        $member->identity_card = $unique_name;
                        $member->save();
                        break;
                    case "certificateoforganization";
                        $this->photo->deleteCertificatePhoto($member->certificate_of_organization);
                        //save new photo
                        $this->photo->copyCertificatePhoto($unique_name);
                        $member->certificate_of_organization = $unique_name;
                        $member->save();
                        break;
                }

                $base_path = Yii::getAlias('@web') . DS . 'resources' . DS . 'images' . DS;
                echo Json::encode([
                    'filelink' => $base_path . 'original' . DS . $unique_name,
                    'uid' => $model->id,
                    'filename' => $file->name,
                    'uniquename' => $unique_name
                ]);
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionCapas()
    {
        $searchModel = new MemberSearch;
        $model = PostSerch::find()->onCondition(['content' => 'pagemembercapas', "type" => 'pagehelper'])->one();
        $dataProvider = $searchModel->capasMemberSearch(Yii::$app->request->getQueryParams());
        return $this->render('capas', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'model' => $model,
                    'param' => Yii::$app->request->get('tax')
        ]);
    }

    public function actionPaskibra()
    {
        $searchModel = new MemberSearch;
        $dataProvider = $searchModel->paskibraMemberSearch(Yii::$app->request->getQueryParams());
        $model = PostSerch::find()->onCondition(['content' => 'pagememberpaskibra', "type" => 'pagehelper'])->one();
        return $this->render('paskibra', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'model' => $model,
                    'param' => Yii::$app->request->get('tax')
        ]);
    }

    public function actionPpi()
    {
        $searchModel = new MemberSearch;
        $dataProvider = $searchModel->ppiMemberSearch(Yii::$app->request->getQueryParams());
        $model = PostSerch::find()->onCondition(['content' => 'pagememberppi', "type" => 'pagehelper'])->one();
        return $this->render('ppi', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'model' => $model,
                    'param' => Yii::$app->request->get('tax')
        ]);
    }

    /**
     * Finds the PpiModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $userid
     * @return UserModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findUserBySlug($slug)
    {
        if (($model = UserModel::find()->onCondition(['slug' => $slug])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the PpiModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $userid
     * @return MemberModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findMemberByUserId($userid)
    {
        if (($model = MemberModel::find()->onCondition(['user_id' => $userid])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function saveOtherLifeSkill($otherlifeskill)
    {
        $life = new \app\modules\member\models\LifeSkillModel();
        $life->setAttribute('name', $otherlifeskill);
        $life->setAttribute('term_id', MEMBER_SKILL);
        $life->setAttribute('description', 'Kemampuan ' . $otherlifeskill);
        $life->setAttribute('create_et', date("Y-m-d H:i:s"));
        $life->setAttribute('update_et', date("Y-m-d H:i:s"));
        $life->save();
        $this->otherlifeskillid = $life->id;
    }

}
