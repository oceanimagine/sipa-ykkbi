<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {
    
    public $layout;
    private $menu;
    public $test;
    public function __construct() {
        parent::__construct();
        $GLOBALS['login_page'] = true;
        $session_exists = Privilege::admin();
        if($session_exists){
            header('location: '.$GLOBALS['base_administrator'].'index.php/home');
        }
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
                $this->get_login->process(array(
                    'action' => 'select',
                    'table' => 'tblmastersatker',
                    'column_value' => array(
                        'satkerid',
                        'nama1',
                        'nama2'
                    )
                ));
                $data_satker = $this->all;
                $data_satker_session = "";
                $comma = "";
                for($i = 0; $i < sizeof($data_satker); $i++){
                    $data_satker_session = $data_satker_session . $comma . $data_satker[$i]->satkerid;
                    $comma = ",";
                }
                $_SESSION['PRI'] = "SUPERADMIN";
                $_SESSION['nomor_admin'] = "AS1";
                $_SESSION['data_satker'] = $data_satker;
                $_SESSION['data_satker_comma'] = $data_satker_session;
                $this->layout->render_alert("Welcome Admin Super.");
		Message::set("Berhasil login sebagai Admin Super.");
                redirect("home");
            } else {
                // print_query();
                $this->get_login->process(array(
                    'action' => 'select',
                    'table' => 'tbl_user_admin',
                    'column_value' => array(
                        'id',
                        'nama_lengkap',
                        'photo_user_admin',
                        'nomor_karyawan',
                        'username',
                        'satker'
                    ),
                    'where' => 'username = \''.$username.'\' and password = \''.md5($password).'\'',
                    'order' => 'id desc'
                ), true);
                
                $user_active = $this->row;
                if(is_object($user_active) && isset($user_active->nama_lengkap)){
                    $this->get_login->process(array(
                        'action' => 'select',
                        'table' => 'tblmastersatker',
                        'column_value' => array(
                            'satkerid',
                            'nama1',
                            'nama2'
                        ),
                        'where' => 'satkerid::int in ('.$user_active->satker.')'
                    ));
                    $data_satker = $this->all;
                    $data_satker_session = "";
                    $comma = "";
                    for($i = 0; $i < sizeof($data_satker); $i++){
                        $data_satker_session = $data_satker_session . $comma . $data_satker[$i]->satkerid;
                        $comma = ",";
                    }
                    $_SESSION['PRI'] = "ADMIN";
                    $_SESSION['USR'] = $user_active->id;
                    $_SESSION['id'] = $user_active->id;
                    $_SESSION['data_satker'] = $data_satker;
                    $_SESSION['data_satker_comma'] = $data_satker_session;
                    $_SESSION['nama_lengkap'] = $user_active->nama_lengkap;
                    $_SESSION['photo_admin'] = $user_active->photo_user_admin;
                    $_SESSION['nomor_admin'] = "AB" . $user_active->nomor_karyawan; 
                    $_SESSION['username'] = $user_active->username;
                    $this->layout->render_alert("Welcome Admin.");
                    Message::set("Berhasil login sebagai ".$user_active->nama_lengkap.".");
                    redirect("home");
                }
	    }
            
            $check = "salah";
        }
        
        $this->layout->loadView('login_form', array(
            "check" => $check
        ));
    }
    
    public function check_login(){
        if(isset($_SESSION['PRI']) && $_SESSION['PRI'] != ""){
            echo "LOGIN";
        } else {
            echo "LOGOUT";
        }
    }
    
}