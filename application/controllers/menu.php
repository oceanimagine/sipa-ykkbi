<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {
    
    public $layout;
    private $menu_class;
    private $hasil_menu;
    public function __construct() {
        parent::__construct();
        Privilege::admin();
        $tag_original = "&nbsp;<i class=\"fa fa-arrow-right\" style=\"font-size: 10px; margin-right: 2px; margin-left: 2px;\"></i>&nbsp;";
        $tag_concate = $tag_original;
        $_GET['id'] = $this->uri->segment(3);
        $this->menu_class = new process_menu();
        $this->hasil_menu = $this->menu_class->option_menu_tr($tag_concate, 0, $tag_original);
        $this->keterangan_parent = $this->menu_class->keterangan_parent;
        $this->layout = new layout('lite');
        $this->load->model('get_menu');
    }
    
    public function test_menu(){
        echo "<title>MENU TEST</title>\n";
        echo "<body style='font-family: consolas, monospace;'>\n";
        $this->menu_class->get_privilege_table();
        echo "</body>\n";
    }

    public function get_menu() {
        header('Content-Type: application/json');
        $this->get_menu->get_data();
    }

    public function script_table(){
        return $this->layout->loadjs("menu/get_menu");
    }
    
    public function hapus(){
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : '';
        $this->get_menu->process(array(
            'action' => 'delete',
            'table' => 'tbl_menu',
            'where' => 'parent_id = \''.$id.'\''
        ));
        $this->get_menu->process(array(
            'action' => 'delete',
            'table' => 'tbl_menu',
            'where' => 'id = \''.$id.'\''
        ));
        redirect('menu');
    }
    
    public function edit(){
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : '';
        if($this->input->post('nama_menu')){
            $nama_menu = $this->input->post('nama_menu');
            $module = $this->input->post('module');
            $select_menu = $this->input->post('select_menu');
            $id_parent_ = $select_menu;
            $this->get_menu->process(array(
                'action' => 'update',
                'table' => 'tbl_menu',
                'column_value' => array(
                    'nama_menu' => $nama_menu,
                    'parent_id' => $id_parent_,
                    'module' => $module
                ),
                'where' => 'id = \'' . $id . '\''
            ));
            redirect('menu');
        }
        $this->get_menu->debug = true;
        $this->get_menu->process(array(
            'action' => 'select',
            'table' => 'tbl_menu',
            'column_value' => array(
                'nama_menu',
                'module'
            ),
            'where' => 'id = \''.$id.'\''
        ));
        $this->layout->loadView('menu_form', array(
            'nama_menu' => $this->row->nama_menu,
            'module' => $this->row->module,
            'judul' => "Menu Edit",
            'opsi_menu' => $this->hasil_menu,
            'keterangan_parent' => $this->keterangan_parent
        ));
    }
    
    public function add(){
        if($this->input->post('nama_menu')){
            $nama_menu = $this->input->post('nama_menu');
            $module = $this->input->post('module');
            $select_menu = $this->input->post('select_menu');
            $id_parent_ = $select_menu;
            $this->get_menu->process(array(
                'action' => 'insert',
                'table' => 'tbl_menu',
                'column_value' => array(
                    'nama_menu' => $nama_menu,
                    'parent_id' => $id_parent_,
                    'module' => $module
                )
            ));
            redirect('menu/add');
        }
        $this->layout->loadView('menu_form',array(
            'judul' => "Menu Add",
            'opsi_menu' => $this->hasil_menu,
            'keterangan_parent' => $this->keterangan_parent
        ));
    }
    public function index() {
        $this->layout->loadView(
            'menu_list',
            array(
                "hasil" => "abcd",
                "script" => $this->script_table()
            )
        );
    }
}