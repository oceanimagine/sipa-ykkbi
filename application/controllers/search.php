<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class search extends CI_Controller {
    public function __construct() {
        parent::__construct();
        Privilege::admin();
    }
    public function cari(){
        if($this->input->post('cari_input')){
            $cari_input = $this->input->post('cari_input');
            $this->get_mata_anggaran_induk->process(array(
                'action' => 'select',
                'table' => 'tblmastersatker',
                'column_value' => array(
                    'nama1',
                    'nama2'
                ),
                'where' => 'nama2 like \'%'.$cari_input.'\'%'
            ));
            
        }
    }
}