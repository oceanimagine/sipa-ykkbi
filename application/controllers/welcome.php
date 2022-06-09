<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
    
    public $layout;
    
    public function __construct() {
        parent::__construct();
        $this->layout = new layout('lite');
    }

    public function get_ajax_kategori() {
        $this->load->model('get_kategori');
        $this->get_kategori->get_data();
    }

    public function script_table(){
        return $this->layout->loadjs("welcome/get_ajax_kategori");
    }

    public function index() {
        $this->layout->loadView(
            'welcome_message',
            array(
                "hasil" => "abcd",
                "script" => $this->script_table()
            )
        );
    }
}