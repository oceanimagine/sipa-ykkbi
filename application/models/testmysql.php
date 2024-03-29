<?php

class testmysql extends CI_Model {

    private $param;
    public $dbmysql;
    function __construct() {
        parent::__construct();
        $this->dbmysql = $this->load->database('mysql_db', TRUE);
    }
    
    /* Process Database */
    function process($param){
        $this->param = new process_param();
        return $this->param->process($param);
    }

    function uji_method() {
        return "Di dalam model test fungsi uji_method.";
    }

    function hasil($param) {
        return $param->result();
    }

    function kueri($param) {
        return $this->dbmysql->query($param);
    }

    /* MYSQL */

    function mysql_describe_table() {
        $kueri = $this->kueri("show tables");
        return $this->hasil($kueri);
    }

}
