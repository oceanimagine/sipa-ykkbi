<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class daftar_program_kerja_tahunan extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('get_daftar_program_kerja_tahunan');
        $this->layout = new layout('lite');
        Privilege::admin();
    }
    
    public function get_daftar_program_kerja_tahunan() {
        $this->get_daftar_program_kerja_tahunan->get_data();
    }
    
    public function script_table(){
        return $this->layout->loadjs("daftar_program_kerja_tahunan/get_daftar_program_kerja_tahunan");
    }
    
    public function hapus($id){
        
        $this->get_daftar_program_kerja_tahunan->process(array(
            'action' => 'delete',
            'table' => 'tbldaftarikupkt',
            'where' => 'pktkode = \''.$id.'\''
        ));
        redirect('daftar_program_kerja_tahunan');
    }
    
    public function edit($id){
        if($this->input->post('kode')){
            $kode = $this->input->post('kode');
            $ikukode = $this->input->post('ikukode');
            $sbpkode = $this->input->post('sbpkode');
            $pktkode = $this->input->post('pktkode');
            $this->get_daftar_program_kerja_tahunan->process(array(
                'action' => 'update',
                'table' => 'tbldaftarikupkt',
                'column_value' => array(

                    'kode' => $kode,
                    'ikukode' => $ikukode,
                    'sbpkode' => $sbpkode,
                    'pktkode' => $pktkode
                ),
                'where' => 'pktkode = \''.$id.'\''
            ));
            
            redirect('daftar_program_kerja_tahunan/edit/'.$id.'');
        }
        
        $this->get_daftar_program_kerja_tahunan->process(array(
            'action' => 'select',
            'table' => 'tbldaftarikupkt',
            'column_value' => array(
                'kode',
                'ikukode',
                'sbpkode',
                'pktkode'
            ),
            'where' => 'pktkode = \''.$id.'\''
        ));
        $this->layout->loadView('daftar_program_kerja_tahunan_form', array(
            
            'kode' => $this->row->{'kode'},
            'ikukode' => $this->row->{'ikukode'},
            'sbpkode' => $this->row->{'sbpkode'},
            'pktkode' => $this->row->{'pktkode'}
        ));
    }
    
    public function add(){
        if($this->input->post('kode')){
            $kode = $this->input->post('kode');
            $sbpkode = $this->input->post('sbpkode');
            $sbpnourut = $this->input->post('sbpnourut');
            $sbpdesc = $this->input->post('sbpdesc');
            $this->get_mata_anggaran_induk->process(array(
                'action' => 'insert',
                'table' => 'tbldaftarsbpps',
                'column_value' => array(
                    'kode' => $kode,
                    'sbpkode' => $sbpkode,
                    'sbpnourut' => $sbpnourut,
                    'sbpdesc' => $sbpdesc
                )
            ));
            
            redirect('daftar_program_kerja_tahunan/add');
        }
        $this->layout->loadView('daftar_program_kerja_tahunan_form');
    }
    
    public function index() {
        $this->layout->loadView(
            'daftar_program_kerja_tahunan_list',
            array(
                "hasil" => "abcd",
                "script" => $this->script_table()
            )
        );
    }
    
}