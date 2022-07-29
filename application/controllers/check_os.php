<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class check_os extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function is_linux($file_name = ""){
        if($file_name){
            if(file_exists(__DIR__ . "/../../upload/xlsx_excel/temporary/".$file_name)){
                shell_exec("/var/www/html/sipa/root/php_root libreoffice --invisible --convert-to html /var/www/html/sipa/application/controllers/../../upload/xlsx_excel/temporary/".$file_name." --outdir /var/www/html/sipa/application/controllers/../../upload/xlsx_excel/temporary/");
                echo "<div id='command'>"."libreoffice --invisible --convert-to html ".__DIR__."/../../upload/xlsx_excel/temporary/".$file_name." --outdir ".__DIR__."/../../upload/xlsx_excel/temporary/"."</div>";
                echo "<div id='result'>SUCCESS</div>\n";
            }
        }
    }
    public function get_html_view_temporary($file_name = "", $file_name_xlsx = ""){
        if($file_name){
            if(file_exists(__DIR__ . "/../../upload/xlsx_excel/temporary/".$file_name)){
                $contents = file_get_contents(__DIR__ . "/../../upload/xlsx_excel/temporary/".$file_name);
                echo $contents;
                unlink(__DIR__ . "/../../upload/xlsx_excel/temporary/".$file_name);
                if($file_name_xlsx && file_exists(__DIR__ . "/../../upload/xlsx_excel/temporary/".$file_name_xlsx)){
                    unlink(__DIR__ . "/../../upload/xlsx_excel/temporary/".$file_name_xlsx);
                }
            } else {
                echo "<title>No Exists.</title><body style='font-family: consolas, monospce;'>File No Longer Exists Please Recreate XLSX View.</body>\n";
            }
        }
    }
    public function index(){
        $this->load->view("regular/check_os", array(
            "osnya" => defined("PHP_OS_FAMILY") ? PHP_OS_FAMILY : "UNKNOWN"
        ));
    }
}

