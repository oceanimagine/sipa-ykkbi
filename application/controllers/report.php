<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class report extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function ma(){
        new process_report_excel_ma("all");
    }
    public function sbp(){
        new process_report_excel_sbp("all");
    }
    public function ak(){
        new process_report_excel_ak("all");
    }
    public function iku(){
        new process_report_excel_iku("all");
    }
    public function siaga_upload_data(){
        new process_report_siaga_upload_data("all");
    }
    
    public function ma_view(){
        $process = new process_report_excel_ma("all",true);
        $nama_file = $process->filename;
        echo "<div id='filename'>".$nama_file."</div>";
    }
    public function sbp_view(){
        $process = new process_report_excel_sbp("all",true);
        $nama_file = $process->filename;
        echo "<div id='filename'>".$nama_file."</div>";
    }
    public function ak_view(){
        $process = new process_report_excel_ak("all", true);
        $nama_file = $process->filename;
        echo "<div id='filename'>".$nama_file."</div>";
    }
    public function iku_view(){
        $process = new process_report_excel_iku("all", true);
        $nama_file = $process->filename;
        echo "<div id='filename'>".$nama_file."</div>";
    }
    public function siaga_upload_data_view(){
        $process = new process_report_siaga_upload_data("all",true);
        $nama_file = $process->filename;
        echo "<div id='filename'>".$nama_file."</div>";
    }
    
}