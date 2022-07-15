<?php 

class layoutcall extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->layout = new layout('digital');
        $this->layout->modulename = "globals/layoutcall";
    }
    
    /* Ajax Call */
    public function ajax_footerslider(){
        $this->load->view("ajax_footerslider");
    }
    public function ajax_header(){
        $data['datas'] = $this->get_tb_kategoriprodukadmin->getdata();        
        $data['modulename'] = $this->layout->modulename;   
        $this->load->view("ajax_header",$data);
    }
    public function ajax_header_service(){
        $this->load->view("ajax_header_service");
    }
    public function ajax_topmenu(){     
        $data['datas'] = $this->get_tb_kategoriprodukadmin->getdata();        
        $data['modulename'] = $this->layout->modulename;   
        $this->load->view("ajax_topmenu",$data);
    }
    public function ajax_footer(){
        $this->load->view("ajax_footer");
    }
}