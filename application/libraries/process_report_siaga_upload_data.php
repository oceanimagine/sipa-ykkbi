<?php

include_once __DIR__ . '/../libraries/phpspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class process_report_siaga_upload_data {
    private $spreadsheet;
    public $filename = "";
    public function __construct($all = "", $view_only = false){
        if($all == "all"){
            ini_set("display_errors", "On");
            error_reporting(E_ALL);
            $this->CI = & get_instance();
            $this->CI->load->model('get_add_anggaran');
            $reader = IOFactory::createReader("Xlsx");
            $this->spreadsheet = $reader->load(__DIR__."/../../upload/xlsx_excel/TEMPLATE07.xlsx");
            $this->sheet_data();
            if($view_only){
                $this->filename = $this->view_excel();
            } else {
                $this->print_excel();
            }
        }
    }
    
    public function sheet_data(){
        $process_report_config = new process_report_config();
        $process_report_config->upload_data_siaga();
        $row_col = $process_report_config->upload_data_siaga;
        
        $key_row_col = array_keys($row_col);
        
        $this->CI->get_add_anggaran->process(array(
            'action' => 'select',
            'table' => 'sp_rpt_anggaran_upload(\''.$this->CI->kode_project_scope_controller.'\')',
            'column_value' => $key_row_col
        ));
        
        $sheetname = "SHEETDATA";
        $spreadsheet = $this->spreadsheet;
        
        $begin_row_delete = 4;
        $begin_row_start = 12;
        $limit_data = 5;
        $begin_row = $begin_row_start;
        
        $all_data = $this->CI->all;
        $no = 1;
        
        if(sizeof($all_data) < $limit_data){
            for($i = 0; $i < $limit_data; $i++){
                $all_data[$i] = isset($all_data[$i]) ? $all_data[$i] : new stdClass();
                for($j = 0; $j < sizeof($key_row_col); $j++){
                    $all_data[$i]->{$key_row_col[$j]} = isset($all_data[$i]->{$key_row_col[$j]}) ? $all_data[$i]->{$key_row_col[$j]} : "";
                }
            }
        }
        
        for($i = 0; $i < sizeof($all_data); $i++){
            for($j = 0; $j < sizeof($key_row_col); $j++){
                $spreadsheet->getSheetByName($sheetname)->setCellValue($row_col[$key_row_col[$j]] . $begin_row, $all_data[$i]->{$key_row_col[$j]});
            }
            $spreadsheet->getSheetByName($sheetname)->setCellValue("A" . $begin_row, $no);
            $begin_row++;
            $no++;
        }
        $spreadsheet->getSheetByName($sheetname)->removeRow(($begin_row_delete + 1),($begin_row_start - ($begin_row_delete + 1)));
        $spreadsheet->getSheetByName($sheetname)->getStyle('A'.($begin_row_delete + 1).":E".(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        $spreadsheet->getActiveSheet()->getStyle('A'.($begin_row_delete + 1).':E'.(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getAlignment()->setWrapText(true);
        
        $this->spreadsheet = $spreadsheet;
    }
    
    function print_excel(){
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition: attachment;filename=Data Upload Untuk SIAGA.xlsx');
        $writer = IOFactory::createWriter($this->spreadsheet, 'Xlsx');
        $writer->save('php://output'); 
    }
    
    function view_excel(){
        ob_start();
        $writer = IOFactory::createWriter($this->spreadsheet, 'Xlsx');
        $writer->save('php://output');
        $hasil = ob_get_clean();
        $file_name = "TEMPORARYMA" . date("YmdHis") . rand(1000,9999) . ".xlsx";
        file_put_contents(__DIR__."/../../upload/xlsx_excel/temporary/" . $file_name, $hasil);
        return $file_name;
    }
}
