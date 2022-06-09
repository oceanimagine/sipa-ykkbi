<?php

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
        $id_data = isset($_GET['id']) ? $_GET['id'] : "";
        $name_kolom = $key_folder;
        $db = $CI->db->conn_id;
        $query_data = mysqli_query($db, "select ".$name_kolom." from ".$name_table." where id = '".$id_data."'");
        if(mysqli_num_rows($query_data) > 0){
            $hasil_data = mysqli_fetch_array($query_data);
            $file_existing = $hasil_data[$name_kolom];
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