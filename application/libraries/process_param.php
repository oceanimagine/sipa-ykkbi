<?php 

class process_param {
    private $model;
    function __construct(){
	include_once "message.php";
        $this->CI =& get_instance();
        $this->CI->load->model('test');
        $this->model = $this->CI->test;
    }
    
    function call_debug($query){
        if(isset($this->model->debug) && $this->model->debug){
            echo $query;
            exit();
        }
    }
    
    /* Process Database */
    function insert($param){ /* Create */
        $table = $param['table'];
        $keyss = array_keys($param['column_value']);
        $comma = "";
        $result_column = "";
        $result_values = "";
        for($i = 0; $i < sizeof($keyss); $i++){
            $result_column = $result_column . $comma . $keyss[$i];
            $result_values = $result_values . $comma . "'" . $this->CI->test->db->escape_str($param['column_value'][$keyss[$i]]) . "'";
            $comma = ",";
        }
        $query = "insert into " . $table . "(".$result_column.") values (".$result_values.")";
        // cetak_html($query);
            
        $this->call_debug($query);
        $this->model->db->query($query);
        $this->CI->insert_id = /* $this->model->db->insert_id() */"0";
        $this->CI->affected = $this->model->db->affected_rows();
        Message::set("Insert data has been done.");
    }
    
    function select($param){ /* Read */
        $table = $param['table'];
        $where = isset($param['where']) && $param['where'] != "" ? " where " . $param['where'] : "";
        $order = isset($param['order']) && $param['order'] != "" ? " order by " . $param['order'] : "";
        $keyss = $param['column_value'];
        $comma = "";
        $result_values = "";
        for($i = 0; $i < sizeof($keyss); $i++){
            $result_values = $result_values . $comma . $keyss[$i];
            $comma = ",";
        }
        $query = "select " . $result_values . " from " . $table . $where . $order;
        $this->call_debug($query);
        $hasil = $this->model->kueri($query);
        $this->CI->row = $hasil->row();
        $this->CI->all = $hasil->result();
        $this->CI->num = sizeof($this->CI->all);
        for($i = 0; isset($GLOBALS['all_models']) && is_array($GLOBALS['all_models']) && $i < sizeof($GLOBALS['all_models']); $i++){
            if(is_object($GLOBALS['all_models'][$i])){
                $GLOBALS['all_models'][$i]->row = $hasil->row();
                $GLOBALS['all_models'][$i]->all = $hasil->result();
            }
        }
    }

    function update($param){ /* Update */
        $table = $param['table'];
        $where = $param['where'];
        $keyss = array_keys($param['column_value']);
        $comma = "";
        $result_values = "";
        for($i = 0; $i < sizeof($keyss); $i++){
            $result_values = $result_values . $comma . $keyss[$i] . " = " . "'" . $this->CI->test->db->escape_str($param['column_value'][$keyss[$i]]) . "'";
            $comma = ",";
        }
        $query = "update " . $table . " set " . $result_values . " where " . $where;
        $this->call_debug($query);
        $this->model->db->query($query);
        $this->CI->affected = $this->model->db->affected_rows();
	Message::set("Update data has been done.");
        
    }
    
    function delete($param){ /* Delete */
        $table = $param['table'];
        $where = $param['where'];
        $query = "delete from " . $table . " where " . $where;
        
        $this->call_debug($query);
        $this->model->db->query($query);
        $this->CI->affected = $this->model->db->affected_rows();
        Message::set("Delete data has been done.");
    }

    function process($param, $debug = false){
        if($debug){
            $this->model->debug = true;
        }
        if(isset($GLOBALS['debug_query']) && $GLOBALS['debug_query']){
            $this->model->debug = true;
        }
        if($param['action'] == "insert"){
            $this->insert($param);
        }
        if($param['action'] == "select"){
            $this->select($param);
        }
        if($param['action'] == "update"){
            $this->update($param, $debug);
        }
        if($param['action'] == "delete"){
            $this->delete($param);
        }
    }
    
}