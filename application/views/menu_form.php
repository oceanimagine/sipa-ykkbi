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
    <form class="form-horizontal" method="POST">
        <div class="box-body">
            
            <div class="form-group">
                <label for="nama_menu" class="col-lg-2 control-label">nama menu</label>
                <div class="col-lg-10">
                    <input required type="text" id="nama_menu" class="form-control" name="nama_menu" placeholder="nama menu" value="<?php echo isset($nama_menu) ? $nama_menu : ""; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="module" class="col-lg-2 control-label">module</label>
                <div class="col-lg-10">
                    <input type="text" id="module" class="form-control" name="module" placeholder="module" value="<?php echo isset($module) ? $module : ""; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="select_menu" class="col-lg-2 control-label">submenu dari (<font style="color: blue; cursor: pointer;" onclick="remove_parent();">parent</font>)</label>
                <div class="col-lg-10">
                    <div class="panel panel-success" style="cursor: default; border-color: #adadad;">
                        <div class="panel-heading" style="padding-bottom: 10px; color: black; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important;">
                            List Menu <?php echo $keterangan_parent; ?>
                        </div>
                        <table border="1" style="border-spacing: 0; font-family: consolas, monospace !important; cursor: default;" class="table table-bordered table-hover no-footer dataTable">
                            <tbody id="tempat_menu">
                                <?php echo $opsi_menu; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
            <div class="form-group">
                <div class="col-lg-6 col-md-6" style="margin-bottom: 40px;">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="submit" class="btn btn-info pull-right bg-light-blue-gradient" name="input_menu" value="Input menu">Input menu</button>
                </div>
                <div class="col-lg-6 col-md-6">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important;" type="button" class="btn btn-default bg-aqua-gradient" onclick="move_url('menu');">Lihat Data</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>