<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* https://stackoverflow.com/jobs/149384/software-engineer-team-lead-iprice-group?med=clc
 * https://stackoverflow.com/questions/17059987/changing-from-msql-to-mysqli-real-escape-string-link
 */

class tarif extends CI_Controller {
    
    public $layout;
    private $kode = "";
    private $satkerid = "";
    private $tarifid = "";
    
    public function __construct() {
        parent::__construct();
        $this->load->model('get_tarif');
        $this->layout = new layout('lite');
        Privilege::admin();
    }
    
    public function process_param($param){
        if($this->router->routes['translate_uri_dashes']){
            $param = str_replace("_", "-", $param);
        }
        $explode_dash = explode("-", $param);
        if(sizeof($explode_dash) == 3){
            $this->kode = $explode_dash[0];
            $this->satkerid = $explode_dash[1];
            $this->tarifid = $explode_dash[2];
        }
    }
    
    public function get_tarif() {
        $this->get_tarif->get_data();
    }

    public function script_table(){
        return $this->layout->loadjs("tarif/get_tarif");
    }
    
    public function hapus($id){
        $this->process_param($id);
        $_GET['id'] = $id;
        if($this->allow_delete == "0"){
            Message::set("Delete Data not allowed.");
            redirect('tarif');
            exit();
        }
        $this->get_tarif->process(array(
            'action' => 'delete',
            'table' => 'tblmastertarif',
            'where' => 'tarifid = \''.$this->tarifid.'\' and satkerid = \''.$this->satkerid.'\' and kode = \''.$this->kode.'\''
        ));
        redirect('tarif');
    }
    
    public function edit($id){
        $this->process_param($id);
        if($this->input->post('kode')){
            $_GET['id'] = $id;
            if($this->allow_update == "0"){
                Message::set("Update Data not allowed.");
                redirect('tarif/edit/'.$id.'');
                exit();
            }
            $kode = $this->input->post('kode');
            $satkerid = $this->input->post('satkerid');
            $tarifid = $this->input->post('tarifid');
            $tarifnama = $this->input->post('tarifnama');
            $tarifnom = $this->input->post('tarifnom');
            $tarifdesc = $this->input->post('tarifdesc');
            $this->get_tarif->process(array(
                'action' => 'update',
                'table' => 'tblmastertarif',
                'column_value' => array(

                    'kode' => $kode,
                    'satkerid' => $satkerid,
                    'tarifid' => $tarifid,
                    'tarifnama' => $tarifnama,
                    'tarifnom' => $tarifnom,
                    'tarifdesc' => $tarifdesc
                ),
                'where' => 'tarifid = \''.$this->tarifid.'\' and satkerid = \''.$this->satkerid.'\' and kode = \''.$this->kode.'\''
            ));
            
            redirect('tarif/edit/'.$kode."-".$satkerid."-".$tarifid.'');
        }
        
        $this->get_tarif->process(array(
            'action' => 'select',
            'table' => 'tblmastersatker',
            'column_value' => array(
                'satkerid',
                'nama1',
                'nama2'
            )
        ));
        $data_satker = $this->all;
        
        $this->get_tarif->process(array(
            'action' => 'select',
            'table' => 'tblmastertarif',
            'column_value' => array(
                'kode',
                'satkerid',
                'tarifid',
                'tarifnama',
                'tarifnom',
                'tarifdesc'
            ),
            'where' => 'tarifid = \''.$this->tarifid.'\' and satkerid = \''.$this->satkerid.'\' and kode = \''.$this->kode.'\''
        ));
        
        if(!isset($this->row->kode)){
            redirect('tarif');
        }
        
        $this->layout->loadView('tarif_form', array(
            
            'kode' => $this->row->{'kode'},
            'satkerid' => $this->row->{'satkerid'},
            'tarifid' => $this->row->{'tarifid'},
            'tarifnama' => $this->row->{'tarifnama'},
            'tarifnom' => $this->row->{'tarifnom'},
            'tarifdesc' => $this->row->{'tarifdesc'},
            "data_satker" => $data_satker
        ));
    }
    
    public function add(){
        if($this->input->post('kode')){
            if($this->allow_create == "0"){
                Message::set("Create Data not allowed.");
                redirect('tarif/add');
                exit();
            }
            $kode = $this->input->post('kode');
            $satkerid = $this->input->post('satkerid');
            $tarifid = $this->input->post('tarifid');
            $tarifnama = $this->input->post('tarifnama');
            $tarifnom = $this->input->post('tarifnom');
            $tarifdesc = $this->input->post('tarifdesc');
            $this->get_tarif->process(array(
                'action' => 'insert',
                'table' => 'tblmastertarif',
                'column_value' => array(
                    
                    'kode' => $kode,
                    'satkerid' => $satkerid,
                    'tarifid' => $tarifid,
                    'tarifnama' => $tarifnama,
                    'tarifnom' => $tarifnom,
                    'tarifdesc' => $tarifdesc
                )
            ));
            redirect('tarif/add');
        }
        
        $this->get_tarif->process(array(
            'action' => 'select',
            'table' => 'tblmastersatker',
            'column_value' => array(
                'satkerid',
                'nama1',
                'nama2'
            )
        ));
        $data_satker = $this->all;
        $this->layout->loadView('tarif_form', array(
            "data_satker" => $data_satker
        ));
    }
    
    public function index() {
        $this->layout->loadView(
            'tarif_list',
            array(
                "hasil" => "abcd",
                "script" => $this->script_table()
            )
        );
    }
    
    public function inbox(){
        $this->layout->loadView('inbox_view');
    }
}