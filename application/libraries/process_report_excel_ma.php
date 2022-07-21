<?php

include_once __DIR__ . '/../libraries/phpspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class process_report_excel_ma {
    private $spreadsheet;
    public function __construct($all = ""){
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
            $this->report_kegiatan_rincian_anggaran_rppt_per_mata_anggaran();
            $this->remove_kamus_sheet();
            $this->print_excel();
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
        $begin_row_start = 9;
        $begin_row = $begin_row_start;
        
        $all_data = $this->CI->all;
        $no = 1;
        
        if(sizeof($all_data) > 0){
            for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                $style_last = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 12);
                $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style_last, Coordinate::stringFromColumnIndex($col) . ($begin_row_start + sizeof($all_data)));
            }
            $this->unmerge_and_empty_cell('D:F', $begin_row, $sheetname);
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
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 9);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
            }
            else if($all_data[$i]->lvl == "2"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('E'.$begin_row.':F'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('E'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('G'.$begin_row, "=C10");
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 10);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
                
            }
            else if($all_data[$i]->lvl == "3"){
                $spreadsheet->getSheetByName($sheetname)->setCellValue('F'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('G'.$begin_row, "=C11");
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 11);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
                
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
        $begin_row_start = 9;
        $begin_row = $begin_row_start;
        
        $all_data = $this->CI->all;
        $no = 1;
        
        if(sizeof($all_data) > 0){
            for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                $style_last = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 14);
                $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style_last, Coordinate::stringFromColumnIndex($col) . ($begin_row_start + sizeof($all_data)));
            }
            $this->unmerge_and_empty_cell('D:H', $begin_row, $sheetname);
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
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 9);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
            }
            else if($all_data[$i]->lvl == "2"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('E'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('E'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, "=C10");
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 10);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
                
            }
            else if($all_data[$i]->lvl == "3"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('F'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('F'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, "=C11");
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 11);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
                
            }
            else if($all_data[$i]->lvl == "4"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('G'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('G'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, "=C12");
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 12);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
            }
            else if($all_data[$i]->lvl == "5"){
                $spreadsheet->getSheetByName($sheetname)->setCellValue('H'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, "=C13");
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 13);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
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
        $begin_row_start = 9;
        $begin_row = $begin_row_start;
        
        $all_data = $this->CI->all;
        $no = 1;
        
        if(sizeof($all_data) > 0){
            for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                $style_last = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 12);
                $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style_last, Coordinate::stringFromColumnIndex($col) . ($begin_row_start + sizeof($all_data)));
            }
            $this->unmerge_and_empty_cell('D:F', $begin_row, $sheetname);
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
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 9);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
            }
            else if($all_data[$i]->lvl == "2"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('E'.$begin_row.':F'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('E'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('G'.$begin_row, "=C10");
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 10);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
                
            }
            else if($all_data[$i]->lvl == "3"){
                $spreadsheet->getSheetByName($sheetname)->setCellValue('F'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('G'.$begin_row, "=C11");
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 11);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
                
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
        $begin_row_start = 9;
        $begin_row = $begin_row_start;
        
        $all_data = $this->CI->all;
        $no = 1;
        
        if(sizeof($all_data) > 0){
            for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                $style_last = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 14);
                $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style_last, Coordinate::stringFromColumnIndex($col) . ($begin_row_start + sizeof($all_data)));
            }
            $this->unmerge_and_empty_cell('D:H', $begin_row, $sheetname);
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
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 9);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
            }
            else if($all_data[$i]->lvl == "2"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('E'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('E'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, "=C10");
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 10);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
                
            }
            else if($all_data[$i]->lvl == "3"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('F'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('F'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, "=C11");
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 11);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
                
            }
            else if($all_data[$i]->lvl == "4"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('G'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('G'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, "=C12");
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 12);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
            }
            else if($all_data[$i]->lvl == "5"){
                $spreadsheet->getSheetByName($sheetname)->setCellValue('H'.$begin_row, $isi_kata);
                
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, "=C13");
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 13);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
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
        $begin_row_start = 8;
        $begin_row = $begin_row_start;
        
        $all_data = $this->CI->all;
        $no = 1;
        
        if(sizeof($all_data) > 0){
            for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                $style_last = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 12);
                $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style_last, Coordinate::stringFromColumnIndex($col) . ($begin_row_start + sizeof($all_data)));
            }
            $this->unmerge_and_empty_cell('J:M', $begin_row, $sheetname);
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
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 8);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
            }
            else if($all_data[$i]->lvl == "2"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('K'.$begin_row.':M'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('K'.$begin_row, $isi_kata);
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 9);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
                
            }
            else if($all_data[$i]->lvl == "3"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('L'.$begin_row.':M'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('L'.$begin_row, $isi_kata);
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 10);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
                
            }
            else if($all_data[$i]->lvl == "4"){
                $spreadsheet->getSheetByName($sheetname)->setCellValue('M'.$begin_row, $isi_kata);
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 11);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
            }
            
            else if($all_data[$i]->lvl == "5"){
                $spreadsheet->getSheetByName($sheetname)->setCellValue('M'.$begin_row, $isi_kata);
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 11);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
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
        header('Content-Disposition: attachment;filename=Hasil Concate Sheet Excel.xlsx');
        $writer = IOFactory::createWriter($this->spreadsheet, 'Xlsx');
        $writer->save('php://output'); 
    }
}
