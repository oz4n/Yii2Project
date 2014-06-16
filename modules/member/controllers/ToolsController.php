<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\member\controllers;

use app\modules\member\models\CapasModel;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use app\modules\member\models\ToolsModel;
use app\modules\member\forms\FormToolsMember;
use yii\web\UploadedFile;
use yii\web\HttpException;

/**
 * Description of ToolsController
 *
 * @author melengo
 */
class ToolsController extends Controller
{

    public function actionIndex()
    {
        
    }

    public function actionImport()
    {
        $form = new FormToolsMember;
        if (Yii::$app->user->can('toolsimport')) {
            if (Yii::$app->request->post()) {
                $file = UploadedFile::getInstanceByName('file');
                if ($file->type === "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $file->type === "application/vnd.ms-excel") {
                    $unique_name = preg_replace('/\s+/', '-', date("YmdHis") . '-' . rand(0, 999999999) . '-' . $file->name);
                    $file->saveAs(Yii::$app->getBasePath() . '/web/resources/report/import/' . $unique_name);
                    return $this->redirect(['nextimport', 'action' => 'member-tools-nextimport', 'uniq' => $unique_name]);
                } else {
                    return $this->redirect(['import', 'action' => 'member-tools-import']);
                }
            } else {
                return $this->render('import', [
                            'model' => $form
                ]);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionNextimport()
    {
        if (Yii::$app->user->can('toolsnextimport')) {
            $form = new FormToolsMember;
            $param = Yii::$app->request->getQueryParams();
            if (isset($param['uniq']) && file_exists(Yii::$app->getBasePath() . '/web/resources/report/import/' . $param['uniq'])) {
                $file = Yii::$app->getBasePath() . '/web/resources/report/import/' . $param['uniq'];
                return $this->render('nextimport', [
                            'model' => $form,
                            'uniq' => $param['uniq']
                ]);
            } else {
                return $this->redirect(['import', 'action' => 'member-tools-import']);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionSaveimport()
    {
        if (Yii::$app->user->can('toolssaveimport')) {
            if (($param = Yii::$app->request->post("FormToolsMember"))) {
                $data = Json::decode($param["member_data"]);
                unset($data[0]);
                switch ($param["type_member"]) {
                    case "PPI";
                        foreach ($data as $val) {
                            unset($val["number"]);
                            ToolsModel::savePpi($val, $param["save_status"]);
                        }
                        break;
                    case "Paskibra";
                        foreach ($data as $val) {
                            unset($val["number"]);
                            ToolsModel::savePaskibra($val, $param["save_status"]);
                        }
                        break;
                    case "Capas";
                        foreach ($data as $val) {
                            unset($val["number"]);
                            ToolsModel::saveCapas($val, $param["save_status"]);
                        }
                        break;
                }
                return $this->redirect(['import', 'action' => 'member-tools-import']);
            } else {
                return $this->redirect(['import', 'action' => 'member-tools-import']);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

    public function actionExport()
    {
        if (Yii::$app->user->can('toolsexport')) {
            $form = new FormToolsMember;
            if (Yii::$app->request->post()) {
                $model = new ToolsModel;
                $data = Yii::$app->request->post('FormToolsMember');
                $filename = Yii::$app->user->identity->username . "-" . time();
                $model->memberExport($data, $filename);
                $file = Yii::getAlias("@web") . 'resources/report/export/' . $filename . '.xlsx';
                if (file_exists($file)) {
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header('Content-Disposition: attachment; filename=' . basename($file));
                    header('Expires: 0');
                    header('Cache-Control: max-age=0');
                    header('Cache-Control: max-age=1');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($file));
                    ob_clean();
                    flush();
                    readfile($file);
                    exit;
                } else {
                    return $this->redirect(['export', 'action' => 'member-tools-ecport']);
                }
            } else {
                return $this->render('export', [
                            'model' => $form
                ]);
            }
        } else {
            throw new HttpException(403, 'You are not allowed to access this page', 0);
        }
    }

}
