<?php 

class get_add_anggaran extends CI_Model {

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

        $sEcho = isset($_GET["sEcho"]) ? $_GET["sEcho"] : '0';
        $iDisplayLength = isset($_GET["iDisplayLength"]) ? intval($_GET["iDisplayLength"]) : 1000;
        $iDisplayStart = isset($_GET["iDisplayStart"]) ? intval($_GET["iDisplayStart"]) : 0;
        $sSearch = isset($_GET["sSearch"]) ? $_GET["sSearch"] : '';

        $clouse = "";

        if ($sSearch != '') {
            $clouse = " where (kode like '%" . $sSearch . "%' or sbpkode like '%" . $sSearch . "%' or pktkode like '%" . $sSearch . "%' or rekmakode like '%" . $sSearch . "%' or keterangan like '%" . $sSearch . "%') ";
        }

        /* select id, harga, tanggal_harus_bayar, case status when '1' then 'Aktif' when '2' then 'Tidak Aktif' else 'Tidak Aktif' end as status from tbl_atur_bayar */

        $sql_total = "select CONCAT(kode, '-', sbpkode, '-', pktkode, '-', rekmakode) as id, kode, sbpkode, pktkode, rekmakode, keterangan from tbldaftarat" . $clouse . $this->where_project($clouse) . "";

        $query_total = $this->db->query($sql_total);
        $total = $query_total->num_rows();

        $sql = "select CONCAT(kode, '-', sbpkode, '-', pktkode, '-', rekmakode) as id, kode, sbpkode, pktkode, rekmakode, keterangan from tbldaftarat ".$clouse.$this->where_project($clouse)." order by kode asc offset $iDisplayStart limit 1000";

        $page = ($iDisplayStart / $iDisplayLength);

        $resuld = $process_table->coba_db($sql, $page, $iDisplayLength, true, "../../../index.php/add-anggaran/edit", "../../../index.php/add-anggaran/hapus");

        $output = array(
            'sEcho' => $sEcho,
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => $total,
            'aaData' => $resuld
        );

        echo json_encode($output, JSON_HEX_QUOT | JSON_HEX_TAG);
    }

}