<?php

// function helper
function escapeString($val) {
    $db = get_instance()->db->conn_id;
    $val_ = mysqli_real_escape_string($db, $val);
    return $val_;
}

function samakan_($param1, $param2){
    $paramA = (string) $param1;
    $paramB = (string) $param2;
    $result = "";
    $selisih = strlen($paramB) - strlen($paramA);
    for($i = 0; $i < $selisih; $i++){
        $result = $result . "0";
    }
    return $result . $paramA;
}

function get_data($table, $columns){
    $db = get_instance()->db->conn_id;
    $cl = "";
    $cm = "";
    for($i = 0; $i < sizeof($columns); $i++){
        $cl = $cl . $cm . $columns[$i];
        $cm = ",";
    }
    $query_db = mysqli_query($db, "select " . $cl . " from " . $table);
    return $query_db;
}

function get_connection(){
    $db = get_instance()->db->conn_id;
    return $db;
}

function validId($id) {
    return preg_match('/^[a-zA-Z0-9_-]{11}$/', $id) > 0;
}

function dir_upload($folder_name = ""){
    return __DIR__ . "/../../upload/" . $folder_name;
}

function rename_file($name_file){
    $explode_type = explode(".", $name_file);
    $type_file = $explode_type[sizeof($explode_type) - 1];
    $name_file = "FILE" . date("YmdHis") . "." . $type_file;
    return $name_file;
}

function upload_file($key_folder){
    $CI =& get_instance();
    $CI->name_file = "";
    $CI->name_file_upload = "";
    $explode_key = explode("_", $key_folder);
    if(isset($explode_key[1]) && $explode_key[1] != ""){
        $rest_name_ = "";
        for($i = 1; $i < sizeof($explode_key); $i++){
            $rest_name_ = $rest_name_ . "_" . $explode_key[$i];
        }
        $name_table = "tbl" . $rest_name_;
        $id_data = isset($_GET['id']) && $_GET['id'] != "" ? $_GET['id'] : "0";
        $name_kolom = $key_folder;
        // echo "AAAA";
        // echo "select ".$name_kolom." from ".$name_table." where id = '".$id_data."'";
        // exit();
        $query_data = $CI->db->query("select ".$name_kolom." from ".$name_table." where id = '".$id_data."'");
        if(sizeof($query_data->result_array()) > 0){
            $hasil_data = $query_data->result_array();
            $file_existing = $hasil_data[0][$name_kolom];
            $CI->name_file = $file_existing;
            $CI->name_file_upload = $CI->name_file;
        }
    }
    
    if(isset($_FILES[$key_folder]) && is_array($_FILES[$key_folder])){
        $FILE_UPLOAD = $_FILES[$key_folder];
        if(isset($FILE_UPLOAD['tmp_name']) && $FILE_UPLOAD['tmp_name'] != ""){
            $temp = $FILE_UPLOAD['tmp_name'];
            $name = rename_file($FILE_UPLOAD['name']);
            $folder = dir_upload($key_folder);
            $dest = $folder . "/" . $name;
            $CI->name_file_upload = $name;
            move_uploaded_file($temp, $dest);
            if(isset($file_existing) && $file_existing != "" && file_exists($folder . "/" . $file_existing)){
                unlink($folder . "/" . $file_existing);
            }
        }
    }
}

function &get_instance_loader(){
    return CI_Loader::get_instance();
}

function initialize_upload_dir(){
    $loader =& get_instance_loader();
    $loader->dir_upload_photo_artikel = dir_upload("photo_artikel");
    $loader->dir_upload_photo_video = dir_upload("photo_video");
    $loader->dir_upload_photo_admin = dir_upload("photo_admin");
    $loader->dir_upload_photo_user = dir_upload("photo_user");
        
}

function delete_photo($key_folder){
    $CI =& get_instance();
    $explode_key = explode("_", $key_folder);
    $folder = dir_upload($key_folder);
    if(isset($explode_key[1]) && $explode_key[1] != ""){
        $rest_name_ = "";
        for($i = 1; $i < sizeof($explode_key); $i++){
            $rest_name_ = $rest_name_ . "_" . $explode_key[$i];
        }
        $name_table = "tbl" . $rest_name_;
        $id_data = isset($_GET['id']) ? $_GET['id'] : "";
        $name_kolom = $key_folder;
        $db = $CI->db->conn_id;
        $query_data = mysqli_query($db, "select ".$name_kolom." from ".$name_table." where id = '".$id_data."'");
        if(mysqli_num_rows($query_data) > 0){
            $hasil_data = mysqli_fetch_array($query_data);
            $file_existing = $hasil_data[$name_kolom];
        }
    }
    if(isset($file_existing) && $file_existing != "" && file_exists($folder . "/" . $file_existing)){
        unlink($folder . "/" . $file_existing);
    }
}

function show_photo_table($name_active, $file_name){
    if($file_name != "" && file_exists(dir_upload($name_active) . "/" . $file_name) && @exif_imagetype(dir_upload($name_active) . "/" . $file_name)){
        $image = "<img src=\"../../../upload/".$name_active."/".$file_name."\" style=\"width: 200px;\" />";
    } else {
        $image = "(NOIMAGE)";
    }
    return $image;
}

function show_photo($name_active, $file_name){
    $explode_title = explode("_", $name_active);
    $title_result = ucfirst($explode_title[0]) . " " . ucfirst($explode_title[1]);
    ?>
    <div class="form-group">
        <label for="<?php echo $name_active; ?>" class="col-lg-2 control-label"><?php echo $title_result; ?></label>
        <div class="col-lg-10">
            <?php if($file_name != "" && file_exists(dir_upload($name_active) . "/" . $file_name) && @exif_imagetype(dir_upload($name_active) . "/" . $file_name)){ ?>
            <div id="tampil_gambar" style="width: 100%; margin-top: 4px; border-top: #d0d0d0 1px solid; border-right: #d0d0d0 1px solid; border-left: #d0d0d0 1px solid; padding: 5px;" align="center">
                <img src="../../../upload/<?php echo $name_active; ?>/<?php echo $file_name; ?>" style="width: 250px;" />
            </div>
            <?php } else { ?>
            <div id="tampil_gambar" style="display: none; width: 100%; margin-top: 4px; border-top: #d0d0d0 1px solid; border-right: #d0d0d0 1px solid; border-left: #d0d0d0 1px solid; padding: 5px;" align="center">
                <img src="" style="display: none;">                    
            </div>
            <?php } ?>
            <input onchange="readURL(this);" type="file" id="<?php echo $name_active; ?>" class="form-control" name="<?php echo $name_active; ?>" />
        </div>
    </div>
    <?php
}

function do_increment($param, $type = "HEX"){
    if($type == "ALP"){
        $huruf_angka = array(
            "A" =>  0,
            "B" =>  1,
            "C" =>  2,
            "D" =>  3,
            "E" =>  4,
            "F" =>  5,
            "G" =>  6,
            "H" =>  7,
            "I" =>  8,
            "J" =>  9,
            "K" => 10,
            "L" => 11,
            "M" => 12,
            "N" => 13,
            "O" => 14,
            "P" => 15,
            "Q" => 16,
            "R" => 17,
            "S" => 18,
            "T" => 19,
            "U" => 20,
            "V" => 21,
            "W" => 22,
            "X" => 23,
            "Y" => 24,
            "Z" => 25
        );
        $angka_huruf = array(
            0  => "A",
            1  => "B",
            2  => "C",
            3  => "D",
            4  => "E",
            5  => "F",
            6  => "G",
            7  => "H",
            8  => "I",
            9  => "J",
            10 => "K",
            11 => "L",
            12 => "M",
            13 => "N",
            14 => "O",
            15 => "P",
            16 => "Q",
            17 => "R",
            18 => "S",
            19 => "T",
            20 => "U",
            21 => "V",
            22 => "W",
            23 => "X",
            24 => "Y",
            25 => "Z",
        );
        $increment = 0;
    }
    if($type == "HEX"){
        $huruf_angka = array(
            "0" =>  0,
            "1" =>  1,
            "2" =>  2,
            "3" =>  3,
            "4" =>  4,
            "5" =>  5,
            "6" =>  6,
            "7" =>  7,
            "8" =>  8,
            "9" =>  9,
            "A" => 10,
            "B" => 11,
            "C" => 12,
            "D" => 13,
            "E" => 14,
            "F" => 15
        );
        $angka_huruf = array(
            0  => "0",
            1  => "1",
            2  => "2",
            3  => "3",
            4  => "4",
            5  => "5",
            6  => "6",
            7  => "7",
            8  => "8",
            9  => "9",
            10 => "A",
            11 => "B",
            12 => "C",
            13 => "D",
            14 => "E",
            15 => "F"
        );
        $increment = 1;
    }
    if($type == "DEC"){
        $huruf_angka = array(
            "0" =>  0,
            "1" =>  1,
            "2" =>  2,
            "3" =>  3,
            "4" =>  4,
            "5" =>  5,
            "6" =>  6,
            "7" =>  7,
            "8" =>  8,
            "9" =>  9
        );
        $angka_huruf = array(
            0  => "0",
            1  => "1",
            2  => "2",
            3  => "3",
            4  => "4",
            5  => "5",
            6  => "6",
            7  => "7",
            8  => "8",
            9  => "9"
        );
        $increment = 1;
    }
    if($type == "OCT"){
        $huruf_angka = array(
            "0" =>  0,
            "1" =>  1,
            "2" =>  2,
            "3" =>  3,
            "4" =>  4,
            "5" =>  5,
            "6" =>  6,
            "7" =>  7
        );
        $angka_huruf = array(
            0  => "0",
            1  => "1",
            2  => "2",
            3  => "3",
            4  => "4",
            5  => "5",
            6  => "6",
            7  => "7"
        );
        $increment = 1;
    }
    if($type == "BIN"){
        $huruf_angka = array(
            "0" =>  0,
            "1" =>  1
        );
        $angka_huruf = array(
            0  => "0",
            1  => "1"
        );
        $increment = 1;
    }
    $param_string = (string) $param;
    $result = "";
    $result_reserve = "";
    $after_f = 0;
    $count_f = 0;
    $keys = array_keys($huruf_angka);
    $last = $keys[sizeof($keys) - 1];
    $begin = $keys[0];
    for($i = strlen($param_string) - 1; $i >= 0; $i--){
        if(!$after_f){
            if($param_string[$i] == $last){
                $result_reserve = $result_reserve . $begin;
                $count_f++;
            } else {
                $angka = $huruf_angka[$param_string[$i]];
                $huruf = $angka_huruf[$angka + 1];
                $result_reserve = $result_reserve . $huruf;
                $after_f = 1;
            }
        } else {
            $result_reserve = $result_reserve . $param_string[$i];
        }
    }
    if($count_f == strlen($param_string)){
        $result = $keys[0 + $increment] . $result_reserve;
    } else {
        for($i = strlen($result_reserve) - 1; $i >= 0; $i--){
            $result = $result . $result_reserve[$i];
        }
    }
    return $result;
}

function convert_alphabet($param){
    $param_hex = 0;
    $param_dec = 0;
    $param_oct = 0;
    $param_bin = 0;
    $param_alp = "A";
    for($i = 0; $i < (int) $param; $i++){
        $param_alp = do_increment($param_alp, "ALP");
    }
    return array(
        $param_alp,
        $param_bin,
        $param_oct,
        $param_dec,
        $param_hex
    );
}

function print_query(){
    $GLOBALS['debug_query'] = true;
}

function post_raw($name_post){
    return isset($_POST[$name_post]) ? $_POST[$name_post] : $name_post;
}

function set_title($title){
    echo "<title>".$title."</title>\n<style>html, body{font-family: consolas, monospace;}</style>\n";
}

function cetak_html($param){
    if(is_array($param)){
        echo "<pre>\n";
        print_r($param);
        echo "</pre>\n";
    } else {
        echo $param . "<br />\n";
    }
}

function set_titik($param){
    $param = (string) $param;
    $hasil = "";
    $jumlah = strlen($param);
    while(true){
        if($jumlah > 3){
            $jumlah = $jumlah - 3;
            $hasil = "," . substr($param, $jumlah, 3) . $hasil;
        } else {
            $hasil = substr($param, 0, $jumlah) . $hasil;
            break;
            
        }
    }
    return $hasil;
}

function tolong_jadiin_dua_angka_aja_di_belakang_koma($param){
    $param = (string) $param;
    $explode_param = explode(".", $param);
    $angka_asli = $explode_param[0];
    $angka_koma = isset($explode_param[1]) ? $explode_param[1] : "";
    return $angka_asli . ($angka_koma != "" ? "." . (strlen($angka_koma) > 2 ? $angka_koma[0] . $angka_koma[1] : $angka_koma . "0") : "");
}

function set_titik_gaya_indonesia($param,$angka_di_belakang_koma_default = false){
    $param = (string) $param;
    $explode_param = explode(".", $param);
    $angka_asli = $explode_param[0];
    $angka_koma = isset($explode_param[1]) ? $explode_param[1] : "";
    $hasil = "";
    $jumlah = strlen($angka_asli);
    while(true){
        if($jumlah > 3){
            $jumlah = $jumlah - 3;
            $hasil = "." . substr($angka_asli, $jumlah, 3) . $hasil;
        } else {
            $hasil = substr($angka_asli, 0, $jumlah) . $hasil;
            break;
            
        }
    }
    return $hasil . ($angka_koma != "" ? "," . (strlen($angka_koma) > 2 ? $angka_koma[0] . $angka_koma[1] : $angka_koma) : ($angka_di_belakang_koma_default ? ",00" : ""));
}

function remove_comma_decimal($param){
    $explode_titik = explode(".", $param);
    $hasil = true;
    if(isset($explode_titik[1]) && $explode_titik[1] != ""){
        for($i = 0; $i < strlen($explode_titik[1]); $i++){
            if($explode_titik[1][$i] != 0){
                $hasil = false;
                break;
            }
        }
    }
    if($hasil && $explode_titik[0] != 0){
        return $explode_titik[0];
    } else {
        return $param;
    }
}

// Project Modal
function project_modal(){
    $CI =& get_instance();
    $CI->layout = new layout('lite');
    $CI->load->model('get_project');
    $CI->get_project->process(array(
        'action' => 'select',
        'table' => 'tblproject',
        'column_value' => array(
            'kode'
        ),
        'order' => ' tahunanggaran desc'
    ));
    $data = $CI->all;
    $CI->project_modal = "UNDEFINED";
    if(sizeof($data) > 0){
        $CI->get_project->process(array(
            'action' => 'select',
            'table' => 'tblproject',
            'column_value' => array(
                'kode'
            ),
            'where' => (isset($_SESSION['PROJECT_ACTIVE']) && $_SESSION['PROJECT_ACTIVE'] != "" ? 'kode = \''.$_SESSION['PROJECT_ACTIVE'].'\'' : ''),
            'order' => ' tahunanggaran desc'
        ));
        $data_where = $CI->all;
        $CI->project_modal = $data_where[0]->kode;
    }
    return $CI->layout->loadView(array(
        "set_ob_view" => "dialog/dialog-project"
    ), array(
        "data_project" => $data
    ));
}

function rincian_kegiatan_modal(){
    $CI =& get_instance();
    $CI->layout = new layout('lite');
    return $CI->layout->loadView(array(
        "set_ob_view" => "dialog/dialog-rincian-kegiatan"
    ));
}

function mata_anggaran_modal(){
    $CI =& get_instance();
    $CI->layout = new layout('lite');
    return $CI->layout->loadView(array(
        "set_ob_view" => "dialog/dialog-mata-anggaran"
    ));
}

function iku_pkt_modal(){
    $CI =& get_instance();
    $CI->layout = new layout('lite');
    return $CI->layout->loadView(array(
        "set_ob_view" => "dialog/dialog-iku"
    ));
}

function sbpps_pkt_modal(){
    $CI =& get_instance();
    $CI->layout = new layout('lite');
    return $CI->layout->loadView(array(
        "set_ob_view" => "dialog/dialog-sbpps"
    ));
}

function kegiatan_modal(){
    $CI =& get_instance();
    $CI->layout = new layout('lite');
    return $CI->layout->loadView(array(
        "set_ob_view" => "dialog/dialog-kegiatan"
    ));
}

function kode_ps_modal(){
    $CI =& get_instance();
    $CI->layout = new layout('lite');
    return $CI->layout->loadView(array(
        "set_ob_view" => "dialog/dialog-kode-ps"
    ));
}

function project_test(){
    $CI =& get_instance();
    $CI->layout = new layout('lite');
    return $CI->layout->loadView(array(
        "set_ob_view" => "dialog/dialog-test"
    ));
}

function master_tarif(){
    $CI =& get_instance();
    $CI->layout = new layout('lite');
    return $CI->layout->loadView(array(
        "set_ob_view" => "dialog/dialog-master-tarif"
    ));
}

// function onload
function get_project(){
    $CI =& get_instance();
    $CI->load->model('get_project');
    $CI->get_project->process(array(
        'action' => 'select',
        'table' => 'tblproject',
        'column_value' => array(
            'kode',
            'allowcrud'
        ),
        'where' => (isset($_SESSION['PROJECT_ACTIVE']) && $_SESSION['PROJECT_ACTIVE'] != "" ? 'kode = \''.$_SESSION['PROJECT_ACTIVE'].'\'' : ''),
        'order' => ' tahunanggaran desc'
    ));
    $data = $CI->all;
    if(sizeof($data) > 0){
        $GLOBALS['kode_project'] = $data[0]->kode;
        $GLOBALS['allowcrud_project'] = $data[0]->allowcrud;
        $CI->kode_project_scope_controller = $GLOBALS['kode_project'];
        return "<div id='button-project' style='cursor: pointer; color: red;'>Project " . $data[0]->kode . "</div>";
    } else {
        return "No Project.";
    }
}

function get_current_project(){
    $CI =& get_instance();
    if(isset($_SESSION) && is_array($_SESSION) && isset($_SESSION['data_satker'])){
        $CI->aplikasi = new stdClass();
        $CI->aplikasi->data = new stdClass();
        $CI->aplikasi->data->satker = $_SESSION['data_satker'];
        $CI->aplikasi->data->satker_string = $_SESSION['data_satker_comma'];
    }
    get_project();
}