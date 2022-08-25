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
            $clouse = " 
                where (
                    lower((select nama1 from tblmastersatker where satkerid = substring(a.pktkode from 1 for 1))) like '%" . strtolower($sSearch) . "%' or 
                    lower((select b.pktkode from tbldaftaratrincian b where a.kode = b.kode and b.sbpkode = a.sbpkode and b.rekmakode = a.rekmakode offset 0 limit 1)) like '%" . strtolower($sSearch) . "%' or 
                    a.rekmakode like '%" . $sSearch . "%' or 
                    lower((select c.nama_rekening from sp_search_mataanggaran(a.kode, substring(a.pktkode from 1 for 1)) c where c.rekmakode = a.rekmakode)) like '%" . strtolower($sSearch) . "%'
                ) ";
        }

        /* select id, harga, tanggal_harus_bayar, case status when '1' then 'Aktif' when '2' then 'Tidak Aktif' else 'Tidak Aktif' end as status from tbl_atur_bayar */

        $sql_total = "select CONCAT(a.kode, '-', a.sbpkode, '-', a.pktkode, '-', a.rekmakode) as id from tbldaftarat a" . $clouse . $this->where_project($clouse) . "";

        $query_total = $this->db->query($sql_total);
        $total = $query_total->num_rows();
        
        /* 
        (a.rekmakode) rekmakode,
        (select c.nama_rekening from sp_search_mataanggaran(a.kode, substring(a.pktkode from 1 for 1)) c where c.rekmakode = a.rekmakode) as nama_rekening
        */
        
        $sql = "
        select 
            CONCAT(a.kode, '-', a.sbpkode, '-', a.pktkode, '-', a.rekmakode) as id, 
            (select nama1 from tblmastersatker where satkerid = substring(a.pktkode from 1 for 1)) as satker_nama,
            CONCAT((select b.pktkode_rk from sp_search_pkt('".$GLOBALS['kode_project']."', substring(a.pktkode from 1 for 1)) b where b.kode = a.kode and b.sbpkode = a.sbpkode and b.pktkode_k = a.pktkode and b.pktkode_rk = (select c.pktkode from tbldaftaratrincian c where c.kode = a.kode and c.sbpkode = a.sbpkode and c.rekmakode = a.rekmakode offset 0 limit 1) offset 0 limit 1), ' # ', (select b.nama_rinciankegiatan from sp_search_pkt('".$GLOBALS['kode_project']."', substring(a.pktkode from 1 for 1)) b where b.kode = a.kode and b.sbpkode = a.sbpkode and b.pktkode_k = a.pktkode and b.pktkode_rk = (select c.pktkode from tbldaftaratrincian c where c.kode = a.kode and c.sbpkode = a.sbpkode and c.rekmakode = a.rekmakode offset 0 limit 1) offset 0 limit 1)) as pktkode_rk,
            CONCAT((select b.rekmakode from sp_search_mataanggaran('".$GLOBALS['kode_project']."', substring(a.pktkode from 1 for 1)) b where b.rekmakode = a.rekmakode offset 0 limit 1), ' # ', (select b.nama_rekening from sp_search_mataanggaran('".$GLOBALS['kode_project']."', substring(a.pktkode from 1 for 1)) b where b.rekmakode = a.rekmakode offset 0 limit 1)) as rekmakode
            
        from 
            tbldaftarat a ".$clouse.$this->where_project($clouse)." 
        order by a.kode asc 
        offset $iDisplayStart limit $iDisplayLength";

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