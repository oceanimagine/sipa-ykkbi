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
            'where' => 'kode = \''.$this->kode_project_scope_controller.'\' and substring(pktkode from 1 for 1) in ('.$result_satker.') and length(pktkode) = 4' . $sbpkode_where,
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
        $do_delete = true;
        if(strlen($this->pktkode) == 4){
            $this->get_daftar_program_kerja_tahunan->process(array(
                'action' => 'select',
                'table' => 'tbldaftarpkt',
                'column_value' => array('pktkode'),
                'where' => 'kode = \''.$this->kode.'\' and sbpkode = \''.$this->sbppskode.'\' and length(pktkode) > 4 and substring(pktkode from 1 for 4) = \''.$this->pktkode.'\''
            ));
            if(sizeof($this->all) > 0){
                $do_delete = false;
            }
        }
        
        if($do_delete){
            $this->get_daftar_program_kerja_tahunan->process(array(
                'action' => 'delete',
                'table' => 'tbldaftarpkt',
                'where' => 'kode = \''.$this->kode.'\' and sbpkode = \''.$this->sbppskode.'\' and pktkode = \''.$this->pktkode.'\''
            ));
        } else {
            Message::set("Kegiatan Cannot Deleted because have some member.");
        }
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
            $sbpps_kode_hidden = $this->input->post('sbpps_kode_hidden');
            $satker_pkt_kode = $this->input->post('satker_pkt_kode');
            $nokegiatan_pkt_kode = $this->input->post('nokegiatan_pkt_kode');
            $norinciankegiatan_pkt_kode = $this->input->post('norinciankegiatan_pkt_kode');
            $pktkrk = $this->input->post('pktkrk');
            $pktnama = $this->input->post('pktnama');
            $pktoutput = $this->input->post('pktoutput');
            $pktkode = $satker_pkt_kode . "." . $nokegiatan_pkt_kode . ($norinciankegiatan_pkt_kode != "" ? "." . $norinciankegiatan_pkt_kode : "");
            
            $do_update = true;
            $data_tidak_sama = true;
            
            $this->get_daftar_program_kerja_tahunan->process(array(
                'action' => 'select',
                'table' => 'tbldaftarpkt',
                'column_value' => array('pktnama','pktoutput'),
                'where' => 'kode = \''.$this->kode_project_scope_controller.'\' and sbpkode = \''.$sbpps_kode_hidden.'\' and pktkode = \''.$pktkode.'\''
            ));
            $row_data = $this->row;
            if($this->kode == $kode && $this->sbppskode == $sbpps_kode_hidden && $this->pktkode == $pktkode && $row_data->pktnama == $pktnama && $row_data->pktoutput == $pktoutput){
                $data_tidak_sama = false;
                Message::set("Data yang sama tidak akan diproses.");
            }
            
            if($data_tidak_sama){
                $this->get_daftar_program_kerja_tahunan->process(array(
                    'action' => 'select',
                    'table' => 'tbldaftarpkt',
                    'column_value' => array('pktkode'),
                    'where' => 'kode = \''.$this->kode_project_scope_controller.'\' and sbpkode = \''.$sbpps_kode_hidden.'\' and (pktkode != \''.$this->pktkode.'\' and pktkode = \''.$pktkode.'\')'
                ));
                if(sizeof($this->all) > 0){
                    $do_update = false;
                    Message::set("Update Data Failed PKT Kode sudah tersedia.");
                }
            }
            
            if($do_update && $data_tidak_sama){
                $this->get_daftar_program_kerja_tahunan->process(array(
                    'action' => 'update',
                    'table' => 'tbldaftarpkt',
                    'column_value' => array(
                        'kode' => $kode,
                        'sbpkode' => $sbpps_kode_hidden,
                        'pktkode' => $pktkode,
                        'pktkrk' => $pktkrk,
                        'pktnama' => $pktnama,
                        'pktoutput' => $pktoutput,
                        'pktnourut' => 'X'
                    ),
                    'where' => 'kode = \''.$this->kode.'\' and sbpkode = \''.$this->sbppskode.'\' and pktkode = \''.$this->pktkode.'\''
                ));
            }
            
            redirect('daftar-program-kerja-tahunan/edit/'. urlencode($kode."-".$sbpps_kode_hidden."-".$pktkode).'');
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
            'where' => 'sbpkode = \''.$sbpkode.'\' and pktkode = \''.$this->pktkode.'\' and kode = \''.$this->kode_project_scope_controller.'\''
        ));
        $kegiatan_rincian = $this->row;
        $pktnama = $kegiatan_rincian->{'pktnama'};
        $pktoutput = $kegiatan_rincian->{'pktoutput'};
        // echo $pktnama;
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
            ),
            'where' => 'kode = \''.$this->kode_project_scope_controller.'\'',
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
            'where' => 'kode = \''.$this->kode_project_scope_controller.'\'',
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
            $sbpps_kode_hidden = $this->input->post('sbpps_kode_hidden');
            $satker_pkt_kode = $this->input->post('satker_pkt_kode');
            $nokegiatan_pkt_kode = $this->input->post('nokegiatan_pkt_kode');
            $norinciankegiatan_pkt_kode = $this->input->post('norinciankegiatan_pkt_kode');
            $pktkrk = $this->input->post('pktkrk');
            $pktnama = $this->input->post('pktnama');
            $pktoutput = $this->input->post('pktoutput');
            $pktkode = $satker_pkt_kode . "." . $nokegiatan_pkt_kode . ($norinciankegiatan_pkt_kode != "" ? "." . $norinciankegiatan_pkt_kode : "");
            
            $do_insert = true;
            $this->get_daftar_program_kerja_tahunan->process(array(
                'action' => 'select',
                'table' => 'tbldaftarpkt',
                'column_value' => array('pktkode'),
                'where' => 'kode = \''.$this->kode_project_scope_controller.'\' and sbpkode = \''.$sbpps_kode_hidden.'\' and pktkode = \''.$pktkode.'\''
            ));
            if(sizeof($this->all) > 0){
                $do_insert = false;
            }
            
            if($do_insert){
                $this->get_daftar_program_kerja_tahunan->process(array(
                    'action' => 'insert',
                    'table' => 'tbldaftarpkt',
                    'column_value' => array(
                        'kode' => $kode,
                        'sbpkode' => $sbpps_kode_hidden,
                        'pktkode' => $pktkode,
                        'pktkrk' => $pktkrk,
                        'pktnama' => $pktnama,
                        'pktoutput' => $pktoutput,
                        'pktnourut' => 'X'
                    )
                ));
            } else {
                Message::set("Insert Data Failed PKT Kode sudah tersedia.");
            }
            
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