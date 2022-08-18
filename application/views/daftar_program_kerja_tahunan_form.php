<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Add Program Kerja Tahunan</title>
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
    <script src="js/daftar-program-kerja-tahunan.js" referrerpolicy="origin"></script>
    <style type="text/css">
        thead {
            position: sticky; 
            top: 0px; 
            z-index: 10;
        }
        .modal-open .modal {
            overflow-y: hidden;
        }
    </style>
    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
        <div class="box-body" style="min-width: 1200px; position: relative;">
            
            <div class="form-group">
                <label for="kode_project" class="col-xs-2 control-label">Kode Project</label>
                <div class="col-xs-10">
                    <input type="text" id="kode_project" class="form-control" name="kode_project" placeholder="Kode Project" value="{replace_project_modal}" disabled>
                    <input type="hidden" name="kode" value="{replace_project_modal}" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="iku_kode" class="col-xs-2 control-label">IKU Kode</label>
                <div class="col-xs-9 autocomplete">
                    <input required="" type="text" id="iku_kode" class="form-control tambah-margin-bawah" name="iku_kode" placeholder="IKU Kode" value="<?php echo isset($iku_kode_display) ? $iku_kode_display : ""; ?>" autocomplete="off" disabled="">
                    <input required="" type="hidden" id="iku_kode_hidden" name="iku_kode_hidden" value="<?php echo isset($iku_kode_hidden) ? $iku_kode_hidden : ""; ?>">
                </div>
                <div class="col-xs-1" style="padding-left:0px;">
                    <button id="buka_dialog_iku_kode" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="search" value="Search"><i class="fa fa-search"></i></button>
                </div>
            </div>
            
            <div class="form-group">
                <label for="sbpps_kode" class="col-xs-2 control-label">SBPPS Kode</label>
                <div class="col-xs-9 autocomplete">
                    <input required="" type="text" id="sbpps_kode" class="form-control tambah-margin-bawah" name="sbpps_kode" placeholder="SBPPS Kode" value="<?php echo isset($sbpps_kode_display) ? $sbpps_kode_display : ""; ?>" autocomplete="off" disabled="">
                    <input required="" type="hidden" id="sbpps_kode_hidden" name="sbpps_kode_hidden" value="<?php echo isset($sbpps_kode_hidden) ? $sbpps_kode_hidden : ""; ?>">
                </div>
                <div class="col-xs-1" style="padding-left:0px;">
                    <button id="buka_dialog_sbpps_kode" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="search" value="Search"><i class="fa fa-search"></i></button>
                </div>
            </div>
            
            <div class="form-group">
                <label for="pkt_kode" class="col-xs-2 control-label">PKT Kode</label>
                <div class="col-xs-10">
                    <select name="pkt_kode" id="pkt_kode" class="form-control">
                        <option value="">PILIH</option>
                        <?php 
                        
                        for($i = 1; $i <= 99; $i++){
                            echo '<option value="1.'. samakan($i, 10).'">1.'. samakan($i, 10).'</option>';
                        }
                        
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="box-footer"></div>
            
            <div class="form-group">
                <div class="col-lg-6 col-md-6" style="margin-bottom: 40px;">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="submit" class="btn btn-info pull-right bg-light-blue-gradient" name="input_daftar_program_kerja_tahunan" value="Input Daftar Program Kerja Tahunan">Input Daftar Program Kerja Tahunan</button>
                </div>
                <div class="col-lg-6 col-md-6">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important;" type="button" class="btn btn-default bg-aqua-gradient" onclick="move_url('daftar-program-kerja-tahunan');">Lihat Data</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>