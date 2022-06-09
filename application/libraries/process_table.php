<?php

class process_table {

    private $increment = 0;
    private $hasil_array = array();
    private $hasil_keyss = array();

    public function __construct() {
        $this->CI = & get_instance();
    }

    public function coba_db(
        $sql, 
        $page, 
        $limit, 
        $action = "", 
        $module_edit = "", 
        $module_hapus = "", 
        $module_detail = "", 
        $titik = "", 
        $module_laporan = "",
        $sub_menu = 0
    ) {
        $this->CI->load->model('test');
        $decare_model = $this->CI->test;
        $query = $decare_model->kueri($sql);
        $hasil = $decare_model->hasil($query);

        $this->change_array($hasil);

        return $this->getDataTable(
            $page, 
            $limit, 
            $action, 
            $module_edit, 
            $module_hapus, 
            $module_detail, 
            $titik, 
            $module_laporan,
            $sub_menu
        );
    }

    public function change_array($array_result) {
        $return_array = array();
        for ($i = 0; $i < sizeof($array_result); $i++) {
            $res_arr = (array) $array_result[$i];
            $key_arr = array_keys($res_arr);
            $return_array[$i] = array();
            for ($j = 0; $j < sizeof($key_arr); $j++) {
                $return_array[$i][$j] = $array_result[$i]->{$key_arr[$j]};
                $this->hasil_keyss[$j] = $key_arr[$j];
            }
        }
        $this->hasil_array = $return_array;
    }

    public function dofetch() {
        $result = array();
        if (isset($this->hasil_array[$this->increment])) {
            for ($i = 0; $i < sizeof($this->hasil_array[$this->increment]); $i++) {
                $result[$i] = $this->hasil_array[$this->increment][$i];
            }
        }
        $this->increment++;
        return $result;
    }

    function getDataTable(
        $page, 
        $limit, 
        $action = "", 
        $module_edit = "", 
        $module_hapus = "", 
        $module_detail = "", 
        $titik = "", 
        $module_laporan = "",
        $sub_menu = 0
    ) {

        $result = array();
        $no = 1;
        $ad = 0;
        while ($row = $this->dofetch()) {
            for ($i = 0; $i < (sizeof($row) + 1); $i++) {
                if ($i == 0) {
                    $result[$ad][$i] = ($page * $limit) + $no;
                } else {
                    if(substr($this->hasil_keyss[($i - 1)],0,strlen("photo")) == "photo"){
                        $result[$ad][$i] = show_photo_table($this->hasil_keyss[($i - 1)], $row[($i - 1)]);
                    } else {
                        $result[$ad][$i] = $row[($i - 1)];
                    }
                }
            }
            if ($titik != "") {
                $split = explode(":", $titik);
                if (sizeof($split) > 1) {
                    $result[$ad][(int) $split[1]] = set_titik($result[$ad][(int) $split[1]]);
                }
            }
            if ($action != "") {
                $count = 0;
                $module = array();
                $rsltmd = "";
                $slash = "";
                if ($module_edit != "") {
		    if(isset($GLOBALS['PRIV_ACTIVE']) && isset($_SESSION['PRI']) && isset($GLOBALS['PRIV_ACTIVE'][$_SESSION['PRI']]) && $GLOBALS['PRIV_ACTIVE'][$_SESSION['PRI']]){
			$module[$count] = "<a href='" . $module_edit . "/" . $result[$ad][1] . "'>Edit</a>";
			$count++;
		    } else {
			if(isset($_SESSION['PRI']) && $_SESSION['PRI'] == "Pimpinan"){
			    $module[$count] = "<a href='" . $module_edit . "/" . $result[$ad][1] . "'>Lakukan Disposisi</a>";
			    $count++;
			} else if(isset($_SESSION['PRI']) && $_SESSION['PRI'] == "User Aplikasi"){
			    $module[$count] = "<a href='" . $module_edit . "/" . $result[$ad][1] . "'>Berikan Feedback</a>";
			    $count++;
			} else {
			    $module[$count] = "Tidak Ada";
			    $count++;
			}
		    }
                }
                if ($module_hapus != "") {
		    if(isset($GLOBALS['PRIV_ACTIVE']) && isset($_SESSION['PRI']) && isset($GLOBALS['PRIV_ACTIVE'][$_SESSION['PRI']]) && $GLOBALS['PRIV_ACTIVE'][$_SESSION['PRI']]){
			$module[$count] = "<a href=\"" . $module_hapus . "/" . $result[$ad][1] . "#\" onclick=\"confirm_delete('" . $module_hapus . "/" . $result[$ad][1] . "')\" data-target=\"#modal-default\" data-toggle=\"modal\">Hapus</a>";
			$count++;
		    }
                }
                if ($module_detail != "") {
                    $module[$count] = "<a href='" . $module_detail . "?id=" . $result[$ad][1] . "'>Detail</a>";
                    $count++;
                }
                if ($module_laporan != "") {
                    $module[$count] = "<a href='" . $module_laporan . "?id=" . $result[$ad][1] . "' target='_laporan'>Laporan</a>";
                    $count++;
                }
                for ($i = 0; $i < sizeof($module); $i++) {
                    $rsltmd = $rsltmd . $slash . $module[$i];
                    $slash = " / ";
                }
                $result[$ad][(sizeof($row) + 1)] = $rsltmd;
            }
            if($sub_menu){
                
                $menu_ = new process_menu();
                $menu_->address_menu = $ad + 1;
                $menu_->json_sub_menu("<i class=\"fa fa-circle-o\" style=\"font-size: 11px; margin-left: 2px;\"></i>", $result[$ad][1], $module_edit, $module_hapus);
                
                $keys_ = array_keys($menu_->result_menu);
                for($j = 0; $j < sizeof($keys_); $j++){
                    $result[$keys_[$j]] = $menu_->result_menu[$keys_[$j]];
                }
            }
            /* $result[] = $row; */
            $no++;
            if(isset($menu_) && is_object($menu_) && isset($menu_->address_menu)){
                $ad = $ad + sizeof($keys_) + 1;
            } else {
                $ad++;
            }
        }
        return $result;
    }

}
