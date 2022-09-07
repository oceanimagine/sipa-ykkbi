<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class laporan_penyusunan_anggaran extends CI_Controller {
    public function __construct() {
        parent::__construct();
        Privilege::admin();
    }
    public function index() {
        $this->layout->loadView(
            'download_report',
            array(
                "hasil" => "abcd",
                'data_satker' => $this->aplikasi->data->satker
            )
        );
    }
}
