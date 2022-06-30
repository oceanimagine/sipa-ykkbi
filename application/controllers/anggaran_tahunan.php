<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* https://stackoverflow.com/jobs/149384/software-engineer-team-lead-iprice-group?med=clc
 * https://stackoverflow.com/questions/17059987/changing-from-msql-to-mysqli-real-escape-string-link
 */

class anggaran_tahunan extends CI_Controller {
    
    public $layout;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('get_anggaran_tahunan');
        $this->layout = new layout('lite');
        Privilege::admin();
    }

    public function get_anggaran_tahunan() {
        $this->get_anggaran_tahunan->get_data();
    }

    public function script_table(){
        return $this->layout->loadjs("anggaran_tahunan/get_anggaran_tahunan");
    }
    
    public function index() {
        $this->layout->loadView(
            'anggaran_tahunan_list',
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