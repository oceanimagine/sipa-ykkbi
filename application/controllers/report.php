<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class report extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function ma($satker = ""){
        new process_report_excel_ma("all",false,$satker);
    }
    public function sbp($satker = ""){
        new process_report_excel_sbp("all",false,$satker);
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
    
    public function ma_view($satker = ""){
        $process = new process_report_excel_ma("all",true,$satker);
        $nama_file = $process->filename;
        echo "<div id='filename'>".$nama_file."</div>";
    }
    public function sbp_view($satker = ""){
        $process = new process_report_excel_sbp("all",true,$satker);
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