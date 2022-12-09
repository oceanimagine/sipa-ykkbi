<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Mata Anggaran Induk</title>
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
    if(!isset($rekmainduk)){
        if($CI->allow_create == "0"){
            $disabled = " disabled=''";
        }
    }
    if(isset($rekmainduk)){
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
                <label for="rekmainduk" class="col-lg-2 control-label">Kode Rek. MA Induk</label>
                <div class="col-lg-10">
                    <input <?php echo $disabled; ?> required type="number" id="rekmainduk" class="form-control numberonly-no-comma" name="rekmainduk" placeholder="Rekma Induk" value="<?php echo isset($rekmainduk) ? $rekmainduk : "0"; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="rekmainduknama" class="col-lg-2 control-label">Nama Rek. MA Induk</label>
                <div class="col-lg-10">
                    <input <?php echo $disabled; ?> required type="text" id="rekmainduknama" class="form-control" name="rekmainduknama" placeholder="Nama Rek. MA Induk" value="<?php echo isset($rekmainduknama) ? $rekmainduknama : ""; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="rekmagroup" class="col-lg-2 control-label">Group Rek. MA</label>
                <div class="col-lg-10">
                    <select <?php echo $disabled; ?> name="rekmagroup" id="rekmagroup" class="form-control">
                        <option value="">Pilih Group Rek. MA</option><?php /*
                        <?php foreach($rekmagroup_data as $data){ ?>
                        <?php $selected = isset($rekmagroup) && $rekmagroup == $data->rekmagroup ? " selected='selected'" : ""; ?>
                        <option value="<?php echo $data->rekmagroup; ?>"<?php echo $selected; ?>><?php echo $data->rekmagroup; ?></option>
                        <?php } ?> */ ?>
                        <option value="PENDAPATAN"<?php echo isset($rekmagroup) ? ($rekmagroup == "PENDAPATAN" ? " selected='selected'" : "") : ""; ?>>PENDAPATAN</option>
                        <option value="BEBAN"<?php echo isset($rekmagroup) ? ($rekmagroup == "BEBAN" ? " selected='selected'" : "") : ""; ?>>BEBAN</option>
                        <option value="BEBAN PAJAK"<?php echo isset($rekmagroup) ? ($rekmagroup == "BEBAN PAJAK" ? " selected='selected'" : "") : ""; ?>>BEBAN PAJAK</option>
                        <option value="INVESTASI"<?php echo isset($rekmagroup) ? ($rekmagroup == "INVESTASI" ? " selected='selected'" : "") : ""; ?>>INVESTASI</option>
                        <option value="INVESTASI & RENCANA KORPORASI"<?php echo isset($rekmagroup) ? ($rekmagroup == "RENCANA KORPORASI" ? " selected='selected'" : "") : ""; ?>>RENCANA KORPORASI</option>
                    </select>
                </div>
            </div>
            
            <div class="box-footer"></div>
            
            <div class="form-group">
                <div class="col-lg-6 col-md-6" style="margin-bottom: 40px;">
                    <button <?php echo $disabled; ?> style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="submit" class="btn btn-info pull-right bg-light-blue-gradient" name="input_mata_anggaran_induk" value="Input mata anggaran induk">Input Mata Anggaran Induk</button>
                </div>
                <div class="col-lg-6 col-md-6">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important;" type="button" class="btn btn-default bg-aqua-gradient" onclick="move_url('mata-anggaran-induk');">Lihat Data</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>