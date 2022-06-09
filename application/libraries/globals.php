<?php 

class globals {
    private $layout;
    function __construct(){
        global $layout_object;
        $this->layout = $layout_object;
    }
    public function alert($alerttext, $alertdetail, $alertprev, $alertnext){
        
        $this->layout->modulename = "globals/alert";
        $this->layout->alerttext= $alerttext;
        $this->layout->alertdetail= $alertdetail;
        $this->layout->alertprev= $alertprev;
        $this->layout->alertnext= $alertnext;   
        $this->layout->loadView(array(
            "{6}"  => "call_alert",
            "{10}" => "call_footerslider",
            "{1}"  => "call_header",
            "{4}"  => "call_header_service",
            "{2}"  => "call_topmenu",
            "{11}" => "call_footer"
        ));
    }
    public function layout_setting($class_name, $method_name, $param_config){
        
        $keys = array_keys($param_config[0]);
        $arrs = array();
        for($i = 0; $i < sizeof($keys); $i++){
            $arrs[$keys[$i]] = array(
                "modulename" => $param_config[3]
            );
        }
        $arrs[$param_config[1]] = array(
            "classname"  => $class_name,
            "methodname" => $method_name,
            "id_active"  => $param_config[2]
        );
        $this->layout->loadView($param_config[0], $arrs, true);
    }
}