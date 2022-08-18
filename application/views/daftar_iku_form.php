<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo isset($title) ? $title : ""; ?></title>
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
                <label for="ikukode_display" class="col-xs-2 control-label">IKU Kode</label>
                <div class="col-xs-10">
                    <input type="text" id="ikukode_display" class="form-control" name="ikukode_display" placeholder="IKU Kode" value="<?php echo isset($iku_kode) ? $iku_kode : ""; ?>" disabled>
                    <input type="hidden" id="ikukode" name="ikukode" value="<?php echo isset($iku_kode) ? $iku_kode : ""; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="ikunama" class="col-xs-2 control-label">IKU Nama</label>
                <div class="col-xs-10">
                    <input type="text" id="ikunama" class="form-control" name="ikunama" placeholder="IKU Nama" value="<?php echo isset($iku_nama) ? $iku_nama : ""; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="ikurincian" class="col-xs-2 control-label">IKU Rincian</label>
                <div class="col-xs-10">
                    <textarea class="form-control" id="ikurincian" name="ikurincian" placeholder="IKU Rincian" style="height: 150px;"><?php echo isset($iku_rincian) ? $iku_rincian : ""; ?></textarea>
                </div>
            </div>
            
            <div class="box-footer"></div>
            
            <div class="form-group">
                <div class="col-lg-6 col-md-6" style="margin-bottom: 40px;">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="submit" class="btn btn-info pull-right bg-light-blue-gradient" name="input_daftar_iku" value="Input Daftar IKU">Input Daftar IKU</button>
                </div>
                <div class="col-lg-6 col-md-6">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important;" type="button" class="btn btn-default bg-aqua-gradient" onclick="move_url('daftar-iku');">Lihat Data</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>