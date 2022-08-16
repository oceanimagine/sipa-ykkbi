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
        
        $this->get_daftar_iku->process(array(
            'action' => 'delete',
            'table' => 'tbldaftariku',
            'where' => 'ikukode = \''.$id.'\''
        ));
        redirect('daftar_iku');
    }
    
    public function edit($id){
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
            
            redirect('daftar_iku/edit/'.$id.'');
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
            'ikukode' => $this->row->{'ikukode'},
            'ikunama' => $this->row->{'ikunama'},
            'ikurincian' => $this->row->{'ikurincian'}
        ));
    }
    
    public function add(){
        if($this->input->post('kode')){
            $kode = $this->input->post('kode');
            $ikukode = $this->input->post('ikukode');
            $ikunama = $this->input->post('ikunama');
            $ikurincian = $this->input->post('ikurincian');
            $this->get_mata_anggaran_induk->process(array(
                'action' => 'insert',
                'table' => 'tbldaftarsbpps',
                'column_value' => array(
                    'kode' => $kode,
                    'ikukode' => $ikukode,
                    'ikunama' => $ikunama,
                    'ikurincian' => $ikurincian
                )
            ));
            
            redirect('daftar_program_kerja_tahunan/add');
        }
        $this->layout->loadView('daftar_iku_form');
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