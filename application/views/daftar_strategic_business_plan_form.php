<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Add Strategic Business Plan</title>
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
                <label for="jenis_entri" class="col-lg-2 control-label">Jenis Entri</label>
                <div class="col-lg-10">
                    <select name="jenis_entri" id="jenis_entri" class="form-control">
                        <option value="">PS (Program Strategis)</option>
                        <option value="">PKS (Program Kerja Strategis)</option>
                        <option value="">PKNS (Program Non Kerja Strategis)</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="kode_ps" class="col-lg-2 control-label">Kode PS</label>
                <div class="col-lg-10">
                    <input required type="text" id="kode_ps" pattern="\d*" class="form-control numberonly-no-comma" name="kode_ps" placeholder="Kode PS" value="<?php echo isset($kode_ps) ? $kode_ps : "00"; ?>" maxlength="2">
                </div>
            </div>
            
            <div class="form-group">
                <label for="kode_pks_pkns" class="col-lg-2 control-label">Kode PKS/PKNS</label>
                <div class="col-lg-10">
                    <input disabled="" type="text" id="kode_pks_pkns" pattern="\d*" class="form-control numberonly-no-comma" name="kode_pks_pkns" placeholder="Kode PKS/PKNS" value="<?php echo isset($kode_pks_pkns) ? $kode_pks_pkns : "0"; ?>" maxlength="1">
                </div>
            </div>
            
            <div class="form-group">
                <label for="nomor_pks_pkns" class="col-lg-2 control-label">Nomor PKS/PKNS</label>
                <div class="col-lg-10">
                    <input disabled="" type="text" id="nomor_pks_pkns" pattern="\d*" class="form-control numberonly-no-comma" name="nomor_pks_pkns" placeholder="Nomor PKS/PKNS" value="<?php echo isset($nomor_pks_pkns) ? $nomor_pks_pkns : "00"; ?>" maxlength="2">
                </div>
            </div>
            
            <div class="form-group">
                <label for="keterangan" class="col-lg-2 control-label">Keterangan</label>
                <div class="col-lg-10">
                    <input required type="text" id="keterangan" class="form-control" name="keterangan" placeholder="Keterangan" value="<?php echo isset($keterangan) ? $keterangan : ""; ?>">
                </div>
            </div>
            
            <div class="box-footer"></div>
            
            <div class="form-group">
                <div class="col-lg-6 col-md-6" style="margin-bottom: 40px;">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="submit" class="btn btn-info pull-right bg-light-blue-gradient" name="input_daftar_strategic_business_plan" value="Input Daftar Strategic Business Plan">Input Daftar Strategic Business Plan</button>
                </div>
                <div class="col-lg-6 col-md-6">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important;" type="button" class="btn btn-default bg-aqua-gradient" onclick="move_url('daftar-strategic-business-plan');">Lihat Data</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>