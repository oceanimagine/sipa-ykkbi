<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->layout = new layout('oreo');
        $this->menu = new process_menu();
        
    }
    public function index(){
        $this->layout->loadView("oreo/home", array( "coba" => "coba" ));
    }
}