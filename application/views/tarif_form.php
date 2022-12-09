<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Tarif</title>
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
    <?php $CI =& get_instance(); ?>
    <?php 
    
    $disabled = "";
    if(!isset($satkerid)){
        if($CI->allow_create == "0"){
            $disabled = " disabled=''";
        }
    }
    if(isset($satkerid)){
        if($CI->allow_update == "0"){
            $disabled = " disabled=''";
        }
    }
    
    ?>
    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
        <div class="box-body">
            
            <div class="form-group">
                <label for="kode_project" class="col-lg-2 control-label">Kode Project</label>
                <div class="col-lg-10">
                    <input type="text" id="kode_project" class="form-control" name="kode_project" placeholder="Kode Project" value="{replace_project_modal}" disabled>
                    <input type="hidden" name="kode" value="{replace_project_modal}" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="satkerid" class="col-lg-2 control-label">Satker</label>
                <div class="col-lg-10">
                    <select <?php echo $disabled; ?> name="satkerid" id="satkerid" class="form-control">
                        <option value="">Pilih Satker</option>
                        <?php foreach($data_satker as $data){ ?>
                        <?php $selected = (isset($satkerid) && $satkerid == $data->satkerid) ? " selected='selected'" : ""; ?>
                        <option value="<?php echo $data->satkerid; ?>" <?php echo $selected; ?>><?php echo $data->nama2 . " (" . $data->nama1 . ")"; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="tarifid" class="col-lg-2 control-label">Tipe Tarif</label>
                <div class="col-lg-10">
                    <select <?php echo $disabled; ?> name="tarifid" id="tarifid" class="form-control">
                        <option value="">Pilih Tarif</option>
                        <option value="0000"<?php echo isset($tarifid) && $tarifid == "0000" ? " selected='selected'" : ""; ?>>Non Tarif</option>
                        <option value="1111"<?php echo isset($tarifid) && $tarifid == "1111" ? " selected='selected'" : ""; ?>>Tarif</option>
                        <option value="0001"<?php echo isset($tarifid) && $tarifid == "0001" ? " selected='selected'" : ""; ?>>Akomodasi Perjalan Dinas Menginap Kadiv</option>
                        <option value="0002"<?php echo isset($tarifid) && $tarifid == "0002" ? " selected='selected'" : ""; ?>>Akomodasi Perjalan Dinas Menginap DepKadiv</option>
                        <option value="0003"<?php echo isset($tarifid) && $tarifid == "0003" ? " selected='selected'" : ""; ?>>Akomodasi Perjalan Dinas Menginap Kasie</option>
                        <option value="0004"<?php echo isset($tarifid) && $tarifid == "0004" ? " selected='selected'" : ""; ?>>Akomodasi Perjalan Dinas Menginap Staf</option>
                        <option value="0005"<?php echo isset($tarifid) && $tarifid == "0005" ? " selected='selected'" : ""; ?>>Akomodasi Perjalan Dinas Menginap PTU</option>
                        <option value="0006"<?php echo isset($tarifid) && $tarifid == "0006" ? " selected='selected'" : ""; ?>>Transportasi Pesawat Perjalan Dinas Menginap</option>
                        <option value="0007"<?php echo isset($tarifid) && $tarifid == "0007" ? " selected='selected'" : ""; ?>>Transportasi Kereta Perjalan Dinas Menginap</option>
                        <option value="0008"<?php echo isset($tarifid) && $tarifid == "0008" ? " selected='selected'" : ""; ?>>Transportasi Taxi Perjalan Dinas Menginap</option>
                    </select>
                    <input type="hidden" name="tarifnama" id="tarifnama" value="<?php echo isset($tarifnama) ? $tarifnama : ""; ?>" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="tarifnom" class="col-lg-2 control-label">Nominal</label>
                <div class="col-lg-10">
                    <input <?php echo $disabled; ?> required type="number" id="tarifnom" class="form-control numberonly" name="tarifnom" placeholder="Nominal" value="<?php echo isset($tarifnom) ? $tarifnom : "0.00"; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="tarifdesc" class="col-lg-2 control-label">Deskripsi</label>
                <div class="col-lg-10">
                    <input <?php echo $disabled; ?> required type="text" id="tarifdesc" class="form-control" name="tarifdesc" placeholder="Deskripsi Tarif" value="<?php echo isset($tarifdesc) ? $tarifdesc : ""; ?>">
                </div>
            </div>
            
            <div class="box-footer"></div>
            
            <div class="form-group">
                <div class="col-lg-6 col-md-6" style="margin-bottom: 40px;">
                    <button <?php echo $disabled; ?> style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="submit" class="btn btn-info pull-right bg-light-blue-gradient" name="input_tarif" value="Input tarif">Input Tarif</button>
                </div>
                <div class="col-lg-6 col-md-6">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important;" type="button" class="btn btn-default bg-aqua-gradient" onclick="move_url('tarif');">Lihat Data</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>