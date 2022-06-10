<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
define("base_url", base_url() . APPPATH);
define("user", isset($_SESSION['PRI']) && $_SESSION['PRI'] != "" ? ($_SESSION['PRI'] == "Admin" ? "Agendaris" : $_SESSION['PRI']) : "Admin");
define("priviledge", isset($_SESSION['PRI']) && $_SESSION['PRI'] != "" ? ($_SESSION['PRI'] == "Admin" ? "Agendaris" : $_SESSION['PRI']) : "Admin");
define("layout_active", "layout/{layout_active}/index.php");

define("base_url_get_param", base_url() . APPPATH);

class combine {
    private $menu;
    public $contain_custom_config = false;
    function layout($html, $getjs = array(), $search = array(), $replace = array(), $array_view = array()) {
        $this->menu = new process_menu();
        $this->CI =& get_instance();
        $this->combine_layout($html, $getjs, $search, $replace, $array_view);
    }

    function get_title($html) {
        $explode_title_open = explode("<title>", $html);
        $explode_title_close = explode("</title>", isset($explode_title_open[1]) ? $explode_title_open[1] : "");
        return $explode_title_close[0];
    }

    function get_inside_body_tag($html) {
        $explode_isi_body = explode("<body", $html);
        $close_tag_body = "</body>";
        $isi_body_step1 = isset($explode_isi_body[1]) ? $explode_isi_body[1] : "";
        $address_isi_body = 0;
        $result_isi_body = "";
        $begin_concate = 0;
        while (isset($isi_body_step1[$address_isi_body])) {
            if (substr($isi_body_step1, $address_isi_body, strlen($close_tag_body)) == $close_tag_body) {
                $begin_concate = 0;
                break;
            }
            if ($begin_concate == 1) {
                $result_isi_body = $result_isi_body . $isi_body_step1[$address_isi_body];
            }
            if ($isi_body_step1[$address_isi_body] == ">") {
                $begin_concate = 1;
            }
            $address_isi_body++;
        }
        return $result_isi_body;
    }
    
    function get_fcontent( $url ) {
        
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        $result = curl_exec($ch);
        echo $result;
        curl_close($ch);
        
    }

    function get_all_script_tag($html) {
        $explode_isi_script = explode("<script", $html);
        $close_tag_script = "</script>";
        $close_tag_slash = "/>";
        $address_array_script = 0;
        $array_tag_script = array();

        for ($i = 1; $i < sizeof($explode_isi_script); $i++) {
            $address_tag_script = 0;
            $begin_inner = 0;
            $tag_explode = $explode_isi_script[$i];
            $result_attribute_script = "";
            $result_inner_script = "";
            $single_quote = 0;
            $double_quote = 0;
            while (isset($tag_explode[$address_tag_script])) {

                /* Get Array */
                if (($single_quote == 0 && $double_quote == 0) && (substr($tag_explode, $address_tag_script, strlen($close_tag_slash)) == $close_tag_slash || substr($tag_explode, $address_tag_script, strlen($close_tag_script)) == $close_tag_script)) {
                    $begin_inner = 0;
                    $array_tag_script[$address_array_script] = array();
                    $result_attribute_replace_src = str_replace('src="', 'src="' . base_url, $result_attribute_script);
                    $array_tag_script[$address_array_script]['attribute_string'] = $result_attribute_replace_src;
                    $array_tag_script[$address_array_script]['inner_string'] = $result_inner_script;
                    $array_tag_script[$address_array_script]['script_tag'] = "<script" . $result_attribute_replace_src . ">" . $result_inner_script . "</script>";
                    $address_array_script++;
                    break;
                }

                /* Get Inner */
                if ($begin_inner == 1) {

                    $result_inner_script = $result_inner_script . $tag_explode[$address_tag_script];
                    /* Single Quote */
                    if ($single_quote == 2) {
                        $single_quote = 0;
                    }
                    if ($single_quote == 1 && $tag_explode[$address_tag_script] == "'" && $tag_explode[($address_tag_script - 1)] != '\\') {
                        $single_quote = 2;
                    }
                    if ($tag_explode[$address_tag_script] == "'" && $single_quote == 0) {
                        $single_quote = 1;
                    }
                    /* Double Quote */
                    if ($double_quote == 2) {
                        $double_quote = 0;
                    }
                    if ($double_quote == 1 && $tag_explode[$address_tag_script] == '"' && $tag_explode[($address_tag_script - 1)] != '\\') {
                        $double_quote = 2;
                    }
                    if ($tag_explode[$address_tag_script] == '"' && $double_quote == 0) {
                        $double_quote = 1;
                    }
                }

                /* Begin Inner */
                if ($tag_explode[$address_tag_script] == ">") {
                    $begin_inner = 1;
                }

                /* Get All Info Attribute */
                if ($begin_inner == 0) {
                    $result_attribute_script = $result_attribute_script . $tag_explode[$address_tag_script];
                }
                $address_tag_script++;
            }
        }
        return $array_tag_script;
    }

    function combine_layout(
        $html, 
        $getjs = array(), 
        $search = array(), 
        $replace = array(), 
        $array_view = array()
    ) {
        if(is_array($html) && isset($html['html'])){
            $this->contain_custom_config = $html['tell_custom_config'];
            $html = $html['html'];
        }
        $get_script = $this->get_all_script_tag($html);
        // $layout_content = file_get_contents(base_url . str_replace("{layout_active}", layout_use, layout_active) . "?base_url=" . base_url_get_param);
        
        ob_start();
        include "application/layout/".layout_use."/index.php";
        $layout_content = ob_get_clean();
        
        $js_collect = "";
        for ($i = 0; $i < sizeof($getjs); $i++) {
            if(isset($get_script[$getjs[$i]])){
                $js_collect = $js_collect . $get_script[$getjs[$i]]['script_tag'] . "\n";
            }
        }
        
        $isi_body = $js_collect . $this->get_inside_body_tag($html);
        
        /* Layout Replace */
        $left_menu_under_logo_search = "{REPLACE_WITH_FUNCTION}";
        $left_menu_under_logo_replace = "";
        if(isset($GLOBALS['left_menu_under_logo']) && $GLOBALS['left_menu_under_logo']){
            if(isset($GLOBALS['function_process']) && $GLOBALS['function_process'] != ""){
                if(function_exists($GLOBALS['function_process'])){
                    eval('$return_function = '.$GLOBALS['function_process'].'();');
                    $return_function = isset($return_function) ? $return_function : "";
                    $left_menu_under_logo_replace = $return_function;
                    $replace_concate = "";
                    $address_body = 0;
                    while(isset($layout_content{$address_body})){
                        if(substr($layout_content, $address_body, strlen($left_menu_under_logo_search . '{{DEFAULT:"')) == $left_menu_under_logo_search . '{{DEFAULT:"'){
                            while(isset($layout_content{$address_body})){
                                $replace_concate = $replace_concate . $layout_content{$address_body};
                                if($layout_content{$address_body} == "}" && $layout_content{$address_body - 1} == "}"){
                                    break;
                                }
                                $address_body++;
                            }
                            break;
                        }
                        $address_body++;
                    }
                    $left_menu_under_logo_search = $replace_concate; 
                }
            }
        }
        if($left_menu_under_logo_replace == ""){
            $explode_start = explode('{REPLACE_WITH_FUNCTION}{{DEFAULT:"', $layout_content);
            if(isset($explode_start[1]) && $explode_start[1] != ""){
                $explode_end = explode('"}}', $explode_start[1]);
                $left_menu_under_logo_search = '{REPLACE_WITH_FUNCTION}{{DEFAULT:"'.$explode_end[0].'"}}';
                $left_menu_under_logo_replace = $explode_end[0];
            }
        }
        
        $title = $this->get_title($html);
        if (sizeof($search) > 0) {
            $isi_body = str_replace($search, $replace, $isi_body);
        }
        $menu_li = $this->menu->select_menu(0);
        $array_search = array(
            "{replace_body}", 
            "{user}", 
            "{priviledge}", 
            "{title}", 
            "<!-- {MENU_REPLACE} -->",
            $left_menu_under_logo_search
        );
        $array_replace = array(
            $isi_body, 
            (user == "SUPERADMIN" ? user : (isset($_SESSION['username']) ? substr($_SESSION['username'], 0, 20) : "")), 
            (priviledge == "SUPERADMIN" ? priviledge : (isset($_SESSION['username']) ? substr($_SESSION['username'], 0, 20) : "")), 
            $title, 
            $menu_li[0],
            $left_menu_under_logo_replace
        );
        
        $keys_add = array_keys($array_view);
        if(sizeof($keys_add) > 0){
            $array_search_add = array();
            $array_replace_add = array();
            for($i = 0; $i < sizeof($keys_add); $i++){
                $array_search_add[$i] = $keys_add[$i];
                $array_replace_add[$i] = $array_view[$keys_add[$i]];
            }
            $array_search_url = array('var url_active = "";','var count_jumlah = 0;');
            $array_replace_url = array('var url_active = "'.base_url().'";','var count_jumlah = '.sizeof($keys_add).';');
            $array_search = array_merge($array_search, $array_search_add, $array_search_url);
            $array_replace = array_merge($array_replace, $array_replace_add, $array_replace_url);
        }
        echo str_replace($array_search, $array_replace, $layout_content);
    }
    
    /* Fungsi Untuk Aplikasi Disposisi */
    
    function set_active($explode_index, $menu){
        $explode_garing = explode("/", $explode_index[1]);
        $controller_active = $explode_garing[0];
        $array_induk = array(
            "pengguna" => array(
                "admin_pimpinan" => true,
                "admin_admin" => true,
                "admin_aplikasi" => true,
                "admin_user" => true
            ),
            "jenis_disposisi" => array(
                "admin_jenis_perihal" => true,
                "admin_jenis_irlog" => true
            ),
            "surat" => array(
                "admin_rekam_surat_masuk" => true,
                "admin_rekam_surat_keluar" => true,
                "admin_disposisi" => true
            ),
            "laporan" => array(
                "admin_laporan_surat_masuk" => true,
                "admin_laporan_surat_keluar" => true,
                "admin_laporan_disposisi" => true
            )
        );
        $returns = "";
        if(isset($array_induk[$menu][$controller_active]) && $array_induk[$menu][$controller_active]){
            $returns = " active";
        }
        if($menu == $controller_active || (isset($_SESSION['ACTIVE_PAGE']) && $_SESSION['ACTIVE_PAGE'] == $menu)){
            $returns = " class='active'";
	    if(isset($_SESSION['ACTIVE_PAGE'])){
		$GLOBALS['ACTIVE_PAGE'] = $_SESSION['ACTIVE_PAGE'];
		unset($_SESSION['ACTIVE_PAGE']);
	    }
        }
	
        return $returns;
    }
    
    function get_active($menu = ""){
        if(isset($_SERVER) && is_array($_SERVER) && isset($_SERVER['PATH_TRANSLATED'])){
            $explode_index = explode("/skripsi-disposisi/", $_SERVER['PATH_TRANSLATED']);
            $masuk_controller = "";
            if(isset($explode_index[1]) && $explode_index[1] != ""){
                $masuk_controller = $explode_index[1];
                if($menu != ""){
                    return $this->set_active($explode_index, $menu);
                }
            }
            return (
                $masuk_controller == "home" || 
                $masuk_controller == "#" || 
                $masuk_controller == ""
            ) && $menu == "" ? " active" : "";
        }
    }

}
