<?php 

class get_daftar_strategic_business_plan extends CI_Model {

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
        $edit_link = "../../../index.php/daftar-strategic-business-plan/edit";
        $delete_link = "../../../index.php/daftar-strategic-business-plan/hapus";
        if($CI->allow_update == "0" && $CI->allow_read == "0"){
            $edit_link = "";
        }
        if($CI->allow_delete == "0"){
            $delete_link = "";
        }
        
        $process_table = new process_table();

        $sEcho = isset($_GET["sEcho"]) ? $_GET["sEcho"] : '0';
        $iDisplayLength = isset($_GET["iDisplayLength"]) ? intval($_GET["iDisplayLength"]) : 1000;
        $iDisplayStart = isset($_GET["iDisplayStart"]) ? intval($_GET["iDisplayStart"]) : 0;
        $sSearch = isset($_GET["sSearch"]) ? $_GET["sSearch"] : '';

        $clouse = "";

        if ($sSearch != '') {
            $clouse = " where (lower(sbpkode) like '%" . strtolower($sSearch) . "%' or lower(sbpnourut) like '%" . strtolower($sSearch) . "%' or lower(sbpdesc) like '%" . strtolower($sSearch) . "%') ";
        }

        /* select id, harga, tanggal_harus_bayar, case status when '1' then 'Aktif' when '2' then 'Tidak Aktif' else 'Tidak Aktif' end as status from tbl_atur_bayar */

        $sql_total = "select * from tbldaftarsbpps" . $clouse . $this->where_project($clouse) . "";

        $query_total = $this->db->query($sql_total);
        $total = $query_total->num_rows();

        $sql = "
        select
            CONCAT(kode, '-', sbpkode, '-', sbpnourut) as id,
            kode,
            sbpkode,
            sbpnourut,
            sbpdesc
        from tbldaftarsbpps ".
        $clouse.$this->where_project($clouse)." order by kode asc offset $iDisplayStart limit " . $iDisplayLength;

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