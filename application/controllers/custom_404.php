<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class custom_404 extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->layout = new layout('lite');
        Privilege::admin();
    }
    public function index(){
        $this->layout->loadView('home_404');
    }
}