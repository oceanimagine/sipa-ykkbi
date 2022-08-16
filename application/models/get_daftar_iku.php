<?php 

class get_daftar_iku extends CI_Model {

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
            $clouse = " where (lower(ikukode) like '%" . strtolower($sSearch) . "%' or lower(ikunama) like '%" . strtolower($sSearch) . "%' or lower(ikurincian) like '%" . strtolower($sSearch) . "%') ";
        }

        /* select id, harga, tanggal_harus_bayar, case status when '1' then 'Aktif' when '2' then 'Tidak Aktif' else 'Tidak Aktif' end as status from tbl_atur_bayar */

        $sql_total = "select * from tbldaftariku" . $clouse . $this->where_project($clouse) . "";

        $query_total = $this->db->query($sql_total);
        $total = $query_total->num_rows();

        $sql = "
        select
            ikukode as id,
            kode,
            ikukode,
            ikunama,
            ikurincian
        from tbldaftariku ".
        $clouse.$this->where_project($clouse)." order by kode asc offset $iDisplayStart limit " . $iDisplayLength;

        $page = ($iDisplayStart / $iDisplayLength);

        $resuld = $process_table->coba_db($sql, $page, $iDisplayLength, true, "../../../index.php/daftar-iku/edit", "../../../index.php/daftar-iku/hapus");

        $output = array(
            'sEcho' => $sEcho,
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => $total,
            'aaData' => $resuld
        );

        echo json_encode($output, JSON_HEX_QUOT | JSON_HEX_TAG);
    }

}