<?php

include_once __DIR__ . '/../libraries/phpspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class process_report_excel_ak {
    private $spreadsheet;
    public $filename = "";
    public function __construct($all = "", $view_only = false){
        if($all == "all"){
            ini_set("display_errors", "On");
            error_reporting(E_ALL);
            $this->CI = & get_instance();
            $this->CI->load->model('get_add_anggaran');
            $reader = IOFactory::createReader("Xlsx");
            $this->spreadsheet = $reader->load(__DIR__."/../../upload/xlsx_excel/template_live_ak.xlsx");
            $this->proyeksi_aktivitas_keuangan();
            $this->remove_kamus_sheet();
            if($view_only){
                $this->filename = $this->view_excel();
            } else {
                $this->print_excel();
            }
        }
    }
    
    public function proyeksi_aktivitas_keuangan(){
        $process_report_config = new process_report_config();
        $process_report_config->proyeksi_ak();
        $row_col = $process_report_config->proyeksi_ak;
        
        $key_row_col = array_keys($row_col);
        
        $this->CI->get_add_anggaran->process(array(
            'action' => 'select',
            'table' => 'sp_rpt_anggaran_mataanggaran(\''.$this->CI->kode_project_scope_controller.'\')',
            'column_value' => $key_row_col,
            'where' => "rekmagroup in ('PENDAPATAN','BEBAN','BEBAN PAJAK') and lvl::int <= 3"
        ));
        
        $sheetname = "PROYEKSI AKTIVITAS KEUANGAN";
        $spreadsheet = $this->spreadsheet;
        
        $highestColumn = $spreadsheet->getSheetByName($sheetname)->getHighestColumn();
        
        $default_height = 12;
        $begin_row_delete = 8;
        $begin_row_start = 24;
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
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){/*
                    $style_last = $spreadsheet->getSheetByName($sheetname)->getStyleByColumnAndRow($col, 12);
                    $spreadsheet->getSheetByName($sheetname)->duplicateStyle($style_last, Coordinate::stringFromColumnIndex($col) . ($begin_row_start + sizeof($all_data)));*/
                }
                $this->unmerge_and_empty_cell('D:F', $begin_row_delete + 1, $sheetname);
            }
        }
        
        $surplus_row = array();
        for($i = 0; $i < sizeof($all_data); $i++){
            $isi_kata = $all_data[$i]->rekmanama;
            if($all_data[$i]->lvl == "1"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('D'.$begin_row.':F'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('D'.$begin_row, $isi_kata . " TEST");
                
                $surplus_row[] = $begin_row;
            }
            else if($all_data[$i]->lvl == "2"){
                $spreadsheet->getSheetByName($sheetname)->mergeCells('E'.$begin_row.':F'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getSheetByName($sheetname)->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getSheetByName($sheetname)->setCellValue('E'.$begin_row, $isi_kata);
                
            }
            else if($all_data[$i]->lvl == "3"){
                $spreadsheet->getSheetByName($sheetname)->setCellValue('F'.$begin_row, $isi_kata);
                
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
        
        $spreadsheet->getSheetByName($sheetname)->mergeCells('D'.($begin_row + 2).':F'.($begin_row + 2));
        $spreadsheet->getSheetByName($sheetname)->mergeCells('D'.($begin_row + 3).':F'.($begin_row + 3));
        $spreadsheet->getSheetByName($sheetname)->mergeCells('D'.($begin_row + 4).':F'.($begin_row + 4));
        $spreadsheet->getSheetByName($sheetname)->mergeCells('D'.($begin_row + 5).':F'.($begin_row + 5));
        $spreadsheet->getSheetByName($sheetname)->mergeCells('D'.($begin_row + 6).':F'.($begin_row + 6));
        
        $spreadsheet->getSheetByName($sheetname)->setCellValue("D" . ($begin_row + 2), "PENDAPATAN");
        $spreadsheet->getSheetByName($sheetname)->setCellValue("J" . ($begin_row + 2), "=J".$surplus_row[0]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("K" . ($begin_row + 2), "=K".$surplus_row[0]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("L" . ($begin_row + 2), "=L".$surplus_row[0]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("N" . ($begin_row + 2), "=N".$surplus_row[0]);/*
        $spreadsheet->getSheetByName($sheetname)->setCellValue("O" . ($begin_row + 2), "=O".$surplus_row[0]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("Q" . ($begin_row + 2), "=Q".$surplus_row[0]);*/
        $spreadsheet->getSheetByName($sheetname)->setCellValue("S" . ($begin_row + 2), "=S".$surplus_row[0]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("U" . ($begin_row + 2), "=U".$surplus_row[0]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("W" . ($begin_row + 2), "=W".$surplus_row[0]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("Y" . ($begin_row + 2), "=Y".$surplus_row[0]);
        
        $spreadsheet->getSheetByName($sheetname)->setCellValue("D" . ($begin_row + 3), "BEBAN");
        $spreadsheet->getSheetByName($sheetname)->setCellValue("J" . ($begin_row + 3), "=J".$surplus_row[1]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("K" . ($begin_row + 3), "=K".$surplus_row[1]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("L" . ($begin_row + 3), "=L".$surplus_row[1]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("N" . ($begin_row + 3), "=N".$surplus_row[1]);/*
        $spreadsheet->getSheetByName($sheetname)->setCellValue("O" . ($begin_row + 3), "=O".$surplus_row[1]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("Q" . ($begin_row + 3), "=Q".$surplus_row[1]);*/
        $spreadsheet->getSheetByName($sheetname)->setCellValue("S" . ($begin_row + 3), "=S".$surplus_row[1]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("U" . ($begin_row + 3), "=U".$surplus_row[1]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("W" . ($begin_row + 3), "=W".$surplus_row[1]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("Y" . ($begin_row + 3), "=Y".$surplus_row[1]);
        
        $spreadsheet->getSheetByName($sheetname)->setCellValue("D" . ($begin_row + 4), "SURPLUS BEFORE TAX");
        $spreadsheet->getSheetByName($sheetname)->setCellValue("J" . ($begin_row + 4), "=J".($begin_row + 2)."-J".($begin_row + 3));
        $spreadsheet->getSheetByName($sheetname)->setCellValue("K" . ($begin_row + 4), "=K".($begin_row + 2)."-K".($begin_row + 3));
        $spreadsheet->getSheetByName($sheetname)->setCellValue("L" . ($begin_row + 4), "=L".($begin_row + 2)."-L".($begin_row + 3));
        $spreadsheet->getSheetByName($sheetname)->setCellValue("N" . ($begin_row + 4), "=N".($begin_row + 2)."-N".($begin_row + 3));/*
        $spreadsheet->getSheetByName($sheetname)->setCellValue("O" . ($begin_row + 4), "=O".($begin_row + 2)."-O".($begin_row + 3));
        $spreadsheet->getSheetByName($sheetname)->setCellValue("Q" . ($begin_row + 4), "=Q".($begin_row + 2)."-Q".($begin_row + 3));*/
        $spreadsheet->getSheetByName($sheetname)->setCellValue("S" . ($begin_row + 4), "=S".($begin_row + 2)."-S".($begin_row + 3));
        $spreadsheet->getSheetByName($sheetname)->setCellValue("U" . ($begin_row + 4), "=U".($begin_row + 2)."-U".($begin_row + 3));
        $spreadsheet->getSheetByName($sheetname)->setCellValue("W" . ($begin_row + 4), "=W".($begin_row + 2)."-W".($begin_row + 3));
        $spreadsheet->getSheetByName($sheetname)->setCellValue("Y" . ($begin_row + 4), "=Y".($begin_row + 2)."-Y".($begin_row + 3));
        
        $spreadsheet->getSheetByName($sheetname)->setCellValue("D" . ($begin_row + 5), "BEBAN PAJAK");
        $spreadsheet->getSheetByName($sheetname)->setCellValue("J" . ($begin_row + 5), "=J".$surplus_row[2]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("K" . ($begin_row + 5), "=K".$surplus_row[2]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("L" . ($begin_row + 5), "=L".$surplus_row[2]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("N" . ($begin_row + 5), "=N".$surplus_row[2]);/*
        $spreadsheet->getSheetByName($sheetname)->setCellValue("O" . ($begin_row + 5), "=O".$surplus_row[2]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("Q" . ($begin_row + 5), "=Q".$surplus_row[2]);*/
        $spreadsheet->getSheetByName($sheetname)->setCellValue("S" . ($begin_row + 5), "=S".$surplus_row[2]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("U" . ($begin_row + 5), "=U".$surplus_row[2]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("W" . ($begin_row + 5), "=W".$surplus_row[2]);
        $spreadsheet->getSheetByName($sheetname)->setCellValue("Y" . ($begin_row + 5), "=Y".$surplus_row[2]);
        
        $spreadsheet->getSheetByName($sheetname)->setCellValue("D" . ($begin_row + 6), "SURPLUS AFTER TAX");
        $spreadsheet->getSheetByName($sheetname)->setCellValue("J" . ($begin_row + 6), "=J".($begin_row + 4)."-J".($begin_row + 5));
        $spreadsheet->getSheetByName($sheetname)->setCellValue("K" . ($begin_row + 6), "=K".($begin_row + 4)."-K".($begin_row + 5));
        $spreadsheet->getSheetByName($sheetname)->setCellValue("L" . ($begin_row + 6), "=L".($begin_row + 4)."-L".($begin_row + 5));
        $spreadsheet->getSheetByName($sheetname)->setCellValue("N" . ($begin_row + 6), "=N".($begin_row + 4)."-N".($begin_row + 5));/*
        $spreadsheet->getSheetByName($sheetname)->setCellValue("O" . ($begin_row + 6), "=O".($begin_row + 4)."-O".($begin_row + 5));
        $spreadsheet->getSheetByName($sheetname)->setCellValue("Q" . ($begin_row + 6), "=Q".($begin_row + 4)."-Q".($begin_row + 5));*/
        $spreadsheet->getSheetByName($sheetname)->setCellValue("S" . ($begin_row + 6), "=S".($begin_row + 4)."-S".($begin_row + 5));
        $spreadsheet->getSheetByName($sheetname)->setCellValue("U" . ($begin_row + 6), "=U".($begin_row + 4)."-U".($begin_row + 5));
        $spreadsheet->getSheetByName($sheetname)->setCellValue("W" . ($begin_row + 6), "=W".($begin_row + 4)."-W".($begin_row + 5));
        $spreadsheet->getSheetByName($sheetname)->setCellValue("Y" . ($begin_row + 6), "=Y".($begin_row + 4)."-Y".($begin_row + 5));
        
        $color_border = $spreadsheet->getSheetByName($sheetname)->getStyle('A4')->getBorders()->getTop()->getColor()->getARGB();
        $spreadsheet->getSheetByName($sheetname)->getStyle('A'.($begin_row + 2).":Z".($begin_row + 6))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color($color_border));
        
        $spreadsheet->getSheetByName($sheetname)->removeRow(($begin_row_delete + 1),($begin_row_start - ($begin_row_delete + 1)));
        $spreadsheet->getSheetByName($sheetname)->getStyle('A'.($begin_row_delete + 1).":C".(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color($color_border));
        $spreadsheet->getSheetByName($sheetname)->getStyle('G'.($begin_row_delete + 1).":Z".(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color($color_border));
        $spreadsheet->getSheetByName($sheetname)->getStyle('D'.($begin_row_delete).":F".(($begin_row_delete + 1) + (sizeof($all_data))))->getBorders()->getHorizontal()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color($color_border));
        
        $spreadsheet->getActiveSheet()->getStyle('A'.($begin_row_delete + 1).':Z'.(($begin_row_delete + 1) + (sizeof($all_data) - 1)))->getAlignment()->setWrapText(true);
        $spreadsheet->getSheetByName($sheetname)->setCellValue('B2',substr($this->CI->kode_project_scope_controller,0,4));
        
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
        header('Content-Disposition: attachment;filename=Hasil Report AK.xlsx');
        $writer = IOFactory::createWriter($this->spreadsheet, 'Xlsx');
        $writer->save('php://output'); 
    }
    
    function view_excel(){
        ob_start();
        $writer = IOFactory::createWriter($this->spreadsheet, 'Xlsx');
        $writer->save('php://output');
        $hasil = ob_get_clean();
        $file_name = "TEMPORARYAK" . date("YmdHis") . rand(1000,9999) . ".xlsx";
        file_put_contents(__DIR__."/../../upload/xlsx_excel/temporary/" . $file_name, $hasil);
        return $file_name;
    }
}
