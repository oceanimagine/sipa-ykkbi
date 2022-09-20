<?php

include_once __DIR__ . '/../libraries/phpspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class process_report_excel_ma {
    private $spreadsheet;
    public $filename = "";
    public function __construct($all = "", $view_only = false){
        if($all == "all"){
            ini_set("display_errors", "On");
            error_reporting(E_ALL);
            $this->CI = & get_instance();
            $this->CI->load->model('get_add_anggaran');
            $reader = IOFactory::createReader("Xlsx");
            $this->spreadsheet = $reader->load(__DIR__."/../../upload/xlsx_excel/TEMPLATE03.xlsx");
            $this->report_operasional_tahunan_dan_rppt();
            $this->report_operasional_tahunan_dan_rppt_rincian();
            $this->report_investasi_rencana_korporasi_dan_rppt();
            $this->report_laporan_anggaran_investasi_rencana_korporasi_rincian();
            $this->report_kegiatan_rincian_anggaran_rppt_per_mata_anggaran();
            $this->remove_kamus_sheet();
            if($view_only){
                $this->filename = $this->view_excel();
            } else {
                $this->print_excel();
            }
        }
    }
    
    public function report_operasional_tahunan_dan_rppt(){
        $process_report_config = new process_report_config();
        $process_report_config->operasional_tahunan_dan_rppt();
        $row_col = $process_report_config->operasional_tahunan_dan_rppt;
        
        $key_row_col = array_keys($row_col);
        
        $this->CI->get_add_anggaran->process(array(
            'action' => 'select',
            'table' => 'sp_rpt_anggaran_mataanggaran(\''.$this->CI->kode_project_scope_controller.'\')',
            'column_value' => $key_row_col,
            'where' => "rekmagroup in ('PENDAPATAN','BIAYA') and lvl::int <= 3"
        ));
        
        $sheetname = "OPERASIONAL";
        $spreadsheet = $this->spreadsheet;
        
        $highestColumn = $spreadsheet->getSheetByName($sheetname)->getHighestColumn();
        
        $default_height = 12;
        $begin_row_delete = 8;
        $begin_row_start = 20;
        $limit_data = 3;
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
        
        if(sizeof($all_data) > 0){
            if(sizeof($all_data) > $limit_data){
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style_last = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 12);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style_last, Coordinate::stringFromColumnIndex($col) . ($begin_row_start + sizeof($all_data)));
                }
                $this->unmerge_and_empty_cell('D:F', $begin_row_delete + 1, $sheetname);
            }
        }
        
        
        for($i = 0; $i < sizeof($all_data); $i++){
            $isi_kata = $all_data[$i]->rekmanama;
            if($all_data[$i]->lvl == "1"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('D'.$begin_row.':F'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('D'.$begin_row, $isi_kata);
    
                $spreadsheet->getSheetByName($sheetname)->setCellValue('G'.$begin_row, "=C9");
                
            }
            else if($all_data[$i]->lvl == "2"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('E'.$begin_row.':F'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('E'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('G'.$begin_row, "=C10");
                
                
            }
            else if($all_data[$i]->lvl == "3"){
                $spreadsheet->getSheetByName($sheetname)->setCellValue('F'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('G'.$begin_row, "=C11");
                
                
            }
            
            for($j = 0; $j < sizeof($key_row_col); $j++){
                if($key_row_col[$j] != "rekmanama"){
                    $spreadsheet->getSheetByName($sheetname)->setCellValue($row_col[$key_row_col[$j]] . $begin_row, $all_data[$i]->{$key_row_col[$j]});
                }
            }
            $spreadsheet->getSheetByName($sheetname)->setCellValue("A" . $begin_row, $no);
            $begin_row++;
            $no++;
        }
        $spreadsheet->getSheetByName($sheetname)->removeRow(($begin_row_delete + 1),($begin_row_start - ($begin_row_delete + 1)));
        
        $spreadsheet->getSheetByName($sheetname)->getStyle('A'.($begin_row_delete + 1).":C".(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        $spreadsheet->getSheetByName($sheetname)->getStyle('G'.($begin_row_delete + 1).":Z".(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        $spreadsheet->getSheetByName($sheetname)->getStyle('D'.($begin_row_delete).":F".(($begin_row_delete + 1) + (sizeof($all_data))))->getBorders()->getHorizontal()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        
        $spreadsheet->getActiveSheet()->getStyle('A'.($begin_row_delete + 1).':Z'.(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getAlignment()->setWrapText(true);
        
        $this->spreadsheet = $spreadsheet;
    }
    
    public function report_operasional_tahunan_dan_rppt_rincian(){
        
        $process_report_config = new process_report_config();
        $process_report_config->operasional_tahunan_dan_rppt_rincian();
        $row_col = $process_report_config->operasional_tahunan_dan_rppt_rincian;
        
        $key_row_col = array_keys($row_col);
        
        $this->CI->get_add_anggaran->process(array(
            'action' => 'select',
            'table' => 'sp_rpt_anggaran_mataanggaran(\''.$this->CI->kode_project_scope_controller.'\')',
            'column_value' => $key_row_col,
            'where' => "rekmagroup in ('PEDAPATAN','BIAYA') and lvl::int <= 5"
        ));
        
        $sheetname = "OPERASIONAL-RINCIAN";
        $spreadsheet = $this->spreadsheet;
        
        $highestColumn = $spreadsheet->getSheetByName($sheetname)->getHighestColumn();
        
        $default_height = 12;
        $begin_row_delete = 8;
        $begin_row_start = 20;
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
        
        if(sizeof($all_data) > 0){
            for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                $style_last = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 14);
                $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style_last, Coordinate::stringFromColumnIndex($col) . ($begin_row_start + sizeof($all_data)));
            }
            $this->unmerge_and_empty_cell('D:H', $begin_row_delete + 1, $sheetname);
        }
        
        for($i = 0; $i < sizeof($all_data); $i++){
            $isi_kata = $all_data[$i]->rekmanama;
            if($all_data[$i]->lvl == "1"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('D'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('D'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, "=C9");
                
            }
            else if($all_data[$i]->lvl == "2"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('E'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('E'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, "=C10");
                
                
            }
            else if($all_data[$i]->lvl == "3"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('F'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('F'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, "=C11");
                
                
            }
            else if($all_data[$i]->lvl == "4"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('G'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('G'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, "=C12");
                
            }
            else if($all_data[$i]->lvl == "5"){
                $spreadsheet->getSheetByName($sheetname)->setCellValue('H'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, "=C13");
                
            }
            
            for($j = 0; $j < sizeof($key_row_col); $j++){
                if($key_row_col[$j] != "rekmanama"){
                    $spreadsheet->getSheetByName($sheetname)->setCellValue($row_col[$key_row_col[$j]] . $begin_row, $all_data[$i]->{$key_row_col[$j]});
                }
            }
            $spreadsheet->getSheetByName($sheetname)->setCellValue("A" . $begin_row, $no);
            $begin_row++;
            $no++;
        }
        $spreadsheet->getSheetByName($sheetname)->removeRow(($begin_row_delete + 1),($begin_row_start - ($begin_row_delete + 1)));
        
        $spreadsheet->getSheetByName($sheetname)->getStyle('A'.($begin_row_delete + 1).":C".(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        $spreadsheet->getSheetByName($sheetname)->getStyle('I'.($begin_row_delete + 1).":AB".(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        $spreadsheet->getSheetByName($sheetname)->getStyle('D'.($begin_row_delete).":H".(($begin_row_delete + 1) + (sizeof($all_data))))->getBorders()->getHorizontal()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        
        $spreadsheet->getActiveSheet()->getStyle('A'.($begin_row_delete + 1).':AB'.(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getAlignment()->setWrapText(true);
        
        $this->spreadsheet = $spreadsheet;
    }
    
    public function report_investasi_rencana_korporasi_dan_rppt(){
        $process_report_config = new process_report_config();
        $process_report_config->investasi_rencana_korporasi_dan_rppt();
        $row_col = $process_report_config->investasi_rencana_korporasi_dan_rppt;
        
        $key_row_col = array_keys($row_col);
        
        $this->CI->get_add_anggaran->process(array(
            'action' => 'select',
            'table' => 'sp_rpt_anggaran_mataanggaran(\''.$this->CI->kode_project_scope_controller.'\')',
            'column_value' => $key_row_col,
            'where' => "rekmagroup in ('INVESTASI','RENCANA KORPORASI') and lvl::int <= 3"
        ));
        
        $sheetname = "INV-RENKORP";
        $spreadsheet = $this->spreadsheet;
        
        $highestColumn = $spreadsheet->getSheetByName($sheetname)->getHighestColumn();
        
        $default_height = 12;
        $begin_row_delete = 8;
        $begin_row_start = 20;
        $limit_data = 3;
        $begin_row = $begin_row_start;
        
        $all_data = $this->CI->all;
        $no = 1;
        
        if(sizeof($all_data) > 0){
            for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                $style_last = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 12);
                $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style_last, Coordinate::stringFromColumnIndex($col) . ($begin_row_start + sizeof($all_data)));
            }
            $this->unmerge_and_empty_cell('D:F', $begin_row_delete + 1, $sheetname);
        }
        
        if(sizeof($all_data) < $limit_data){
            for($i = 0; $i < $limit_data; $i++){
                $all_data[$i] = isset($all_data[$i]) ? $all_data[$i] : new stdClass();
                for($j = 0; $j < sizeof($key_row_col); $j++){
                    $all_data[$i]->{$key_row_col[$j]} = isset($all_data[$i]->{$key_row_col[$j]}) ? $all_data[$i]->{$key_row_col[$j]} : "";
                }
            }
        }
        
        for($i = 0; $i < sizeof($all_data); $i++){
            $isi_kata = $all_data[$i]->rekmanama;
            if($all_data[$i]->lvl == "1"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('D'.$begin_row.':F'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('D'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('G'.$begin_row, "=C9");
                
            }
            else if($all_data[$i]->lvl == "2"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('E'.$begin_row.':F'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('E'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('G'.$begin_row, "=C10");
                
                
            }
            else if($all_data[$i]->lvl == "3"){
                $spreadsheet->getSheetByName($sheetname)->setCellValue('F'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('G'.$begin_row, "=C11");
                
                
            }
            
            for($j = 0; $j < sizeof($key_row_col); $j++){
                if($key_row_col[$j] != "rekmanama"){
                    $spreadsheet->getSheetByName($sheetname)->setCellValue($row_col[$key_row_col[$j]] . $begin_row, $all_data[$i]->{$key_row_col[$j]});
                }
            }
            $spreadsheet->getSheetByName($sheetname)->setCellValue("A" . $begin_row, $no);
            $begin_row++;
            $no++;
        }
        $spreadsheet->getSheetByName($sheetname)->removeRow(($begin_row_delete + 1),($begin_row_start - ($begin_row_delete + 1)));
        
        $spreadsheet->getSheetByName($sheetname)->getStyle('A'.($begin_row_delete + 1).":C".(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        $spreadsheet->getSheetByName($sheetname)->getStyle('G'.($begin_row_delete + 1).":Z".(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        $spreadsheet->getSheetByName($sheetname)->getStyle('D'.($begin_row_delete).":F".(($begin_row_delete + 1) + (sizeof($all_data))))->getBorders()->getHorizontal()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        
        $spreadsheet->getActiveSheet()->getStyle('A'.($begin_row_delete + 1).':Z'.(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getAlignment()->setWrapText(true);
        
        $this->spreadsheet = $spreadsheet;
        
    }
    
    public function report_laporan_anggaran_investasi_rencana_korporasi_rincian(){
        $process_report_config = new process_report_config();
        $process_report_config->laporan_anggaran_investasi_rencana_korporasi_rincian();
        $row_col = $process_report_config->laporan_anggaran_investasi_rencana_korporasi_rincian;
        
        $key_row_col = array_keys($row_col);
        
        $this->CI->get_add_anggaran->process(array(
            'action' => 'select',
            'table' => 'sp_rpt_anggaran_mataanggaran(\''.$this->CI->kode_project_scope_controller.'\')',
            'column_value' => $key_row_col,
            'where' => "rekmagroup in ('INVESTASI','RENCANA KORPORASI') and lvl::int <= 5"
        ));
        
        $sheetname = "INV-RENKORP-RINCIAN";
        $spreadsheet = $this->spreadsheet;
        
        $highestColumn = $spreadsheet->getSheetByName($sheetname)->getHighestColumn();
        
        $default_height = 12;
        $begin_row_delete = 8;
        $begin_row_start = 20;
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
        
        if(sizeof($all_data) > 0){
            for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                $style_last = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 14);
                $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style_last, Coordinate::stringFromColumnIndex($col) . ($begin_row_start + sizeof($all_data)));
            }
            $this->unmerge_and_empty_cell('D:H', $begin_row_delete + 1, $sheetname);
        }
        
        for($i = 0; $i < sizeof($all_data); $i++){
            $isi_kata = $all_data[$i]->rekmanama;
            if($all_data[$i]->lvl == "1"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('D'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('D'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, "=C9");
                
            }
            else if($all_data[$i]->lvl == "2"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('E'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('E'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, "=C10");
                
                
            }
            else if($all_data[$i]->lvl == "3"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('F'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('F'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, "=C11");
                
                
            }
            else if($all_data[$i]->lvl == "4"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('G'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('G'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, "=C12");
                
            }
            else if($all_data[$i]->lvl == "5"){
                $spreadsheet->getSheetByName($sheetname)->setCellValue('H'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, "=C13");
                
            }
            
            for($j = 0; $j < sizeof($key_row_col); $j++){
                if($key_row_col[$j] != "rekmanama"){
                    $spreadsheet->getSheetByName($sheetname)->setCellValue($row_col[$key_row_col[$j]] . $begin_row, $all_data[$i]->{$key_row_col[$j]});
                }
            }
            $spreadsheet->getSheetByName($sheetname)->setCellValue("A" . $begin_row, $no);
            $begin_row++;
            $no++;
        }
        $spreadsheet->getSheetByName($sheetname)->removeRow(($begin_row_delete + 1),($begin_row_start - ($begin_row_delete + 1)));
        
        $spreadsheet->getSheetByName($sheetname)->getStyle('A'.($begin_row_delete + 1).":C".(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        $spreadsheet->getSheetByName($sheetname)->getStyle('I'.($begin_row_delete + 1).":AB".(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        $spreadsheet->getSheetByName($sheetname)->getStyle('D'.($begin_row_delete).":H".(($begin_row_delete + 1) + (sizeof($all_data))))->getBorders()->getHorizontal()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        
        $spreadsheet->getActiveSheet()->getStyle('A'.($begin_row_delete + 1).':AB'.(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getAlignment()->setWrapText(true);
        
        $this->spreadsheet = $spreadsheet;
    }
    
    public function report_kegiatan_rincian_anggaran_rppt_per_mata_anggaran(){
        $process_report_config = new process_report_config();
        $process_report_config->kegiatan_rincian_anggaran_rppt_per_mata_anggaran();
        $row_col = $process_report_config->kegiatan_rincian_anggaran_rppt_per_mata_anggaran;
        
        $key_row_col = array_keys($row_col);
        
        $this->CI->get_add_anggaran->process(array(
            'action' => 'select',
            'table' => 'sp_rpt_anggaran_mataanggaran_kegiatan(\''.$this->CI->kode_project_scope_controller.'\')',
            'column_value' => array("*"),
            'where' => "lvl::int <= 5"
        ));
        
        $sheetname = "MA-KEGIATAN";
        $spreadsheet = $this->spreadsheet;
        
        $highestColumn = $spreadsheet->getSheetByName($sheetname)->getHighestColumn();
        
        $default_height = 12;
        $begin_row_delete = 7;
        $begin_row_start = 20;
        $limit_data = 4;
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
        
        if(sizeof($all_data) > 0){
            for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                $style_last = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 12);
                $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style_last, Coordinate::stringFromColumnIndex($col) . ($begin_row_start + sizeof($all_data)));
            }
            $this->unmerge_and_empty_cell('J:M', $begin_row_delete + 1, $sheetname);
        }
        
        for($i = 0; $i < sizeof($all_data); $i++){
            $isi_kata = $all_data[$i]->keterangan;
            if($all_data[$i]->lvl == "1"){
                
                $spreadsheet->getSheetByName($sheetname)->mergeCells('J'.$begin_row.':M'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('J'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('G'.$begin_row, $spreadsheet->getSheetByName($sheetname)->getCell('G8')->getValue());
                
            }
            else if($all_data[$i]->lvl == "2"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('K'.$begin_row.':M'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('K'.$begin_row, $isi_kata);
                
            }
            else if($all_data[$i]->lvl == "3"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('L'.$begin_row.':M'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('L'.$begin_row, $isi_kata);
                
            }
            else if($all_data[$i]->lvl == "4"){
                $spreadsheet->getSheetByName($sheetname)->setCellValue('M'.$begin_row, $isi_kata);
                
            }
            
            else if($all_data[$i]->lvl == "5"){
                $spreadsheet->getSheetByName($sheetname)->setCellValue('M'.$begin_row, $isi_kata);
                
            }
            
            for($j = 0; $j < sizeof($key_row_col); $j++){
                if($key_row_col[$j] != "keterangan"){
                    $spreadsheet->getSheetByName($sheetname)->setCellValue($row_col[$key_row_col[$j]] . $begin_row, $all_data[$i]->{$key_row_col[$j]});
                }
            }
            $spreadsheet->getSheetByName($sheetname)->setCellValue("A" . $begin_row, $no);
            $begin_row++;
            $no++;
        }
        $spreadsheet->getSheetByName($sheetname)->removeRow(($begin_row_delete + 1),($begin_row_start - ($begin_row_delete + 1)));
        
        $spreadsheet->getSheetByName($sheetname)->getStyle('A'.($begin_row_delete + 1).":I".(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        $spreadsheet->getSheetByName($sheetname)->getStyle('N'.($begin_row_delete + 1).":Y".(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        $spreadsheet->getSheetByName($sheetname)->getStyle('J'.($begin_row_delete).":M".(($begin_row_delete + 1) + (sizeof($all_data))))->getBorders()->getHorizontal()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000000'));
        
        $spreadsheet->getActiveSheet()->getStyle('A'.($begin_row_delete + 1).':Y'.(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getAlignment()->setWrapText(true);
        
        $this->spreadsheet = $spreadsheet;
    }
    
    public function remove_kamus_sheet(){
        $spreadsheet = $this->spreadsheet;
        $sheetIndex = $spreadsheet->getIndex(
            $spreadsheet->getSheetByName('Kamus')
        );
        $spreadsheet->removeSheetByIndex($sheetIndex);
        $this->spreadsheet = $spreadsheet;
    }
    
    public function unmerge_and_empty_cell($range, $begin_row, $sheetname){
        $explode_range = explode(":", $range);
        if(sizeof($explode_range) == 2){
            $begin_loop = Coordinate::columnIndexFromString($explode_range[0]);
            $end_loop = Coordinate::columnIndexFromString($explode_range[1]);
            $spreadsheet = $this->spreadsheet;
            $plus = 0;
            for($i = $begin_loop; $i < $end_loop; $i++){
                $spreadsheet->getSheetByName($sheetname)->unmergeCells(Coordinate::stringFromColumnIndex($i).($begin_row + $plus).':'.Coordinate::stringFromColumnIndex($end_loop).($begin_row + $plus));
                $spreadsheet->getSheetByName($sheetname)->setCellValue(Coordinate::stringFromColumnIndex($i).($begin_row + $plus), '');
                $plus++;
            }
            $this->spreadsheet = $spreadsheet;
        }
    }
    
    function print_excel(){
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition: attachment;filename=Hasil Report MA.xlsx');
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
