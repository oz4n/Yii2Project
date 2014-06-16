<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/11/14
 * Time: 5:01 PM
 */

namespace app\modules\member\controllers;

define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

use Yii;
use yii\web\Controller;
use yii\web\User;
use yii\imagine\Image;

class TestController extends Controller
{

    public function actionTest()
    {
        $pat = "/media/HD-500/Libraries/Github/Yii2Project/web/resources/images/original/";
        $img = imagecreatefromjpeg($pat . "20140530171040-645105076-adaaas.jpg");
//        echo imagesx($img)."<br>";
//        echo imagesy($img)."<br>";
        $imagine = new \Imagine\Gd\Imagine();
        $imagine = new \Imagine\Imagick\Imagine();
        $image = $imagine->open($pat . "20140530171040-645105076-adaaas.jpg");
        $image->crop(new \Imagine\Image\Point(5, 200), new \Imagine\Image\Box(1804, 255))
            ->show('jpg');

//        $imagine = new \Imagine\Imagick\Imagine();
//        $options = array(
//        'resolution-units' => \Imagine\Image\ImageInterface::RESOLUTION_PIXELSPERINCH,
//        'resolution-x' => 150,
//        'resolution-y' => 120,
//        'resampling-filter' => \Imagine\Image\ImageInterface::FILTER_LANCZOS,
//        );
//        $imagine->open($pat . "20140530171040-645105076-adaaas.jpg")->save($pat . "ozan.jpg", $options);

        
//        $img = imagecreatefromjpeg($pat . "20140530171040-645105076-adaaas.jpg");
//        echo imagesx($img)."<br>";
//        echo imagesy($img)."<br>";
//        Image::thumbnail($pat. "20140530171040-645105076-adaaas.jpg", 1080, 500)->save($pat."ozan", ['quality' => 80]);
//        $size = new \Imagine\Image\Box(imagesx($img), imagesy($img));
//        $point = new \Imagine\Image\Point\Center($size);
//        $size->scale($ratio);
//        Image::crop($pat . "20140530171040-645105076-adaaas.jpg", 1080, 500, [1,0])->save($pat . "ozan-rock.jpg", ['quality' => 80]);
        ;
    }

    public function actionRepot()
    {
        // Create new PHPExcel object
        $objPHPExcel = new \PHPExcel();

// Set document properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                ->setLastModifiedBy("Maarten Balliauw")
                ->setTitle("Office 2007 XLSX Test Document")
                ->setSubject("Office 2007 XLSX Test Document")
                ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("Test result file");


        // Add some data
        $line = 1;

        foreach (\app\modules\dao\ar\Member::find()->all() as $no => $value) {
            $row = $line + $no;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $row, $no + 1);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $row, $value->name);
        }




// Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('C')->setAutoSize(true);


        // Redirect output to a client's web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="01simple.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0      
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    public function actionTemplate()
    {

        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = $objReader->load("/media/HD-500/Libraries/Github/Yii2Project/ppi_template.xls");

        $data = \app\modules\dao\ar\Member::find()->all();
        $objPHPExcel->getActiveSheet()->setTitle('PPI LOTENG');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', \PHPExcel_Shared_Date::PHPToExcel(time()));

        $baseRow = 7;
        $objPHPExcel->getActiveSheet()->setCellValue('B2', date('F d, Y H:i:s', time()));
        foreach ($data as $r => $dataRow) {
            $row = $baseRow + $r;
            $objPHPExcel->getActiveSheet()->insertNewRowBefore($row, 1);
//            $dataRow = new \app\modules\dao\ar\Member;
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $r + 1)
                    ->setCellValue('B' . $row, $dataRow->nra)
                    ->setCellValue('C' . $row, $dataRow->name)
                    ->setCellValue('D' . $row, $dataRow->nickname)
                    ->setCellValue('E' . $row, $dataRow->identity_card_number)
                    ->setCellValue('F' . $row, $dataRow->birth)
                    ->setCellValue('G' . $row, $dataRow->age)
                    ->setCellValue('H' . $row, $dataRow->address)
                    ->setCellValue('I' . $row, $dataRow->gender)
                    ->setCellValue('J' . $row, $dataRow->religion)
                    ->setCellValue('K' . $row, $dataRow->nationality)
                    ->setCellValue('L' . $row, "Daerah")
                    ->setCellValue('M' . $row, "Suku")
                    ->setCellValue('N' . $row, "skolah")
                    ->setCellValue('O' . $row, $dataRow->zip_code)
                    ->setCellValue('P' . $row, $dataRow->blood_group)
                    ->setCellValue('Q' . $row, "penghargaan")
                    ->setCellValue('R' . $row, $dataRow->organizational_experience)
                    ->setCellValue('S' . $row, $dataRow->illness)
                    ->setCellValue('T' . $row, $dataRow->height_body)
                    ->setCellValue('U' . $row, $dataRow->weight_body)
                    ->setCellValue('V' . $row, $dataRow->dress_size)
                    ->setCellValue('W' . $row, $dataRow->shoe_size)
                    ->setCellValue('X' . $row, $dataRow->shoe_size)
                    ->setCellValue('Y' . $row, $dataRow->hat_size)
                    ->setCellValue('Z' . $row, $dataRow->membership_status)
                    ->setCellValue('AA' . $row, $dataRow->status_organization)
                    ->setCellValue('AB' . $row, $dataRow->year)
                    ->setCellValue('AC' . $row, $dataRow->educational_status)
                    ->setCellValue('AD' . $row, $dataRow->marital_status)
                    ->setCellValue('AE' . $row, $dataRow->job)
                    ->setCellValue('AF' . $row, $dataRow->email)
                    ->setCellValue('AG' . $row, $dataRow->phone_number)
                    ->setCellValue('AH' . $row, $dataRow->other_phone_number)
                    ->setCellValue('AI' . $row, $dataRow->relationship_phone_number)
                    ->setCellValue('AJ' . $row, $dataRow->father_name)
                    ->setCellValue('AK' . $row, $dataRow->mother_name)
                    ->setCellValue('AL' . $row, $dataRow->father_work)
                    ->setCellValue('AM' . $row, $dataRow->mother_work)
                    ->setCellValue('AN' . $row, $dataRow->income_father)
                    ->setCellValue('AO' . $row, $dataRow->income_mothers)
                    ->setCellValue('AP' . $row, $dataRow->number_of_brothers)
                    ->setCellValue('AQ' . $row, $dataRow->number_of_sisters)
                    ->setCellValue('AR' . $row, $dataRow->number_of_children)
                    ->setCellValue('AS' . $row, "bahasa")
                    ->setCellValue('AT' . $row, "personal")
                    ->setCellValue('AU' . $row, $dataRow->note);
        }


//        $objPHPExcel->getActiveSheet()->removeRow($baseRow - 1, 1);

        $alpabet = 'A';
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alpabet)->setAutoSize(true);
        for ($n = 0; $n < 46; $n++) {
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension( ++$alpabet)->setAutoSize(true);
        }

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('export.txt', Yii::$app->user->identity->username . "-" . time() . '.xlsx', Yii::getAlias('@web') . 'resources/report/export/export.txt'));
        exit();

//        echo date('H:i:s'), " Peak memory usage: ", (memory_get_peak_usage(true) / 1024 / 1024), " MB", EOL;
    }

    public function actionImport()
    {
        return $this->render('index');
//        $objPHPExcel = \PHPExcel_IOFactory::load(Yii::getAlias('@web') . 'resources/report/1402567861.xlsx');
//        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
//            $worksheetTitle = $worksheet->getTitle();
//            $highestRow = $worksheet->getHighestRow(); // e.g. 10
//            $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
//            $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
//            $nrColumns = ord($highestColumn) - 64;
//            echo "<br>The worksheet " . $worksheetTitle . " has ";
//            echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
//            echo ' and ' . $highestRow . ' row.';
//            echo '<table class="table"><tr>';
//            for ($row = 1; $row <= $highestRow; ++$row) {
//                echo '<tr>';
//                for ($col = 0; $col < $highestColumnIndex; ++$col) {
//                    $cell = $worksheet->getCellByColumnAndRow($col, $row);
//                    $val = $cell->getValue();
////                    $dataType = \PHPExcel_Cell_DataType::dataTypeForValue($val);
//                    echo '<td>' . $val .'</td>';
//                }
//                echo '</tr>';
//            }
//            echo '</table>';
//        }
    }

//
//    public function actionIndex()
//    {
//        echo Yii::$app->user->identity->role;
////        $auth = Yii::$app->authManager;
////        $rule = new \app\modules\users\rules\PpiGroupRule();
////        $auth->add($rule);
////        
////        $ppiindex = $auth->createPermission('ppiindex');
////        $ppiindex->description = 'List data anggota ppi';
////        $ppiindex->ruleName = $rule->name;
////        $auth->add($ppiindex);
////        
////        $ppiview = $auth->createPermission('ppiview');
////        $ppiview->description = 'Lihat detail data anggota ppi';
////        $ppiview->ruleName = $rule->name;
////        $auth->add($ppiview);
////        
////        $ppicreate = $auth->createPermission('ppicreate');
////        $ppicreate->description = 'Tambah data anggota ppi';
////        $ppicreate->ruleName = $rule->name;
////        $auth->add($ppicreate);
////        
////        $ppiupdate = $auth->createPermission('ppiupdate');
////        $ppiupdate->description = 'Perbaharui data anggota ppi';
////        $ppiupdate->ruleName = $rule->name;
////        $auth->add($ppiupdate);
////        
////        $ppitrash = $auth->createPermission('ppitrash');
////        $ppitrash->description = 'Buang ketongsampah data anggota ppi';
////        $ppitrash->ruleName = $rule->name;
////        $auth->add($ppitrash);
////        
////        $ppidelete = $auth->createPermission('ppidelete');
////        $ppidelete->description = 'Hapus data anggota ppi';
////        $ppidelete->ruleName = $rule->name;
////        $auth->add($ppidelete);
////        
////        $adminppe = $auth->getRole('adminppe');        
////        $auth->addChild($adminppe, $ppiindex);
////        $auth->addChild($adminppe, $ppiview);
////        $auth->addChild($adminppe, $ppicreate);
////        $auth->addChild($adminppe, $ppiupdate);
////        $auth->addChild($adminppe, $ppitrash);
////        $auth->addChild($adminppe, $ppidelete);
////        
////        $subadminppe = $auth->getRole('subadminppe');
////        $auth->addChild($subadminppe, $ppiindex);
////        $auth->addChild($subadminppe, $ppiview);
////        $auth->addChild($subadminppe, $ppicreate);
////        $auth->addChild($subadminppe, $ppiupdate);
////        $auth->addChild($subadminppe, $ppitrash);
////        $auth->addChild($subadminppe, $ppidelete);
//    }
//
//    public function actionAddadministrator()
//    {
////        $auth = Yii::$app->authManager;
////        $rule = new \app\modules\users\rules\UserGroupRule();
////        $auth->add($rule);
////
////        $admin = $auth->createRole('admin');
////        $admin->ruleName = $rule->name;
////        $admin->description = "Admin default user";
////        $auth->add($admin);
////        $auth->addChild($admin, $auth->getRole('adminppe'));
////
////        $administrator = $auth->createRole('administrator');
////        $administrator->ruleName = $rule->name;
////        $administrator->description = "Administrator default user";
////        $auth->add($administrator);
////        $auth->addChild($administrator, $admin);
//    }
//
//    public function actionAddmemberrule()
//    {
//        $auth = Yii::$app->authManager;
//
////        $ppiindex = $auth->createPermission('ppiindex');
////        $ppiindex->description = 'List data anggota ppi';
////        $auth->add($ppiindex);
////
////        $ppiview = $auth->createPermission('ppiview');
////        $ppiview->description = 'Lihat detail data anggota ppi';
////        $auth->add($ppiview);
////
////        $ppicreate = $auth->createPermission('ppicreate');
////        $ppicreate->description = 'Tambah data anggota ppi';
////        $auth->add($ppicreate);
////
////        $ppiupdate = $auth->createPermission('ppiupdate');
////        $ppiupdate->description = 'Perbaharui data anggota ppi';
////        $auth->add($ppiupdate);
////
////        $ppitrash = $auth->createPermission('ppitrash');
////        $ppitrash->description = 'Buang ketongsampah data anggota ppi';
////        $auth->add($ppitrash);
////
////        $ppidelete = $auth->createPermission('ppidelete');
////        $ppidelete->description = 'Hapus data anggota ppi';
////        $auth->add($ppidelete);
////
////        $auth->addChild($auth->getRole('subadminppe'), $ppiindex);
////        $auth->addChild($auth->getRole('subadminppe'), $ppiview);
////        $auth->addChild($auth->getRole('subadminppe'), $ppicreate);
////        $auth->addChild($auth->getRole('subadminppe'), $ppiupdate);
////        $auth->addChild($auth->getRole('subadminppe'), $ppitrash);
////        $auth->addChild($auth->getRole('subadminppe'), $ppidelete);
////        $paskibraindex = $auth->createPermission('paskibraindex');
////        $paskibraindex->description = 'List data anggota paskibra';
////        $auth->add($paskibraindex);
////
////        $paskibraview = $auth->createPermission('paskibraview');
////        $paskibraview->description = 'Lihat detail data anggota paskibra';
////        $auth->add($paskibraview);
////
////        $paskibracreate = $auth->createPermission('paskibracreate');
////        $paskibracreate->description = 'Tambah data anggota paskibra';
////        $auth->add($paskibracreate);
////
////        $paskibraupdate = $auth->createPermission('paskibraupdate');
////        $paskibraupdate->description = 'Perbaharui data anggota paskibra';
////        $auth->add($paskibraupdate);
////
////        $paskibratrash = $auth->createPermission('paskibratrash');
////        $paskibratrash->description = 'Buang ketongsampah data anggota paskibra';
////        $auth->add($paskibratrash);
////
////        $paskibradelete = $auth->createPermission('paskibradelete');
////        $paskibradelete->description = 'Hapus data anggota paskibra';
////        $auth->add($paskibradelete);
////
////        $auth->addChild($auth->getRole('subadminppe'), $paskibraindex);
////        $auth->addChild($auth->getRole('subadminppe'), $paskibraview);
////        $auth->addChild($auth->getRole('subadminppe'), $paskibracreate);
////        $auth->addChild($auth->getRole('subadminppe'), $paskibraupdate);
////        $auth->addChild($auth->getRole('subadminppe'), $paskibratrash);
////        $auth->addChild($auth->getRole('subadminppe'), $paskibradelete);
////        $capasindex = $auth->createPermission('capasindex');
////        $capasindex->description = 'List data anggota capas';
////        $auth->add($capasindex);
////
////        $capasview = $auth->createPermission('capasview');
////        $capasview->description = 'Lihat detail data anggota capas';
////        $auth->add($capasview);
////
////        $capascreate = $auth->createPermission('capascreate');
////        $capascreate->description = 'Tambah data anggota capas';
////        $auth->add($capascreate);
////
////        $capasupdate = $auth->createPermission('capasupdate');
////        $capasupdate->description = 'Perbaharui data anggota capas';
////        $auth->add($capasupdate);
////
////        $capastrash = $auth->createPermission('capastrash');
////        $capastrash->description = 'Buang ketongsampah data anggota capas';
////        $auth->add($capastrash);
////
////        $capasdelete = $auth->createPermission('capasdelete');
////        $capasdelete->description = 'Hapus data anggota capas';
////        $auth->add($capasdelete);
////        $auth->addChild($auth->getRole('subadminppe'), $capasindex);
////        $auth->addChild($auth->getRole('subadminppe'), $capasview);
////        $auth->addChild($auth->getRole('subadminppe'), $capascreate);
////        $auth->addChild($auth->getRole('subadminppe'), $capasupdate);
////        $auth->addChild($auth->getRole('subadminppe'), $capastrash);
////        $auth->addChild($auth->getRole('subadminppe'), $capasdelete);
////        $brevetawardindex = $auth->createPermission('brevetawardindex');
////        $brevetawardindex->description = 'List data brevet peghargaan';
////        $auth->add($brevetawardindex);
////
////        $brevetawardview = $auth->createPermission('brevetawardview');
////        $brevetawardview->description = 'Lihat detail data brevet peghargaan';
////        $auth->add($brevetawardview);
////
////        $brevetawardcreate = $auth->createPermission('brevetawardcreate');
////        $brevetawardcreate->description = 'Tambah data brevet peghargaan';
////        $auth->add($brevetawardcreate);
////
////        $brevetawardupdate = $auth->createPermission('brevetawardupdate');
////        $brevetawardupdate->description = 'Perbaharui data brevet peghargaan';
////        $auth->add($brevetawardupdate);
////
////        $brevetawardbulk = $auth->createPermission('brevetawardbulk');
////        $brevetawardbulk->description = 'Hapus data brevet peghargaan secara masal';
////        $auth->add($brevetawardbulk);
////
////        $brevetawarddelete = $auth->createPermission('brevetawarddelete');
////        $brevetawarddelete->description = 'Hapus data brevet peghargaan';
////        $auth->add($brevetawarddelete);
////
////        $auth->addChild($auth->getRole('subadminppe'), $brevetawardindex);
////        $auth->addChild($auth->getRole('subadminppe'), $brevetawardview);
////        $auth->addChild($auth->getRole('subadminppe'), $brevetawardcreate);
////        $auth->addChild($auth->getRole('subadminppe'), $brevetawardupdate);
////        $auth->addChild($auth->getRole('subadminppe'), $brevetawardbulk);
////        $auth->addChild($auth->getRole('subadminppe'), $brevetawarddelete);
////        $lifeskillindex = $auth->createPermission('lifeskillindex');
////        $lifeskillindex->description = 'List data keterampilan';
////        $auth->add($lifeskillindex);
////
////        $lifeskillview = $auth->createPermission('lifeskillview');
////        $lifeskillview->description = 'Lihat detail data keterampilan';
////        $auth->add($lifeskillview);
////
////        $lifeskillcreate = $auth->createPermission('lifeskillcreate');
////        $lifeskillcreate->description = 'Tambah data keterampilan';
////        $auth->add($lifeskillcreate);
////
////        $lifeskillupdate = $auth->createPermission('lifeskillupdate');
////        $lifeskillupdate->description = 'Perbaharui data keterampilan';
////        $auth->add($lifeskillupdate);
////
////        $lifeskillbulk = $auth->createPermission('lifeskillbulk');
////        $lifeskillbulk->description = 'Hapus data keterampilan secara masal';
////        $auth->add($lifeskillbulk);
////
////        $lifeskilldelete = $auth->createPermission('lifeskilldelete');
////        $lifeskilldelete->description = 'Hapus data keterampilan';
////        $auth->add($lifeskilldelete);
////
////        $auth->addChild($auth->getRole('subadminppe'), $lifeskillindex);
////        $auth->addChild($auth->getRole('subadminppe'), $lifeskillview);
////        $auth->addChild($auth->getRole('subadminppe'), $lifeskillcreate);
////        $auth->addChild($auth->getRole('subadminppe'), $lifeskillupdate);
////        $auth->addChild($auth->getRole('subadminppe'), $lifeskillbulk);
////        $auth->addChild($auth->getRole('subadminppe'), $lifeskilldelete);
////        $languageskillindex = $auth->createPermission('languageskillindex');
////        $languageskillindex->description = 'List data keterampilan bahasa';
////        $auth->add($languageskillindex);
////
////        $languageskillview = $auth->createPermission('languageskillview');
////        $languageskillview->description = 'Lihat detail data keterampilan bahasa';
////        $auth->add($languageskillview);
////
////        $languageskillcreate = $auth->createPermission('languageskillcreate');
////        $languageskillcreate->description = 'Tambah data keterampilan bahasa';
////        $auth->add($languageskillcreate);
////
////        $languageskillupdate = $auth->createPermission('languageskillupdate');
////        $languageskillupdate->description = 'Perbaharui data keterampilan bahasa';
////        $auth->add($languageskillupdate);
////
////        $languageskillbulk = $auth->createPermission('languageskillbulk');
////        $languageskillbulk->description = 'Hapus data keterampilan bahasa secara masal';
////        $auth->add($languageskillbulk);
////
////        $languageskilldelete = $auth->createPermission('languageskilldelete');
////        $languageskilldelete->description = 'Hapus data keterampilan bahasa';
////        $auth->add($languageskilldelete);
////
////        $auth->addChild($auth->getRole('subadminppe'), $languageskillindex);
////        $auth->addChild($auth->getRole('subadminppe'), $languageskillview);
////        $auth->addChild($auth->getRole('subadminppe'), $languageskillcreate);
////        $auth->addChild($auth->getRole('subadminppe'), $languageskillupdate);
////        $auth->addChild($auth->getRole('subadminppe'), $languageskillbulk);
////        $auth->addChild($auth->getRole('subadminppe'), $languageskilldelete);
////        $areaindex = $auth->createPermission('areaindex');
////        $areaindex->description = 'List data daerah';
////        $auth->add($areaindex);
////
////        $areaview = $auth->createPermission('areaview');
////        $areaview->description = 'Lihat detail data daerah';
////        $auth->add($areaview);
////
////        $areacreate = $auth->createPermission('areacreate');
////        $areacreate->description = 'Tambah data daerah';
////        $auth->add($areacreate);
////
////        $areaupdate = $auth->createPermission('areaupdate');
////        $areaupdate->description = 'Perbaharui data daerah';
////        $auth->add($areaupdate);
////
////        $areabulk = $auth->createPermission('areabulk');
////        $areabulk->description = 'Hapus data daerah secara masal';
////        $auth->add($areabulk);
////
////        $areadelete = $auth->createPermission('areadelete');
////        $areadelete->description = 'Hapus data daerah';
////        $auth->add($areadelete);
////
////        $auth->addChild($auth->getRole('subadminppe'), $areaindex);
////        $auth->addChild($auth->getRole('subadminppe'), $areaview);
////        $auth->addChild($auth->getRole('subadminppe'), $areacreate);
////        $auth->addChild($auth->getRole('subadminppe'), $areaupdate);
////        $auth->addChild($auth->getRole('subadminppe'), $areabulk);
////        $auth->addChild($auth->getRole('subadminppe'), $areadelete);
////        $tribeindex = $auth->createPermission('tribeindex');
////        $tribeindex->description = 'List data suku bangsa';
////        $auth->add($tribeindex);
////
////        $tribeview = $auth->createPermission('tribeview');
////        $tribeview->description = 'Lihat detail data suku bangsa';
////        $auth->add($tribeview);
////
////        $tribecreate = $auth->createPermission('tribecreate');
////        $tribecreate->description = 'Tambah data suku bangsa';
////        $auth->add($tribecreate);
////
////        $tribeupdate = $auth->createPermission('tribeupdate');
////        $tribeupdate->description = 'Perbaharui data suku bangsa';
////        $auth->add($tribeupdate);
////
////        $tribebulk = $auth->createPermission('tribebulk');
////        $tribebulk->description = 'Hapus data suku bangsa secara masal';
////        $auth->add($tribebulk);
////
////        $tribedelete = $auth->createPermission('tribedelete');
////        $tribedelete->description = 'Hapus data suku bangsa';
////        $auth->add($tribedelete);
////
////        $auth->addChild($auth->getRole('subadminppe'), $tribeindex);
////        $auth->addChild($auth->getRole('subadminppe'), $tribeview);
////        $auth->addChild($auth->getRole('subadminppe'), $tribecreate);
////        $auth->addChild($auth->getRole('subadminppe'), $tribeupdate);
////        $auth->addChild($auth->getRole('subadminppe'), $tribebulk);
////        $auth->addChild($auth->getRole('subadminppe'), $tribedelete);
////        $schoolindex = $auth->createPermission('schoolindex');
////        $schoolindex->description = 'List data skolah';
////        $auth->add($schoolindex);
////
////        $schoolview = $auth->createPermission('schoolview');
////        $schoolview->description = 'Lihat detail data skolah';
////        $auth->add($schoolview);
////
////        $schoolcreate = $auth->createPermission('schoolcreate');
////        $schoolcreate->description = 'Tambah data skolah';
////        $auth->add($schoolcreate);
////
////        $schoolupdate = $auth->createPermission('schoolupdate');
////        $schoolupdate->description = 'Perbaharui data skolah';
////        $auth->add($schoolupdate);
////
////        $schoolbulk = $auth->createPermission('schoolbulk');
////        $schoolbulk->description = 'Hapus data skolah secara masal';
////        $auth->add($schoolbulk);
////
////        $schooldelete = $auth->createPermission('schooldelete');
////        $schooldelete->description = 'Hapus data skolah';
////        $auth->add($schooldelete);
////
////        $auth->addChild($auth->getRole('subadminppe'), $schoolindex);
////        $auth->addChild($auth->getRole('subadminppe'), $schoolview);
////        $auth->addChild($auth->getRole('subadminppe'), $schoolcreate);
////        $auth->addChild($auth->getRole('subadminppe'), $schoolupdate);
////        $auth->addChild($auth->getRole('subadminppe'), $schoolbulk);
////        $auth->addChild($auth->getRole('subadminppe'), $schooldelete);
//    }
//
//    public function actionAddrule()
//    {
//        $auth = Yii::$app->authManager;
//
////        $auth->add($subadminppe);
////        $auth->addChild($subadminppe, $ppiindex);
////        $auth->addChild($subadminppe, $ppiview);
////        $auth->addChild($subadminppe, $ppicreate);
////        $auth->addChild($subadminppe, $ppiupdate);
////        $auth->addChild($subadminppe, $ppitrash);
////        $auth->addChild($subadminppe, $ppidelete);
////
////
////        $adminppe = $auth->createRole('adminppe');
////        $adminppe->description = 'Admin PPE';
////        $auth->add($adminppe);
////        $auth->addChild($adminppe, $ppiupdate);
////        $auth->addChild($adminppe, $subadminppe);
////
////        $auth->assign($adminppe, 2);
////        $auth->assign($subadminppe, 3);
//    }
}
