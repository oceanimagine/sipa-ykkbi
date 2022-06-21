<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
class layout {
    private $layout = "";
    private $folder_main = "";
    private $layout_stay = false;
    
    /* Private Var for View Library */ 
    private $enter_setts = false;
    private $enter_count = 0;
    private $result_call = "";
    private $combinecall = [];
    private $variable_return = [];
    private $tell_custom_config = false;
    
    public function __construct($layout = "lite", $config_sequence = "", $layout_stay = false) {    
        if(!defined("layout_folder")){
            define("label_no_picture", "No Picture.");
            define("layout_folder", APPPATH . "layout/".$layout."/");
            define("layout_image", APPPATH . "layout/".$layout."/image/");
            define("layout_image_client", base_url . "layout/".$layout."/image/");
        }
        $this->layout_stay = $layout_stay;
        $this->layout = $layout;
        $this->CI =& get_instance();
        $this->set_session_globals();
        $this->use_setting($config_sequence, $layout_stay);
    }

    public function __call($name, $args){
        $explode_us = explode("_", $name);
        if($explode_us[0] == "upload"){
            $this->folder_main = $explode_us[1];
            return $this->upload_data($args[0], $args[1]);
        }
        else if($explode_us[0] == "delete"){
            $this->folder_main = $explode_us[1];
            return $this->hapus_data($args[0], $args[1]);
        }
        else if($explode_us[0] == "check"){
            $this->folder_main = $explode_us[1];
            return $this->check_data($args[0], $args[1]);
        }
        else if($explode_us[0] == "globals"){
            $GLOBALS['layout_object'] = $this;
            $globals = new $explode_us[0]();
            $globals->{$explode_us[1]}($args[0], $args[1], $args[2], $args[3]);
        }
    }
    
    public function __set($name, $value) {
        if($name == "folder_upload" && !defined($value)){
            define($value, $value);
            define("folder_upload", $value);
        } else {
            $this->{$name} = $value;
            $GLOBALS[$name] = $value;
            if(isset($_SESSION)){
                $_SESSION[$name] = $value;
            }
        }
    }
    
    public function loadjs($urlajax, $file = "datatable"){
        ob_start();
        if($file == "datatable"){
            echo "var url__ = \"../../../index.php/".$urlajax."\";\n";
        }
        include_once APPPATH . "libraries/jsfile/" . $file . ".js";
        $js = ob_get_clean();
        return $js;
    }
    
    public function check_data($nama_file, $folder){
        return $nama_file != "" ? file_exists(layout_folder . $this->folder_main . "/" . $folder . "/" . $nama_file) : false;
    }
    
    public function check_isset(){
        $keys = array_keys($_FILES);
        $keys[0] = isset($keys[0]) ? $keys[0] : "UNKNOWN";
        return (isset($_FILES[$keys[0]]) && isset($_FILES[$keys[0]]['name']) && $_FILES[$keys[0]]['name'] != "");
    }
    
    public function hapus_data($nama_file, $folder){
        $result = 0;
        if($this->check_data($nama_file, $folder) && $this->check_isset()){
            unlink(layout_folder . $this->folder_main . "/" . $folder . "/" . $nama_file);
            $result = 1;
        }
        if(isset($this->nocheck) && $this->nocheck && $this->check_data($nama_file, $folder)){
            unlink(layout_folder . $this->folder_main . "/" . $folder . "/" . $nama_file);
            $result = 1;
        }
        return $nama_file != "" && $nama_file != label_no_picture ? $result : 1;
    }
    
    public function upload_data($nama_input, $folder){
        $nama_file = "";
        if(isset($_FILES[$nama_input]) && isset($_FILES[$nama_input]['name']) && $_FILES[$nama_input]['name'] != ""){
            $nama_file = strtoupper(str_replace(array(" ", "_"), array("S", "U"), $_FILES[$nama_input]['name']));
            move_uploaded_file($_FILES[$nama_input]['tmp_name'], layout_folder . $this->folder_main . "/".$folder."/" . $nama_file);
        }
        return $nama_file;
    }
    
    /* ----------------------------------------*/
    /* Begin View Process Library */
    
    public function callFunction($param){
        $GLOBALS['class_name'] = isset($param['table_name']) ? $param['table_name'] : get_class($param['class_active']);
        $GLOBALS['id_user'] = (isset($_SESSION['nomor_karyawan']) ? $_SESSION['nomor_karyawan'] : (isset($_SESSION['nomor_admin']) ? $_SESSION['nomor_admin'] : "001"));
        eval("\$GLOBALS['no_tiket'] = " . $param['function_name'] . "();");
        $this->variable_return = array($param['variable_return'] => $GLOBALS['no_tiket']);
    }
    
    public function loadView($view_file, $variable = array(), $setting_use = false){
        if(!defined("layout_use")){
            define("layout_use", $this->layout);
        }
        
        if(is_array($view_file) && isset($view_file['set_custom_view'])){
            $this->combinecall = new combine();
            $class_name = strtolower(get_class($view_file['set_custom_view']));
            $method_name = $this->CI->router->fetch_method();
            $config_view = $this->CI->config->item('view_custom');
            if(is_array($config_view) && isset($config_view[$class_name]) && is_array($config_view[$class_name]) && isset($config_view[$class_name][$method_name])){
                $view_position = $config_view[$class_name][$method_name];
                $this->tell_custom_config = true;
                $this->process_regular_view($view_position, array_merge($variable, $this->variable_return));
            } else {
                $this->process_regular_view("home_404", array_merge($variable, $this->variable_return));
            }
        } else {
            if(is_array($view_file) && isset($view_file['set_ob_view'])){
                $this->combinecall = new combine();
                ob_start();
                $this->process_only_view($view_file['set_ob_view'], array_merge($variable, $this->variable_return));
                return ob_get_clean();
            } else {
                $this->process_private_var_view($view_file, $setting_use);
                $this->combinecall = new combine();

                if(is_array($view_file)){
                    $this->process_array_view($view_file, array_merge($variable, $this->variable_return));
                } else {
                    $this->process_regular_view($view_file, array_merge($variable, $this->variable_return));
                }
            }
        }
    }
    
    public function set_session_globals(){
        if(isset($_SESSION)){
            $keys = array_keys($_SESSION);
            for($i = 0; $i < sizeof($keys); $i++){
                $GLOBALS[$keys[$i]] = $_SESSION[$keys[$i]];
            }
        }
    }
    
    public function use_setting($config_sequence = "", $layout_stay = false){
        if($layout_stay && !isset($_GET['print'])){
            
            $GLOBALS['layout_object'] = $this;
            $globals = new globals();
            $setting = new setting();
            $setting_param = $setting->{"config_" . $config_sequence}();
            
            $class_name = $this->CI->router->fetch_class();
            $method_name = $this->CI->router->fetch_method();
            
            $globals->layout_setting($class_name, $method_name, $setting_param);
        }
    }
    
    public function process_ob_result($view_file){
        if(!is_array($view_file)){
            echo $this->result_call; 
        } else {
            $this->result_call = "";
            $this->enter_setts = false;
        }
    }
    
    public function  process_private_var_view($view_file, $setting_use){
        if($setting_use){
            $this->enter_setts = true;
        }
        if($this->enter_setts){
            $this->enter_count++;
        }
        if($this->enter_count == 2){
            $this->process_ob_result($view_file);
        }
    }
    
    public function process_array_view($view_file, $variable){
        $keys = array_keys($view_file);
        $arrs = array();
        $keys_globals = array_keys($GLOBALS);
        for($i = 0; $i < sizeof($keys); $i++){
            ob_start();
            $variable_ = isset($variable[$keys[$i]]) ? $variable[$keys[$i]] : (sizeof($keys_globals) > 0 ? $GLOBALS : array());
            $this->CI->load->view($view_file[$keys[$i]], $variable_);
            $arrs[$keys[$i]] = ob_get_clean();
        }
        if($this->enter_setts){
            ob_start();
        }
        $this->combinecall->layout(
            "", 
            array(),
            array(),
            array(),
            $arrs
        );
        if($this->enter_setts){
            $this->result_call = ob_get_clean();
        }
    }
    
    public function process_view_from_ajax($view_file, $variable){
        if(isset($_GET['print']) && $_GET['print'] == "true"){
            ob_start();
            $this->CI->load->view($view_file, $variable);
            $html = ob_get_clean();
            echo $html;
        }
    }
    
    public function process_only_view($view_file, $variable){
        $this->CI->load->view($view_file, $variable);
    }
    
    public function process_regular_view($view_file, $variable){
        if(!$this->layout_stay){
            if($this->tell_custom_config){
                ob_start();
                $this->CI->load->view($view_file, $variable);
                $html = ob_get_clean();
                $html_array = array(
                    "html" => $html,
                    "tell_custom_config" => $this->tell_custom_config
                );
                $this->combinecall->layout($html_array, array(0));
            } else {
                ob_start();
                $this->CI->load->view($view_file, $variable);
                $html = ob_get_clean();
                $this->combinecall->layout($html, array(0));
            }
        } else {
            $this->process_view_from_ajax($view_file, $variable);
        }
    }
    
    /* End View Process Library */
    /* ----------------------------------------*/
    
}