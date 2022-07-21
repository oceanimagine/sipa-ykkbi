<?php

include_once __DIR__ . '/../libraries/phpspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
class process_report_excel {
    
    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('get_add_anggaran');
    }
    
    public function test_indent(){
        $reader = IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load(__DIR__."/../../upload/xlsx_excel/TEMPLATE.xlsx");
        $spreadsheet->getActiveSheet()->setCellValue("D9", "Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo");
        
        $spreadsheet->getActiveSheet()->getStyle("D9")->getAlignment()->setIndent(4);
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition: attachment;filename=Hasil Indent.xlsx');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output'); 
    }
    public function print_pdf(){
        ini_set("display_errors", "On");
        error_reporting(E_ALL);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile(__DIR__ . "/../../upload/xlsx_excel/HASILINDENT.xlsx");
        
        $phpWord = $reader->load(__DIR__ . "/../../upload/xlsx_excel/HASILINDENT.xlsx");
        $xmlWriter = IOFactory::createWriter($phpWord,'Mpdf');
        $xmlWriter->writeAllSheets();
        $xmlWriter->save(__DIR__ . "/../../upload/xlsx_excel/HELLOWWORLD.pdf");
    }
    public function print_html(){
        $objPHPExcelReader = \PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objPHPExcelReader->load(__DIR__ . "/../../upload/xlsx_excel/HASILINDENT.xlsx");
        
        $objPHPExcelWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel,'HTML');
        $objPHPExcelWriter->save(__DIR__ . "/../../upload/xlsx_excel/HELLOWWORLD.html");

    }
    public function test_template(){
        ini_set("display_errors", "On");
        error_reporting(E_ALL);
        $reader = IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load(__DIR__."/../../upload/xlsx_excel/TEMPLATE02.xlsx");
        
        $default_height = 12;
        $isi_kata = "Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo Hallo";
        $spreadsheet->getActiveSheet()->setCellValue("AD9", $isi_kata);
        $spreadsheet->getActiveSheet()->setCellValue("D9", $isi_kata);
        
        $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
        $wrap_explode = explode(" ----- ", $wrap_kata);
        
        $height_total = sizeof($wrap_explode) * $default_height;
        $spreadsheet->getActiveSheet()->getRowDimension('9')->setRowHeight($height_total);
        $spreadsheet->getActiveSheet()->setCellValue("AD9", "");
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition: attachment;filename=Hasil Wrap Merge Cell.xlsx');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output'); 
    }
    
    public function test_complete_template_one_sheet(){
        ini_set("display_errors", "On");
        error_reporting(E_ALL);
        $level_1 = "AD";
        $level_2 = "AE";
        $level_3 = "AF";
        $level_4 = "AG";
        $level_5 = "AH";
        $reader = IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load(__DIR__."/../../upload/xlsx_excel/TEMPLATE03.xlsx");
        
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
        
        $spreadsheet->getActiveSheet()->setCellValue($level_1 . "6", "");
        $spreadsheet->getActiveSheet()->setCellValue($level_2 . "6", "");
        $spreadsheet->getActiveSheet()->setCellValue($level_3 . "6", "");
        $spreadsheet->getActiveSheet()->setCellValue($level_4 . "6", "");
        $spreadsheet->getActiveSheet()->setCellValue($level_5 . "6", "");
        
        $spreadsheet->getActiveSheet()->setCellValue($level_1 . "9", "");
        $spreadsheet->getActiveSheet()->setCellValue($level_2 . "10", "");
        $spreadsheet->getActiveSheet()->setCellValue($level_3 . "11", "");
        $spreadsheet->getActiveSheet()->setCellValue($level_4 . "12", "");
        $spreadsheet->getActiveSheet()->setCellValue($level_5 . "13", "");
        
        $default_height = 12;
        $begin_row = 9;
        $all_data = $this->CI->all;
        for($i = 0; $i < sizeof($all_data); $i++){
            $isi_kata = $all_data[$i]->rekmanama;
            if($all_data[$i]->lvl == "1"){
                $spreadsheet->getActiveSheet()->mergeCells('D'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getActiveSheet()->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getActiveSheet()->setCellValue('D'.$begin_row, $isi_kata);
            }
            else if($all_data[$i]->lvl == "2"){
                $spreadsheet->getActiveSheet()->mergeCells('E'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getActiveSheet()->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getActiveSheet()->setCellValue('E'.$begin_row, $isi_kata);
                
            }
            else if($all_data[$i]->lvl == "3"){
                $spreadsheet->getActiveSheet()->mergeCells('F'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getActiveSheet()->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getActiveSheet()->setCellValue('F'.$begin_row, $isi_kata);
                
            }
            else if($all_data[$i]->lvl == "4"){
                $spreadsheet->getActiveSheet()->mergeCells('G'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getActiveSheet()->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getActiveSheet()->setCellValue('G'.$begin_row, $isi_kata);
                
            }
            else if($all_data[$i]->lvl == "5"){
                $spreadsheet->getActiveSheet()->setCellValue('H'.$begin_row, $isi_kata);
            }
            
            for($j = 0; $j < sizeof($key_row_col); $j++){
                if($key_row_col[$j] != "rekmanama"){
                    $spreadsheet->getActiveSheet()->setCellValue($row_col[$key_row_col[$j]] . $begin_row, $all_data[$i]->{$key_row_col[$j]});
                }
            }
            $begin_row++;
        }
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition: attachment;filename=Hasil Wrap Merge Cell All.xlsx');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output'); 
    }
    
    public function test_complete_template_one_sheet_new(){
        ini_set("display_errors", "On");
        error_reporting(E_ALL);
        $level_1 = "AD";
        $level_2 = "AE";
        $level_3 = "AF";
        $level_4 = "AG";
        $level_5 = "AH";
        $reader = IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load(__DIR__."/../../upload/xlsx_excel/TEMPLATE03.xlsx");
        
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
        
        $spreadsheet->getActiveSheet()->setCellValue($level_1 . "6", "");
        $spreadsheet->getActiveSheet()->setCellValue($level_2 . "6", "");
        $spreadsheet->getActiveSheet()->setCellValue($level_3 . "6", "");
        $spreadsheet->getActiveSheet()->setCellValue($level_4 . "6", "");
        $spreadsheet->getActiveSheet()->setCellValue($level_5 . "6", "");
        
        $spreadsheet->getActiveSheet()->setCellValue($level_1 . "9", "");
        $spreadsheet->getActiveSheet()->setCellValue($level_2 . "10", "");
        $spreadsheet->getActiveSheet()->setCellValue($level_3 . "11", "");
        $spreadsheet->getActiveSheet()->setCellValue($level_4 . "12", "");
        $spreadsheet->getActiveSheet()->setCellValue($level_5 . "13", "");
        
        $highestColumn = $spreadsheet->getActiveSheet()->getHighestColumn();
        
        $default_height = 12;
        $begin_row_start = 9;
        $begin_row = $begin_row_start;
        
        $all_data = $this->CI->all;
        $no = 1;
        
        for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
            $style_last = $spreadsheet->getActiveSheet()->getStyleByColumnAndRow($col, 14);
            $spreadsheet->getActiveSheet()->duplicateStyle($style_last, Coordinate::stringFromColumnIndex($col) . ($begin_row_start + sizeof($all_data)));
        }
        
        for($i = 0; $i < sizeof($all_data); $i++){
            $isi_kata = $all_data[$i]->rekmanama;
            if($all_data[$i]->lvl == "1"){
                $spreadsheet->getActiveSheet()->mergeCells('D'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getActiveSheet()->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getActiveSheet()->setCellValue('D'.$begin_row, $isi_kata);
                
                $spreadsheet->getActiveSheet()->setCellValue('I'.$begin_row, "=C9");
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getActiveSheet()->getStyleByColumnAndRow($col, 9);
                    $spreadsheet->getActiveSheet()->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
            }
            else if($all_data[$i]->lvl == "2"){
                $spreadsheet->getActiveSheet()->mergeCells('E'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getActiveSheet()->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getActiveSheet()->setCellValue('E'.$begin_row, $isi_kata);
                
                $spreadsheet->getActiveSheet()->setCellValue('I'.$begin_row, "=C10");
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getActiveSheet()->getStyleByColumnAndRow($col, 10);
                    $spreadsheet->getActiveSheet()->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
                
            }
            else if($all_data[$i]->lvl == "3"){
                $spreadsheet->getActiveSheet()->mergeCells('F'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getActiveSheet()->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getActiveSheet()->setCellValue('F'.$begin_row, $isi_kata);
                
                $spreadsheet->getActiveSheet()->setCellValue('I'.$begin_row, "=C11");
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getActiveSheet()->getStyleByColumnAndRow($col, 11);
                    $spreadsheet->getActiveSheet()->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
                
            }
            else if($all_data[$i]->lvl == "4"){
                $spreadsheet->getActiveSheet()->mergeCells('G'.$begin_row.':H'.$begin_row);
                $wrap_kata = wordwrap($isi_kata, 95, " ----- ");
                $wrap_explode = explode(" ----- ", $wrap_kata);
                $height_total = sizeof($wrap_explode) * $default_height;
                
                $spreadsheet->getActiveSheet()->getRowDimension($begin_row)->setRowHeight($height_total);
                $spreadsheet->getActiveSheet()->setCellValue('G'.$begin_row, $isi_kata);
                
                $spreadsheet->getActiveSheet()->setCellValue('I'.$begin_row, "=C12");
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getActiveSheet()->getStyleByColumnAndRow($col, 12);
                    $spreadsheet->getActiveSheet()->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
            }
            else if($all_data[$i]->lvl == "5"){
                $spreadsheet->getActiveSheet()->setCellValue('H'.$begin_row, $isi_kata);
                
                $spreadsheet->getActiveSheet()->setCellValue('I'.$begin_row, "=C13");
                
                for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
                    $style = $spreadsheet->getActiveSheet()->getStyleByColumnAndRow($col, 13);
                    $spreadsheet->getActiveSheet()->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . $begin_row);
                }
            }
            
            for($j = 0; $j < sizeof($key_row_col); $j++){
                if($key_row_col[$j] != "rekmanama"){
                    $spreadsheet->getActiveSheet()->setCellValue($row_col[$key_row_col[$j]] . $begin_row, $all_data[$i]->{$key_row_col[$j]});
                }
            }
            $spreadsheet->getActiveSheet()->setCellValue("A" . $begin_row, $no);
            $begin_row++;
            $no++;
        }
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition: attachment;filename=Hasil Wrap Merge Cell All.xlsx');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output'); 
    }
    
    public function test_get_style(){
        ini_set("display_errors", "On");
        error_reporting(E_ALL);
        $reader = IOFactory::createReader("Xlsx");
        $spreadsheet = $reader->load(__DIR__."/../../upload/xlsx_excel/TEMPLATE02.xlsx");
        
        $highestColumn = $spreadsheet->getActiveSheet()->getHighestColumn();
        
        $style = $spreadsheet->getActiveSheet()->getStyleByColumnAndRow(4, 9);
        $spreadsheet->getActiveSheet()->duplicateStyle($style, "H14");
        
        $style = $spreadsheet->getActiveSheet()->getStyleByColumnAndRow(9, 9);
        $spreadsheet->getActiveSheet()->duplicateStyle($style, "I14");
        
        $style = $spreadsheet->getActiveSheet()->getStyleByColumnAndRow(12, 9);
        $spreadsheet->getActiveSheet()->duplicateStyle($style, "L14");
        
        for ($col = 1; $col <= Coordinate::columnIndexFromString($highestColumn); $col++){
            // echo Coordinate::stringFromColumnIndex($col) . "<br />\n";
            $style = $spreadsheet->getActiveSheet()->getStyleByColumnAndRow($col, 9);
            $spreadsheet->getActiveSheet()->duplicateStyle($style, Coordinate::stringFromColumnIndex($col) . "14");
        }
        // echo $highestColumn . "<br />\n";
        // exit();
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition: attachment;filename=Hasil Copy Style.xlsx');
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output'); 
    }
}