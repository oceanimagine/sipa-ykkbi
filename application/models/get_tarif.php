<?php 

class get_tarif extends CI_Model {

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
        $edit_link = "../../../index.php/tarif/edit";
        $delete_link = "../../../index.php/tarif/hapus";
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
            $clouse = " where tarifdesc like '%" . $sSearch . "%' ";
        }

        /* select id, harga, tanggal_harus_bayar, case status when '1' then 'Aktif' when '2' then 'Tidak Aktif' else 'Tidak Aktif' end as status from tbl_atur_bayar */

        $sql_total = "select kode, satkerid, tarifid, tarifnama, tarifnom, tarifdesc from tblmastertarif" . $clouse . $this->where_project($clouse) . "";

        $query_total = $this->db->query($sql_total);
        $total = $query_total->num_rows();

        $sql = "select b.satkerid as id, kode, (select a.nama1 from tblmastersatker a where a.satkerid = b.satkerid) satkerid, b.tarifnama, b.tarifnom, b.tarifdesc from tblmastertarif b".$clouse.$this->where_project($clouse)." order by id asc offset $iDisplayStart limit $iDisplayLength";

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