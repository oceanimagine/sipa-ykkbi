<?php

class process_kamus_excel {
    public $result = array();
    public function __construct($type = "") {
        if($type == "xlsx" || $type == "xls"){
            $this->load_kamus($type);
        }
    }
    private function load_kamus($type){
        ini_set("display_errors", 0);
        error_reporting(0);
        require_once __DIR__.'/phpexcel/PHPExcel.php';
        $inputFileName = __DIR__ . '/../../upload/xlsx_excel/KAMUS.' . $type;
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow(); 
        $highestColumn = $sheet->getHighestColumn();
        
        $all_array = array();
        $key_begin = "";
        for ($col = "B"; $col <= $highestColumn; $col++){ 
            
            // Get Define Name Condition 
            if($sheet->getCell($col . "3")->getValue() != ""){
                $key_begin = trim($sheet->getCell($col . "3")->getValue());
                $all_array[$key_begin] = array();
            }
            
            // Get Formula Condition
            if($sheet->getCell($col . "5")->getValue() != ""){
                $array_formula = array();
                $address = 0;
                $address_array = 0;
                $begin_concate = 0;
                $value_col_5 = $sheet->getCell($col . "5")->getValue();
                while(isset($value_col_5[$address])){
                    if(!$begin_concate){
                        if($value_col_5[$address] == "{"){
                            $begin_concate = 1;
                            $array_formula[$address_array] = "";

                        }
                    } else {
                        if($value_col_5[$address] == "}"){
                            $begin_concate = 0;
                            $address_array++;
                        } else {
                            $array_formula[$address_array] = $array_formula[$address_array] . $value_col_5[$address];
                        }
                    }
                    $address++;
                }
                $all_array[$key_begin]['formula'] = $array_formula;
                
                // Get Define Col Row
                $array_key_val = array();
                for ($row = 7; $row <= $highestRow; $row++){ 
                    if($sheet->getCell($col . $row)->getValue() != ""){
                        $key_field = $sheet->getCell($col . $row)->getValue();
                        $val_field = $sheet->getCell(do_increment($col, "ALP") . $row)->getValue();
                        $array_key_val[$key_field] = $val_field;
                    }
                }
                $all_array[$key_begin]['row_col'] = $array_key_val;
                
            }
        }
        $this->result = $all_array;
    }
}