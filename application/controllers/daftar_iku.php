<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class daftar_iku extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('get_daftar_iku');
        $this->layout = new layout('lite');
        Privilege::admin();
    }
    
    public function get_daftar_iku() {
        $this->get_daftar_iku->get_data();
    }
    
    public function script_table(){
        return $this->layout->loadjs("daftar_iku/get_daftar_iku");
    }
    
    public function hapus($id){
        $id = urldecode($id);
        $this->get_daftar_iku->process(array(
            'action' => 'delete',
            'table' => 'tbldaftariku',
            'where' => 'ikukode = \''.$id.'\''
        ));
        redirect('daftar-iku');
    }
    
    public function edit($id){
        $id = urldecode($id);
        if($this->input->post('kode')){
            $kode = $this->input->post('kode');
            $ikukode = $this->input->post('ikukode');
            $ikunama = $this->input->post('ikunama');
            $ikurincian = $this->input->post('ikurincian');
            $this->get_daftar_iku->process(array(
                'action' => 'update',
                'table' => 'tbldaftariku',
                'column_value' => array(

                    'kode' => $kode,
                    'ikukode' => $ikukode,
                    'ikunama' => $ikunama,
                    'ikurincian' => $ikurincian
                ),
                'where' => 'ikukode = \''.$id.'\''
            ));
            
            redirect('daftar-iku/edit/'.urlencode($id).'');
        }
        
        $this->get_daftar_iku->process(array(
            'action' => 'select',
            'table' => 'tbldaftariku',
            'column_value' => array(
                'kode',
                'ikukode',
                'ikunama',
                'ikurincian'
            ),
            'where' => 'ikukode = \''.$id.'\''
        ));
        
        $this->layout->loadView('daftar_iku_form', array(
            'kode' => $this->row->{'kode'},
            'iku_kode' => $this->row->{'ikukode'},
            'iku_nama' => $this->row->{'ikunama'},
            'iku_rincian' => $this->row->{'ikurincian'},
            'title' => 'Edit IKU'
        ));
    }
    
    public function add(){
        if($this->input->post('kode')){
            $kode = $this->input->post('kode');
            $ikukode = $this->input->post('ikukode');
            $ikunama = $this->input->post('ikunama');
            $ikurincian = $this->input->post('ikurincian');
            $this->get_daftar_iku->process(array(
                'action' => 'insert',
                'table' => 'tbldaftariku',
                'column_value' => array(
                    'kode' => $kode,
                    'ikukode' => $ikukode,
                    'ikunama' => $ikunama,
                    'ikurincian' => $ikurincian
                )
            ));
            
            redirect('daftar-iku/add');
        }
        
        // Get Highest Kode IKU
        $this->get_daftar_iku->process(array(
            'action' => 'select',
            'table' => 'tbldaftariku',
            'column_value' => array(
                'ikukode'
            ),
            'order' => 'ikukode desc'
        ));
        
        $this->layout->loadView('daftar_iku_form', array(
            "iku_kode" => $this->next_iku($this->all[0]->ikukode),
            'title' => 'Add IKU'
        ));
    }
    
    public function next_iku($current_kode){
        $explode_ = explode("#", $current_kode);
        $next_increment = (int) $explode_[1] + 1;
        return "IKU#" . samakan($next_increment, 99);
    }
    
    public function index() {
        $this->layout->loadView(
            'daftar_iku_list',
            array(
                "hasil" => "abcd",
                "script" => $this->script_table()
            )
        );
    }
    
}