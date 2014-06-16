<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\member\models;

use Yii;
use app\modules\member\searchs\PpiSerch;

/**
 * Description of ToolsModel
 *
 * @author melengo
 */
class ToolsModel extends PpiSerch
{

    public function findAllMemberByType($param)
    {
        $model = self::find();
        $model->onCondition([
            'type_member' => $param['member_type']
        ])->limit($param['limit']);

        if (isset($param['year_filtr1']) || isset($param['year_filtr2'])) {
            $model->orFilterWhere(['like', 'year', $param['year_filtr1']]);
            $model->orFilterWhere(['like', 'year', $param['year_filtr2']]);
        }

        return $model->all();
    }

    public static function savePpi($data, $save_status)
    {
        /** @var CapasModel $ppi */
        $ppi = ((object) $data);
        $model = new CapasModel;
        $model->create_et = date("Y-m-d H:i:s");
        $model->update_et = date("Y-m-d H:i:s");
        $model->type_member = MEMBER_TYPE_PPI;
        $model->save_status = $save_status;
        $model->taxonomy_id = 114;
        $model->school_id = 1;
        $model->user_id = Yii::$app->user->identity->getId();
        $model->nra = $ppi->nra;
        $model->name = $ppi->name;
        $model->nickname = $ppi->nickname;
        $model->identity_card_number = $ppi->identity_card_number;
        $model->birth = $ppi->birth;
        $model->age = $ppi->age;
        $model->address = $ppi->address;
        $model->gender = $ppi->gender;
        $model->religion = $ppi->religion;
        $model->nationality = $ppi->nationality;
        $model->tribal_members = $ppi->tribal_members;
        $model->zip_code = $ppi->zip_code;
        $model->blood_group = $ppi->blood_group;
        $model->brevetaward = $ppi->brevetaward;
        $model->organizational_experience = $ppi->organizational_experience;
        $model->illness = $ppi->illness;
        $model->height_body = $ppi->height_body;
        $model->weight_body = $ppi->weight_body;
        $model->dress_size = $ppi->dress_size;
        $model->pants_size = $ppi->pants_size;
        $model->shoe_size = $ppi->shoe_size;
        $model->hat_size = $ppi->hat_size;
        $model->membership_status = $ppi->membership_status;
        $model->status_organization = $ppi->status_organization;
        $model->year = $ppi->year;
        $model->educational_status = $ppi->educational_status;
        $model->marital_status = $ppi->marital_status;
        $model->job = $ppi->job;
        $model->email = $ppi->email;
        $model->phone_number = $ppi->phone_number;
        $model->other_phone_number = $ppi->other_phone_number;
        $model->relationship_phone_number = $ppi->relationship_phone_number;
        $model->father_name = $ppi->father_name;
        $model->mother_name = $ppi->mother_name;
        $model->father_work = $ppi->father_work;
        $model->mother_work = $ppi->mother_work;
        $model->income_father = $model->income_mothers;
        $model->number_of_brothers = $ppi->number_of_brothers;
        $model->number_of_sisters = $ppi->number_of_sisters;
        $model->number_of_children = $ppi->number_of_children;
        $model->languageskill = $ppi->languageskill;
        $model->lifeskill = $ppi->lifeskill;
        $model->note = $ppi->note;
        $model->save();
    }

    public static function savePaskibra($data, $save_status)
    {
        /** @var CapasModel $paskibra */
        $paskibra = ((object) $data);
        $model = new CapasModel;
        $model->create_et = date("Y-m-d H:i:s");
        $model->update_et = date("Y-m-d H:i:s");
        $model->type_member = MEMBER_TYPE_PASKIBRA;
        $model->save_status = $save_status;
        $model->taxonomy_id = 114;
        $model->school_id = 1;
        $model->user_id = Yii::$app->user->identity->getId();
        $model->nra = $paskibra->nra;
        $model->name = $paskibra->name;
        $model->nickname = $paskibra->nickname;
        $model->identity_card_number = $paskibra->identity_card_number;
        $model->birth = $paskibra->birth;
        $model->age = $paskibra->age;
        $model->address = $paskibra->address;
        $model->gender = $paskibra->gender;
        $model->religion = $paskibra->religion;
        $model->nationality = $paskibra->nationality;
        $model->tribal_members = $paskibra->tribal_members;
        $model->zip_code = $paskibra->zip_code;
        $model->blood_group = $paskibra->blood_group;
        $model->brevetaward = $paskibra->brevetaward;
        $model->organizational_experience = $paskibra->organizational_experience;
        $model->illness = $paskibra->illness;
        $model->height_body = $paskibra->height_body;
        $model->weight_body = $paskibra->weight_body;
        $model->dress_size = $paskibra->dress_size;
        $model->pants_size = $paskibra->pants_size;
        $model->shoe_size = $paskibra->shoe_size;
        $model->hat_size = $paskibra->hat_size;
        $model->membership_status = $paskibra->membership_status;
        $model->status_organization = $paskibra->status_organization;
        $model->year = $paskibra->year;
        $model->educational_status = $paskibra->educational_status;
        $model->marital_status = $paskibra->marital_status;
        $model->job = $paskibra->job;
        $model->email = $paskibra->email;
        $model->phone_number = $paskibra->phone_number;
        $model->other_phone_number = $paskibra->other_phone_number;
        $model->relationship_phone_number = $paskibra->relationship_phone_number;
        $model->father_name = $paskibra->father_name;
        $model->mother_name = $paskibra->mother_name;
        $model->father_work = $paskibra->father_work;
        $model->mother_work = $paskibra->mother_work;
        $model->income_father = $model->income_mothers;
        $model->number_of_brothers = $paskibra->number_of_brothers;
        $model->number_of_sisters = $paskibra->number_of_sisters;
        $model->number_of_children = $paskibra->number_of_children;
        $model->languageskill = $paskibra->languageskill;
        $model->lifeskill = $paskibra->lifeskill;
        $model->note = $paskibra->note;
        $model->save();
    }

    public static function saveCapas($data, $save_status)
    {
        /** @var CapasModel $capas */
        $capas = ((object) $data);
        $model = new CapasModel;
        $model->create_et = date("Y-m-d H:i:s");
        $model->update_et = date("Y-m-d H:i:s");
        $model->type_member = MEMBER_TYPE_CAPAS;
        $model->save_status = $save_status;
        $model->taxonomy_id = 114;
        $model->school_id = 1;
        $model->user_id = Yii::$app->user->identity->getId();
        $model->nra = $capas->nra;
        $model->name = $capas->name;
        $model->nickname = $capas->nickname;
        $model->identity_card_number = $capas->identity_card_number;
        $model->birth = $capas->birth;
        $model->age = $capas->age;
        $model->address = $capas->address;
        $model->gender = $capas->gender;
        $model->religion = $capas->religion;
        $model->nationality = $capas->nationality;
        $model->tribal_members = $capas->tribal_members;
        $model->zip_code = $capas->zip_code;
        $model->blood_group = $capas->blood_group;
        $model->brevetaward = $capas->brevetaward;
        $model->organizational_experience = $capas->organizational_experience;
        $model->illness = $capas->illness;
        $model->height_body = $capas->height_body;
        $model->weight_body = $capas->weight_body;
        $model->dress_size = $capas->dress_size;
        $model->pants_size = $capas->pants_size;
        $model->shoe_size = $capas->shoe_size;
        $model->hat_size = $capas->hat_size;
        $model->membership_status = $capas->membership_status;
        $model->status_organization = $capas->status_organization;
        $model->year = $capas->year;
        $model->educational_status = $capas->educational_status;
        $model->marital_status = $capas->marital_status;
        $model->job = $capas->job;
        $model->email = $capas->email;
        $model->phone_number = $capas->phone_number;
        $model->other_phone_number = $capas->other_phone_number;
        $model->relationship_phone_number = $capas->relationship_phone_number;
        $model->father_name = $capas->father_name;
        $model->mother_name = $capas->mother_name;
        $model->father_work = $capas->father_work;
        $model->mother_work = $capas->mother_work;
        $model->income_father = $model->income_mothers;
        $model->number_of_brothers = $capas->number_of_brothers;
        $model->number_of_sisters = $capas->number_of_sisters;
        $model->number_of_children = $capas->number_of_children;
        $model->languageskill = $capas->languageskill;
        $model->lifeskill = $capas->lifeskill;
        $model->note = $capas->note;
        $model->save();
    }

    public function getAreaNameByID($id)
    {
        $m = AreaModel::findBySql("SELECT * FROM taxonomy WHERE id='" . $id . "'")->one();
        return $m["name"];
    }

    public function getSchollNameByID($id)
    {
        $m = SchoolModel::findBySql("SELECT * FROM school WHERE id='" . $id . "'")->one();
        return $m["name"];
    }

    public function memberExport($param, $filename)
    {
        $data = $this->findAllMemberByType($param);
        switch ($param["member_type"]) {
            case "PPI";
                return $this->ppiExport($data, $filename);
                break;
            case "Paskibra";
                return $this->paskibraExport($data, $filename);
                break;
            case "Capas";
                return $this->capasExport($data, $filename);
                break;
        }
    }

    public function ppiExport($data, $filename)
    {
        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = $objReader->load(__DIR__ . "/../template/" . "ppi_template.xls");

        $objPHPExcel->getActiveSheet()->setTitle('PPI LOTENG');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', \PHPExcel_Shared_Date::PHPToExcel(time()));

        $baseRow = 7;
        $objPHPExcel->getActiveSheet()->setCellValue('B2', date('F d, Y H:i:s', time()));
        foreach ($data as $r => $dataRow) {
            $row = $baseRow + $r;
            $objPHPExcel->getActiveSheet()->insertNewRowBefore($row, 1);
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
                    ->setCellValue('L' . $row, $this->getAreaNameByID($dataRow->taxonomy_id))
                    ->setCellValue('M' . $row, $dataRow->tribal_members)
                    ->setCellValue('N' . $row, $this->getSchollNameByID($dataRow->school_id))
                    ->setCellValue('O' . $row, $dataRow->zip_code)
                    ->setCellValue('P' . $row, $dataRow->blood_group)
                    ->setCellValue('Q' . $row, $dataRow->brevetaward)
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
                    ->setCellValue('AS' . $row, $dataRow->languageskill)
                    ->setCellValue('AT' . $row, $dataRow->lifeskill)
                    ->setCellValue('AU' . $row, $dataRow->note);
        }


        $objPHPExcel->getActiveSheet()->removeRow($baseRow - 1, 1);

        $alpabet = 'A';
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alpabet)->setAutoSize(true);
        for ($n = 0; $n < 46; $n++) {
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension( ++$alpabet)->setAutoSize(true);
        }

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('export.txt', $filename . '.xlsx', Yii::getAlias('@web') . 'resources/report/export/export.txt'));
    }

    public function paskibraExport($data, $filename)
    {
        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = $objReader->load(__DIR__ . "/../template/" . "paskibra_template.xls");

        $objPHPExcel->getActiveSheet()->setTitle('PASKIBRA LOTENG');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', \PHPExcel_Shared_Date::PHPToExcel(time()));

        $baseRow = 7;
        $objPHPExcel->getActiveSheet()->setCellValue('B2', date('F d, Y H:i:s', time()));
        foreach ($data as $r => $dataRow) {
            $row = $baseRow + $r;
            $objPHPExcel->getActiveSheet()->insertNewRowBefore($row, 1);
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
                    ->setCellValue('L' . $row, $this->getAreaNameByID($dataRow->taxonomy_id))
                    ->setCellValue('M' . $row, $dataRow->tribal_members)
                    ->setCellValue('N' . $row, $this->getSchollNameByID($dataRow->school_id))
                    ->setCellValue('O' . $row, $dataRow->zip_code)
                    ->setCellValue('P' . $row, $dataRow->blood_group)
                    ->setCellValue('Q' . $row, $dataRow->brevetaward)
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
                    ->setCellValue('AS' . $row, $dataRow->languageskill)
                    ->setCellValue('AT' . $row, $dataRow->lifeskill)
                    ->setCellValue('AU' . $row, $dataRow->note);
        }


        $objPHPExcel->getActiveSheet()->removeRow($baseRow - 1, 1);

        $alpabet = 'A';
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alpabet)->setAutoSize(true);
        for ($n = 0; $n < 46; $n++) {
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension( ++$alpabet)->setAutoSize(true);
        }

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('export.txt', $filename . '.xlsx', Yii::getAlias('@web') . 'resources/report/export/export.txt'));
    }

    public function capasExport($data, $filename)
    {
        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = $objReader->load(__DIR__ . "/../template/" . "capas_template.xls");

        $objPHPExcel->getActiveSheet()->setTitle('CAPAS LOTENG');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', \PHPExcel_Shared_Date::PHPToExcel(time()));

        $baseRow = 7;
        $objPHPExcel->getActiveSheet()->setCellValue('B2', date('F d, Y H:i:s', time()));
        foreach ($data as $r => $dataRow) {
            $row = $baseRow + $r;
            $objPHPExcel->getActiveSheet()->insertNewRowBefore($row, 1);
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
                    ->setCellValue('L' . $row, $this->getAreaNameByID($dataRow->taxonomy_id))
                    ->setCellValue('M' . $row, $dataRow->tribal_members)
                    ->setCellValue('N' . $row, $this->getSchollNameByID($dataRow->school_id))
                    ->setCellValue('O' . $row, $dataRow->zip_code)
                    ->setCellValue('P' . $row, $dataRow->blood_group)
                    ->setCellValue('Q' . $row, $dataRow->brevetaward)
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
                    ->setCellValue('AB' . $row, $dataRow->educational_status)
                    ->setCellValue('AC' . $row, $dataRow->marital_status)
                    ->setCellValue('AD' . $row, $dataRow->job)
                    ->setCellValue('AE' . $row, $dataRow->email)
                    ->setCellValue('AF' . $row, $dataRow->phone_number)
                    ->setCellValue('AG' . $row, $dataRow->other_phone_number)
                    ->setCellValue('AH' . $row, $dataRow->relationship_phone_number)
                    ->setCellValue('AI' . $row, $dataRow->father_name)
                    ->setCellValue('AJ' . $row, $dataRow->mother_name)
                    ->setCellValue('AK' . $row, $dataRow->father_work)
                    ->setCellValue('AL' . $row, $dataRow->mother_work)
                    ->setCellValue('AM' . $row, $dataRow->income_father)
                    ->setCellValue('AN' . $row, $dataRow->income_mothers)
                    ->setCellValue('AO' . $row, $dataRow->number_of_brothers)
                    ->setCellValue('AP' . $row, $dataRow->number_of_sisters)
                    ->setCellValue('AQ' . $row, $dataRow->number_of_children)
                    ->setCellValue('AR' . $row, $dataRow->languageskill)
                    ->setCellValue('AS' . $row, $dataRow->lifeskill)
                    ->setCellValue('AT' . $row, $dataRow->note);
        }


        $objPHPExcel->getActiveSheet()->removeRow($baseRow - 1, 1);

        $alpabet = 'A';
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($alpabet)->setAutoSize(true);
        for ($n = 0; $n < 45; $n++) {
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension( ++$alpabet)->setAutoSize(true);
        }

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('export.txt', $filename . '.xlsx', Yii::getAlias('@web') . 'resources/report/export/export.txt'));
    }

    public function validateXlsxFormat($file)
    {
        $objPHPExcel = \PHPExcel_IOFactory::load($file);
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $worksheetTitle = $worksheet->getTitle();
            $highestRow = $worksheet->getHighestRow(); // e.g. 10
            $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
            $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
            $nrColumns = ord($highestColumn) - 64;
            for ($row = 5; $row <= $highestRow; ++$row) {
                if ($row === 5) {
                    for ($col = 0; $col < $highestColumnIndex; ++$col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();
                        switch ($col) {
                            case 0;
                                return true;
                                break;
                            case 1;
                                return true;
                                break;
                            case 2;
                                return true;
                                break;
                            case 3;
                                return true;
                                break;
                            case 4;
                                return true;
                                break;
                            case 5;
                                return true;
                                break;
                            case 6;
                                echo "<th data-val='$col'>age</th>";
                                break;
                            case 7;
                                echo "<th data-val='$col'>address</th>";
                                break;
                            case 8;
                                echo "<th data-val='$col'>gender</th>";
                                break;
                            case 9;
                                echo "<th data-val='$col'>religion</th>";
                                break;
                            case 10;
                                echo "<th data-val='$col'>nationality</th>";
                                break;
                            case 11;
                                echo "<th data-val='$col'>taxonomy_id</th>"; //asal daerah
                                break;
                            case 12;
                                echo "<th data-val='$col'>tribal_members</th>";
                                break;
                            case 13;
                                echo "<th data-val='$col'>school_id</th>"; // asal sekolah
                                break;
                            case 14;
                                echo "<th data-val='$col'>zip_code</th>";
                                break;
                            case 15;
                                echo "<th data-val='$col'>blood_group</th>";
                                break;
                            case 16;
                                echo "<th data-val='$col'>brevetaward</th>";
                                break;
                            case 17;
                                echo "<th data-val='$col'>organizational_experience</th>";
                                break;
                            case 18;
                                echo "<th data-val='$col'>illness</th>";
                                break;
                            case 19;
                                echo "<th data-val='$col'>height_body</th>";
                                break;
                            case 20;
                                echo "<th data-val='$col'>weight_body</th>";
                                break;
                            case 21;
                                echo "<th data-val='$col'>dress_size</th>";
                                break;
                            case 22;
                                echo "<th data-val='$col'>pants_size</th>";
                                break;
                            case 23;
                                echo "<th data-val='$col'>shoe_size</th>";
                                break;
                            case 24;
                                echo "<th data-val='$col'>hat_size</th>";
                                break;
                            case 25;
                                echo "<th data-val='$col'>membership_status</th>";
                                break;
                            case 26;
                                echo "<th data-val='$col'>status_organization</th>";
                                break;
                            case 27;
                                echo "<th data-val='$col'>year</th>";
                                break;
                            case 28;
                                echo "<th data-val='$col'>educational_status</th>";
                                break;
                            case 29;
                                echo "<th data-val='$col'>marital_status</th>";
                                break;
                            case 30;
                                echo "<th data-val='$col'>job</th>";
                                break;
                            case 31;
                                echo "<th data-val='$col'>email</th>";
                                break;
                            case 32;
                                echo "<th data-val='$col'>phone_number</th>";
                                break;
                            case 33;
                                echo "<th data-val='$col'>other_phone_number</th>";
                                break;
                            case 34;
                                echo "<th data-val='$col'>relationship_phone_number</th>";
                                break;
                            case 35;
                                echo "<th data-val='$col'>father_name</th>";
                                break;
                            case 36;
                                echo "<th data-val='$col'>mother_name</th>";
                                break;
                            case 37;
                                echo "<th data-val='$col'>father_work</th>";
                                break;
                            case 38;
                                echo "<th data-val='$col'>mother_work</th>";
                                break;
                            case 39;
                                echo "<th data-val='$col'>income_father</th>";
                                break;
                            case 40;
                                echo "<th data-val='$col'>income_mothers</th>";
                                break;
                            case 41;
                                echo "<th data-val='$col'>number_of_brothers</th>";
                                break;
                            case 42;
                                echo "<th data-val='$col'>number_of_sisters</th>";
                                break;
                            case 43;
                                echo "<th data-val='$col'>number_of_children</th>";
                                break;
                            case 44;
                                echo "<th data-val='$col'>languageskill</th>";
                                break;
                            case 45;
                                echo "<th data-val='$col'>lifeskill</th>";
                                break;
                            case 46;
                                echo "<th data-val='$col'>note</th>";
                                break;
                        }
                    }
                }
            }
        }
    }

}