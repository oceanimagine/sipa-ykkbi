<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* https://stackoverflow.com/jobs/149384/software-engineer-team-lead-iprice-group?med=clc
 * https://stackoverflow.com/questions/17059987/changing-from-msql-to-mysqli-real-escape-string-link
 */

class tarif extends CI_Controller {
    
    public $layout;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('get_tarif');
        $this->layout = new layout('lite');
        Privilege::admin();
    }

    public function get_tarif() {
        $this->get_tarif->get_data();
    }

    public function script_table(){
        return $this->layout->loadjs("tarif/get_tarif");
    }
    
    public function hapus($id){
        $_GET['id'] = $id;
        
        $this->get_tarif->process(array(
            'action' => 'delete',
            'table' => 'tblmastertarif',
            'where' => 'satkerid = \''.$id.'\''
        ));
        redirect('tarif');
    }
    
    public function edit($id){
        if($this->input->post('kode')){
            $_GET['id'] = $id;
            
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
                'where' => 'satkerid = \''.$id.'\''
            ));
            
            redirect('tarif/edit/'.$id.'');
        }
        
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
            )
        ));
        
        $this->layout->loadView('tarif_form', array(
            
            'kode' => $this->row->{'kode'},
            'satkerid' => $this->row->{'satkerid'},
            'tarifid' => $this->row->{'tarifid'},
            'tarifnama' => $this->row->{'tarifnama'},
            'tarifnom' => $this->row->{'tarifnom'},
            'tarifdesc' => $this->row->{'tarifdesc'}
        ));
    }
    
    public function add(){
        if($this->input->post('notiket')){
            
            $kode = $this->input->post('kode');
            $satkerid = $this->input->post('satkerid');
            $tarifid = $this->input->post('tarifid');
            $tarifnama = $this->input->post('tarifnama');
            $tarifnom = $this->input->post('tarifnom');
            $tarifdesc = $this->input->post('tarifdesc');
            $this->get_tarif->process(array(
                'action' => 'insert',
                'table' => 'hdcasedaftar',
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
        
        $this->layout->loadView('tarif_form');
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