<?php

class setting {
    
    /* Global Sets */
    public function globals(){
        $class_rf = "home";
        $var_view = array(
            "{1}"  => "call_dynamic",
            "{2}"  => "call_dynamic",
            "{3}"  => "call_dynamic",
            "{4}"  => "call_dynamic",
            "{5}"  => "call_dynamic",
            "{6}"  => "call_dynamic",
            "{7}"  => "call_dynamic",
            "{8}"  => "call_dynamic",
            "{9}"  => "call_dynamic",
            "{10}" => "call_dynamic",
            "{11}" => "call_dynamic"
        );
        $var_sets = array(
            "{1}"  => array(
                "id_active"  => "part_header",
                "classname"  => $class_rf,
                "methodname" => "ajax_header"
            ),
            "{2}"  => array(
                "id_active"  => "part_top_menu",
                "classname"  => $class_rf,
                "methodname" => "ajax_topmenu"
            ),
            "{3}"  => array(
                "id_active"  => "part_slider",
                "classname"  => $class_rf,
                "methodname" => "ajax_slideshow"
            ),
            "{4}"  => array(
                "id_active"  => "part_header_service",
                "classname"  => $class_rf,
                "methodname" => "ajax_header_service"
            ),
            "{5}"  => array(
                "id_active"  => "part_offer_banner_section",
                "classname"  => $class_rf,
                "methodname" => "ajax_offer_banner_section"
            ),
            "{6}"  => array(
                "id_active"  => "part_main_container",
                "classname"  => $class_rf,
                "methodname" => "ajax_main_container"
            ),
            "{7}"  => array(
                "id_active"  => "part_recomend_slider",
                "classname"  => $class_rf,
                "methodname" => "ajax_recomend_slider"
            ),
            "{8}"  => array(
                "id_active"  => "part_banner_section",
                "classname"  => $class_rf,
                "methodname" => "ajax_banner_section"
            ),
            "{9}"  => array(
                "id_active"  => "part_featured_slider",
                "classname"  => $class_rf,
                "methodname" => "ajax_featured_slider"
            ),
            "{10}" => array(
                "id_active"  => "part_footerslider",
                "classname"  => $class_rf,
                "methodname" => "ajax_footerslider"
            ),
            "{11}" => array(
                "id_active"  => "part_footer",
                "classname"  => $class_rf,
                "methodname" => "ajax_footer"
            )
        );
        return array($var_view, $var_sets);
    }
    
    /* Config Sets */
    
    public function config_1(){
        $dnamic = array(
            "{6}"  => "call_dynamic"
        );
        $static = array(
            "{1}"  => "call_header",
            "{2}"  => "call_topmenu",
            "{4}"  => "call_header_service",
            "{10}" => "call_footerslider",
            "{11}" => "call_footer"
        );
        return array(array_merge($dnamic, $static), "{6}", "part_main_container", "home");
    }
    
    public function config_layout(){
        $dnamic = array(
            "{6}"  => "call_dynamic"
        );
        $static = array(
            "{1}"  => "call_header",
            "{2}"  => "call_topmenu",
            "{4}"  => "call_header_service",
            "{10}" => "call_footerslider",
            "{11}" => "call_footer"
        );
        return array(array_merge($dnamic, $static), "{6}", "part_main_container", "home");
    }
    
}