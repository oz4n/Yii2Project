<?php

use yii\web\View;

$this->registerJsFile('PixelAdmin/js/jquery.2.0.3.min.js', [], ['position' => View::POS_HEAD]);
?>
<div class="panel">
    <div class="panel-body">
        <div class="table-responsive">
            <?php
            $objPHPExcel = \PHPExcel_IOFactory::load(\Yii::getAlias('@web') . 'resources/report/1402579790.xlsx');

            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                $worksheetTitle = $worksheet->getTitle();
                $highestRow = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;
//                echo $highestRow;
                echo '<table id="table-import" class="table">';
                echo '<thead style="display:none">';
                for ($row = 5; $row <= $highestRow; ++$row) {
                    if ($row === 5) {
                        echo '<tr>';
                            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                                $cell = $worksheet->getCellByColumnAndRow($col, $row);
                                $val = $cell->getValue();
                                echo '<th>' . str_replace("-", "", str_replace(" ", "", $val)) . '</th>';
                            }
                        echo '</tr>';
                        
                    }
                }                   
               echo '</thead>';
               
              
               
               for ($row = 5; $row <= $highestRow; ++$row) {
                    if ($row === 5) {
                        echo '<tr>';
                        for ($col = 0; $col < $highestColumnIndex; ++$col) {
                            $cell = $worksheet->getCellByColumnAndRow($col, $row);
                            $val = $cell->getValue();
                            echo '<th>' . $val . '</th>';
                        }
                        echo '</tr>';
                    } else {
                        echo '<tr>';
                        for ($col = 0; $col < $highestColumnIndex; ++$col) {
                            $cell = $worksheet->getCellByColumnAndRow($col, $row);
                            $val = $cell->getValue();
                            echo '<td data-vale="' . $val . '">' . $val . '</td>';
                        }
                        echo '</tr>';
                    }
                }
                echo '</table>';
            }
            ?>
        </div>
    </div>
    <div class="panel-footer">
        <button class="btn btn-primary" id="convert-table">Convert!</button>
    </div>
</div>

<?php
$this->registerJs(
        '
    $("#convert-table").click( function() {
        var table = $("#table-import").tableToJSON(); // Convert the table into a javascript object
        console.log(table);
        alert(JSON.stringify(table));
    });
    '
        , View::POS_READY);
?>