<?php

class get_project extends CI_Model {

    private $param;

    function __construct() {
        parent::__construct();
    }
    
    /* Process Database */
    function process($param){
        $this->param = new process_param();
        return $this->param->process($param);
    }

}
