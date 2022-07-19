<?php

include_once __DIR__ . '/../libraries/phpspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
class process_report_excel {
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
        // header('Content-Disposition: attachment;filename=Hasil Indent.ods');
        // $writer = IOFactory::createWriter($spreadsheet, 'Ods');
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
}