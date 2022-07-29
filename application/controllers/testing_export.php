<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class testing_export extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function export_data($param_){
        new process_kamus_report_excel($param_);
    }
    
    public function export_indent(){
        $process_report_excel = new process_report_excel();
        $process_report_excel->test_indent();
    }
    
    public function export_test_template(){
        $process_report_excel = new process_report_excel();
        $process_report_excel->test_template();
    }
    
    public function export_test_template_b(){
        $process_report_excel = new process_report_excel();
        $process_report_excel->test_complete_template_one_sheet();
    }
    
    public function export_test_template_b_new(){
        $process_report_excel = new process_report_excel();
        $process_report_excel->test_complete_template_one_sheet_new();
    }
    
    public function export_excel_ma(){
        new process_report_excel_ma("all");
    }
    
    public function export_pdf(){
        $process_report_excel = new process_report_excel();
        $process_report_excel->print_pdf();
    }
    
    public function print_html(){
        $process_report_excel = new process_report_excel();
        $process_report_excel->print_html();
    }
}