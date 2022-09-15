<?php

## https://stackoverflow.com/questions/68211913/phpspreadsheet-select-specific-sheet-to-display-in-html
## https://stackoverflow.com/questions/40763273/how-to-delete-worksheet-in-phpexcel
## https://stackoverflow.com/questions/22170864/500-internal-server-error-how-to-debug

## https://askubuntu.com/questions/1302280/can-we-increase-the-memory-limit-of-php-directly-from-the-command-line
## https://stackoverflow.com/questions/70207326/phpspreadsheet-how-to-copy-cell-with-formatting
## https://stackoverflow.com/questions/46959282/styling-cell-borders-with-phpspreadsheet-php
## https://practicum.com/id-idn/
## https://www.yasir252.com/software/download-microsoft-office-2013-full-version-gratis/
## https://www.yasir252.com/games/far-cry-5-full-crack/
## https://www.yasir252.com/games/one-piece-unlimited-world-red-full-version-download/
## https://www.yasir252.com/games/download-one-piece-pirate-warriors-4-full-version/
## https://phpspreadsheet.readthedocs.io/en/latest/topics/recipes/#alignment-and-wrap-text
## https://github.com/PHPOffice/PhpSpreadsheet/blob/master/docs/topics/recipes.md

include_once __DIR__ . '/../libraries/phpspreadsheet/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

class process_spreadsheet_html_viewer {

    public function __construct($tampilkan = false) {
        if($tampilkan){
            error_reporting(-1);
            ini_set("display_errors", "1");
            ini_set("log_errors", 1);
            ini_set("error_log", "/tmp/php-error-2.log");
            $file = __DIR__."/../../upload/xlsx_excel/EXAMPLE.xlsx";
            
            echo "<title>HTML Spreadsheet Viewer</title>\n";
            echo "<style type='text/css'>html, body {font-family: consolas, monospace;}</style>\n";
            
            ##  GET ALL SHEETS OF EXCEL FILE
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($file);
            $array_sheet = $spreadsheet->getSheetNames();
            
            ##  DISPLAY ALL SHEETS
            ##  DECLARE OR SET POST sheet and the index  depending what is submitted
            if (!isset($_POST['sheet'])) {
                ##  LOAD FIRST SHEET AS DEFAULT
                $_POST['sheet'] = $array_sheet[0];
                $index = 0;
            }
            
            ##  SET SELECTED SHEET
            for ($i = 0; $i < sizeof($array_sheet); $i++) {
                if ($_POST['sheet'] == $array_sheet[$i]) {
                    $_POST['sheet'] = $array_sheet[$i];
                    $index = $i;
                }
            }
            
            ##  BLOCK FOR DISPLAY FROM EXCEL TO HTML
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
            $spreadsheet = $reader->load($file);
            
            ##  LOOP TO DETERMINE WHICH SHEETS TO REMOVE
            for ($i = 0; $i < sizeof($array_sheet); $i++) {
                ##  REMOVE SHEET
                if ($i != $index) {
                    $spreadsheet->setActiveSheetIndexByName($array_sheet[$i]);
                    $sheetIndex = $spreadsheet->getActiveSheetIndex();
                    $spreadsheet->removeSheetByIndex($sheetIndex);
                }
            }
            
            $spreadsheet->setActiveSheetIndexByName($_POST['sheet']);
            
            ##  ADD TO WRITER
            $writer = IOFactory::createWriter($spreadsheet, 'Html');
            $message = $writer->save('php://output');
            
            ##  THIS WILL DISPLAY THE TABLE
            echo $message;
            echo "<br />\n";
            
            ##  FORM AND BUTTONS WHICH WILL BE USED TO NAVIGATE BETWEEN SHEETS
            echo "<form method = \"POST\" action = \"\">\n";
            for ($i = 0; $i < sizeof($array_sheet); $i++) {
                $style = "";
                if ($array_sheet[$i] == $_POST['sheet']) {
                    $style = "background:red;";
                }
                echo "<button type = \"submit\" name = \"sheet\" value = \"" . $array_sheet[$i] . "\" style = \"$style\">" . $array_sheet[$i] . "</button>\n";
            }
            echo "</form>\n";
        }
    }

}
