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
}