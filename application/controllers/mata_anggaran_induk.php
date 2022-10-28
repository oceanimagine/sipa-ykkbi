<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* https://stackoverflow.com/jobs/149384/software-engineer-team-lead-iprice-group?med=clc
 * https://stackoverflow.com/questions/17059987/changing-from-msql-to-mysqli-real-escape-string-link
 */

class mata_anggaran_induk extends CI_Controller {
    
    public $layout;
    private $rekmagroup;
    public function __construct() {
        parent::__construct();
        $this->load->model('get_mata_anggaran_induk');
        $this->layout = new layout('lite');
        Privilege::admin();
        
        $this->get_mata_anggaran_induk->process(array(
            'action' => 'select',
            'table' => 'tblmastermainduk',
            'column_value' => array('distinct rekmagroup')
        ));
        
        $this->rekmagroup = $this->all;
    }

    public function get_mata_anggaran_induk() {
        $this->get_mata_anggaran_induk->get_data();
    }

    public function script_table(){
        return $this->layout->loadjs("mata_anggaran_induk/get_mata_anggaran_induk");
    }
    
    public function hapus($id){
        $_GET['id'] = $id;
        if($this->allow_delete == "0"){
            Message::set("Delete Data not allowed.");
            redirect('mata-anggaran-induk');
            exit();
        }
        $do_delete = true;
        
        $this->get_mata_anggaran_induk->process(array(
            'action' => 'select',
            'table' => 'tblmastermaindividual',
            'column_value' => array('rekmainduk'),
            'where' => 'rekmainduk = \''.$id.'\' and kode = \''.$this->kode_project_scope_controller.'\''
        ));
        if(sizeof($this->all) > 0){
            $do_delete = false;
        }
        
        if($do_delete){
            $this->get_mata_anggaran_induk->process(array(
                'action' => 'delete',
                'table' => 'tblmastermainduk',
                'where' => 'rekmainduk = \''.$id.'\' and kode = \''.$this->kode_project_scope_controller.'\''
            ));
        } else {
            Message::set("Rekma Induk Cannot Deleted because have some member.");
        }
        redirect('mata-anggaran-induk');
    }
    
    public function edit($id){
        if($this->input->post('kode')){
            $_GET['id'] = $id;
            if($this->allow_update == "0"){
                Message::set("Update Data not allowed.");
                redirect('mata-anggaran-induk/edit/'.$id.'');
                exit();
            }
            
            $kode = $this->input->post('kode');
            $rekmainduk = $this->input->post('rekmainduk');
            $rekmainduknama = $this->input->post('rekmainduknama');
            $rekmagroup = $this->input->post('rekmagroup');
            $this->get_mata_anggaran_induk->process(array(
                'action' => 'update',
                'table' => 'tblmastermainduk',
                'column_value' => array(

                    'kode' => $kode,
                    'rekmainduk' => $rekmainduk,
                    'rekmainduknama' => $rekmainduknama,
                    'rekmagroup' => $rekmagroup
                ),
                'where' => 'rekmainduk = \''.$id.'\' and kode = \''.$this->kode_project_scope_controller.'\''
            ));
            
            redirect('mata-anggaran-induk/edit/'.$id.'');
        }
        
        $this->get_mata_anggaran_induk->process(array(
            'action' => 'select',
            'table' => 'tblmastermainduk',
            'column_value' => array(
                'kode',
                'rekmainduk',
                'rekmainduknama',
                'rekmagroup'
            ),
            'where' => 'rekmainduk = \''.$id.'\' and kode = \''.$this->kode_project_scope_controller.'\''
        ));
        
        $this->layout->loadView('mata_anggaran_induk_form', array(
            
            'kode' => $this->row->{'kode'},
            'rekmainduk' => $this->row->{'rekmainduk'},
            'rekmainduknama' => $this->row->{'rekmainduknama'},
            'rekmagroup' => $this->row->{'rekmagroup'},
            'rekmagroup_data' => $this->rekmagroup
        ));
    }
    
    public function add(){
        if($this->input->post('kode')){
            if($this->allow_create == "0"){
                Message::set("Insert Data not allowed.");
                redirect('mata-anggaran-induk/add');
                exit();
            }
            $kode = $this->input->post('kode');
            $rekmainduk = $this->input->post('rekmainduk');
            $rekmainduknama = $this->input->post('rekmainduknama');
            $rekmagroup = $this->input->post('rekmagroup');
            $this->get_mata_anggaran_induk->process(array(
                'action' => 'insert',
                'table' => 'tblmastermainduk',
                'column_value' => array(
                    
                    'kode' => $kode,
                    'rekmainduk' => $rekmainduk,
                    'rekmainduknama' => $rekmainduknama,
                    'rekmagroup' => $rekmagroup
                )
            ));
            redirect('mata-anggaran-induk/add');
        }
        
        $this->layout->loadView('mata_anggaran_induk_form',array(
            'rekmagroup_data' => $this->rekmagroup
        ));
    }
    
    public function index() {
        $this->layout->loadView(
            'mata_anggaran_induk_list',
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