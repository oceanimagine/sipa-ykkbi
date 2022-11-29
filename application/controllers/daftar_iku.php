<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class daftar_iku extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('get_daftar_iku');
        $this->layout = new layout('lite');
        Privilege::admin();
    }
    
    public function coba_html(){
        new process_spreadsheet_html_viewer(true);
    }
    
    public function get_daftar_iku() {
        $this->get_daftar_iku->get_data();
    }
    
    public function script_table(){
        return $this->layout->loadjs("daftar_iku/get_daftar_iku");
    }
    
    public function hapus($id){
        if($this->allow_delete == "0"){
            Message::set("Delete Data not allowed.");
            redirect('daftar-iku');
            exit();
        }
        $id = urldecode($id);
        
        $affected_delete_iku = 0;
        $affected_delete_iku_pkt = 0;
        
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        $this->get_daftar_iku->process(array(
            'action' => 'delete',
            'table' => 'tbldaftariku',
            'where' => 'kode = \''.$this->kode_project_scope_controller.'\' and ikukode = \''.$id.'\''
        ));
        if($this->affected){
            $affected_delete_iku = 1;
        }
        
        $this->get_daftar_iku->process(array(
            'action' => 'delete',
            'table' => 'tbldaftarikupkt',
            'where' => 'kode = \''.$this->kode_project_scope_controller.'\' and ikukode = \''.$id.'\''
        ));
        if($this->affected){
            $affected_delete_iku_pkt = 1;
        }
        
        if($affected_delete_iku && $affected_delete_iku_pkt && $this->db->trans_status()){
            $this->db->trans_commit();
        } else {
            $this->db->trans_rollback();
            Message::set("Delete failed.");
        }
        
        redirect('daftar-iku');
    }
    
    public function get_kegiatan_only($sbpkode = ""){
        
        $sbpkode_where = $sbpkode != "" ? " and sbpkode = '".$sbpkode."'" : "";
        $explode_comma = explode(",", $this->aplikasi->data->satker_string);
        $result_satker = "";
        $comma = "";
        for($i = 0; $i < sizeof($explode_comma); $i++){
            $result_satker = $result_satker . $comma . "'" . $explode_comma[$i] . "'";
            $comma = ",";
        }
        
        $this->get_daftar_iku->process(array(
            'action' => 'select',
            'table' => 'tbldaftarpkt',
            'column_value' => array(
                '*'
            ),
            'where' => 'kode = \''.$this->kode_project_scope_controller.'\' and substring(pktkode from 1 for 1) in ('.$result_satker.') and length(pktkode) = 4' . $sbpkode_where,
            'order' => 'sbpkode asc, pktkode asc'
        ));
        
        $this->load->view("regular/data_search_kegiatan_based_satker", array(
            "data_search" => $this->all
        ));
    }
    
    public function edit($id){
        $id = urldecode($id);
        if($this->input->post('kode')){
            if($this->allow_update == "0"){
                Message::set("Update Data not allowed.");
                redirect('daftar-iku/edit/'.$id.'');
                exit();
            }
            $affected_delete_iku_pkt = 0;
            $affected_iku_pkt = 0;
            
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);
            
            $kode = $this->input->post('kode');
            $ikukode = $this->input->post('ikukode');
            $ikunama = $this->input->post('ikunama');
            $ikurincian = $this->input->post('ikurincian');
            $this->get_daftar_iku->process(array(
                'action' => 'update',
                'table' => 'tbldaftariku',
                'column_value' => array(

                    'kode' => $kode,
                    'ikukode' => $ikukode,
                    'ikunama' => $ikunama,
                    'ikurincian' => $ikurincian
                ),
                'where' => 'kode = \''.$this->kode_project_scope_controller.'\' and ikukode = \''.$id.'\''
            ));
            
            $this->get_daftar_iku->process(array(
                'action' => 'delete',
                'table' => 'tbldaftarikupkt',
                'where' => 'kode = \''.$this->kode_project_scope_controller.'\' and ikukode = \''.$id.'\''
            ));
            if($this->affected){
                $affected_delete_iku_pkt = 1;
            }
            
            $count_iku_pkt = 0;
            $pkt_sbp = $_POST['pkt_sbp'];
            if(is_array($pkt_sbp) && sizeof($pkt_sbp) > 0){
                for($i = 0; $i < sizeof($pkt_sbp); $i++){
                    $explode_pkt_sbp = explode(",", $pkt_sbp[$i]);
                    $sbp_kode = $explode_pkt_sbp[1];
                    $pkt_kode = $explode_pkt_sbp[0];
                    $this->get_daftar_iku->process(array(
                        'action' => 'insert',
                        'table' => 'tbldaftarikupkt',
                        'column_value' => array(
                            'kode' => $kode,
                            'ikukode' => $ikukode,
                            'sbpkode' => $sbp_kode,
                            'pktkode' => $pkt_kode
                        )
                    ));
                    if($this->affected){
                        $count_iku_pkt++;
                    }
                }
            }
            if($count_iku_pkt == sizeof($pkt_sbp)){
                $affected_iku_pkt = 1;
            }
            
            if($affected_delete_iku_pkt && $affected_iku_pkt && $this->db->trans_status()){
                $this->db->trans_commit();
            } else {
                $this->db->trans_rollback();
                Message::set("Update failed.");
            }
            
            redirect('daftar-iku/edit/'.urlencode($id).'');
        }
        
        $this->get_daftar_iku->process(array(
            'action' => 'select',
            'table' => 'tbldaftarikupkt',
            'column_value' => array(
                'kode',
                'ikukode',
                'sbpkode',
                'pktkode'
            ),
            'where' => 'kode = \''.$this->kode_project_scope_controller.'\' and ikukode = \''.$id.'\''
        ));
        $data_iku_pkt = $this->all;
        $collect_data_iku_pkt = array();
        for($i = 0; $i < sizeof($data_iku_pkt); $i++){
            
            $this->get_daftar_iku->process(array(
                'action' => 'select',
                'table' => 'tbldaftarpkt',
                'column_value' => array(
                    'pktkode',
                    'kode',
                    'sbpkode',
                    'pktkrk',
                    'pktnourut',
                    'pktnama',
                    'pktoutput'
                ),
                'where' => 'kode = \''.$this->kode_project_scope_controller.'\' and pktkode = \''.$data_iku_pkt[$i]->pktkode.'\''
            ));
            $collect_data_iku_pkt[$i] = array();
            $collect_data_iku_pkt[$i]['sbpkode'] = $this->all[0]->sbpkode;
            $collect_data_iku_pkt[$i]['pktkode'] = $this->all[0]->pktkode;
            $collect_data_iku_pkt[$i]['pktnama'] = $this->all[0]->pktnama;
            $collect_data_iku_pkt[$i]['attr_info'] = json_encode(array($this->all[0]->pktkode, $this->all[0]->kode, $this->all[0]->sbpkode, $this->all[0]->pktkrk, $this->all[0]->pktnourut, $this->all[0]->pktnama, $this->all[0]->pktoutput));
        }
        
        $this->get_daftar_iku->process(array(
            'action' => 'select',
            'table' => 'tbldaftariku',
            'column_value' => array(
                'kode',
                'ikukode',
                'ikunama',
                'ikurincian'
            ),
            'where' => 'kode = \''.$this->kode_project_scope_controller.'\' and ikukode = \''.$id.'\''
        ));
        
        if(!isset($this->row->{'kode'})){
            Message::set("No Data.");
            redirect('daftar-iku');
        }
        
        $this->layout->loadView('daftar_iku_form', array(
            'kode' => $this->row->{'kode'},
            'iku_kode' => $this->row->{'ikukode'},
            'iku_nama' => $this->row->{'ikunama'},
            'iku_rincian' => $this->row->{'ikurincian'},
            'title' => 'Edit IKU',
            'collect_data_iku_pkt' => $collect_data_iku_pkt
        ));
    }
    
    public function add(){
        if($this->input->post('kode')){
            if($this->allow_create == "0"){
                Message::set("Create Data not allowed.");
                redirect('daftar-iku/add');
                exit();
            }
            $affected_iku = 0;
            $affected_iku_pkt = 0;
            // echo "<pre>\n";
            // print_r($_POST['pkt_sbp']);
            // exit();
            
            $kode = $this->input->post('kode');
            $ikukode = $this->input->post('ikukode');
            $ikunama = $this->input->post('ikunama');
            $ikurincian = $this->input->post('ikurincian');
            $pkt_sbp = $_POST['pkt_sbp'];
            
            if($ikunama != "" && $ikurincian != "" && is_array($pkt_sbp) && sizeof($pkt_sbp) > 0){
                $this->db->trans_start();
                $this->db->trans_strict(FALSE);

                $this->get_daftar_iku->process(array(
                    'action' => 'insert',
                    'table' => 'tbldaftariku',
                    'column_value' => array(
                        'kode' => $kode,
                        'ikukode' => $ikukode,
                        'ikunama' => $ikunama,
                        'ikurincian' => $ikurincian
                    )
                ));
                if($this->affected){
                    $affected_iku = 1;
                }

                $count_iku_pkt = 0;
                if(is_array($pkt_sbp) && sizeof($pkt_sbp) > 0){
                    for($i = 0; $i < sizeof($pkt_sbp); $i++){
                        $explode_pkt_sbp = explode(",", $pkt_sbp[$i]);
                        $sbp_kode = $explode_pkt_sbp[1];
                        $pkt_kode = $explode_pkt_sbp[0];
                        $this->get_daftar_iku->process(array(
                            'action' => 'insert',
                            'table' => 'tbldaftarikupkt',
                            'column_value' => array(
                                'kode' => $kode,
                                'ikukode' => $ikukode,
                                'sbpkode' => $sbp_kode,
                                'pktkode' => $pkt_kode
                            )
                        ));
                        if($this->affected){
                            $count_iku_pkt++;
                        }
                    }
                }
                if($count_iku_pkt == sizeof($pkt_sbp)){
                    $affected_iku_pkt = 1;
                }

                if($affected_iku && $affected_iku_pkt && $this->db->trans_status()){
                    $this->db->trans_commit();
                } else {
                    $this->db->trans_rollback();
                    Message::set("Insert failed.");
                }
            } else {
                Message::set("Mohon Diisi Semua Data.");
            }
            redirect('daftar-iku/add');
        }
        
        // Get Highest Kode IKU
        $this->get_daftar_iku->process(array(
            'action' => 'select',
            'table' => 'tbldaftariku',
            'column_value' => array(
                'ikukode'
            ),
            'order' => 'ikukode desc',
            'where' => 'kode = \''.$this->kode_project_scope_controller.'\''
        ));
        
        $this->layout->loadView('daftar_iku_form', array(
            "iku_kode" => $this->next_iku($this->all[0]->ikukode),
            'title' => 'Add IKU'
        ));
    }
    
    public function next_iku($current_kode){
        $explode_ = explode("#", $current_kode);
        $next_increment = (int) $explode_[1] + 1;
        return "IKU#" . samakan($next_increment, 99);
    }
    
    public function index() {
        $this->layout->loadView(
            'daftar_iku_list',
            array(
                "hasil" => "abcd",
                "script" => $this->script_table()
            )
        );
    }
    
}