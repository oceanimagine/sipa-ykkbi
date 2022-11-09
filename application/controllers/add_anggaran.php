<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* https://stackoverflow.com/jobs/149384/software-engineer-team-lead-iprice-group?med=clc
 * https://stackoverflow.com/questions/17059987/changing-from-msql-to-mysqli-real-escape-string-link
 */

class add_anggaran extends CI_Controller {
    
    public $layout;
    public $kamus;
    
    public function __construct() {
        parent::__construct();
        $this->load->model('get_add_anggaran');
        $this->layout = new layout('lite');
        Privilege::admin();
        
    }

    public function get_add_anggaran() {
        $this->get_add_anggaran->get_data();
    }

    public function get_style(){
        $process_report_excel = new process_report_excel();
        $process_report_excel->test_get_style();
    }
    
    public function script_table(){
        return $this->layout->loadjs("add_anggaran/get_add_anggaran");
    }
    
    public function get_sp_search_pkt_based_satker($satker){
        $this->get_add_anggaran->process(array(
            'action' => 'select',
            'table' => 'sp_search_pkt(\''.$this->kode_project_scope_controller.'\',\''.$this->aplikasi->data->satker_string.'\')',
            'column_value' => array(
                '*'
            ),
            'where' => 'nama_satker = \''.str_replace(array("SEPASI","KURUNGBUKA","KURUNGTUTUP"), array(" ","(",")"), $satker).'\''
        ));
        $this->load->view("regular/data_search_pkt_based_satker", array(
            "data_search" => $this->all
        ));
    }
    
    public function get_sp_search_mataanggaran(){
        $this->get_add_anggaran->process(array(
            'action' => 'select',
            'table' => 'sp_search_mataanggaran(\''.$this->kode_project_scope_controller.'\',\''.$this->aplikasi->data->satker_string.'\')',
            'column_value' => array(
                '*'
            )
        ));
        $this->load->view("regular/data_search_mataanggaran", array(
            "data_search" => $this->all
        ));
    }
    
    private $redirect_kode_edit = "";
    private $redirect_sbpkode_edit = "";
    private $redirect_pktkode_edit = "";
    private $redirect_rekmakode_edit = "";
    public function insert_anggaran_process(){
        if($this->input->post("kode_project_hidden")){
            // set_title("Debug POST.");
            // cetak_html($_POST);
            
            //Table tbldaftarat
            $explode_kegiatan_program_kerja_rincian_hidden = explode(" ---- ", $_POST['kegiatan_program_kerja_rincian_hidden']);
            $explode_mata_anggaran_hidden = explode(" ---- ", $_POST['mata_anggaran_hidden']);
            $kode_at = $_POST['kode_project_hidden'];
            $sbpkode_at = $explode_kegiatan_program_kerja_rincian_hidden[5];
            $pktkode_at = $explode_kegiatan_program_kerja_rincian_hidden[1];
            $rekmakode_at = $explode_mata_anggaran_hidden[2];
	    
            $pktkode_at = $pktkode_at;
            
	    $pktkode_rk_rincian_ = $explode_kegiatan_program_kerja_rincian_hidden[3];

            $keterangan = "-";
            // cetak_html($explode_kegiatan_program_kerja_rincian_hidden);
            // print_query();
            
            $this->get_add_anggaran->process(array(
                'action' => 'insert',
                'table' => 'tbldaftarat',
                'column_value' => array(
                    'kode' => $kode_at,
                    'sbpkode' => $sbpkode_at,
                    'pktkode' => /* $pktkode_at */ $pktkode_rk_rincian_,
                    'rekmakode' => $rekmakode_at,
                    'keterangan' => $keterangan
                )
            )); 
            $affected_at = $this->affected;
            
            $this->redirect_kode_edit = $kode_at;
            $this->redirect_sbpkode_edit = $sbpkode_at;
            $this->redirect_pktkode_edit = $pktkode_rk_rincian_;
            $this->redirect_rekmakode_edit = $rekmakode_at;
            
            // Table tbldaftaratgroup
            // cetak_html("AAAAA");
            // cetak_html($_POST['group_default']);
            $affected_group = 0;
            for($i = 0; $i < sizeof($_POST['group_default']); $i++){
                $group_default = $_POST['group_default'][$i];
                $kode_group = $_POST['kode_project_hidden'];
                $sbpkode_group = $explode_kegiatan_program_kerja_rincian_hidden[5];
                $pktkode_group = $explode_kegiatan_program_kerja_rincian_hidden[1];
                $rekmakode_group = $explode_mata_anggaran_hidden[2];
                $group_group = $group_default;
                
		$pktkode_group = $pktkode_group;

                $this->get_add_anggaran->process(array(
                    'action' => 'insert',
                    'table' => 'tbldaftaratgroup',
                    'column_value' => array(
                        '"kode"' => $kode_group,
                        '"sbpkode"' => $sbpkode_group,
                        '"pktkode"' => /* $pktkode_group */ $pktkode_rk_rincian_,
                        '"rekmakode"' => $rekmakode_group,
                        '"group"' => $group_group
                    )
                ));
                $affected_group = 0;
                if($this->affected){
                    $affected_group = 1;
                }
            }
            
            //Table tbldaftaratrincian
            $info_satker = $explode_kegiatan_program_kerja_rincian_hidden[0];
            $explode_satker = explode("(", $info_satker);
            $explode_satker_2 = explode(")", $explode_satker[1]);
            $id_satker = $explode_satker_2[0];
            $explode_inisial_all = explode(",", $_POST['inisial_all']);
            $pktkode_rk_rincian = $explode_kegiatan_program_kerja_rincian_hidden[3];
            $affected_rincian = 0;
            for($i = 0; $i < sizeof($explode_inisial_all); $i++){
                $inisial_name = $explode_inisial_all[$i];
                $nama = $_POST['nama'.$inisial_name];
                $Q = $_POST['Q'.$inisial_name];
                $F = $_POST['F'.$inisial_name];
                $tarif = $_POST['tarif'.$inisial_name];
                $subtotal = $_POST['subtotal'.$inisial_name];
                $persen_tw1 = $_POST['persen_tw1'.$inisial_name];
                $tw1 = $_POST['tw1'.$inisial_name];
                $persen_tw2 = $_POST['persen_tw2'.$inisial_name];
                $tw2 = $_POST['tw2'.$inisial_name];
                $persen_tw3 = $_POST['persen_tw3'.$inisial_name];
                $tw3 = $_POST['tw3'.$inisial_name];
                $persen_tw4 = $_POST['persen_tw4'.$inisial_name];
                $tw4 = $_POST['tw4'.$inisial_name];
                $group_default = $_POST['group_default'][$i];
                for($j = 0; $j < sizeof($nama); $j++){
                    
                    $this->get_add_anggaran->process(array(
                        'action' => 'insert',
                        'table' => 'tbldaftaratrincian',
                        'column_value' => array(
                            '"kode"' => $kode_group,
                            '"sbpkode"' => $sbpkode_group,
                            '"pktkode"' => $pktkode_rk_rincian,
                            '"rekmakode"' => $rekmakode_group,
                            '"group"' => $group_default,
                            '"satkerid"' => $id_satker,
                            '"nourut"' => ($j + 1),
                            '"rincian"' => $nama[$j],
                            '"tarifid"' => 0,
                            '"taridnom"' => $tarif[$j],
                            '"rinkuantitas"' => $Q[$j],
                            '"rinfrekwensi"' => $F[$j],
                            '"rintarif"' => $tarif[$j],
                            '"rintotal"' => $subtotal[$j],
                            '"rppt1perc"' => $persen_tw1[$j],
                            '"rppt2perc"' => $persen_tw2[$j],
                            '"rppt3perc"' => $persen_tw3[$j],
                            '"rppt4perc"' => $persen_tw4[$j],
                            '"rppt1nom"' => $tw1[$j],
                            '"rppt2nom"' => $tw2[$j],
                            '"rppt3nom"' => $tw3[$j],
                            '"rppt4nom"' => $tw4[$j]
                        )
                    ));
                    $affected_rincian = 0;
                    if($this->affected){
                        $affected_rincian = 1;
                    }
                }
            }
            
            if($affected_at && $affected_group && $affected_rincian && $this->insert_anggaran_process_lanjutan()){
                $this->commit_insert = TRUE;
            }
        }
    }
    
    public function insert_anggaran_process_lanjutan(){
        if(isset($_POST['kumpulan_alphabet']) && $_POST['kumpulan_alphabet'] != ""){
            // echo "<pre>\n";
            // print_r($_POST);
            // exit();
            $kumpulan_alphabet = $_POST['kumpulan_alphabet'];
            $explode_kumpulan_alphabet = explode(",", $kumpulan_alphabet);
            $explode_kegiatan_program_kerja_rincian_hidden = explode(" ---- ", $_POST['kegiatan_program_kerja_rincian_hidden']);
            $kode_group = $_POST['kode_project_hidden'];
            $sbpkode_group = $explode_kegiatan_program_kerja_rincian_hidden[5];
            $pktkode_rk_rincian_ = $explode_kegiatan_program_kerja_rincian_hidden[3];
            
            $affected_group = 0;
            $affected_rincian = 0;
            for($i = 0; $i < sizeof($explode_kumpulan_alphabet); $i++){
                $alphabet = $explode_kumpulan_alphabet[$i];
                $explode_inisial_all = explode(",", $_POST['inisial_all_' . $alphabet]);
                
                $explode_mata_anggaran_hidden = explode(" ---- ", $_POST['mata_anggaran'.$alphabet.'_hidden']);
                $rekmakode_group = $explode_mata_anggaran_hidden[2];
                for($j = 0; $j < sizeof($_POST['group_'.$alphabet.'_default']); $j++){
                    $group_default = $_POST['group_'.$alphabet.'_default'][$j];
                    $group_group = $group_default;
                    $this->get_add_anggaran->process(array(
                        'action' => 'insert',
                        'table' => 'tbldaftaratgroup',
                        'column_value' => array(
                            '"kode"' => $kode_group,
                            '"sbpkode"' => $sbpkode_group,
                            '"pktkode"' => $pktkode_rk_rincian_,
                            '"rekmakode"' => $rekmakode_group,
                            '"group"' => $group_group
                        )
                    ));
                    $affected_group = 0;
                    if($this->affected){
                        $affected_group = 1;
                    }
                }
                
                $info_satker = $explode_kegiatan_program_kerja_rincian_hidden[0];
                $explode_satker = explode("(", $info_satker);
                $explode_satker_2 = explode(")", $explode_satker[1]);
                $id_satker = $explode_satker_2[0];
                $pktkode_rk_rincian = $explode_kegiatan_program_kerja_rincian_hidden[3];
                
                for($j = 0; $j < sizeof($explode_inisial_all); $j++){
                    $inisial_name = $explode_inisial_all[$j];
                    $nama = $_POST['nama_'.$alphabet.$inisial_name];
                    $Q = $_POST['Q_'.$alphabet.$inisial_name];
                    $F = $_POST['F_'.$alphabet.$inisial_name];
                    $tarif = $_POST['tarif_'.$alphabet.$inisial_name];
                    $subtotal = $_POST['subtotal_'.$alphabet.$inisial_name];
                    $persen_tw1 = $_POST['persen_tw1_'.$alphabet.$inisial_name];
                    $tw1 = $_POST['tw1_'.$alphabet.$inisial_name];
                    $persen_tw2 = $_POST['persen_tw2_'.$alphabet.$inisial_name];
                    $tw2 = $_POST['tw2_'.$alphabet.$inisial_name];
                    $persen_tw3 = $_POST['persen_tw3_'.$alphabet.$inisial_name];
                    $tw3 = $_POST['tw3_'.$alphabet.$inisial_name];
                    $persen_tw4 = $_POST['persen_tw4_'.$alphabet.$inisial_name];
                    $tw4 = $_POST['tw4_'.$alphabet.$inisial_name];
                    $group_default = $_POST['group_'.$alphabet.'_default'][$j];
                    for($k = 0; $k < sizeof($nama); $k++){

                        $this->get_add_anggaran->process(array(
                            'action' => 'insert',
                            'table' => 'tbldaftaratrincian',
                            'column_value' => array(
                                '"kode"' => $kode_group,
                                '"sbpkode"' => $sbpkode_group,
                                '"pktkode"' => $pktkode_rk_rincian,
                                '"rekmakode"' => $rekmakode_group,
                                '"group"' => $group_default,
                                '"satkerid"' => $id_satker,
                                '"nourut"' => ($k + 1),
                                '"rincian"' => $nama[$k],
                                '"tarifid"' => 0,
                                '"taridnom"' => $tarif[$k],
                                '"rinkuantitas"' => $Q[$k],
                                '"rinfrekwensi"' => $F[$k],
                                '"rintarif"' => $tarif[$k],
                                '"rintotal"' => $subtotal[$k],
                                '"rppt1perc"' => $persen_tw1[$k],
                                '"rppt2perc"' => $persen_tw2[$k],
                                '"rppt3perc"' => $persen_tw3[$k],
                                '"rppt4perc"' => $persen_tw4[$k],
                                '"rppt1nom"' => $tw1[$k],
                                '"rppt2nom"' => $tw2[$k],
                                '"rppt3nom"' => $tw3[$k],
                                '"rppt4nom"' => $tw4[$k]
                            )
                        ));
                        $affected_rincian = 0;
                        if($this->affected){
                            $affected_rincian = 1;
                        }
                    }
                }   
            }
            return $affected_group && $affected_rincian;
        }
        return false;
    }
    
    public function insert_anggaran(){
        if($this->input->post("kode_project_hidden")){
            if($this->allow_delete == "0"){
                Message::set("Create Data not allowed.");
                header('location: '.$GLOBALS['base_administrator'].'index.php/add-anggaran');
                exit();
            }
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);
            
            $this->insert_anggaran_process();
            
            if($this->commit_insert && $this->db->trans_status()){
                $this->db->trans_commit();
                header('location: '.$GLOBALS['base_administrator'].'index.php/add-anggaran');
            } else {
                $this->db->trans_rollback();
                set_title("Failed.");
                cetak_html("Gagal Delete.");
                Message::set("Insert failed.");
                header('location: '.$GLOBALS['base_administrator'].'index.php/add-anggaran');
            }
            
            exit();
        }
    }
    
    public function update_anggaran($param_id){
        if($this->input->post("kode_project_hidden")){
            if($this->allow_update == "0"){
                Message::set("Update Data not allowed.");
                header('location: '.$GLOBALS['base_administrator'].'index.php/add-anggaran/edit/' . $param_id);
                exit();
            }
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);
            
            $this->hapus_process($param_id);
            $this->insert_anggaran_process();
            
            if($this->commit_delete && $this->commit_insert && $this->db->trans_status()){
                $this->db->trans_commit();
                cetak_html("Berhasil Update.");
                Message::set("Berhasil Update.");
                $param_id = $this->redirect_kode_edit . "-" . $this->redirect_sbpkode_edit . "-" . $this->redirect_pktkode_edit . "-" . $this->redirect_rekmakode_edit;
                header('location: '.$GLOBALS['base_administrator'].'index.php/add-anggaran/edit/' . $param_id);
            } else {
                $this->db->trans_rollback();
                set_title("Failed.");
                cetak_html("Gagal Update.");
                Message::set("Gagal Update.");
                header('location: '.$GLOBALS['base_administrator'].'index.php/add-anggaran');
            }
            
            exit();
        }
    }
    
    private $kode_at;
    private $sbpkode_at;
    private $pktkode_at;
    private $rekmakode_at;
    private $debug_param = FALSE;
    private $commit_insert = FALSE;
    private $commit_delete = FALSE;
    function debug_param($param_id){
        if($this->debug_param){
            if($this->router->routes['translate_uri_dashes']){
                $param_id = str_replace("_", "-", $param_id);
            }
            set_title("Debug Param.");
            cetak_html($param_id);
            $explode_param_id = explode("-", $param_id);
            $kode = $explode_param_id[0];
            $sbpkode = isset($explode_param_id[1]) ? $explode_param_id[1] : "";
            $pktkode = isset($explode_param_id[2]) ? $explode_param_id[2] : "";
            $rekmakode = isset($explode_param_id[3]) ? $explode_param_id[3] : "";
            cetak_html($kode);
            cetak_html($sbpkode);
            cetak_html($pktkode);
            cetak_html($rekmakode);
            exit();
        }
    }
    
    public function process_param($param_id){
        $this->debug_param($param_id);
        if($this->router->routes['translate_uri_dashes']){
            $param_id = str_replace("_", "-", $param_id);
        }
        $explode_param_id = explode("-", $param_id);
        $kode = $explode_param_id[0];
        $sbpkode = isset($explode_param_id[1]) ? $explode_param_id[1] : "";
        $pktkode = isset($explode_param_id[2]) ? $explode_param_id[2] : "";
        $rekmakode = isset($explode_param_id[3]) ? $explode_param_id[3] : "";
        $this->kode_at = $kode;
        $this->sbpkode_at = $sbpkode;
        $this->pktkode_at = $pktkode;
        $this->rekmakode_at = $rekmakode;
    }
    
    public function hapus_process($param_id){
        $this->process_param($param_id);
        
        $this->get_add_anggaran->process(array(
            'action' => 'delete',
            'table' => 'tbldaftarat',
            'where' => 'kode = \''.$this->kode_at .'\' and sbpkode = \''.$this->sbpkode_at .'\' and pktkode = \''.$this->pktkode_at .'\''
        ));
        $affected_1 = $this->affected;
        
        $this->get_add_anggaran->process(array(
            'action' => 'delete',
            'table' => 'tbldaftaratgroup',
            'where' => 'kode = \''.$this->kode_at .'\' and sbpkode = \''.$this->sbpkode_at .'\' and pktkode = \''.$this->pktkode_at .'\''
        ));
        $affected_2 = $this->affected;
        
        $this->get_add_anggaran->process(array(
            'action' => 'delete',
            'table' => 'tbldaftaratrincian',
            'where' => 'kode = \''.$this->kode_at .'\' and sbpkode = \''.$this->sbpkode_at .'\' and pktkode = \''.$this->pktkode_at .'\''
        ));
        $affected_3 = $this->affected;
        
        if($affected_1 && $affected_2 && $affected_3){
            $this->commit_delete = TRUE;
        }
        
    }
    
    public function hapus_process_old($param_id){
        $this->process_param($param_id);
        $this->get_add_anggaran->process(array(
            'action' => 'delete',
            'table' => 'tbldaftarat',
            'where' => 'kode = \''.$this->kode_at .'\' and sbpkode = \''.$this->sbpkode_at .'\' and pktkode = \''.$this->pktkode_at .'\' and rekmakode = \''.$this->rekmakode_at .'\''
        ));
        $affected_1 = $this->affected;
        
        $this->get_add_anggaran->process(array(
            'action' => 'delete',
            'table' => 'tbldaftaratgroup',
            'where' => 'kode = \''.$this->kode_at .'\' and sbpkode = \''.$this->sbpkode_at .'\' and pktkode = \''.$this->pktkode_at .'\' and rekmakode = \''.$this->rekmakode_at .'\''
        ));
        $affected_2 = $this->affected;
             
        $this->get_add_anggaran->process(array(
            'action' => 'select',
            'table' => 'tbldaftaratrincian',
            'column_value' => array('*'),
            'where' => 'kode = \''.$this->kode_at .'\' and sbpkode = \''.$this->sbpkode_at .'\' and rekmakode = \''.$this->rekmakode_at .'\''
        ));
        
        $pktkode_rincian = "";
        $data_rincian = $this->all;
        if(sizeof($data_rincian) > 0){
            $pktkode_rincian = $data_rincian[0]->pktkode;
        }
        
        $this->get_add_anggaran->process(array(
            'action' => 'delete',
            'table' => 'tbldaftaratrincian',
            'where' => 'kode = \''.$this->kode_at .'\' and sbpkode = \''.$this->sbpkode_at .'\' and pktkode = \''.$this->pktkode_at .'\' and rekmakode = \''.$this->rekmakode_at .'\''
        ));
        $affected_3 = $this->affected;
        if($affected_1 && $affected_2 && $affected_3){
            $this->commit_delete = TRUE;
        }
    }
    
    public function hapus($param_id){
        
        if($this->input->post("kode_project_hidden")){
            if($this->allow_delete == "0"){
                Message::set("Delete Data not allowed.");
                header('location: '.$GLOBALS['base_administrator'].'index.php/add-anggaran');
                exit();
            }
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);

            $this->hapus_process($param_id);

            if($this->commit_delete && $this->db->trans_status()){
                $this->db->trans_commit();
                header('location: '.$GLOBALS['base_administrator'].'index.php/add-anggaran');
            } else {
                $this->db->trans_rollback();
                set_title("Failed.");
                cetak_html("Gagal Delete.");
                Message::set("Delete failed.");
                header('location: '.$GLOBALS['base_administrator'].'index.php/add-anggaran');
            }
            exit();
        }
        $this->get_data_edit($param_id);
        $this->get_data_edit_lanjutan($param_id);
        $this->layout->loadView(
            'add_anggaran_form',
            array(
                "hasil" => "abcd",
                "script" => $this->script_table(),
                'data_satker' => $this->aplikasi->data->satker,
                'update' => TRUE,
                'data_rincian_edit' => $this->data_rincian_edit,
                'data_group_edit' => $this->data_group_edit,
                'id_satker_edit' => $this->id_satker_edit,
                'data_rincian_kegiatan_edit' => $this->data_rincian_kegiatan_edit,
                'data_mata_anggaran_edit' => $this->data_mata_anggaran_edit,
                'data_rincian_kegiatan_display' => $this->data_rincian_kegiatan_display,
                'data_rincian_kegiatan_hidden' => $this->data_rincian_kegiatan_hidden,
                'data_mata_anggaran_display' => $this->data_mata_anggaran_display,
                'data_mata_anggaran_hidden' => $this->data_mata_anggaran_hidden,
                'konfirmasi_hapus' => true,
                
                // Edit Lanjutan
                'group_lanjutan' => $this->group_lanjutan,
                'mata_anggaran_lanjutan_display' => $this->mata_anggaran_lanjutan_display,
                'mata_anggaran_lanjutan_hidden' => $this->mata_anggaran_lanjutan_hidden,
                'rincian_lanjutan' => $this->rincian_lanjutan
            )
        );
    }
    
    private $data_rincian_edit = array();
    private $data_group_edit = array();
    private $data_rincian_kegiatan_edit = array();
    private $data_mata_anggaran_edit = array();
    private $id_satker_edit = array();
    private $data_rincian_kegiatan_display = "";
    private $data_rincian_kegiatan_hidden = "";
    private $data_mata_anggaran_display = "";
    private $data_mata_anggaran_hidden = "";
    public function get_data_edit($param_id){
        $this->process_param($param_id);
        
        // Get Group
        $this->get_add_anggaran->process(array(
            'action' => 'select',
            'table' => 'tbldaftaratgroup',
            'column_value' => array('*'),
            'where' => 'kode = \''.$this->kode_at .'\' and sbpkode = \''.$this->sbpkode_at .'\' and pktkode = \''.$this->pktkode_at .'\' and rekmakode = \''.$this->rekmakode_at .'\''
        ));
        $this->data_group_edit = $this->all;
        
        // Get Rincian
        $this->get_add_anggaran->process(array(
            'action' => 'select',
            'table' => 'tbldaftaratrincian',
            'column_value' => array('*'),
            'where' => 'kode = \''.$this->kode_at .'\' and sbpkode = \''.$this->sbpkode_at .'\' and rekmakode = \''.$this->rekmakode_at .'\''
        ));
        
        $pktkode_rincian = "";
        $data_rincian = $this->all;
        if(sizeof($data_rincian) > 0){
            $pktkode_rincian = $data_rincian[0]->pktkode;
        }
        
        $this->get_add_anggaran->process(array(
            'action' => 'select',
            'table' => 'tbldaftaratrincian',
            'column_value' => array('*'),
            'where' => 'kode = \''.$this->kode_at .'\' and sbpkode = \''.$this->sbpkode_at .'\' and rekmakode = \''.$this->rekmakode_at .'\''
        ));
        $this->data_rincian_edit = $this->all;
        
        // Get Rincian Kegiatan Edit
        $explode_pktkode_at = explode(".", $this->pktkode_at);
        // print_query();
        $kode_satker = $explode_pktkode_at[0];
        $this->get_add_anggaran->process(array(
            'action' => 'select',
            'table' => 'sp_search_pkt(\''.$this->kode_at.'\',\''.$kode_satker.'\')',
            'column_value' => array('*'),
            'where' => 'kode = \''.$this->kode_at .'\' and sbpkode = \''.$this->sbpkode_at .'\' and pktkode_rk = \''.$this->pktkode_at .'\''
        ));
        
        // echo "<pre>\n";
        // echo $pktkode_rincian . "\n";
        // print_r($this->all);
        // echo "</pre>\n";
        //exit();
        $this->id_satker_edit = $kode_satker;
        $this->data_rincian_kegiatan_edit = $this->all;
        
        if(sizeof($this->data_rincian_kegiatan_edit) > 0){
            $data_rincian_kegiatan_edit = $this->data_rincian_kegiatan_edit;
            $this->data_rincian_kegiatan_display = $data_rincian_kegiatan_edit[0]->pktkode_rk . " # " . $data_rincian_kegiatan_edit[0]->nama_rinciankegiatan;
            $this->data_rincian_kegiatan_hidden = $data_rincian_kegiatan_edit[0]->nama_satker . " ---- " . $data_rincian_kegiatan_edit[0]->pktkode_k . " ---- " . $data_rincian_kegiatan_edit[0]->nama_kegiatan . " ---- " . $data_rincian_kegiatan_edit[0]->pktkode_rk . " ---- " . $data_rincian_kegiatan_edit[0]->nama_rinciankegiatan . " ---- " . $data_rincian_kegiatan_edit[0]->sbpkode;
        }
        
        // Get Mata Anggaran Edit
        $this->get_add_anggaran->process(array(
            'action' => 'select',
            'table' => 'sp_search_mataanggaran(\''.$this->kode_at.'\',\''.$kode_satker.'\')',
            'column_value' => array('*'),
            'where' => 'rekmakode = \''.$this->rekmakode_at .'\''
        ));
        $this->data_mata_anggaran_edit = $this->all;
        
        if(sizeof($this->data_mata_anggaran_edit) > 0){
            $data_mata_anggaran_edit = $this->data_mata_anggaran_edit;
            $this->data_mata_anggaran_display = (substr($data_mata_anggaran_edit[0]->rekmakode,0,3) . "." . substr($data_mata_anggaran_edit[0]->rekmakode,3,3) . "." . substr($data_mata_anggaran_edit[0]->rekmakode,6)) . " # " . $data_mata_anggaran_edit[0]->nama_rekening;
            $this->data_mata_anggaran_hidden = $data_mata_anggaran_edit[0]->kode . " ---- " . $data_mata_anggaran_edit[0]->remagroup . " ---- " . $data_mata_anggaran_edit[0]->rekmakode . " ---- " . $data_mata_anggaran_edit[0]->nama_rekening;
        }
    }
    
    private $group_lanjutan = array();
    private $rincian_lanjutan = array();
    private $mata_anggaran_lanjutan_display = array();
    private $mata_anggaran_lanjutan_hidden = array();
    public function get_data_edit_lanjutan($param_id){
        $this->process_param($param_id);
        
        // Get Group
        $this->get_add_anggaran->process(array(
            'action' => 'select',
            'table' => 'tbldaftaratgroup',
            'column_value' => array('*'),
            'where' => 'kode = \''.$this->kode_at .'\' and sbpkode = \''.$this->sbpkode_at .'\' and pktkode = \''.$this->pktkode_at .'\' and rekmakode != \''.$this->rekmakode_at .'\''
        ));
        $group_lanjutan = $this->all;
        for($i = 0; $i < sizeof($group_lanjutan); $i++){
            if(!isset($this->group_lanjutan[$group_lanjutan[$i]->rekmakode])){
                $address_group_lanjutan = 0;
                $this->group_lanjutan[$group_lanjutan[$i]->rekmakode] = array();
                $this->group_lanjutan[$group_lanjutan[$i]->rekmakode][$address_group_lanjutan] = $group_lanjutan[$i];
                $address_group_lanjutan++;
            } else {
                $this->group_lanjutan[$group_lanjutan[$i]->rekmakode][$address_group_lanjutan] = $group_lanjutan[$i];
                $address_group_lanjutan++;
            }
        }
        
        $keys_mata_anggaran = array_keys($this->group_lanjutan);
        for($i = 0; $i < sizeof($keys_mata_anggaran); $i++){
            $this->get_add_anggaran->process(array(
                'action' => 'select',
                'table' => 'sp_search_mataanggaran(\''.$this->kode_at.'\',\''.$this->id_satker_edit.'\')',
                'column_value' => array('*'),
                'where' => 'rekmakode = \''.$keys_mata_anggaran[$i].'\''
            ));
            $data_mata_anggaran_edit = $this->all;
            if(sizeof($data_mata_anggaran_edit) > 0){
                $this->mata_anggaran_lanjutan_display[$keys_mata_anggaran[$i]] = (substr($data_mata_anggaran_edit[0]->rekmakode,0,3) . "." . substr($data_mata_anggaran_edit[0]->rekmakode,3,3) . "." . substr($data_mata_anggaran_edit[0]->rekmakode,6)) . " # " . $data_mata_anggaran_edit[0]->nama_rekening;
                $this->mata_anggaran_lanjutan_hidden[$keys_mata_anggaran[$i]] = $data_mata_anggaran_edit[0]->kode . " ---- " . $data_mata_anggaran_edit[0]->remagroup . " ---- " . $data_mata_anggaran_edit[0]->rekmakode . " ---- " . $data_mata_anggaran_edit[0]->nama_rekening;
            }
        }
        
        // Get Rincian
        $this->get_add_anggaran->process(array(
            'action' => 'select',
            'table' => 'tbldaftaratrincian',
            'column_value' => array('*'),
            'where' => 'kode = \''.$this->kode_at .'\' and sbpkode = \''.$this->sbpkode_at .'\' and rekmakode != \''.$this->rekmakode_at .'\''
        ));
        $rincian_lanjutan = $this->all;
        for($i = 0; $i < sizeof($rincian_lanjutan); $i++){
            if(!isset($this->rincian_lanjutan[$rincian_lanjutan[$i]->rekmakode . $rincian_lanjutan[$i]->group])){
                $address_rincian_lanjutan = 0;
                $this->rincian_lanjutan[$rincian_lanjutan[$i]->rekmakode . $rincian_lanjutan[$i]->group] = array();
                $this->rincian_lanjutan[$rincian_lanjutan[$i]->rekmakode . $rincian_lanjutan[$i]->group][$address_rincian_lanjutan] = $rincian_lanjutan[$i];
                $address_rincian_lanjutan++;
            } else {
                $this->rincian_lanjutan[$rincian_lanjutan[$i]->rekmakode . $rincian_lanjutan[$i]->group][$address_rincian_lanjutan] = $rincian_lanjutan[$i];
                $address_rincian_lanjutan++;
            }
        }
        
        // echo "<div style='display: none;'>\n";
        // print_r($this->group_lanjutan);
        // print_r($this->mata_anggaran_lanjutan_display);
        // print_r($this->mata_anggaran_lanjutan_hidden);
        // print_r($this->rincian_lanjutan);
        // echo "</div>\n";
        
    }
    
    public function edit($param_id){
        $this->update_anggaran($param_id);
        $this->get_data_edit($param_id);
        $this->get_data_edit_lanjutan($param_id);
        $this->layout->loadView(
            'add_anggaran_form',
            array(
                "hasil" => "abcd",
                "script" => $this->script_table(),
                'data_satker' => $this->aplikasi->data->satker,
                'update' => TRUE,
                'data_rincian_edit' => $this->data_rincian_edit,
                'data_group_edit' => $this->data_group_edit,
                'id_satker_edit' => $this->id_satker_edit,
                'data_rincian_kegiatan_edit' => $this->data_rincian_kegiatan_edit,
                'data_mata_anggaran_edit' => $this->data_mata_anggaran_edit,
                'data_rincian_kegiatan_display' => $this->data_rincian_kegiatan_display,
                'data_rincian_kegiatan_hidden' => $this->data_rincian_kegiatan_hidden,
                'data_mata_anggaran_display' => $this->data_mata_anggaran_display,
                'data_mata_anggaran_hidden' => $this->data_mata_anggaran_hidden,
                
                // Edit Lanjutan
                'group_lanjutan' => $this->group_lanjutan,
                'mata_anggaran_lanjutan_display' => $this->mata_anggaran_lanjutan_display,
                'mata_anggaran_lanjutan_hidden' => $this->mata_anggaran_lanjutan_hidden,
                'rincian_lanjutan' => $this->rincian_lanjutan
                
            )
        );
    }
    
    public function add(){
        $this->insert_anggaran();
        $this->layout->loadView(
            'add_anggaran_form',
            array(
                "hasil" => "abcd",
                "script" => $this->script_table(),
                'data_satker' => $this->aplikasi->data->satker
            )
        );
    }
    
    public function index(){
        $this->layout->loadView(
            'add_anggaran_list',
            array(
                "hasil" => "abcd",
                "script" => $this->script_table(),
                'data_satker' => $this->aplikasi->data->satker
            )
        );
    }
    
    public function inbox(){
        $this->layout->loadView('inbox_view');
    }
}
