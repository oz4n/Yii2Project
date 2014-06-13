<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\member\controllers;

use Yii;
use yii\web\Controller;
use app\modules\member\models\ToolsModel;
use app\modules\member\forms\FormToolsMember;

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

        return $this->render('import');
    }

    public function actionExport()
    {
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
                return $this->redirect(['export']);
            }
        } else {
            return $this->render('export', [
                        'model' => $form
            ]);
        }
    }

}
