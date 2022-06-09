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

$query_describe = mysqli_query($connect, "describe " . $nama_tabel);

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
    
    ob_start();
    ?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo change_name($rest_name_); ?> List</title>
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
            window.onload = function(){
	        var tempat_script = document.getElementById("tempat_script");
	        var script = document.createElement("script");
	        script.setAttribute("type","text/javascript");
	        script.innerHTML = tempat_script.innerHTML;
	        document.body.appendChild(script);
                tempat_script.parentNode.removeChild(tempat_script);
                
	    }; 
            function move_url(link){
                document.location = "../../../index.php/" + link;
            }
            function confirm_delete(param){
                var split_ = param.split("index.php/");
                var button_confirm = document.getElementById("button-confirm");
                button_confirm.setAttribute("onclick", "move_url('"+split_[1]+"')");
            }
            
	</script>
</head>
<body>
    
    <script type="text/javascript" id="tempat_script">
    if(typeof $ !== "undefined"){
        <?php echo "<?php echo \$script; ?>"; ?>        
    }
    </script>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12 col-lg-12a">
                <div class="panel panel-success" style="font-family: consolas, monospace !important; cursor: default; border-color: #adadad;">
                    <!-- Default panel contents -->
                    <div class="panel-heading" style="padding-bottom: 10px; color: black; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important;">
                        List <?php echo change_name($rest_name_); ?>                        
                        <a id="addData" href="../../../index.php/<?php echo $rest_name_; ?>/add" class="btn btn-primary btn-xs pull-right hidden-xs bg-green-gradient"><span class="glyphicon glyphicon-plus"></span>&nbsp;New <?php echo change_name($rest_name_); ?></a>
                    </div>
                    <table id="table-data" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <?php while($hasil_describe = mysqli_fetch_array($query_describe)){ ?>
                                <?php if($hasil_describe['Field'] != "timestamp" && strtolower($hasil_describe['Type']) != "text"){ 
                                if(substr($hasil_describe['Field'], 0, strlen("id_")) == "id_"){
                                    $hasil_describe['Field'] = substr($hasil_describe['Field'], 3);
                                }    
                                ?>
                                
                                <th><?php echo change_name($hasil_describe['Field']); ?></th><?php } ?>
                                <?php } ?>
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>  
                </div> <!-- end panel  -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    
</body>
</html><?php
    $hasil_controller = ob_get_clean();
    file_put_contents(__DIR__ . "/../application/views/" . $rest_name_ . "_list.php", $hasil_controller);
}
