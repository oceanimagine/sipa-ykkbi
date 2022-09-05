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
    
    public function get_kegiatan_only($sbpkode = ""){
        
        $sbpkode_where = $sbpkode != "" ? " and sbpkode = '".$sbpkode."'" : "";
        $explode_comma = explode(",", $this->aplikasi->data->satker_string);
        $result_satker = "";
        $comma = "";
        for($i = 0; $i < sizeof($explode_comma); $i++){
            $result_satker = $result_satker . $comma . "'" . $explode_comma[$i] . "'";
            $comma = ",";
        }
        
        $this->get_daftar_program_kerja_tahunan->process(array(
            'action' => 'select',
            'table' => 'tbldaftarpkt',
            'column_value' => array(
                '*'
            ),
            'where' => 'substring(pktkode from 1 for 1) in ('.$result_satker.') and length(pktkode) = 4' . $sbpkode_where,
            'order' => 'sbpkode asc, pktkode asc'
        ));
        
        $this->load->view("regular/data_search_kegiatan_based_satker", array(
            "data_search" => $this->all
        ));
    }
    
    public function hapus($id){
        if($this->allow_delete == "0"){
            Message::set("Delete Data not allowed.");
            redirect('daftar-program-kerja-tahunan');
            exit();
        }
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
            if($this->allow_update == "0"){
                Message::set("Update Data not allowed.");
                redirect('daftar-program-kerja-tahunan/edit/'.$id.'');
                exit();
            }
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
        
        // Get SBPPS
        $sbpkode = $this->sbppskode;
        $merah = "";
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
        if($sbpkode_display == " # "){
            $sbpkode_display = "";
        }
        
        // Get Kegiatan
        $this->get_daftar_program_kerja_tahunan->process(array(
            'action' => 'select',
            'table' => 'tbldaftarpkt',
            'column_value' => array(
                'pktkode',
                'pktnama',
                'pktoutput'
            ),
            'where' => 'sbpkode = \''.$sbpkode.'\' and pktkode = \''.$this->pktkode_kegiatan.'\''
        ));
        $kegiatan = $this->row;
        $kegiatan_display = $kegiatan->{'pktkode'} . " # " . $kegiatan->{'pktnama'};
        $kegiatan_hidden = $kegiatan->{'pktkode'};
        
        $kegiatan_count = $this->all;
        if(sizeof($kegiatan_count) == 0){
            $this->get_daftar_program_kerja_tahunan->process(array(
                'action' => 'select',
                'table' => 'tbldaftarpkt',
                'column_value' => array(
                    'pktkode',
                    'pktnama',
                    'pktoutput'
                ),
                'where' => 'pktkode = \''.$this->pktkode_kegiatan.'\''
            ));
            $kegiatan = $this->row;
            $kegiatan_display = $kegiatan->{'pktkode'} . " # " . $kegiatan->{'pktnama'};
            $kegiatan_hidden = $kegiatan->{'pktkode'};
            $merah = "merah";
        }
        if($kegiatan_display == " # "){
            $kegiatan_display = "";
        }
        
        $this->get_daftar_program_kerja_tahunan->process(array(
            'action' => 'select',
            'table' => 'tbldaftarpkt',
            'column_value' => array(
                'pktnama',
                'pktoutput'
            ),
            'where' => 'sbpkode = \''.$sbpkode.'\' and pktkode = \''.$this->pktkode.'\''
        ));
        $kegiatan_rincian = $this->row;
        $pktnama = $kegiatan_rincian->{'pktnama'};
        $pktoutput = $kegiatan_rincian->{'pktoutput'};
        
        $this->layout->loadView('daftar_program_kerja_tahunan_form', array(
            'sbpkode_display' => $sbpkode_display,
            'sbpkode_hidden' => $sbpkode_hidden,
            'pktkrk' => strlen($this->pktkode) > 4 ? "RK" : "K",
            'kegiatan_kode_display' => $kegiatan_display,
            'kegiatan_kode_hidden' => $kegiatan_hidden,
            'pktnama' => $pktnama,
            'pktoutput' => $pktoutput,
            'satker_display' => $this->satker_display,
            'urutan_kegiatan' => $this->urutan_kegiatan,
            'urutan_rincian_kegiatan' => $this->urutan_rincian_kegiatan,
            'satker_view' => $this->aplikasi->data->satker,
            'merah' => $merah
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
            ),
            'order' => 'sbpkode asc'
        ));
        $this->load->view("regular/data_search_sbpps", array(
            "data_search" => $this->all
        ));
    }
    
    public function add(){
        if($this->input->post('kode')){
            if($this->allow_create == "0"){
                Message::set("Create Data not allowed.");
                redirect('daftar-program-kerja-tahunan/add');
                exit();
            }
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
            'daftar_sbpps' => $daftar_sbpps,
            'satker_view' => $this->aplikasi->data->satker
        ));
    }
    
    private $kode;
    private $sbppskode;
    private $pktkode;
    private $pktkode_kegiatan;
    private $satker_display;
    private $urutan_kegiatan;
    private $urutan_rincian_kegiatan;
    public function process_param($param_id){
        if($this->router->routes['translate_uri_dashes']){
            $param_id = str_replace("_", "-", $param_id);
        }
        $explode_param_id = explode("-", $param_id);
        $kode = $explode_param_id[0];
        $sbppskode = $explode_param_id[1];
        $pktkode = $explode_param_id[2];
        $this->kode = $kode;
        $this->sbppskode = $sbppskode;
        $this->pktkode = $pktkode;
        $explode_pktkode = explode(".", $pktkode);
        $this->satker_display = $explode_pktkode[0];
        $this->urutan_kegiatan = $explode_pktkode[1];
        $this->pktkode_kegiatan = $explode_pktkode[0] . "." . $explode_pktkode[1];
        if(isset($explode_pktkode[2])){
            $this->urutan_rincian_kegiatan = $explode_pktkode[2];
        }
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