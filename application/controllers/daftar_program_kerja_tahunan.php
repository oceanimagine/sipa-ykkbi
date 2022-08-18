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
        $id = urldecode($id);
        $this->process_param($id);
        $this->get_daftar_program_kerja_tahunan->process(array(
            'action' => 'delete',
            'table' => 'tbldaftarikupkt',
            'where' => 'kode = \''.$this->kode.'\' and ikukode = \''.$this->ikukode.'\' and sbpkode = \''.$this->sbppskode.'\' and pktkode = \''.$this->pktkode.'\''
        ));
        redirect('daftar-program-kerja-tahunan');
    }
    
    public function edit($id){
        $id = urldecode($id);
        $this->process_param($id);
        if($this->input->post('kode')){
            $kode = $this->input->post('kode');
            $ikukode = $this->input->post('iku_kode_hidden');
            $sbpkode = $this->input->post('sbpps_kode_hidden');
            $pktkode = $this->input->post('pkt_kode');
            $this->get_daftar_program_kerja_tahunan->process(array(
                'action' => 'update',
                'table' => 'tbldaftarikupkt',
                'column_value' => array(

                    'kode' => $kode,
                    'ikukode' => $ikukode,
                    'sbpkode' => $sbpkode,
                    'pktkode' => $pktkode
                ),
                'where' => 'kode = \''.$this->kode.'\' and ikukode = \''.$this->ikukode.'\' and sbpkode = \''.$this->sbppskode.'\' and pktkode = \''.$this->pktkode.'\''
            ));
            
            redirect('daftar-program-kerja-tahunan/edit/'. urlencode($kode."-".$ikukode."-".$sbpkode."-".$pktkode).'');
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
            'where' => 'kode = \''.$this->kode.'\' and ikukode = \''.$this->ikukode.'\' and sbpkode = \''.$this->sbppskode.'\' and pktkode = \''.$this->pktkode.'\''
        ));
        $data_row = $this->row;
        
        // Get SBPPS
        $sbpkode = $data_row->{'sbpkode'};
        $this->get_daftar_program_kerja_tahunan->process(array(
            'action' => 'select',
            'table' => 'tbldaftarsbpps',
            'column_value' => array(
                'sbpkode',
                'sbpdesc'
            ),
            'where' => 'sbpkode = \''.$sbpkode.'\''
        ));
        $data_row_sbpps = $this->row;
        $sbpkode_display = $data_row_sbpps->{'sbpkode'} . " # " . $data_row_sbpps->{'sbpdesc'};
        $sbpkode_hidden = $data_row_sbpps->{'sbpkode'};
        
        // Get Urutan IKU
        $explode_ = explode(".", $sbpkode_hidden);
        $urutan_iku = (int) $explode_[sizeof($explode_) - 1];
        
        // Get IKU
        $ikukode = $data_row->{'ikukode'};
        $this->get_daftar_program_kerja_tahunan->process(array(
            'action' => 'select',
            'table' => 'tbldaftariku',
            'column_value' => array(
                'ikukode',
                'ikunama'
            ),
            'where' => 'ikukode = \''.$ikukode.'\''
        ));
        $data_row_iku = $this->row;
        $iku_display = $data_row_iku->{'ikukode'} . " # " . $data_row_iku->{'ikunama'};
        $iku_hidden = $data_row_iku->{'ikukode'};
        
        $this->layout->loadView('daftar_program_kerja_tahunan_form', array(
            
            'kode' => $data_row->{'kode'},
            'sbpkode_display' => $sbpkode_display,
            'sbpkode_hidden' => $sbpkode_hidden,
            'iku_display' => $iku_display,
            'iku_hidden' => $iku_hidden,
            'pktkode' => $data_row->{'pktkode'},
            'urutan_iku' => $urutan_iku
        ));
    }
    
    public function get_iku_only(){
         // Get IKU
        $this->get_daftar_program_kerja_tahunan->process(array(
            'action' => 'select',
            'table' => 'tbldaftariku',
            'column_value' => array(
                'ikukode',
                'ikunama',
                'ikurincian'
            )
        ));
        $this->load->view("regular/data_search_iku", array(
            "data_search" => $this->all
        ));
    }
    
    public function get_sbpps_only(){
        // Get SBPPS
        $this->get_daftar_program_kerja_tahunan->process(array(
            'action' => 'select',
            'table' => 'tbldaftarsbpps',
            'column_value' => array(
                'sbpkode',
                'sbpnourut',
                'sbpdesc'
            )
        ));
        $this->load->view("regular/data_search_sbpps", array(
            "data_search" => $this->all
        ));
    }
    
    public function add(){
        if($this->input->post('kode')){
            $kode = $this->input->post('kode');
            $ikukode = $this->input->post('iku_kode_hidden');
            $sbpkode = $this->input->post('sbpps_kode_hidden');
            $pktkode = $this->input->post('pkt_kode');
            $this->get_daftar_program_kerja_tahunan->process(array(
                'action' => 'insert',
                'table' => 'tbldaftarikupkt',
                'column_value' => array(
                    'kode' => $kode,
                    'ikukode' => $ikukode,
                    'sbpkode' => $sbpkode,
                    'pktkode' => $pktkode
                )
            ));
            
            redirect('daftar-program-kerja-tahunan/add');
        }
        $daftar_sbpps = "UNDEFINED";
        $this->layout->loadView('daftar_program_kerja_tahunan_form', array(
            'daftar_sbpps' => $daftar_sbpps
        ));
    }
    
    private $kode;
    private $ikukode;
    private $sbppskode;
    private $pktkode;
    public function process_param($param_id){
        if($this->router->routes['translate_uri_dashes']){
            $param_id = str_replace("_", "-", $param_id);
        }
        $explode_param_id = explode("-", $param_id);
        $kode = $explode_param_id[0];
        $ikukode = $explode_param_id[1];
        $sbppskode = $explode_param_id[2];
        $pktkode = $explode_param_id[3];
        $this->kode = $kode;
        $this->ikukode = $ikukode;
        $this->sbppskode = $sbppskode;
        $this->pktkode = $pktkode;
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