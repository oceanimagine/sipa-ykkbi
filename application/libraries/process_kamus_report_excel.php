<?php

include_once __DIR__ . '/../libraries/phpspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
class process_kamus_report_excel {
    public $kamus;
    public function __construct($param_ = "") {
        $this->CI = & get_instance();
        $this->CI->load->model('get_add_anggaran');
        $this->export_data($param_);
    }
    public function get_kamus(){
        $get_kamus = new process_kamus_excel('xlsx');
        $this->kamus = $get_kamus;
    }
    
    public function get_mapping(){
        $this->get_kamus();
        echo "<pre>\n";
        print_r($this->kamus->result);
        echo "</pre>\n";
    }
    
    public function export_data($param_){
        $this->get_kamus();
        $param = str_replace("_", "-", $param_);
        if(isset($this->kamus->result[$param])){
            $param_begin = $this->kamus->result[$param];
            $formula = $param_begin['formula'];
            $row_col = $param_begin['row_col'];
            $where = "";
            $and = "";
            if(isset($formula[0]) && $formula[0] != ""){
                $explode_semicolon = explode(";", $formula[0]);
                
                for($i = 0; $i < sizeof($explode_semicolon); $i++){
                    if($explode_semicolon[$i] != ""){
                        $where = $where . $and . "'" . trim($explode_semicolon[$i]) . "'";
                        $and = ", ";
                    }
                }
                if($where != ""){
                    $where = "rekmagroup in (" . $where . ")";
                }
            }
            
            if(isset($formula[1]) && $formula[1] != ""){
                if($where == ""){
                    $where = $where . " lvl::int " . $formula[1];
                } else {
                    $where = $where . " and lvl::int " . $formula[1];
                }
            }
            $key_row_col = array_keys($row_col);
            
            $this->CI->get_add_anggaran->process(array(
                'action' => 'select',
                'table' => 'sp_rpt_anggaran_mataanggaran(\''.$this->CI->kode_project_scope_controller.'\')',
                'column_value' => $key_row_col,
                'where' => $where
            ));
            
            $reader = IOFactory::createReader("Xlsx");
            $spreadsheet = $reader->load(__DIR__."/../../upload/xlsx_excel/TEMPLATE.xlsx");
            
            $all_data = $this->CI->all;
            $currentrow = 9;
            for($i = 0; $i < sizeof($all_data); $i++){
                for($j = 0; $j < sizeof($key_row_col); $j++){
                    $spreadsheet->getActiveSheet()->setCellValue($row_col[$key_row_col[$j]] . $currentrow, $all_data[$i]->{$key_row_col[$j]});
                }
                $currentrow++;
            }

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");
            header('Content-Disposition: attachment;filename=Hasil Excel.xlsx');
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output'); 
        }
    }
}
