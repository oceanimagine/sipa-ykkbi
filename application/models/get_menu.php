<?php 

class get_menu extends CI_Model {

    function __construct(){
        $this->param = new process_param();
        parent::__construct();
    }

    /* Process Database */
    function process($param){
        return $this->param->process($param);
    }

    function get_data(){

        $GLOBALS['kolom_menu'] = "id, nama_menu, module";
        $process_table = new process_table();

        $sEcho = isset($_GET["sEcho"]) ? $_GET["sEcho"] : '0';
        $iDisplayLength = isset($_GET["iDisplayLength"]) ? intval($_GET["iDisplayLength"]) : 10;
        $iDisplayStart = isset($_GET["iDisplayStart"]) ? intval($_GET["iDisplayStart"]) : 0;
        $sSearch = isset($_GET["sSearch"]) ? $_GET["sSearch"] : '';

        $clouse = "";

        if ($sSearch != '') {
            $clouse = " and nama_menu like '%" . $sSearch . "%' ";
        }

        /* select id, harga, tanggal_harus_bayar, case status when '1' then 'Aktif' when '2' then 'Tidak Aktif' else 'Tidak Aktif' end as status from tbl_atur_bayar */

        $sql_total = "select ".$GLOBALS['kolom_menu']." from tbl_menu where parent_id = '0'" . $clouse . "";

        $query_total = $this->db->query($sql_total);
        $total = $query_total->num_rows();

        $sql = "select ".$GLOBALS['kolom_menu']." from tbl_menu where parent_id = '0'".$clouse." order by id asc limit $iDisplayStart , $iDisplayLength";
        //echo $sql;
        $page = ($iDisplayStart / $iDisplayLength);

        $resuld = $process_table->coba_db(
            $sql, 
            $page, 
            $iDisplayLength, 
            true, 
            "../../../index.php/menu/edit",
            "../../../index.php/menu/hapus",
            "",
            "",
            "",
            1
        );

        $output = array(
            'sEcho' => $sEcho,
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => $total,
            'aaData' => $resuld
        );

        echo json_encode($output, JSON_HEX_QUOT | JSON_HEX_TAG);
    }

}