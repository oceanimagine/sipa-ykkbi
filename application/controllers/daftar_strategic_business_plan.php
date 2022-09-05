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
        $this->layout->loadView('daftar_strategic_business_plan_form', array(
            
            'kode' => $this->row->{'kode'},
            'sbpkode' => $this->row->{'sbpkode'},
            'sbpnourut' => $this->row->{'sbpnourut'},
            'sbpdesc' => $this->row->{'sbpdesc'}
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
            
            redirect('daftar-strategic-business-plan/add');
        }
        $this->layout->loadView('daftar_strategic_business_plan_form');
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