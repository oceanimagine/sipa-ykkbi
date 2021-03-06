<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* https://stackoverflow.com/jobs/149384/software-engineer-team-lead-iprice-group?med=clc
 * https://stackoverflow.com/questions/17059987/changing-from-msql-to-mysqli-real-escape-string-link
 */

class mata_anggaran_individual_benchmarks extends CI_Controller {
    
    public $layout;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('get_mata_anggaran_individual_benchmarks');
        $this->layout = new layout('lite');
        Privilege::admin();
    }

    public function get_mata_anggaran_individual_benchmarks() {
        $this->get_mata_anggaran_individual_benchmarks->get_data();
    }

    public function script_table(){
        return $this->layout->loadjs("mata_anggaran_individual_benchmarks/get_mata_anggaran_individual_benchmarks");
    }
    
    public function hapus($id){
        $_GET['id'] = $id;
        
        $this->get_mata_anggaran_individual_benchmarks->process(array(
            'action' => 'delete',
            'table' => 'tblmastermaindividual',
            'where' => 'satkerid = \''.$id.'\''
        ));
        redirect('mata_anggaran_individual_benchmarks');
    }
    
    public function edit($id){
        if($this->input->post('kode')){
            $_GET['id'] = $id;
            
            $kode = $this->input->post('kode');
            $rekmakode = $this->input->post('rekmakode');
            $rekmanama = $this->input->post('rekmanama');
            $rekmainduk = $this->input->post('rekmainduk');
            $benchmarkang = $this->input->post('benchmarkang');
            $benchmarkprog = $this->input->post('benchmarkprog');
            $this->get_mata_anggaran_individual_benchmarks->process(array(
                'action' => 'update',
                'table' => 'tblmastermaindividual',
                'column_value' => array(

                    'kode' => $kode,
                    'rekmakode' => $rekmakode,
                    'rekmanama' => $rekmanama,
                    'rekmainduk' => $rekmainduk,
                    'benchmarkang' => $benchmarkang,
                    'benchmarkprog' => $benchmarkprog
                ),
                'where' => 'rekmakode = \''.$id.'\''
            ));
            
            redirect('mata_anggaran_individual_benchmarks/edit/'.$id.'');
        }
        
        $this->get_mata_anggaran_individual_benchmarks->process(array(
            'action' => 'select',
            'table' => 'tblmastermainduk',
            'column_value' => array(
                'kode',
                'rekmainduk',
                'rekmainduknama'
            )
        ));
        $data_tblmastermainduk = $this->all;
        
        $this->get_mata_anggaran_individual_benchmarks->process(array(
            'action' => 'select',
            'table' => 'tblmastermaindividual',
            'column_value' => array(
                'kode',
                'rekmakode',
                'rekmanama',
                'rekmainduk',
                'benchmarkang',
                'benchmarkprog'
            ),
            'where' => 'rekmakode = \''.$id.'\''
        ));
        
        $this->layout->loadView('mata_anggaran_individual_benchmarks_form', array(
            
            'kode' => $this->row->{'kode'},
            'rekmakode' => $this->row->{'rekmakode'},
            'rekmanama' => $this->row->{'rekmanama'},
            'rekmainduk' => $this->row->{'rekmainduk'},
            'benchmarkang' => $this->row->{'benchmarkang'},
            'benchmarkprog' => $this->row->{'benchmarkprog'},
            'data_tblmastermainduk' => $data_tblmastermainduk
        ));
    }
    
    public function add(){
        if($this->input->post('notiket')){
            
            $kode = $this->input->post('kode');
            $rekmakode = $this->input->post('rekmakode');
            $rekmanama = $this->input->post('rekmanama');
            $rekmainduk = $this->input->post('rekmainduk');
            $benchmarkang = $this->input->post('benchmarkang');
            $benchmarkprog = $this->input->post('benchmarkprog');
            $this->get_mata_anggaran_individual_benchmarks->process(array(
                'action' => 'insert',
                'table' => 'tblmastermaindividual',
                'column_value' => array(
                    
                    'kode' => $kode,
                    'rekmakode' => $rekmakode,
                    'rekmanama' => $rekmanama,
                    'rekmainduk' => $rekmainduk,
                    'benchmarkang' => $benchmarkang,
                    'benchmarkprog' => $benchmarkprog
                )
            ));
            redirect('mata_anggaran_individual_benchmarks/add');
        }
        
        $this->get_mata_anggaran_individual_benchmarks->process(array(
            'action' => 'select',
            'table' => 'tblmastermainduk',
            'column_value' => array(
                'kode',
                'rekmainduk',
                'rekmainduknama'
            )
        ));
        $data_tblmastermainduk = $this->all;
        
        $this->layout->loadView('mata_anggaran_individual_benchmarks_form', array(
            'data_tblmastermainduk' => $data_tblmastermainduk
        ));
    }
    
    public function index() {
        $this->layout->loadView(
            'mata_anggaran_individual_benchmarks_list',
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