<?php

define('BASEPATH', "../application/config");
include_once __DIR__ . "/../config/connect-list.php";
include_once __DIR__ . "/../config/connect.php";
include BASEPATH . "/database.php";

$host = $db['default']['hostname'];
$user = $db['default']['username'];
$pass = $db['default']['password'];
$data = $db['default']['database'];

$nama_tabel = "hdcasedaftar";
$connect = mysqli_connect($host, $user, $pass, $data);
$id_prefiks = strtoupper(substr($nama_tabel, 0, 3));

$query_describe = mysqli_query($connect, "describe " . $nama_tabel);
$array_password_label = array(
    "password",
    "pass",
    "pwd"
);
$array_email_label = array(
    "email",
    "mail"
);
$array_google_drive_label = array(
    "google_drive_pdf",
    "google_pdf"
);
$array_date_label = array(
    "tanggal",
    "tggl",
    "date",
    "tgl"
);
$array_photo_label = array(
    "photo",
    "foto",
    "picture",
    "gambar",
    "pic",
    "picture"
);
$array_youtube_label = array(
    "youtube",
    "tube"
);
$array_latlong_label = array(
    "latlong",
    "latitudelongitude"
);
$array_jam_label = array(
    "jam"
);
$array_id_not_include_label = array(
    "id"
);
function is_alphabet($param){
    $huruf = array(
        "a" => true,
        "b" => true,
        "c" => true,
        "d" => true,
        "e" => true,
        "f" => true,
        "g" => true,
        "h" => true,
        "i" => true,
        "j" => true,
        "k" => true,
        "l" => true,
        "m" => true,
        "n" => true,
        "o" => true,
        "p" => true,
        "q" => true,
        "r" => true,
        "s" => true,
        "t" => true,
        "u" => true,
        "v" => true,
        "w" => true,
        "x" => true,
        "y" => true,
        "z" => true
    );
    return isset($huruf[strtolower($param)]) ? true : false;
}
function is_vocal_alphabet($param){
    $huruf = array(
        "a" => true,
        "i" => true,
        "u" => true,
        "e" => true,
        "o" => true
    );
    return isset($huruf[strtolower($param)]) ? true : false;
}
function is_consonant_alphabet($param){
    $huruf = array(
        "b" => true,
        "c" => true,
        "d" => true,
        "f" => true,
        "g" => true,
        "h" => true,
        "j" => true,
        "k" => true,
        "l" => true,
        "m" => true,
        "n" => true,
        "p" => true,
        "q" => true,
        "r" => true,
        "s" => true,
        "t" => true,
        "v" => true,
        "w" => true,
        "x" => true,
        "y" => true,
        "z" => true
    );
    return isset($huruf[strtolower($param)]) ? true : false;
}
function contain_name($strlower_name, $array_contain){
    $address = 0;
    $returns = false;
    $i = 0;
    while(isset($strlower_name{$address})){
        if(isset($array_contain[$i]) && substr($strlower_name, $address, strlen($array_contain[$i])) == $array_contain[$i]){
            $final_check = 0;
            if(isset($strlower_name{$address + strlen($array_contain[$i])})){
                if(is_consonant_alphabet($strlower_name{($address + strlen($array_contain[$i])) - 1})){
                    if(is_vocal_alphabet($strlower_name{($address + strlen($array_contain[$i]))})){
                        $final_check = 1;
                    }
                    if(is_consonant_alphabet($strlower_name{($address + strlen($array_contain[$i]))})){
                        if(isset($strlower_name{($address + strlen($array_contain[$i])) + 1})){
                            if(is_vocal_alphabet($strlower_name{($address + strlen($array_contain[$i])) + 1})){
                                $final_check = 1;
                            }
                        }
                    }
                }
                if(is_vocal_alphabet($strlower_name{($address + strlen($array_contain[$i])) - 1})){
                    if($strlower_name{($address + strlen($array_contain[$i])) - 1} != $strlower_name{($address + strlen($array_contain[$i]))}){
                        if(is_alphabet($strlower_name{($address + strlen($array_contain[$i]))}) && is_consonant_alphabet($strlower_name{($address + strlen($array_contain[$i]))})){
                            if(isset($strlower_name{($address + strlen($array_contain[$i])) + 1}) && isset($strlower_name{($address + strlen($array_contain[$i])) + 2})){
                                if(is_vocal_alphabet($strlower_name{($address + strlen($array_contain[$i])) + 1}) && is_consonant_alphabet($strlower_name{($address + strlen($array_contain[$i])) + 2})){
                                    $final_check = 1;
                                }
                            }
                        } else {
                            $final_check = 1;
                        }
                    }
                }
            }
            if($final_check || (isset($strlower_name{$address + strlen($array_contain[$i])}) && !is_alphabet($strlower_name{$address + strlen($array_contain[$i])}))){
                $returns = true;
            } else {
                if(!isset($strlower_name{$address + strlen($array_contain[$i])})){
                    $returns = true;
                }
            }
            break;
        }
        if($i < sizeof($array_contain)){
            $i++;
        } else {
            $i = 0;
            $address++;
        }
    }
    return $returns;
}
function change_name($name_underscore){
    $results_name = "";
    $explode_name = explode("_", $name_underscore);
    $space = "";
    for($i = 0; $i < sizeof($explode_name); $i++){
        $results_name = $results_name . $space . ucfirst($explode_name[$i]);
        $space = " ";
    }
    return $results_name;
}

if(mysqli_num_rows($query_describe) > 0){
    
    $explode_key = explode("_", $nama_tabel);
    $underscore_ = "";
    $rest_name_ = "";
    for($i = 1; $i < sizeof($explode_key); $i++){
        $rest_name_ = $rest_name_ . $underscore_ . $explode_key[$i];
        $underscore_ = "_";
    }
    if($rest_name_ == ""){
        $rest_name_ = $nama_tabel;
    }
    $maps_active = 0;
    $maps_count = 0;
    $google_drive_pdf = 0;
    $google_drive_pdf_id = "";
    ob_start();
    ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo change_name($rest_name_); ?> Form</title>
    <style type="text/css">
        html, body {
            font-family: consolas, monospace;
            cursor: default;
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0px;
        }
        pre {
            font-family: consolas, monospace;
        }
    </style>
    <script type="text/javascript">
        /* Put JS Here */ 
        function move_url(link){
            document.location = "../../../index.php/" + link;
        }
        /* JS Latlong Here */ 

    </script>
</head>
<body>
    <form class="form-horizontal" method="POST" enctype="multipart/form-data"{id_form}>
        <div class="box-body">
            <?php $address = 0; ?>
            <?php while($hasil_describe = mysqli_fetch_array($query_describe)){ $real_name = str_replace(" ", "_", $hasil_describe['Field']); ?>
            <?php if(strtolower($hasil_describe['Key']) != strtolower("PRI") && $hasil_describe['Field'] != "timestamp"){ ?>
            <?php if((strtolower(substr($hasil_describe['Type'], 0, strlen("varchar"))) == "varchar" || strtolower(substr($hasil_describe['Type'], 0, strlen("int"))) == "int" || strtolower(substr($hasil_describe['Type'], 0, strlen("date"))) == "date") && substr($hasil_describe['Field'], 0, strlen("id_")) != "id_" && !contain_name(strtolower($hasil_describe['Field']), $array_id_not_include_label) && !contain_name(strtolower($hasil_describe['Field']), $array_photo_label) && !contain_name(strtolower($hasil_describe['Field']), $array_latlong_label)){ 
            
            $type = "text";
            $class_date = "";
            /* Field */
            if(contain_name(strtolower($hasil_describe['Field']), $array_password_label)){
                $type = "password";
            }
            if(contain_name(strtolower($hasil_describe['Field']), $array_email_label)){
                $type = "email";
            }
            if(contain_name(strtolower($hasil_describe['Field']), $array_google_drive_label)){
                $google_drive_pdf = 1;
                $google_drive_pdf_id = $real_name;
            }
            if(contain_name(strtolower($hasil_describe['Field']), $array_date_label)){
                $class_date = " tanggal_pilih";
            }
            if(contain_name(strtolower($hasil_describe['Field']), $array_jam_label)){
                $class_date = " jam";
            }
            /* Type */
            if(strtolower(substr($hasil_describe['Type'], 0, strlen("int"))) == "int"){
                $type = "number";
            }
            if(strtolower(substr($hasil_describe['Type'], 0, strlen("date"))) == "date"){
                $class_date = " tanggal_pilih";
            }
            ?>
            
            <div class="form-group">
                <label for="<?php echo $real_name; ?>" class="col-lg-2 control-label"><?php echo change_name($real_name); ?></label>
                <div class="col-lg-10">
                    <input type="<?php echo $type; ?>" id="<?php echo $real_name; ?>" class="form-control<?php echo $class_date; ?>" name="<?php echo $real_name; ?>" placeholder="<?php echo change_name($real_name); ?>" value="<?php echo '<?php echo isset($'.$real_name.') ? $'.$real_name.' : ""; ?>'; ?>">
                </div>
            </div>
            <?php } ?>
            <?php if(strtolower($hasil_describe['Key']) != strtolower("PRI") && $hasil_describe['Field'] != "timestamp"){ ?>
            <?php if(contain_name(strtolower($hasil_describe['Field']), $array_id_not_include_label) && !$address){ ?>
            <?php 
            echo "
            <?php 
            \$gabungan = \"\";
            if(!isset($".$real_name.")){
                \$connect = get_connection();
                \$query_max = mysqli_query(\$connect, \"select ".$hasil_describe['Field']." from ".$nama_tabel." order by ".$hasil_describe['Field']." desc\");
                if(mysqli_num_rows(\$query_max) > 0){
                    \$hasil_max = mysqli_fetch_array(\$query_max);
                    \$only_number = (int) substr(\$hasil_max['".$hasil_describe['Field']."'], -5);
                    \$only_number_plus_1 = \$only_number + 1;
                } else {
                    \$only_number_plus_1 = 1;
                }
                \$gabungan = \"". strtoupper($nama_tabel),"\" . samakan(\$only_number_plus_1, \"10000\");
            }
            ?>
";  
            ?>
            
            <div class="form-group">
                <label for="<?php echo $real_name; ?>" class="col-lg-2 control-label"><?php echo change_name($real_name); ?></label>
                <div class="col-lg-10">
                    <input readonly type="text" id="<?php echo $real_name; ?>" class="form-control" name="<?php echo $real_name; ?>" placeholder="<?php echo change_name($real_name); ?>" value="<?php echo '<?php echo isset($'.$real_name.') ? $'.$real_name.' : $gabungan; ?>'; ?>">
                </div>
            </div>
            <?php } ?>
            <?php } ?>
            <?php if(strtolower(substr($hasil_describe['Type'], 0, strlen("text"))) == "text"){ ?> 
            
            <div class="form-group">
                <label for="article_build" class="col-lg-2 control-label"><?php echo change_name($real_name); ?></label>
                <div class="col-lg-10">
                    <textarea id="article_build" class="form-control" name="<?php echo $real_name; ?>" placeholder="<?php echo change_name($real_name); ?>"><?php echo '<?php echo isset($'.$real_name.') ? $'.$real_name.' : ""; ?>'; ?></textarea>
                </div>
            </div>
            <?php } ?>
            <?php if(strtolower(substr($hasil_describe['Type'], 0, strlen("enum"))) == "enum"){ 
            $enum_all = strtolower($hasil_describe['Type']);
            $explode_01 = explode("enum('", $enum_all);
            $explode_02 = explode("')", $explode_01[1]);
            $explode_03 = explode("','", $explode_02[0]);
            ?> 
            
            <div class="form-group">
                <label for="<?php echo $real_name; ?>" class="col-lg-2 control-label"><?php echo change_name($real_name); ?></label>
                <div class="col-lg-10">
                    <select name="<?php echo $real_name; ?>" id="<?php echo $real_name; ?>" class="form-control">
                        <option value="">PILIH <?php echo strtoupper(change_name($real_name)); ?></option>
                        <?php for($i = 0; $i < sizeof($explode_03); $i++){ ?>
                        
                        <option value="<?php echo $explode_03[$i]; ?>"<?php echo " <?php echo isset($".$real_name.") && $".$real_name." == '".$explode_03[$i]."' ? ' selected' : ''; ?>"; ?>><?php echo $explode_03[$i]; ?></option><?php } ?>
                        
                    </select>
                </div>
            </div>
            <?php } ?>
            <?php if(contain_name(strtolower($hasil_describe['Field']), $array_latlong_label)){ $maps_active = 1; ?>  
            
            <div class="form-group">
                <label for="beginmarker<?php echo $maps_count; ?>" class="col-lg-2 control-label"><?php echo change_name($real_name); ?></label>
                <div class="col-lg-10">
                    <button id="beginmarker<?php echo $maps_count; ?>" style="width: 100%;" type="button" class="btn btn-default">Start Marker</button>
                </div>
            </div>
            <div class="form-group">
                <div for="latlong<?php echo $maps_count; ?>" class="col-lg-2 control-label" style="padding: 0px;"></div>
                <div class="col-lg-10">
                    <input type="text" id="latlong<?php echo $maps_count; ?>" class="form-control" name="<?php echo $real_name; ?>" placeholder="Latitude Longitude" value="<?php echo '<?php echo isset($'.$real_name.') ? $'.$real_name.' : ""; ?>'; ?>">
                </div>
            </div>
            <div class="form-group">
                <div for="map<?php echo $maps_count; ?>" class="col-lg-2 control-label" style="padding: 0px;"></div>
                <div class="col-lg-10">
                    <div id="map<?php echo $maps_count; ?>" style="width: 100%; margin-top: 6px;">If you are not see the map, maybe your browser is not supported.</div>
                </div>
            </div>
            <?php $maps_count++; } ?>
            <?php if(contain_name(strtolower($hasil_describe['Field']), $array_photo_label)){ ?>  
            
            <?php echo "<?php " ?>show_photo("<?php echo $real_name; ?>", (isset($<?php echo $real_name; ?>) ? $<?php echo $real_name; ?> : ""));<?php echo " ?>"; ?> 
            
            <?php } ?>
            <?php if(substr($hasil_describe['Field'], 0, strlen("id_")) == "id_"){ 
            $table_name = "tbl_" . substr($hasil_describe['Field'], strlen("id_"));
            $describe_table_inside = mysqli_query($connect, "describe " . $table_name);
            if($describe_table_inside && mysqli_num_rows($describe_table_inside)){
                $column_pri = "";
                $column_varchar = "";
                while($hasil_describe_table_inside = mysqli_fetch_array($describe_table_inside)){
                    if(strtolower($hasil_describe_table_inside['Key']) == strtolower("PRI")){
                        if($column_pri == ""){
                           $column_pri = $hasil_describe_table_inside['Field'];
                        }
                    }
                    if(strtolower(substr($hasil_describe_table_inside['Type'], 0, strlen("varchar"))) == "varchar"){
                        if($column_varchar == ""){
                            $column_varchar = $hasil_describe_table_inside['Field'];
                        }
                    }
                    if($column_pri != "" && $column_varchar != ""){
                        break;
                    }
                }
            } else {
                ob_get_clean();
                echo "ERROR TABLE.";
                exit();
            }
            ?> 
            <div class="form-group">
                <label for="<?php echo substr($real_name,3); ?>" class="col-lg-2 control-label"><?php echo change_name(substr($real_name,3)); ?></label>
                <div class="col-lg-10">
                    <select name="<?php echo $real_name; ?>" id="<?php echo substr($real_name,3); ?>" class="form-control">
                        <option value="">PILIH <?php echo strtoupper(change_name(substr($real_name,3))); ?></option>
                        <?php echo '<?php $get_data = get_data("'.$table_name.'",array("'.$column_pri.'","'.$column_varchar.'")); ?>' . "\n";?>
                        <?php echo '<?php while(mysqli_num_rows($get_data) && $res_data = mysqli_fetch_array($get_data)){ ?>' . "\n"; ?>
                        <?php echo '    <option value="<?php echo $res_data[\''.$column_pri.'\']; ?>"<?php echo isset($'.$real_name.') && $'.$real_name.' == $res_data[\''.$column_pri.'\'] ? " selected" : ""; ?>><?php echo $res_data[\''.$column_varchar.'\']; ?></option>' . "\n"; ?>
                        <?php echo '<?php } ?>' . "\n"; ?>
                    </select>
                </div>
            </div>
            <?php } ?>
            <?php } ?>
            <?php $address++; ?>
            <?php } ?>
            
            <div class="box-footer"></div>
            
            <div class="form-group">
                <div class="col-lg-6 col-md-6" style="margin-bottom: 40px;">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="submit" class="btn btn-info pull-right bg-light-blue-gradient" name="input_<?php echo $rest_name_; ?>"{id_button} value="Input <?php echo change_name($rest_name_); ?>">Input <?php echo change_name($rest_name_); ?></button>
                </div>
                <div class="col-lg-6 col-md-6">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important;" type="button" class="btn btn-default bg-aqua-gradient" onclick="move_url('<?php echo $rest_name_; ?>');">Lihat Data</button>
                </div>
            </div>
        </div>
    </form>
    <!-- Script JS Google Drive Input Link -->
    <?php if($maps_active){ ?>
    
    <script type="text/javascript" src="js/mapmarker_new.js"></script>
    <?php for($i = 0; $i < $maps_count; $i++){ ?>
    <input type="text" class="form-control" id="search_map<?php echo $i; ?>" placeholder="Cari Map" style="width: 50%; z-index: 9999; display: none;" value="Binus" />
    <?php } ?>
    <?php } ?>
</body>
</html><?php
    $hasil_controller = ob_get_clean();
    if($maps_active){
        $hasil_controller = str_replace(
            "/* JS Latlong Here */", '
        window.onload = function(){
            setTimeout(function(){
                for(var i = 0; i <= 100; i++){
                    if(document.getElementById("latlong" + i)){
                        initialize(i);
                    } else {
                        break;
                    }
                }
            }, 500);
        };', 
            $hasil_controller
        );
    }
    if($google_drive_pdf){
        $hasil_controller = str_replace(
            array("{id_form}","{id_button}","<!-- Script JS Google Drive Input Link -->"), array(' id="form_google_drive_' . $rest_name_ . '"', ' id="input_' . $rest_name_ . '"','
    <script type="text/javascript">
        var form_google_drive_'.$rest_name_.' = document.getElementById("form_google_drive_'.$rest_name_.'");
        form_google_drive_'.$rest_name_.'.onsubmit = function(e){
            e.preventDefault();
            var '.$google_drive_pdf_id.' = document.getElementById("'.$google_drive_pdf_id.'");
            if('.$google_drive_pdf_id.'.value === ""){
                var pesan_modal = document.getElementById("pesan_modal");
                pesan_modal.innerHTML = "Link Google Drive Tidak Boleh Kosong.";
                $(\'#modal-success\').modal(\'show\');
            } else {
                if('.$google_drive_pdf_id.'.value.substr(0,"https://drive.google.com/file/d/".length) !== "https://drive.google.com/file/d/"){
                    var pesan_modal = document.getElementById("pesan_modal");
                    pesan_modal.innerHTML = "Link Google Drive Salah.<br /><br />Berikut Contoh yang Benar : <br /><font style=\'font-size: 11px; color: blue;\'><b>https://drive.google.com/file/d/1tVXy_uv0Ry4RaZ7XAn0U2REsHQcNTuIG/preview</b></font><br /><br />Ikuti Link Berikut Untuk Mekanismenya :<br /><a href=\'https://www.steegle.com/websites/google-sites-howtos/embed-drive-pdf\' style=\'text-decoration: none; font-size: 11px;\' target=\'_blank\'>Klik Disini.</a>";
                    $(\'#modal-success\').modal(\'show\');
                }
                else if('.$google_drive_pdf_id.'.value.substr(0,"https://drive.google.com/file/d/".length) === "https://drive.google.com/file/d/"){
                    var split_link = '.$google_drive_pdf_id.'.value.substring("https://".length).split("/");
                    var validate_link = 0;
                    if(split_link.length === 5){
                        if(split_link[split_link.length - 2] === ""){
                            var pesan_modal = document.getElementById("pesan_modal");
                            pesan_modal.innerHTML = "Link Google Drive masih Salah pastikan ujung link adalah <b>preview</b>.<br /><br />Berikut Contoh yang Benar : <br /><font style=\'font-size: 11px; color: blue;\'><b>https://drive.google.com/file/d/1tVXy_uv0Ry4RaZ7XAn0U2REsHQcNTuIG/preview</b></font>";
                            $(\'#modal-success\').modal(\'show\');
                        }
                        else if(split_link[split_link.length - 1] !== "preview"){
                            var pesan_modal = document.getElementById("pesan_modal");
                            pesan_modal.innerHTML = "Link Google Drive masih Salah pastikan ujung link adalah <b>preview</b>.<br /><br />Berikut Contoh yang Benar : <br /><font style=\'font-size: 11px; color: blue;\'><b>https://drive.google.com/file/d/1tVXy_uv0Ry4RaZ7XAn0U2REsHQcNTuIG/preview</b></font>";
                            $(\'#modal-success\').modal(\'show\');
                        } else {
                            validate_link = 1;
                        }
                    } else {
                        var pesan_modal = document.getElementById("pesan_modal");
                        pesan_modal.innerHTML = "Link Google Drive masih Salah pastikan urutan link benar.<br /><br />Berikut Contoh yang Benar : <br /><font style=\'font-size: 11px; color: blue;\'><b>https://drive.google.com/file/d/1tVXy_uv0Ry4RaZ7XAn0U2REsHQcNTuIG/preview</b></font>";
                        $(\'#modal-success\').modal(\'show\');
                    }
                    if(validate_link){
                        var input_'.$rest_name_.' = document.getElementById("input_'.$rest_name_.'");
                        input_'.$rest_name_.'.innerHTML = "Proses....";
                        input_'.$rest_name_.'.style.opacity = "0.5";
                        input_'.$rest_name_.'.setAttribute("disabled", "");
                        this.submit();
                    }
                }
            }
        };
    </script>'), 
            $hasil_controller
        );
    }
    $hasil_controller = str_replace(
        array("{id_form}","{id_button}","<!-- Script JS Google Drive Input Link -->"), array("","",""),
        $hasil_controller
    );
    file_put_contents(__DIR__ . "/../application/views/" . $rest_name_ . "_form.php", $hasil_controller);
}
