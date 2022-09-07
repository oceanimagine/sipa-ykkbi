<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftar_strategic_business_plan extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('get_daftar_strategic_business_plan');
        $this->layout = new layout('lite');
        Privilege::admin();
    }
    
    public function get_daftar_strategic_business_plan() {
        $this->get_daftar_strategic_business_plan->get_data();
    }
    
    public function script_table(){
        return $this->layout->loadjs("daftar-strategic-business-plan/get_daftar_strategic_business_plan");
    }
    
    public function get_ps_only(){
        $this->get_daftar_strategic_business_plan->process(array(
            'action' => 'select',
            'table' => 'tbldaftarsbpps',
            'column_value' => array(
                '*'
            ),
            'where' => 'length(sbpkode) = 2 and kode = \''.$this->kode_project_scope_controller.'\'',
            'order' => 'sbpkode asc'
        ));
        
        $this->load->view("regular/data_search_kode_ps_only", array(
            "data_search" => $this->all
        ));
    }
    
    private $kode = "";
    private $sbpkode = "";
    private $sbpnourut = "";
    public function hapus($id){
        if($this->allow_delete == "0"){
            Message::set("Delete Data not allowed.");
            redirect('daftar-strategic-business-plan');
            exit();
        }
        $this->process_param($id);
        
        $this->get_daftar_strategic_business_plan->process(array(
            'action' => 'delete',
            'table' => 'tbldaftarsbpps',
            'where' => 'kode = \''.$this->kode.'\' and sbpkode = \''.$this->sbpkode.'\' and sbpnourut = \''.$this->sbpnourut.'\''
        ));
        redirect('daftar-strategic-business-plan');
    }
    
    public function get_nomor_urut_sbp($nosbp){
        
        $this->get_daftar_strategic_business_plan->process(array(
            'action' => 'select',
            'table' => 'tbldaftarsbpps',
            'column_value' => array(
                'sbpkode'
            ),
            'where' => 'length(sbpkode) != 2 and sbpkode like \''.$nosbp.'%\'',
            'order' => 'sbpkode asc'
        ));
        echo sizeof($this->all) + 1;
    }
    
    public function edit($id){
        $this->process_param($id);
        if($this->input->post('kode')){
            if($this->allow_update == "0"){
                Message::set("Update Data not allowed.");
                redirect('daftar-strategic-business-plan/edit/'.$id.'');
                exit();
            }
            $kode = $this->input->post('kode');
            $sbpkode = $this->input->post('sbpkode');
            $sbpnourut = $this->input->post('sbpnourut');
            $sbpdesc = $this->input->post('sbpdesc');
            $this->get_daftar_strategic_business_plan->process(array(
                'action' => 'update',
                'table' => 'tbldaftarsbpps',
                'column_value' => array(

                    'kode' => $kode,
                    'sbpkode' => $sbpkode,
                    'sbpnourut' => $sbpnourut,
                    'sbpdesc' => $sbpdesc
                ),
                'where' => 'kode = \''.$this->kode.'\' and sbpkode = \''.$this->sbpkode.'\' and sbpnourut = \''.$this->sbpnourut.'\''
            ));
            
            redirect('daftar-strategic-business-plan/edit/'.$id.'');
        }
        
        $this->get_daftar_strategic_business_plan->process(array(
            'action' => 'select',
            'table' => 'tbldaftarsbpps',
            'column_value' => array(
                'kode',
                'sbpkode',
                'sbpnourut',
                'sbpdesc'
            ),
            'where' => 'kode = \''.$this->kode.'\' and sbpkode = \''.$this->sbpkode.'\' and sbpnourut = \''.$this->sbpnourut.'\''
        ));
        
        $explode_sbpkode = explode(".", $this->sbpkode);
        $kode_program_strategis = $explode_sbpkode[0];
        $penanda_non_operasional = "";
        $nomor_pks_pkns = "";
        $sbp_kode_param_edit = "";
        $sbp_desc_param_edit = "";
        $sbp_keterangan = $this->row->{'sbpdesc'};
        if(isset($explode_sbpkode[1]) && isset($explode_sbpkode[2])){
            
            $this->get_daftar_strategic_business_plan->process(array(
                'action' => 'select',
                'table' => 'tbldaftarsbpps',
                'column_value' => array(
                    'sbpkode',
                    'sbpdesc'
                ),
                'where' => 'sbpkode = \''.$kode_program_strategis.'\''
            ));
            $data_all = $this->all;
            
            $sbp_kode_param_edit = $data_all[0]->sbpkode;
            $sbp_desc_param_edit = $data_all[0]->sbpdesc;
            $penanda_non_operasional = $explode_sbpkode[1];
            $nomor_pks_pkns = $explode_sbpkode[2];
            $kode_ps_display = $sbp_kode_param_edit . " # " . $sbp_desc_param_edit;
        }
        
        $this->layout->loadView('daftar_strategic_business_plan_form', array(
            
            'kode' => $this->row->{'kode'},
            'sbpkode' => $this->row->{'sbpkode'},
            'sbpnourut' => $this->row->{'sbpnourut'},
            'sbpdesc' => $this->row->{'sbpdesc'},
                    
            'sbp_keterangan' => $sbp_keterangan,
            'sbp_kode_param_edit' => $sbp_kode_param_edit,
            'sbp_desc_param_edit' => $sbp_desc_param_edit,
            'penanda_non_operasional' => $penanda_non_operasional,
            'kode_ps_display' => $kode_ps_display,
            'nomor_pks_pkns' => $nomor_pks_pkns
        ));
    }
    
    public function add(){
        if($this->input->post('kode')){
            if($this->allow_create == "0"){
                Message::set("Create Data not allowed.");
                redirect('daftar-strategic-business-plan/add');
                exit();
            }
            $kode = $this->input->post('kode');
            $sbpkode = $this->input->post('sbpkode');
            $sbpnourut = $this->input->post('sbpnourut');
            $sbpdesc = $this->input->post('sbpdesc');
            $this->get_daftar_strategic_business_plan->process(array(
                'action' => 'insert',
                'table' => 'tbldaftarsbpps',
                'column_value' => array(
                    'kode' => $kode,
                    'sbpkode' => $sbpkode,
                    'sbpnourut' => $sbpnourut,
                    'sbpdesc' => $sbpdesc
                )
            ));
            
            redirect('daftar-strategic-business-plan/add');
        }
        $this->get_daftar_strategic_business_plan->process(array(
            'action' => 'select',
            'table' => 'tbldaftarsbpps',
            'column_value' => array(
                '*'
            ),
            'where' => 'length(sbpkode) = 2',
            'order' => 'sbpkode asc'
        ));
        
        $this->layout->loadView('daftar_strategic_business_plan_form', array(
            "nomor_exists" => $this->param_check_exists_number_sbp()
        ));
    }
    
    private function param_check_exists_number_sbp(){
        $nomor_array = array();
        $nomor_exists = $this->all;
        for($i = 0; $i < sizeof($nomor_exists); $i++){
            $nomor_array[$nomor_exists[$i]->sbpkode] = true;
        }
        return $nomor_array;
    }
    
    public function index() {
        $this->layout->loadView(
            'daftar_strategic_business_plan_list',
            array(
                "hasil" => "abcd",
                "script" => $this->script_table()
            )
        );
    }
    
    public function process_param($param_id){
        if($this->router->routes['translate_uri_dashes']){
            $param_id = str_replace("_", "-", $param_id);
        }
        $explode_param_id = explode("-", $param_id);
        $kode = $explode_param_id[0];
        $sbpkode = isset($explode_param_id[1]) ? $explode_param_id[1] : "";
        $sbpnourut = isset($explode_param_id[2]) ? $explode_param_id[2] : "";
        $this->kode = $kode;
        $this->sbpkode = $sbpkode;
        $this->sbpnourut = $sbpnourut;
    }
}