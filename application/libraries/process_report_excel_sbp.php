<?php

include_once __DIR__ . '/../libraries/phpspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class process_report_excel_sbp {
    private $spreadsheet;
    private $default_height = 18;
    private $default_string = 78;
    public function __construct($all = ""){
        if($all == "all"){
            ini_set("display_errors", "On");
            error_reporting(E_ALL);
            $this->CI = & get_instance();
            $this->CI->load->model('get_report');
            $reader = IOFactory::createReader("Xlsx");
            $this->spreadsheet = $reader->load(__DIR__."/../../upload/xlsx_excel/TEMPLATE04.xlsx");
            // $this->report_program_strategis_ps();
            // $this->report_program_kerja_strategis_pks_non_strategis_pkns();
            // $this->report_program_kerja_tahunan_pkt_kegiatan_k(4,"PKT-K");
            $this->report_program_kerja_tahunan_pkt_rincian_kegiatan_rk(5,"PKT-RK");
            // $this->report_mata_anggaran_per_rincian_kegiatan();
            $this->remove_kamus_sheet();
            $this->print_excel();
        }
    }
    
    public function report_program_strategis_ps(){
        $process_report_config = new process_report_config();
        $process_report_config->program_strategis_ps();
        $row_col = $process_report_config->program_strategis_ps;
        
        $key_row_col = array_keys($row_col);
        
        $this->CI->get_report->process(array(
            'action' => 'select',
            'table' => 'sp_rpt_sbpps_kegiatan_rincian(\''.$this->CI->kode_project_scope_controller.'\')',
            'column_value' => $key_row_col,
            'where' => 'lvl::int = 1'
        ));
        
        $sheetname = "PROG-STRATEGIS";
        $spreadsheet = $this->spreadsheet;
        
        $highestColumn = $spreadsheet->getSheetByName($sheetname)->getHighestColumn();
        
        $begin_row_start = 9;
        $begin_row = $begin_row_start;
        
        $all_data = $this->CI->all;
        $no = 1;
        
        if(sizeof($all_data) > 0){
            for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                $style_last = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 10);
                $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style_last, Coordinate::stringFromColumnIndex($col) . ($begin_row_start + sizeof($all_data)));
            }
        }
        
        $spreadsheet->getSheetByName($sheetname)->setCellValue("L7","=SUM(L9:L".($begin_row_start + sizeof($all_data)).")");
        $spreadsheet->getSheetByName($sheetname)->setCellValue("M7","=SUM(M9:M".($begin_row_start + sizeof($all_data)).")");
        $spreadsheet->getSheetByName($sheetname)->setCellValue("N7","=SUM(N9:N".($begin_row_start + sizeof($all_data)).")");
        $spreadsheet->getSheetByName($sheetname)->setCellValue("O7","=SUM(O9:O".($begin_row_start + sizeof($all_data)).")");
        
        for($i = 0; $i < sizeof($all_data); $i++){
            for($j = 0; $j < sizeof($key_row_col); $j++){
                $spreadsheet->getSheetByName($sheetname)->setCellValue($row_col[$key_row_col[$j]] . $begin_row, $all_data[$i]->{$key_row_col[$j]});
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 9);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
            }
            $spreadsheet->getSheetByName($sheetname)->setCellValue("A" . $begin_row, $no);
            $h = $spreadsheet->getSheetByName($sheetname)->getRowDimension(9)->getRowHeight();
            $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($h);
            $begin_row++;
            $no++;
        }
        $this->spreadsheet = $spreadsheet;
    }
    
    public function report_program_kerja_strategis_pks_non_strategis_pkns(){
        
        $process_report_config = new process_report_config();
        $process_report_config->program_kerja_strategis_pks_non_strategis_pkns();
        $row_col = $process_report_config->program_kerja_strategis_pks_non_strategis_pkns;
        
        $key_row_col = array_keys($row_col);
        
        $this->CI->get_report->process(array(
            'action' => 'select',
            'table' => 'sp_rpt_sbpps_kegiatan_rincian(\''.$this->CI->kode_project_scope_controller.'\')',
            'column_value' => $key_row_col,
            'where' => "lvl::int <= 3"
        ));
        
        $sheetname = "PROG-KERJA";
        $spreadsheet = $this->spreadsheet;
        
        $highestColumn = $spreadsheet->getSheetByName($sheetname)->getHighestColumn();
        
        $default_height = $this->default_height;
        $begin_row_delete = 7;
        $begin_row_start = 20;
        $begin_row = $begin_row_start;
        
        $all_data = $this->CI->all;
        $no = 1;
        
        if(sizeof($all_data) > 0){
            for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                $style_last = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 11);
                $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style_last, Coordinate::stringFromColumnIndex($col) . ($begin_row_start + sizeof($all_data)));
            }
            $this->unmerge_and_empty_cell('I:K', $begin_row_delete + 1, $sheetname);
        }
        for($i = 0; $i < sizeof($all_data); $i++){
            $isi_kata = $all_data[$i]->nama;
            if($all_data[$i]->lvl == "1"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('I'.$begin_row.':K'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, $this->default_string, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;

                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, $isi_kata);

                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 8);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
            }
            else if($all_data[$i]->lvl == "2"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('J'.$begin_row.':K'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, $this->default_string - 3, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;

                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('J'.$begin_row, $isi_kata);

                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 9);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
            }
            else if($all_data[$i]->lvl == "3"){
                $spreadsheet->getSheetByName($sheetname)->setCellValue('K'.$begin_row, $isi_kata);

                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 10);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
            }
            for($j = 0; $j < sizeof($key_row_col); $j++){
                if($key_row_col[$j] != "nama"){
                    $spreadsheet->getSheetByName($sheetname)->setCellValue($row_col[$key_row_col[$j]] . $begin_row, $all_data[$i]->{$key_row_col[$j]});
                }
            }
            $spreadsheet->getSheetByName($sheetname)->setCellValue("A" . $begin_row, $no);
            $begin_row++;
            $no++;
        }
        $spreadsheet->getSheetByName($sheetname)->removeRow($begin_row_delete,($begin_row_start - $begin_row_delete));
        $this->spreadsheet = $spreadsheet;
    }
    
    public function report_program_kerja_tahunan_pkt_kegiatan_k($level,$sheet){
        $process_report_config = new process_report_config();
        $process_report_config->program_kerja_tahunan_pkt_kegiatan_k();
        $row_col = $process_report_config->program_kerja_tahunan_pkt_kegiatan_k;
        
        $key_row_col = array_keys($row_col);
        
        $this->CI->get_report->process(array(
            'action' => 'select',
            'table' => 'sp_rpt_sbpps_kegiatan_rincian(\''.$this->CI->kode_project_scope_controller.'\')',
            'column_value' => $key_row_col,
            'where' => "lvl::int <= " . $level
        ));
        
        $sheetname = $sheet;
        $spreadsheet = $this->spreadsheet;
        
        $highestColumn = $spreadsheet->getSheetByName($sheetname)->getHighestColumn();
        
        $default_height = $this->default_height;
        $begin_row_delete = 7;
        $begin_row_start = 20;
        $begin_row = $begin_row_start;
        
        $all_data = $this->CI->all;
        $no = 1;
        
        if(sizeof($all_data) > 0){
            for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                $style_last = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 13);
                $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style_last, Coordinate::stringFromColumnIndex($col) . ($begin_row_start + sizeof($all_data)));
            }
            $this->unmerge_and_empty_cell('I:M', $begin_row_delete + 1, $sheetname);
        }
        for($i = 0; $i < sizeof($all_data); $i++){
            $isi_kata = $all_data[$i]->nama;
            if($all_data[$i]->lvl == "1"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('I'.$begin_row.':M'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, $this->default_string, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;

                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('I'.$begin_row, $isi_kata);
                
                /*
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 8);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                } */
            }
            else if($all_data[$i]->lvl == "2"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('J'.$begin_row.':M'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, $this->default_string - 3, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;

                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('J'.$begin_row, $isi_kata);
                /*
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 9);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                } */
            }
            else if($all_data[$i]->lvl == "3"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('K'.$begin_row.':M'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, $this->default_string - 6, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;

                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('K'.$begin_row, $isi_kata);
                
                /*
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 10);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                } */
            }
            else if($all_data[$i]->lvl == "4"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('L'.$begin_row.':M'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, $this->default_string - 9, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;

                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('L'.$begin_row, $isi_kata);
                
                /*
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 11);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                } */
            }
            else if($all_data[$i]->lvl == "5"){
                $spreadsheet->getSheetByName($sheetname)->setCellValue('M'.$begin_row, $isi_kata);
                
                /*
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 12);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                } */
            }
            
            for($j = 0; $j < sizeof($key_row_col); $j++){
                if($key_row_col[$j] != "nama"){
                    $spreadsheet->getSheetByName($sheetname)->setCellValue($row_col[$key_row_col[$j]] . $begin_row, $all_data[$i]->{$key_row_col[$j]});
                }
            }
            $spreadsheet->getSheetByName($sheetname)->setCellValue("A" . $begin_row, $no);
            $begin_row++;
            $no++; 
        }
        
        $spreadsheet->getSheetByName($sheetname)->removeRow(($begin_row_delete + 1),($begin_row_start - ($begin_row_delete + 1)));
        $this->spreadsheet = $spreadsheet;   
    }
    
    public function report_program_kerja_tahunan_pkt_rincian_kegiatan_rk($level,$sheet){
        $this->report_program_kerja_tahunan_pkt_kegiatan_k($level,$sheet);
    }
    
    public function report_mata_anggaran_per_rincian_kegiatan(){
        $process_report_config = new process_report_config();
        $process_report_config->mata_anggaran_per_rincian_kegiatan();
        $row_col = $process_report_config->mata_anggaran_per_rincian_kegiatan;
        
        $key_row_col = array_keys($row_col);
        
        $this->CI->get_report->process(array(
            'action' => 'select',
            'table' => 'sp_rpt_sbpps_kegiatan_mataanggaran(\''.$this->CI->kode_project_scope_controller.'\')',
            'column_value' => $key_row_col,
            'where' => "lvl::int <= 6"
        ));
        
        $sheetname = "PS-PKT-MA";
        $spreadsheet = $this->spreadsheet;
        
        $highestColumn = $spreadsheet->getSheetByName($sheetname)->getHighestColumn();
        
        $default_height = $this->default_height;
        $begin_row_delete = 7;
        $begin_row_start = 20;
        $begin_row = $begin_row_start;
        
        $all_data = $this->CI->all;
        $no = 1;
        
        if(sizeof($all_data) > 0){
            for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                $style_last = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 14);
                $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style_last, Coordinate::stringFromColumnIndex($col) . ($begin_row_start + sizeof($all_data)));
            }
            $this->unmerge_and_empty_cell('J:O', $begin_row_delete + 1, $sheetname);
        }
        for($i = 0; $i < sizeof($all_data); $i++){
            $isi_kata = $all_data[$i]->nama;
            if($all_data[$i]->lvl == "1"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('J'.$begin_row.':O'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, $this->default_string, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;

                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('J'.$begin_row, $isi_kata);

                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 8);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
            }
            else if($all_data[$i]->lvl == "2"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('K'.$begin_row.':O'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, $this->default_string - 3, " ----- ");
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
                $spreadsheet->getSheetByName($sheetname)->mergeCells('L'.$begin_row.':O'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, $this->default_string - 6, " ----- ");
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
                $spreadsheet->getSheetByName($sheetname)->mergeCells('M'.$begin_row.':O'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, $this->default_string - 9, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;

                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('M'.$begin_row, $isi_kata);

                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 11);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
            }
            else if($all_data[$i]->lvl == "5"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('N'.$begin_row.':O'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, $this->default_string - 9, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;

                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('N'.$begin_row, $isi_kata);

                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 12);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
            }
            else if($all_data[$i]->lvl == "6"){
                $spreadsheet->getSheetByName($sheetname)->setCellValue('O'.$begin_row, $isi_kata);
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 13);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
            }
            
            for($j = 0; $j < sizeof($key_row_col); $j++){
                if($key_row_col[$j] != "nama"){
                    $spreadsheet->getSheetByName($sheetname)->setCellValue($row_col[$key_row_col[$j]] . $begin_row, $all_data[$i]->{$key_row_col[$j]});
                }
            }
            $spreadsheet->getSheetByName($sheetname)->setCellValue("A" . $begin_row, $no);
            $begin_row++;
            $no++; 
        }
        
        $spreadsheet->getSheetByName($sheetname)->removeRow($begin_row_delete,($begin_row_start - $begin_row_delete));
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
    
    public function get_width_merge($col, $sheetname){
        $explode_col = explode(":", $col);
        $spreadsheet = $this->spreadsheet;
        $total_width = 0;
        if(isset($explode_col[1])){
            $begin = Coordinate::columnIndexFromString($explode_col[0]);
            $lasts = Coordinate::columnIndexFromString($explode_col[1]);
            for($i = $begin; $i <= $lasts; $i++){
                $total_width = $total_width + floor($spreadsheet->getSheetByName($sheetname)->getColumnDimensionByColumn($i)->getWidth());
            }
        }
        return $total_width;
    }
    
    function print_excel(){
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition: attachment;filename=Hasil Report SBP.xlsx');
        $writer = IOFactory::createWriter($this->spreadsheet, 'Xlsx');
        $writer->save('php://output'); 
    }
}

// $this->unmerge_and_empty_cell('I:K', $begin_row, $sheetname);
// $this->get_width_merge("I:K",$sheetname);