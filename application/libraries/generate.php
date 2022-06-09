<?php

class generate {
    function sample_controller(){
        return "
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class {nama_tabel} extends CI_Controller {
    public \$layout;
    
    public function __construct() {
        parent::__construct();
        \$this->load->model('get_{nama_tabel}');
        \$this->layout = new layout('lite');
    }

    public function get_ajax_kategori() {
        \$this->get_kategori->get_{nama_tabel}();
    }

    public function script_table(){
        return \$this->layout->loadjs(\"kategori/get_ajax_{nama_tabel}\");
    }
    
    public function hapus(){
        \$id = isset(\$_GET['id']) && is_numeric(\$_GET['id']) ? \$_GET['id'] : '';
        \$this->get_{nama_tabel}->process(array(
            'action' => 'delete',
            'table' => '{nama_tabel}',
            'where' => '{pri_column} = \''.\$id.'\''
        ));
        redirect('kategori');
    }
    
    public function edit(){
        \$id = isset(\$_GET['id']) && is_numeric(\$_GET['id']) ? \$_GET['id'] : '';
        if(\$this->input->post('nama_kategori')){
            // output --> \$nama_kategori = \$this->input->post('nama_kategori');
            
            \$this->get_{nama_tabel}->process(array(
                'action' => 'update',
                'table' => '{nama_tabel}',
                'column_value' => array(
                    // output --> 'nama_kategori' => \$nama_kategori
                    {key_column_value}
                ),
                'where' => '{pri_column} = \''.\$id.'\''
            ));
            redirect('kategori');
        }
        \$this->get_kategori->process(array(
            'action' => 'select',
            'table' => 'tbl_villa_kategori',
            'column_value' => array(
                'nama_kategori'
            ),
            'where' => 'id = \''.\$id.'\''
        ));
        \$this->layout->loadView('kategori_edit', array(
            'nama_kategori' => \$this->row->nama_kategori
        ));
    }
    
    public function add(){
        if(\$this->input->post('nama_kategori')){
            \$nama_kategori = \$this->input->post('nama_kategori');
            \$this->get_kategori->process(array(
                'action' => 'insert',
                'table' => 'tbl_villa_kategori',
                'column_value' => array(
                    'nama_kategori' => \$nama_kategori
                )
            ));
            redirect('kategori/add');
        }
        \$this->layout->loadView('kategori_add');
    }
    
    public function index() {
        \$this->layout->loadView(
            'kategori_list',
            array(
                \"hasil\" => \"abcd\",
                \"script\" => \$this->script_table()
            )
        );
    }
    
}

";
    }
}