<?php 

class privilege {
    public static function admin(){
	$GLOBALS['PRIV_ACTIVE'] = array(
	    "SUPERADMIN" => true,
            "ADMIN" => true,
            "HDUSER" => true,
            "ITUSER" => true
	);
	$jenis_privilege = array_keys($GLOBALS['PRIV_ACTIVE']);
        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $explode_get = explode("get", current_url());
        $explode_check = explode("check", current_url());
        $explode_report = explode("report", current_url());
        $explode_add = explode("add", current_url());
        $explode_edit = explode("edit", current_url());
        if(sizeof($explode_get) == 1 && sizeof($explode_check) == 1 && sizeof($explode_report) == 1 && sizeof($explode_add) == 1 && sizeof($explode_edit) == 1){
            $_SESSION['URL_CURRENT'] = str_replace("?","/",current_url());
        }
	$same = 0;
        for($i = 0; $i < sizeof($jenis_privilege); $i++){
	    if((isset($_SESSION['PRI']) && $_SESSION['PRI'] == $jenis_privilege[$i])){
		$same = 1;
		break;
	    }
	}
	if(!$same && !isset($GLOBALS['login_page'])){
            header('location: '.$GLOBALS['base_administrator'].'index.php/login');
	}
        return $same;
    }
    
}