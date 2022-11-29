<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('get_home');
        $this->layout = new layout('lite');
        Privilege::admin();
    }
    public function index(){
        /* 
        $this->layout->loadView(array(
            "set_custom_view" => $this
        ), array(
            "controller" => $this
        )); */
        $this->get_home->process(array(
            'action' => 'select',
            'table' => 'sp_dashboard_sbpcount(\''.$this->kode_project_scope_controller.'\')',
            'column_value' => array('*'),
            'order' => 'sbpkode asc'
        ));
        $this->layout->loadView("home", array( "data" => $this->all ));
    }
}