<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo isset($judul) && $judul != "" ? $judul : ""; ?></title>
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
            
	</script>
</head>
<body>
    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
        <div class="box-body">
            
            <div class="form-group">
                <label for="nama_lengkap" class="col-lg-2 control-label">nama lengkap</label>
                <div class="col-lg-10">
                    <input type="text" id="nama_lengkap" class="form-control" name="nama_lengkap" placeholder="nama lengkap" value="<?php echo isset($nama_lengkap) ? $nama_lengkap : ""; ?>">
                </div>
            </div>
            
            <?php show_photo("photo_user_admin", (isset($photo_user_admin) ? $photo_user_admin : "")); ?>
            
            <div class="form-group">
                <label for="nomor_karyawan" class="col-lg-2 control-label">nomor karyawan</label>
                <div class="col-lg-10">
                    <input <?php echo isset($profile) ? " disabled='disabled'" : ""; ?> type="text" id="nomor_karyawan" class="form-control" name="nomor_karyawan" placeholder="nomor karyawan" value="<?php echo isset($nomor_karyawan) ? $nomor_karyawan : ""; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="username" class="col-lg-2 control-label">username</label>
                <div class="col-lg-10">
                    <input <?php echo isset($profile) ? " disabled='disabled'" : ""; ?> required type="text" id="username" class="form-control" name="username" placeholder="username" value="<?php echo isset($username) ? $username : ""; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-lg-2 control-label"><?php echo isset($profile) ? "old " : ""; ?>password</label>
                <div class="col-lg-10">
                    <input <?php echo isset($profile) ? " disabled='disabled'" : ""; ?> value="<?php echo isset($profile) ? "secret" : ""; ?>" type="password" id="password" class="form-control" name="password" placeholder="password <?php echo isset($profile) ? " lama" : " baru"; ?>">
                </div>
            </div>
            <?php
            
            $array_selected = array();
            if(isset($satker)){
                $explode_satker = explode(",", $satker);
                for($i = 0; $i < sizeof($explode_satker); $i++){
                    $array_selected[$explode_satker[$i]] = true;
                }
            }
            if(!isset($profile)){
            ?>
            <div class="form-group">
                <label for="satker" class="col-lg-2 control-label">satker</label>
                <div class="col-lg-10">
                    <select class="form-control multiple" name="satker[]" id="satker" multiple="multiple">
                        <?php foreach($satker_all as $data){ ?>
                        <?php $selected = isset($array_selected[$data->satkerid]) && $array_selected[$data->satkerid] ? " selected='selected'" : ""; ?>
                        <option value="<?php echo $data->satkerid; ?>"<?php echo $selected; ?>><?php echo $data->nama1; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <?php 
            } /*
            <div class="form-group">
                <label for="jam" class="col-lg-2 control-label">jam</label>
                <div class="col-lg-10">
                    <input type="text" id="jam" class="form-control jam" name="jam" placeholder="jam" value="<?php echo isset($jam) ? $jam : ""; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="jam_b" class="col-lg-2 control-label">jam b</label>
                <div class="col-lg-10">
                    <input type="text" id="jam_b" class="form-control jam" name="jam_b" placeholder="jam b" value="<?php echo isset($jam_b) ? $jam_b : ""; ?>">
                </div>
            </div> */ ?>
            <?php 
            if(isset($table_menu)){
                ?>
                <div class="form-group">
                    <label for="password" class="col-lg-2 control-label">privilege</label>
                    <div class="col-lg-10">
                        <?php echo $table_menu; ?>
                    </div>
                </div>
                <?php
            }
            ?>
            <?php if(isset($profile)){ ?>
            <div class="form-group">
                <label for="password_baru" class="col-lg-2 control-label">new password</label>
                <div class="col-lg-10">
                    <input autocomplete="off" type="password" id="password_baru" class="form-control" name="password_baru" placeholder="password baru">
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirm" class="col-lg-2 control-label">confirm password</label>
                <div class="col-lg-10">
                    <input autocomplete="off" type="password" id="password_confirm" class="form-control" name="password_confirm" placeholder="confirm password">
                </div>
            </div>
            <script type="text/javascript">
            
            function check_password(){
                var input_useradmin = document.getElementById("input_useradmin");
                var password_confirm = document.getElementById("password_confirm");
                var password_baru = document.getElementById("password_baru");
                if(password_confirm.value === password_baru.value){
                    password_confirm.removeAttribute("style");
                    password_baru.removeAttribute("style");
                    input_useradmin.removeAttribute("disabled");
                } else {
                    password_confirm.setAttribute("style", "border: red 1px solid;");
                    password_baru.setAttribute("style", "border: red 1px solid;");
                    input_useradmin.setAttribute("disabled","");
                }
            }
            
            window.addEventListener("load", function(){
                setTimeout(function(){
                    $("#password_confirm").bind("keypress keyup keydown", function () {
                        check_password();
                    });
                    $("#password_baru").bind("keypress keyup keydown", function () {
                        check_password();
                    });
                }, 500);
            });
            
            </script>
            <?php } ?>
            <div class="box-footer"></div>
            
            <div class="form-group">
                <div class="<?php echo isset($profile) ? "col-lg-12 col-md-12" : "col-lg-6 col-md-6"; ?>" style="margin-bottom: 40px;">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="submit" class="btn btn-info pull-right bg-light-blue-gradient" name="input_useradmin" id="input_useradmin" value="Input user admin"><?php echo isset($profile) ? "Update Info" : "Input user admin"; ?></button>
                </div>
                <?php if(!isset($profile)){ ?>
                <div class="col-lg-6 col-md-6">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important;" type="button" class="btn btn-default bg-aqua-gradient" onclick="move_url('useradmin');">Lihat Data</button>
                </div>
                <?php } ?>
            </div>
        </div>
    </form>
</body>
</html>