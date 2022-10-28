<?php 

class get_mata_anggaran_individual_benchmarks extends CI_Model {

    function __construct(){
        $this->param = new process_param();
        parent::__construct();
    }

    /* Process Database */
    function process($param){
        return $this->param->process($param);
    }

    function get_data(){

        $CI =& get_instance();
        $edit_link = "../../../index.php/mata-anggaran-individual-benchmarks/edit";
        $delete_link = "../../../index.php/mata-anggaran-individual-benchmarks/hapus";
        if($CI->allow_update == "0" && $CI->allow_read == "0"){
            $edit_link = "";
        }
        if($CI->allow_delete == "0"){
            $delete_link = "";
        }
        
        $process_table = new process_table();

        $sEcho = isset($_GET["sEcho"]) ? $_GET["sEcho"] : '0';
        $iDisplayLength = isset($_GET["iDisplayLength"]) ? intval($_GET["iDisplayLength"]) : 10;
        $iDisplayStart = isset($_GET["iDisplayStart"]) ? intval($_GET["iDisplayStart"]) : 0;
        $sSearch = isset($_GET["sSearch"]) ? $_GET["sSearch"] : '';

        $clouse = "";

        if ($sSearch != '') {
            $clouse = " where (lower(rekmakode) like '%" . $sSearch . "%' or lower(rekmanama) like '%" . $sSearch . "%' or lower(rekmainduk) like '%" . $sSearch . "%') ";
        }

        /* select id, harga, tanggal_harus_bayar, case status when '1' then 'Aktif' when '2' then 'Tidak Aktif' else 'Tidak Aktif' end as status from tbl_atur_bayar */

        $sql_total = "select kode, rekmakode, rekmanama, rekmainduk, benchmarkang, benchmarkprog from tblmastermaindividual" . $clouse . $this->where_project($clouse) . "";

        $query_total = $this->db->query($sql_total);
        $total = $query_total->num_rows();
        // CONCAT(substring(b.rekmainduk from 1 for 3), '.', substring(b.rekmainduk from 4 for 3), '.', substring(b.rekmainduk from 7 for 2)) 
        $sql = "select b.rekmakode as id, b.kode, CONCAT(substring(b.rekmakode from 1 for 3), '.', substring(b.rekmakode from 4 for 3), '.', substring(b.rekmakode from 7 for 2)) rekmakode, b.rekmanama, b.rekmainduk, (select a.rekmainduknama from tblmastermainduk a where a.rekmainduk = b.rekmainduk) rekmainduknama, b.benchmarkang, b.benchmarkprog from tblmastermaindividual b ".$clouse.$this->where_project($clouse)." order by id asc, kode asc, rekmainduk asc, rekmakode asc offset $iDisplayStart limit $iDisplayLength";

        $page = ($iDisplayStart / $iDisplayLength);

        $resuld = $process_table->coba_db($sql, $page, $iDisplayLength, true, $edit_link, $delete_link);

        $output = array(
            'sEcho' => $sEcho,
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => $total,
            'aaData' => $resuld
        );

        echo json_encode($output, JSON_HEX_QUOT | JSON_HEX_TAG);
    }

}