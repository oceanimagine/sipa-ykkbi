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

        $CI =& get_instance();
        $edit_link = "../../../index.php/add-anggaran/edit";
        $delete_link = "../../../index.php/add-anggaran/hapus";
        if($CI->allow_update == "0" && $CI->allow_read == "0"){
            $edit_link = "";
        }
        if($CI->allow_delete == "0"){
            $delete_link = "";
        }
        
        if($CI->allow_delete == "0" && $CI->allow_read == "1"){
            $edit_link = "";
            $delete_link = "../../../index.php/add-anggaran/hapus";
        }
        
        $process_table = new process_table();

        $sEcho = isset($_GET["sEcho"]) ? $_GET["sEcho"] : '0';
        $iDisplayLength = isset($_GET["iDisplayLength"]) ? intval($_GET["iDisplayLength"]) : 1000;
        $iDisplayStart = isset($_GET["iDisplayStart"]) ? intval($_GET["iDisplayStart"]) : 0;
        $sSearch = isset($_GET["sSearch"]) ? $_GET["sSearch"] : '';

        $clouse = "\n";

        if ($sSearch != '') {
            $clouse = " 
                -- where 
                and (
                    lower((select nama1 from tblmastersatker where satkerid = substring(a.pktkode from 1 for 1))) like '%" . strtolower($sSearch) . "%' or 
                    lower((select b.pktkode from tbldaftaratrincian b where a.kode = b.kode and b.sbpkode = a.sbpkode and b.rekmakode = a.rekmakode offset 0 limit 1)) like '%" . strtolower($sSearch) . "%' or 
                    a.rekmakode like '%" . $sSearch . "%' or 
                    lower((select c.nama_rekening from sp_search_mataanggaran(a.kode, substring(a.pktkode from 1 for 1)) c where c.rekmakode = a.rekmakode)) like '%" . strtolower($sSearch) . "%'
                ) ";
        }

        /* select id, harga, tanggal_harus_bayar, case status when '1' then 'Aktif' when '2' then 'Tidak Aktif' else 'Tidak Aktif' end as status from tbl_atur_bayar */

        $sql_total = "
            select 
                CONCAT(a.kode, '-', a.sbpkode, '-', a.pktkode, '-', a.rekmakode) as id
            from tbldaftarat a
                left join 
                tblmastersatker b on b.satkerid = left(a.pktkode,1)
                left join
                tbldaftarpkt c on c.pktkode = a.pktkode
                left join
                tblmastermaindividual d on d.rekmakode=a.rekmakode		 
            where 
                a.kode='".$GLOBALS['kode_project']."'
                and c.kode='".$GLOBALS['kode_project']."'
                and d.kode='".$GLOBALS['kode_project']."'
                and b.satkerid::int in (".$_SESSION['data_satker_comma'].")
            ".$clouse." 
        ";

        $query_total = $this->db->query($sql_total);
        $total = $query_total->num_rows();
        
        /* 
        (a.rekmakode) rekmakode,
        (select c.nama_rekening from sp_search_mataanggaran(a.kode, substring(a.pktkode from 1 for 1)) c where c.rekmakode = a.rekmakode) as nama_rekening
        */
        
        /* 
        $sql = "
        select 
            CONCAT(a.kode, '-', a.sbpkode, '-', a.pktkode, '-', a.rekmakode) as id, 
            (select nama1 from tblmastersatker where satkerid = substring(a.pktkode from 1 for 1)) as satker_nama,
            CONCAT((select b.pktkode_rk from sp_search_pkt('".$GLOBALS['kode_project']."', substring(a.pktkode from 1 for 1)) b where b.kode = a.kode and b.sbpkode = a.sbpkode and b.pktkode_rk = a.pktkode offset 0 limit 1), ' # ', (select b.nama_rinciankegiatan from sp_search_pkt('".$GLOBALS['kode_project']."', substring(a.pktkode from 1 for 1)) b where b.kode = a.kode and b.sbpkode = a.sbpkode and b.pktkode_rk = a.pktkode offset 0 limit 1)) as pktkode_rk,
            CONCAT(substring((select b.rekmakode from sp_search_mataanggaran('".$GLOBALS['kode_project']."', substring(a.pktkode from 1 for 1)) b where b.rekmakode = a.rekmakode offset 0 limit 1) from 1 for 3), '.', substring((select b.rekmakode from sp_search_mataanggaran('".$GLOBALS['kode_project']."', substring(a.pktkode from 1 for 1)) b where b.rekmakode = a.rekmakode offset 0 limit 1) from 4 for 3), '.', substring((select b.rekmakode from sp_search_mataanggaran('".$GLOBALS['kode_project']."', substring(a.pktkode from 1 for 1)) b where b.rekmakode = a.rekmakode offset 0 limit 1) from 7 for 2),' # ', (select b.nama_rekening from sp_search_mataanggaran('".$GLOBALS['kode_project']."', substring(a.pktkode from 1 for 1)) b where b.rekmakode = a.rekmakode offset 0 limit 1)) as rekmakode
            
        from 
            tbldaftarat a ".$clouse.$this->where_project($clouse)." 
        order by a.kode asc 
        offset $iDisplayStart limit $iDisplayLength"; */
        
         $sql = "
            
            select 
                CONCAT(a.kode, '-', a.sbpkode, '-', a.pktkode, '-', a.rekmakode) as id,
                -- a.kode, 
                b.nama1, 
                a.pktkode ||' # '|| c.pktnama xxx,
                overlay(overlay(d.rekmakode placing '.' from 4 for 0) placing '.' from 8 for 0)  ||' # '|| d.rekmanama yyy,
                CONCAT(
                    trim(to_char(a.svrtime, 'Dy')), ' ', 
                    to_char(a.svrtime, 'Mon DD YYYY'), ' at ', 
                    to_char(a.svrtime, 'HH24:MI:SS')
                ) tanggal 
            from tbldaftarat a
                left join 
                tblmastersatker b on b.satkerid = left(a.pktkode,1)
                left join
                tbldaftarpkt c on c.pktkode = a.pktkode
                left join
                tblmastermaindividual d on d.rekmakode=a.rekmakode		 
            where 
                a.kode='".$GLOBALS['kode_project']."'
                and c.kode='".$GLOBALS['kode_project']."'
                and d.kode='".$GLOBALS['kode_project']."'
                and b.satkerid::int in (".$_SESSION['data_satker_comma'].")
            ".$clouse." 
            order by a.pktkode asc 
            offset $iDisplayStart limit $iDisplayLength";
        
        
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
