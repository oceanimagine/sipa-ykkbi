<?php

define('BASEPATH', "../application/config");
include_once __DIR__ . "/../config/connect-list.php";
include_once __DIR__ . "/../config/connect.php";
include BASEPATH . "/database.php";

$host = $db['default']['hostname'];
$user = $db['default']['username'];
$pass = $db['default']['password'];
$data = $db['default']['database'];

$nama_tabel = "hdcasedaftar";
$connect = mysqli_connect($host, $user, $pass, $data);

$query_describe = mysqli_query($connect, "describe " . $nama_tabel);

if(mysqli_num_rows($query_describe) > 0){
    
    $explode_key = explode("_", $nama_tabel);
    $underscore_ = "";
    $rest_name_ = "";
    for($i = 1; $i < sizeof($explode_key); $i++){
        $rest_name_ = $rest_name_ . $underscore_ . $explode_key[$i];
        $underscore_ = "_";
    }
    if($rest_name_ == ""){
        $rest_name_ = $nama_tabel;
    }
    
    $comma = "";
    $select_column = "";
    $column_first = "";
    while($hasil_describe = mysqli_fetch_array($query_describe)){
        if($column_first == ""){
            if(strtolower($hasil_describe['Key']) != strtolower("PRI") && strtolower(substr($hasil_describe['Type'], 0, strlen("varchar"))) == "varchar"){
                $column_first = $hasil_describe['Field'];
            }
        }
        if($hasil_describe['Field'] != "timestamp" && strtolower($hasil_describe['Type']) != "text"){
            if(substr($hasil_describe['Field'], 0, strlen("id_")) == "id_"){
                $table_name = "tbl_" . substr($hasil_describe['Field'], strlen("id_"));
                $describe_table_inside = mysqli_query($connect, "describe " . $table_name);
                if($describe_table_inside && mysqli_num_rows($describe_table_inside)){
                    $column_pri = "";
                    $column_varchar = "";
                    while($hasil_describe_table_inside = mysqli_fetch_array($describe_table_inside)){
                        if(strtolower($hasil_describe_table_inside['Key']) == strtolower("PRI")){
                            if($column_pri == ""){
                               $column_pri = $hasil_describe_table_inside['Field'];
                            }
                        }
                        if(strtolower(substr($hasil_describe_table_inside['Type'], 0, strlen("varchar"))) == "varchar"){
                            if($column_varchar == ""){
                                $column_varchar = $hasil_describe_table_inside['Field'];
                            }
                        }
                        if($column_pri != "" && $column_varchar != ""){
                            break;
                        }
                    }
                    $hasil_describe['Field'] = "(select a.".$column_varchar." from ".$table_name." a where a.".$column_pri." = ".$hasil_describe['Field'].")";
                }
            }
            $select_column = $select_column . $comma . $hasil_describe['Field'];
            $comma = ", ";
        }
    }
    
    ob_start();
    echo '<?php 

class get_'.$rest_name_.' extends CI_Model {

    function __construct(){
        $this->param = new process_param();
        parent::__construct();
    }

    /* Process Database */
    function process($param){
        return $this->param->process($param);
    }

    function get_data(){

        $process_table = new process_table();

        $sEcho = isset($_GET["sEcho"]) ? $_GET["sEcho"] : \'0\';
        $iDisplayLength = isset($_GET["iDisplayLength"]) ? intval($_GET["iDisplayLength"]) : 10;
        $iDisplayStart = isset($_GET["iDisplayStart"]) ? intval($_GET["iDisplayStart"]) : 0;
        $sSearch = isset($_GET["sSearch"]) ? $_GET["sSearch"] : \'\';

        $clouse = "";

        if ($sSearch != \'\') {
            $clouse = " where '.$column_first.' like \'%" . $sSearch . "%\' ";
        }

        $sql_total = "select '.$select_column.' from '.$nama_tabel.'" . $clouse . "";

        $query_total = $this->db->query($sql_total);
        $total = $query_total->num_rows();

        $sql = "select '.$select_column.' from '.$nama_tabel.'".$clouse." order by '.$column_first.' asc limit $iDisplayStart , $iDisplayLength";

        $page = ($iDisplayStart / $iDisplayLength);

        $resuld = $process_table->coba_db($sql, $page, $iDisplayLength, true, "../../../index.php/'.$rest_name_.'/edit", "../../../index.php/'.$rest_name_.'/hapus");

        $output = array(
            \'sEcho\' => $sEcho,
            \'iTotalRecords\' => $total,
            \'iTotalDisplayRecords\' => $total,
            \'aaData\' => $resuld
        );

        echo json_encode($output, JSON_HEX_QUOT | JSON_HEX_TAG);
    }

}';
    $hasil_controller = ob_get_clean();
    file_put_contents(__DIR__ . "/../application/models/" . "get_" . $rest_name_ . ".php", $hasil_controller);
}
