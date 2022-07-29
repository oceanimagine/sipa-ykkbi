<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class logout extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        session_start();
        session_destroy();
        header('location: ../index.php/login');
    }
}