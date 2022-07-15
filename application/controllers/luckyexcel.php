<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class luckyexcel extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->layout = new layout('luckyexcel');
    }
    public function index(){
        $this->layout->loadView('luckyexcel');
    }
}