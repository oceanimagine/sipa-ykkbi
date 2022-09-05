<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Useradmin extends CI_Controller {
    
    public $layout;
    private $menu_class;
    private $table_menu;
    private $has_insert = array();
    private $satker_all = array();
    public function __construct() {
        parent::__construct();
        Privilege::admin();
        $_GET['id'] = $this->uri->segment(3);
        $this->menu_class = new process_menu();
        $this->table_menu = $this->menu_class->get_privilege_table();
        $this->layout = new layout('lite');
        $this->load->model('get_useradmin');
        $this->get_useradmin->process(array(
            'action' => 'select',
            'table' => 'tblmastersatker',
            'column_value' => array(
                'satkerid',
                'nama1',
                'nama2'
            )
        ));
        $this->satker_all = $this->all;
    }

    public function get_ajax_useradmin() {
        header('Content-Type: application/json');
        $this->get_useradmin->get_data();
    }

    public function script_table(){
        return $this->layout->loadjs("useradmin/get_ajax_useradmin");
    }
    
    public function hapus($id){
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : $id;
        $_GET['id'] = $id;
        delete_photo('photo_user_admin');
        $this->get_useradmin->process(array(
            'action' => 'delete',
            'table' => 'tbl_user_admin',
            'where' => 'id = \''.$id.'\''
        ));
        $this->remove_privilege($id);
        redirect('useradmin');
    }
    
    public function edit($id){
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : $id;
        $_GET['id'] = $id;
        if($this->input->post('username')){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $nama_lengkap = $this->input->post('nama_lengkap');
            $nomor_karyawan = $this->input->post('nomor_karyawan');
            $satker_isi = "";
            if(isset($_POST['satker']) && is_array($_POST['satker'])){
                $satker = $_POST['satker'];
                $comma = "";
                for($i = 0; $i < sizeof($satker); $i++){
                    $satker_isi = $satker_isi . $comma . $satker[$i];
                    $comma = ",";
                }
            }
            upload_file("photo_user_admin");
            $this->get_useradmin->process(array(
                'action' => 'update',
                'table' => 'tbl_user_admin',
                'column_value' => array(
                    'username' => $username,
                    'nama_lengkap' => $nama_lengkap,
                    'nomor_karyawan' => $nomor_karyawan,
                    'photo_user_admin' => $this->name_file_upload,
                    'satker' => $satker_isi
                ),
                'where' => 'id = \'' . $id . '\''
            ));
            if($password != ""){
                $this->get_useradmin->process(array(
                    'action' => 'update',
                    'table' => 'tbl_user_admin',
                    'column_value' => array(
                        'password' => md5($password)
                    ),
                    'where' => 'id = \'' . $id . '\''
                ));
            }
            $this->add_privilege($id);
            redirect('useradmin');
        }
        $this->get_useradmin->process(array(
            'action' => 'select',
            'table' => 'tbl_user_admin',
            'column_value' => array(
                'username',
                'nama_lengkap',
                'photo_user_admin',
                'nomor_karyawan',
                'satker'
            ),
            'where' => 'id = \''.$id.'\''
        ));
        $this->layout->loadView('useradmin_form', array(
            'username' => $this->row->username,
            'nama_lengkap' => $this->row->nama_lengkap,
            'photo_user_admin' => $this->row->photo_user_admin,
            'nomor_karyawan' => $this->row->nomor_karyawan,
            'judul' => "User Admin Edit",
            'satker' => $this->row->satker,
            'table_menu' => $this->table_menu,
            'satker_all' => $this->satker_all
        ));
    }
    public function remove_privilege($id){
        $this->get_useradmin->process(array(
            'action' => 'delete',
            'table' => 'tbl_menu_privilege',
            'where' => 'id_user = \''.$id.'\''
        ));
    }
    public function add_privilege_detail($id,$array_explode){
        for($i = 0; $i < sizeof($array_explode); $i++){
            if(!isset($this->has_insert[$array_explode[$i]])){
                $this->get_useradmin->process(array(
                    'action' => 'insert',
                    'table' => 'tbl_menu_privilege',
                    'column_value' => array(
                        'id_menu' => $array_explode[$i],
                        'id_user' => $id
                    )
                ));
                $this->has_insert[$array_explode[$i]] = true;
            }
        }
    }
    public function add_privilege($id){
        $this->remove_privilege($id);
        for($i = 0; $i < 100; $i++){
            if($this->input->post('check_' . $i)){
                $check_ = $this->input->post('check_' . $i);
                $expld_ = explode(",", $check_);
                $this->add_privilege_detail($id,$expld_);
            }
        }
    }
    public function add(){
        if($this->input->post('username')){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $nama_lengkap = $this->input->post('nama_lengkap');
            $nomor_karyawan = $this->input->post('nomor_karyawan');
            upload_file("photo_user_admin");
            $satker_isi = "";
            if(isset($_POST['satker']) && is_array($_POST['satker'])){
                $satker = $_POST['satker'];
                $comma = "";
                for($i = 0; $i < sizeof($satker); $i++){
                    $satker_isi = $satker_isi . $comma . $satker[$i];
                    $comma = ",";
                }
            }
            $this->get_useradmin->process(array(
                'action' => 'insert',
                'table' => 'tbl_user_admin',
                'column_value' => array(
                    'username' => $username,
                    'password' => md5($password),
                    'nama_lengkap' => $nama_lengkap,
                    'nomor_karyawan' => $nomor_karyawan,
                    'photo_user_admin' => $this->name_file_upload,
                    'satker' => $satker_isi
                )
            ));
            $this->get_useradmin->process(array(
                'action' => 'select',
                'table' => 'tbl_user_admin',
                'column_value' => array(
                    'id'
                ),
                'order' => 'id desc'
            ));
            
            $this->add_privilege($this->row->id);
            redirect('useradmin/add');
        }
        $this->layout->loadView('useradmin_form',array(
            'judul' => "User Admin Add",
            'table_menu' => $this->table_menu,
            'satker_all' => $this->satker_all
        ));
    }
    public function index() {
        $this->layout->loadView(
            'useradmin_list',
            array(
                "hasil" => "abcd",
                "script" => $this->script_table()
            )
        );
    }
}