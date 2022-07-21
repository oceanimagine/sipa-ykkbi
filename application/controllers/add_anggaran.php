<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* https://stackoverflow.com/jobs/149384/software-engineer-team-lead-iprice-group?med=clc
 * https://stackoverflow.com/questions/17059987/changing-from-msql-to-mysqli-real-escape-string-link
 */



class add_anggaran extends CI_Controller {
    
    public $layout;
    public $kamus;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('get_add_anggaran');
        $this->layout = new layout('lite');
        Privilege::admin();
    }

    public function get_add_anggaran() {
        $this->get_add_anggaran->get_data();
    }

    public function script_table(){
        return $this->layout->loadjs("add_anggaran/get_add_anggaran");
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
    
    public function get_style(){
        $process_report_excel = new process_report_excel();
        $process_report_excel->test_get_style();
    }
    
    public function index() {
        $this->layout->loadView(
            'add_anggaran_form',
            array(
                "hasil" => "abcd",
                "script" => $this->script_table()
            )
        );
    }
    
    public function inbox(){
        $this->layout->loadView('inbox_view');
    }
}