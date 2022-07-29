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

    public function script_table(){
        return $this->layout->loadjs("add_anggaran/get_add_anggaran");
    }
    
    public function get_style(){
        $process_report_excel = new process_report_excel();
        $process_report_excel->test_get_style();
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
    
    public function index() {
        if($this->input->post("kode_project_hidden")){
            // echo "<pre>\n";
            // print_r($_POST);
            
            //Table tbldaftarat
            $explode_kegiatan_program_kerja_rincian_hidden = explode(" ---- ", $_POST['kegiatan_program_kerja_rincian_hidden']);
            $explode_mata_anggaran_hidden = explode(" ---- ", $_POST['mata_anggaran_hidden']);
            $kode_at = $_POST['kode_project_hidden'];
            $sbpkode_at = $explode_kegiatan_program_kerja_rincian_hidden[3];
            $pktkode_at = $explode_kegiatan_program_kerja_rincian_hidden[1];
            $rekmakode_at = $explode_mata_anggaran_hidden[2];
            $keterangan = "-";
            print_r($explode_kegiatan_program_kerja_rincian_hidden);
            //print_query();
            
            $this->get_add_anggaran->process(array(
                'action' => 'insert',
                'table' => 'tbldaftarat',
                'column_value' => array(
                    'kode' => $kode_at,
                    'sbpkode' => $sbpkode_at,
                    'pktkode' => $pktkode_at,
                    'rekmakode' => $rekmakode_at,
                    'keterangan' => $keterangan
                )
            )); 
            
            // Table tbldaftaratgroup
            // echo "AAAAA";
            print_r($_POST['group_default']);
            for($i = 0; $i < sizeof($_POST['group_default']); $i++){
                $group_default = $_POST['group_default'][$i];
                $kode_group = $_POST['kode_project_hidden'];
                $sbpkode_group = $explode_kegiatan_program_kerja_rincian_hidden[3];
                $pktkode_group = $explode_kegiatan_program_kerja_rincian_hidden[1];
                $rekmakode_group = $explode_mata_anggaran_hidden[2];
                $group_group = $group_default;
                
                $this->get_add_anggaran->process(array(
                    'action' => 'insert',
                    'table' => 'tbldaftaratgroup',
                    'column_value' => array(
                        '"kode"' => $kode_group,
                        '"sbpkode"' => $sbpkode_group,
                        '"pktkode"' => $pktkode_group,
                        '"rekmakode"' => $rekmakode_group,
                        '"group"' => $group_group
                    )
                ));
            }
            
            //Table tbldaftaratrincian
            $info_satker = $explode_kegiatan_program_kerja_rincian_hidden[0];
            $explode_satker = explode("(", $info_satker);
            $explode_satker_2 = explode(")", $explode_satker[1]);
            $id_satker = $explode_satker_2[0];
            $explode_inisial_all = explode(",", $_POST['inisial_all']);
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
                            '"pktkode"' => $pktkode_group,
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
                }
            }
            // echo "</pre>\n";
            header('location: '.$GLOBALS['base_administrator'].'index.php/add-anggaran');
            exit();
        }
        $this->layout->loadView(
            'add_anggaran_form',
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