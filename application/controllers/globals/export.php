<?php

class export extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->json_luckyexcel = post_raw('json_luckyexcel');
    }
    public function index(){
        new lucky_export($this->json_luckyexcel);
    }
}