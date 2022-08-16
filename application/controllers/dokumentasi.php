<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dokumentasi extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $this->layout->loadView(
            'dokumentasi',
            array(
                "hasil" => "abcd",
                'data_satker' => $this->aplikasi->data->satker
            )
        );
    }
}
