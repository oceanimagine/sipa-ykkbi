<?php

class get_login extends CI_Model {
    private $param;
    function __construct(){
	$this->param = new process_param();
        parent::__construct();
    }
    /* Process Database */
    function process($param){
        return $this->param->process($param);
    }
}