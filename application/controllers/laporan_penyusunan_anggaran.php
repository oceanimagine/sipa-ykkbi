<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_penyusunan_anggaran extends CI_Controller {
    public function __construct() {
        parent::__construct();
        Privilege::admin();
        $this->load->model('get_project');
    }
    public function index() {
        $this->get_project->process(array(
            'action' => 'select',
            'table' => 'tblmastersatker',
            'column_value' => array(
                'nama2'
            )
        ));
        $this->layout->loadView(
            'download_report',
            array(
                "hasil" => "abcd",
                'data_satker' => $this->aplikasi->data->satker,
                'ukuran_satker' => sizeof($this->all)
            )
        );
    }
}
