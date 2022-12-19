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
        $do_delete = true;
        
        if(strlen($this->sbpkode) == 2){
            $this->get_daftar_strategic_business_plan->process(array(
                'action' => 'select',
                'table' => 'tbldaftarsbpps',
                'column_value' => array(
                    'sbpkode'
                ),
                'where' => 'length(sbpkode) > 2 and substring(sbpkode from 1 for 2) = \''.$this->sbpkode.'\' and kode = \''.$this->kode.'\''
            ));
            if(sizeof($this->all) > 0){
                $do_delete = false;
            }
        }
        
        if($do_delete){
            $this->get_daftar_strategic_business_plan->process(array(
                'action' => 'delete',
                'table' => 'tbldaftarsbpps',
                'where' => 'kode = \''.$this->kode.'\' and sbpkode = \''.$this->sbpkode.'\' and sbpnourut = \''.$this->sbpnourut.'\''
            ));
        } else {
            Message::set("SBP Number Cannot Deleted because have some member.");
        }
        redirect('daftar-strategic-business-plan');
    }
    
    public function get_nomor_urut_sbp($nosbp, $return = false){
        
        $this->get_daftar_strategic_business_plan->process(array(
            'action' => 'select',
            'table' => 'tbldaftarsbpps',
            'column_value' => array(
                'sbpkode'
            ),
            'where' => 'length(sbpkode) != 2 and sbpkode like \''.$nosbp.'%\' and kode = \''.$this->kode_project_scope_controller.'\'',
            'order' => 'sbpkode asc'
        ));
        if($return){
            return sizeof($this->all) + 1;
        }
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
            $jenis_entri = $this->input->post('jenis_entri');
            $kode_ps = $this->input->post('kode_ps');
            $kode_pks_pkns = $this->input->post('kode_pks_pkns');
            $nomor_pks_pkns = $this->input->post('nomor_pks_pkns');
            $sbp_nourut = $this->input->post('sbp_nourut');
            $keterangan = $this->input->post('keterangan');
            
            $param_baru = $id;
            $masuk_update = 0;
            
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);
            if($kode_ps != "" && $jenis_entri == "PS"){
                $data = array();
                if($kode_ps != $this->sbpkode){
                    $this->get_daftar_strategic_business_plan->process(array(
                        'action' => 'select',
                        'table' => 'tbldaftarsbpps',
                        'column_value' => array(
                            'sbpkode'
                        ), 
                        'where' => 'kode = \''.$kode.'\' and sbpkode = \''.$kode_ps.'\''
                    ));
                    $data = $this->all;
                }
                if(sizeof($data) == 0){
                    $this->get_daftar_strategic_business_plan->process(array(
                        'action' => 'update',
                        'table' => 'tbldaftarsbpps',
                        'column_value' => array(
                            'kode' => $kode,
                            'sbpkode' => $kode_ps,
                            'sbpnourut' => $sbp_nourut,
                            'sbpdesc' => $keterangan
                        ),
                        'where' => 'kode = \''.$this->kode.'\' and sbpkode = \''.$this->sbpkode.'\' and sbpnourut = \''.$this->sbpnourut.'\''
                    ));
                    $param_baru = $kode . "-" . $kode_ps . "-" . $sbp_nourut;
                    $masuk_update = 1;
                } else {
                    Message::set("Kode PS sudah tersedia.");
                }
            }
            
            if($kode_ps != "" && ($jenis_entri == "PKS" || $jenis_entri == "PKNS")){
                
                $kode_ps_pks_pkns = $kode_ps . "." . $kode_pks_pkns . "." . $nomor_pks_pkns;
                $data = array();
                if($kode_ps_pks_pkns != $this->sbpkode){
                    $this->get_daftar_strategic_business_plan->process(array(
                        'action' => 'select',
                        'table' => 'tbldaftarsbpps',
                        'column_value' => array(
                            'sbpkode'
                        ), 
                        'where' => 'kode = \''.$kode.'\' and sbpkode = \''.$kode_ps_pks_pkns.'\''
                    ));
                    $data = $this->all;
                }
                
                if(sizeof($data) == 0){
                    $this->get_daftar_strategic_business_plan->process(array(
                        'action' => 'update',
                        'table' => 'tbldaftarsbpps',
                        'column_value' => array(
                            'kode' => $kode,
                            'sbpkode' => $kode_ps_pks_pkns,
                            'sbpnourut' => $sbp_nourut,
                            'sbpdesc' => $keterangan
                        ),
                        'where' => 'kode = \''.$this->kode.'\' and sbpkode = \''.$this->sbpkode.'\' and sbpnourut = \''.$this->sbpnourut.'\''
                    ));
                    $param_baru = $kode . "-" . $kode_ps_pks_pkns . "-" . $sbp_nourut;
                    $masuk_update = 1;
                } else {
                    Message::set("Kode PKS PKNS sudah tersedia.");
                }
            }
            
            if($masuk_update){
                $this->db->trans_commit();
            } else {
                $this->db->trans_rollback();
            }
            
            if(!$masuk_update){
                Message::set("Data yang sama tidak akan diproses.");
            }
            
            if($kode_ps == ""){
                Message::set("Kode PS tidak boleh kosong.");
            }
            
            redirect('daftar-strategic-business-plan/edit/'.$param_baru.'');
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
        
        $row_data = $this->row;
        $explode_sbpkode = explode(".", $this->sbpkode);
        $kode_program_strategis = $explode_sbpkode[0];
        $penanda_non_operasional = "";
        $nomor_pks_pkns = "";
        $sbp_kode_param_edit = "";
        $sbp_desc_param_edit = "";
        $sbp_keterangan = $row_data->{'sbpdesc'};
        if(isset($explode_sbpkode[1]) && isset($explode_sbpkode[2])){
            
            $this->get_daftar_strategic_business_plan->process(array(
                'action' => 'select',
                'table' => 'tbldaftarsbpps',
                'column_value' => array(
                    'sbpkode',
                    'sbpdesc'
                ),
                'where' => 'kode = \''.$this->kode.'\' and sbpkode = \''.$kode_program_strategis.'\''
            ));
            $data_all = $this->all;
            
            $sbp_kode_param_edit = $data_all[0]->sbpkode;
            $sbp_desc_param_edit = $data_all[0]->sbpdesc;
            $penanda_non_operasional = $explode_sbpkode[1];
            $nomor_pks_pkns = $explode_sbpkode[2];
            $kode_ps_display = $sbp_kode_param_edit . " # " . $sbp_desc_param_edit;
        }
        
        $this->layout->loadView('daftar_strategic_business_plan_form', array(
            
            'kode' => $row_data->{'kode'},
            'sbpkode' => $row_data->{'sbpkode'},
            'sbp_nourut' => $row_data->{'sbpnourut'},
            'sbpdesc' => $row_data->{'sbpdesc'},
                    
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
            $jenis_entri = $this->input->post('jenis_entri');
            $kode_ps = $this->input->post('kode_ps');
            $kode_pks_pkns = $this->input->post('kode_pks_pkns');
            $nomor_pks_pkns = $this->input->post('nomor_pks_pkns');
            $sbp_nourut = $this->input->post('sbp_nourut');
            $keterangan = $this->input->post('keterangan');
            
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);
            $do_insert = 0;
            if($kode_ps != "" && $jenis_entri == "PS"){
                $this->get_daftar_strategic_business_plan->process(array(
                    'action' => 'select',
                    'table' => 'tbldaftarsbpps',
                    'column_value' => array(
                        'sbpkode'
                    ), 
                    'where' => 'kode = \''.$kode.'\' and sbpkode = \''.$kode_ps.'\''
                ));
                $data = $this->all;
                if(sizeof($data) == 0){
                    
                    $explode_sbp_nourut = explode(".", $sbp_nourut);
                    if(sizeof($explode_sbp_nourut) == 1){
                        $this->get_daftar_strategic_business_plan->process(array(
                            'action' => 'select',
                            'table' => 'tbldaftarsbpps',
                            'column_value' => array(
                                'kode'
                            ),
                            'where' => 'length(sbpkode) = 2 and kode = \''.$this->kode_project_scope_controller.'\'',
                            'order' => 'sbpkode asc'
                        ));
                        if($sbp_nourut != $this->param_next_number()){
                            $sbp_nourut = $this->param_next_number();
                        }
                    }
                    
                    $this->get_daftar_strategic_business_plan->process(array(
                        'action' => 'insert',
                        'table' => 'tbldaftarsbpps',
                        'column_value' => array(
                            'kode' => $kode,
                            'sbpkode' => $kode_ps,
                            'sbpnourut' => $sbp_nourut,
                            'sbpdesc' => $keterangan
                        )
                    ));
                    if($this->affected){
                        $do_insert = 1;
                    }
                } else {
                    Message::set("Kode PS sudah tersedia.");
                }
            }
            
            if($kode_ps != "" && ($jenis_entri == "PKS" || $jenis_entri == "PKNS")){
                
                $kode_ps_pks_pkns = $kode_ps . "." . $kode_pks_pkns . "." . $nomor_pks_pkns;
                
                $this->get_daftar_strategic_business_plan->process(array(
                    'action' => 'select',
                    'table' => 'tbldaftarsbpps',
                    'column_value' => array(
                        'sbpkode'
                    ), 
                    'where' => 'kode = \''.$kode.'\' and sbpkode = \''.$kode_ps_pks_pkns.'\''
                ));
                $data = $this->all;
                
                if(sizeof($data) == 0){
                    
                    $explode_sbp_nourut = explode(".", $sbp_nourut);
                    if(sizeof($explode_sbp_nourut) == 1){
                        $this->get_daftar_strategic_business_plan->process(array(
                            'action' => 'select',
                            'table' => 'tbldaftarsbpps',
                            'column_value' => array(
                                'kode'
                            ),
                            'where' => 'length(sbpkode) = 2 and kode = \''.$this->kode_project_scope_controller.'\'',
                            'order' => 'sbpkode asc'
                        ));
                        if($sbp_nourut != $this->param_next_number()){
                            $sbp_nourut = $this->param_next_number();
                        }
                    }
                    
                    $this->get_daftar_strategic_business_plan->process(array(
                        'action' => 'insert',
                        'table' => 'tbldaftarsbpps',
                        'column_value' => array(
                            'kode' => $kode,
                            'sbpkode' => $kode_ps_pks_pkns,
                            'sbpnourut' => $sbp_nourut,
                            'sbpdesc' => $keterangan
                        )
                    ));
                    if($this->affected){
                        $do_insert = 1;
                    }
                } else {
                    Message::set("Kode PKS PKNS sudah tersedia.");
                }
            }
            
            if($kode_ps == ""){
                Message::set("Kode PS tidak boleh kosong.");
            }
            
            if($do_insert){
                $this->db->trans_commit();
            } else {
                $this->db->trans_rollback();
            }
            
            redirect('daftar-strategic-business-plan/add');
        }
        $this->get_daftar_strategic_business_plan->process(array(
            'action' => 'select',
            'table' => 'tbldaftarsbpps',
            'column_value' => array(
                'kode'
            ),
            'where' => 'length(sbpkode) = 2 and kode = \''.$this->kode_project_scope_controller.'\'',
            'order' => 'sbpkode asc'
        ));
        
        $this->layout->loadView('daftar_strategic_business_plan_form', array(
            "nomor_exists" => $this->param_check_exists_number_sbp(),
            "nomor_next" => $this->param_next_number()
        ));
    }
    
    private function param_next_number(){
        
        return convert_alphabet(sizeof($this->all))[0];
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