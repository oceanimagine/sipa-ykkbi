<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class daftar_iku extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('get_daftar_iku');
        $this->layout = new layout('lite');
        Privilege::admin();
    }
    
    public function coba_html(){
        new process_spreadsheet_html_viewer(true);
    }
    
    public function get_daftar_iku() {
        $this->get_daftar_iku->get_data();
    }
    
    public function script_table(){
        return $this->layout->loadjs("daftar_iku/get_daftar_iku");
    }
    
    public function hapus($id){
        if($this->allow_delete == "0"){
            Message::set("Delete Data not allowed.");
            redirect('daftar-iku');
            exit();
        }
        $id = urldecode($id);
        $this->get_daftar_iku->process(array(
            'action' => 'delete',
            'table' => 'tbldaftariku',
            'where' => 'ikukode = \''.$id.'\''
        ));
        redirect('daftar-iku');
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
        
        $this->get_daftar_iku->process(array(
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
    
    public function edit($id){
        $id = urldecode($id);
        if($this->input->post('kode')){
            if($this->allow_update == "0"){
                Message::set("Update Data not allowed.");
                redirect('daftar-iku/edit/'.$id.'');
                exit();
            }
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
            if($this->allow_create == "0"){
                Message::set("Create Data not allowed.");
                redirect('daftar-iku/add');
                exit();
            }
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
            'order' => 'ikukode desc',
            'where' => 'kode = \''.$this->kode_project_scope_controller.'\''
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