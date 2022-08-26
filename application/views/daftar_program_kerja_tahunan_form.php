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
                <label for="sbpps_kode" class="col-xs-2 control-label">SBPPS Kode</label>
                <div class="col-xs-9 autocomplete">
                    <input required="" type="text" id="sbpps_kode" class="form-control tambah-margin-bawah" name="sbpps_kode" placeholder="SBPPS Kode" value="<?php echo isset($sbpkode_display) ? $sbpkode_display : ""; ?>" autocomplete="off" disabled="">
                    <input required="" type="hidden" id="sbpps_kode_hidden" name="sbpps_kode_hidden" value="<?php echo isset($sbpkode_hidden) ? $sbpkode_hidden : ""; ?>">
                </div>
                <div class="col-xs-1" style="padding-left:0px;">
                    <button id="buka_dialog_sbpps_kode" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="search" value="Search"><i class="fa fa-search"></i></button>
                </div>
            </div>
            
            <div class="form-group">
                <label for="pktkrk" class="col-xs-2 control-label">Tipe</label>
                <div class="col-xs-10">
                    <select name="pktkrk" id="pktkrk" class="form-control">
                        <option value="">PILIH</option>
                        <option value="K">Kegiatan</option>
                        <option value="RK">Rincian Kegiatan</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="pktkode" class="col-xs-2 control-label">PKT Kode</label>
                <div class="col-xs-10">
                    <input type="text" id="pktkode" class="form-control" name="pktkode" placeholder="PKT Kode" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="pktnama" class="col-xs-2 control-label">PKT Nama</label>
                <div class="col-xs-10">
                    <input type="text" id="pktnama" class="form-control" name="pktnama" placeholder="PKT Nama" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="pktoutput" class="col-xs-2 control-label">PKT Output</label>
                <div class="col-xs-10">
                    <input type="text" id="pktoutput" class="form-control" name="pktoutput" placeholder="PKT Output" />
                </div>
            </div>
            
            <div class="box-footer"></div>
            
            <div class="form-group">
                <div class="col-lg-6 col-md-6" style="margin-bottom: 40px;">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="submit" class="btn btn-info pull-right bg-light-blue-gradient" name="input_daftar_program_kerja_tahunan" value="Input Daftar Program Kerja Tahunan" disabled>Input Daftar Program Kerja Tahunan</button>
                </div>
                <div class="col-lg-6 col-md-6">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important;" type="button" class="btn btn-default bg-aqua-gradient" onclick="move_url('daftar-program-kerja-tahunan');">Lihat Data</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>