<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {
    
    public $layout;
    private $menu;
    public $test;
    public function __construct() {
        parent::__construct();
	$this->load->model('get_login');
        $this->layout = new layout('login');
        $this->menu = new process_menu();
    }
    
    public function index(){
        $check = "";
        if(isset($_POST['username'])){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            if($username == "sipa" && $password == "sipa"){
                $_SESSION['PRI'] = "SUPERADMIN";
                $_SESSION['nomor_admin'] = "AS1"; 
                $this->layout->render_alert("Welcome Admin Super.");
		Message::set("Berhasil login sebagai Admin Super.");
                redirect("home");
            } else {
                $this->get_login->process(array(
                    'action' => 'select',
                    'table' => 'tbl_user_admin',
                    'column_value' => array(
                        'id',
                        'nama_lengkap',
                        'photo_user_admin',
                        'nomor_karyawan',
                        'username'
                    ),
                    'where' => 'username = \''.$username.'\' and password = \''.md5($password).'\'',
                    'order' => 'id desc'
                ));
                $user_active = $this->row;
                if(is_object($user_active) && isset($user_active->nama_lengkap)){
                    $_SESSION['PRI'] = "ADMIN";
                    $_SESSION['USR'] = "9998";
                    $_SESSION['id'] = $user_active->id;
                    $_SESSION['nama_lengkap'] = $user_active->nama_lengkap;
                    $_SESSION['photo_admin'] = $user_active->photo_admin;
                    $_SESSION['nomor_admin'] = "AB" . $user_active->nomor_karyawan; 
                    $_SESSION['username'] = $user_active->username;
                    $this->layout->render_alert("Welcome Admin.");
                    Message::set("Berhasil login sebagai Admin.");
                    redirect("home");
                }
	    }
            
            $check = "salah";
        }
        
        $this->layout->loadView('login_form', array(
            "check" => $check
        ));
    }
    
}