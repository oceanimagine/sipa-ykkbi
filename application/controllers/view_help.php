<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class view_help extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $this->layout->loadView(
            'view_help',
            array(
                "hasil" => "abcd",
                'data_satker' => $this->aplikasi->data->satker
            )
        );
    }
}
