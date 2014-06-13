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
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(++$alpabet)->setAutoSize(true);
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
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(++$alpabet)->setAutoSize(true);
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
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension(++$alpabet)->setAutoSize(true);
        }

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('export.txt', $filename . '.xlsx', Yii::getAlias('@web') . 'resources/report/export/export.txt'));
    }

}
