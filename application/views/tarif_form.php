<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Module Tarif Form</title>
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
                <label for="kode_project" class="col-lg-2 control-label">Kode Project</label>
                <div class="col-lg-10">
                    <input type="text" id="kode_project" class="form-control" name="kode_project" placeholder="Kode Project" value="{replace_project_modal}" disabled>
                    <input type="hidden" name="kode" value="{replace_project_modal}" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="satkerid" class="col-lg-2 control-label">Satker</label>
                <div class="col-lg-10">
                    <select name="satkerid" id="satkerid" class="form-control">
                        <option value="">PILIH Satker</option>
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
                    <select name="tarifid" id="tarifid" class="form-control">
                        <option value="">PILIH TARIF</option>
                        <option value="0000"<?php echo isset($tarifid) && $tarifid == "0000" ? " selected='selected'" : ""; ?>>Non Tarif</option>
                        <option value="1111"<?php echo isset($tarifid) && $tarifid == "1111" ? " selected='selected'" : " selected='selected'"; ?>>Tarif</option>
                    </select>
                    <input type="hidden" name="tarifnama" id="tarifnama" value="<?php echo isset($tarifnama) ? $tarifnama : ""; ?>" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="tarifnom" class="col-lg-2 control-label">Nominal</label>
                <div class="col-lg-10">
                    <input required type="number" id="tarifnom" class="form-control numberonly" name="tarifnom" placeholder="Nominal" value="<?php echo isset($tarifnom) ? $tarifnom : "0.00"; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="tarifdesc" class="col-lg-2 control-label">Deskripsi</label>
                <div class="col-lg-10">
                    <input required type="text" id="tarifdesc" class="form-control" name="tarifdesc" placeholder="Tarif Description" value="<?php echo isset($tarifdesc) ? $tarifdesc : ""; ?>">
                </div>
            </div>
            
            <div class="box-footer"></div>
            
            <div class="form-group">
                <div class="col-lg-6 col-md-6" style="margin-bottom: 40px;">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="submit" class="btn btn-info pull-right bg-light-blue-gradient" name="input_tarif" value="Input tarif">Input Tarif</button>
                </div>
                <div class="col-lg-6 col-md-6">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important;" type="button" class="btn btn-default bg-aqua-gradient" onclick="move_url('tarif');">Lihat Data</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>