<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Download Report</title>
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
    <link rel="stylesheet" href="css/download-report.css"  type="text/css" />
    <script src="js/download-report.js" referrerpolicy="origin"></script>
    <form class="form-horizontal" method="POST">
        <div class="box-body">
            
            <div class="form-group" style="margin-bottom: 5px;">
                <label style="text-align: left; padding-top: 10px; overflow: hidden; text-overflow: ellipsis;" for="laporan_anggaran_berdasarkan_program_kerja" class="col-md-6 control-label">1. Laporan Anggaran Berdasarkan Program Kerja</label>
                <div class="col-md-3 button-preview" style="padding-right: 0px;">
                    <button id="preview_laporan_anggaran_berdasarkan_program_kerja" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient button-button-preview" name="preview_laporan_anggaran_berdasarkan_program_kerja" value="Preview">Preview</button>
                </div>
                <div class="col-md-3 button-download" style="padding-left: 5px;">
                    <button id="download_laporan_anggaran_berdasarkan_program_kerja" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="download_laporan_anggaran_berdasarkan_program_kerja" value="Download">Download</button>
                </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 5px;">
                <label style="text-align: left; padding-top: 10px; overflow: hidden; text-overflow: ellipsis;" for="laporan_anggaran_berdasarkan_mata_anggaran" class="col-md-6 control-label">2. Laporan Anggaran Berdasarkan Mata Anggaran</label>
                <div class="col-md-3 button-preview" style="padding-right: 0px;">
                    <button id="preview_laporan_anggaran_berdasarkan_mata_anggaran" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient button-button-preview" name="preview_laporan_anggaran_berdasarkan_mata_anggaran" value="Preview">Preview</button>
                </div>
                <div class="col-md-3 button-download" style="padding-left: 5px;">
                    <button id="download_laporan_anggaran_berdasarkan_mata_anggaran" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="download_laporan_anggaran_berdasarkan_mata_anggaran" value="Download">Download</button>
                </div>
            </div>
            <?php /*
            <div class="form-group" style="margin-bottom: 5px;">
                <label style="text-align: left; padding-top: 10px; overflow: hidden; text-overflow: ellipsis;" for="laporan_anggaran_berdasarkan_mata_anggaran" class="col-md-6 control-label">3. Laporan Proyeksi Aktivitas Keuangan</label>
                <div class="col-md-3 button-preview" style="padding-right: 0px;">
                    <button id="preview_laporan_proyeksi_aktivitas_keuangan" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient button-button-preview" name="preview_laporan_proyeksi_aktivitas_keuangan" value="Preview">Preview</button>
                </div>
                <div class="col-md-3 button-download" style="padding-left: 5px;">
                    <button id="download_laporan_proyeksi_aktivitas_keuangan" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="download_laporan_proyeksi_aktivitas_keuangan" value="Download">Download</button>
                </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 5px;">
                <label style="text-align: left; padding-top: 10px; overflow: hidden; text-overflow: ellipsis;" for=laporan_anggaran_iku" class="col-md-6 control-label">4. Laporan Anggaran IKU</label>
                <div class="col-md-3 button-preview" style="padding-right: 0px;">
                    <button id="preview_laporan_anggaran_iku" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient button-button-preview" name="preview_laporan_anggaran_iku" value="Preview">Preview</button>
                </div>
                <div class="col-md-3 button-download" style="padding-left: 5px;">
                    <button id="download_laporan_anggaran_iku" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="download_laporan_anggaran_iku" value="Download">Download</button>
                </div>
            </div>
            */ ?>
            
            <div class="form-group" style="margin-bottom: 5px;">
                <label style="text-align: left; padding-top: 10px; overflow: hidden; text-overflow: ellipsis;" for=data_upload_siaga" class="col-md-6 control-label">3. Data Upload SIAGA</label>
                <div class="col-md-3 button-preview" style="padding-right: 0px;">
                    <button id="preview_data_upload_siaga" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient button-button-preview" name="data_upload_siaga" value="Preview">Preview</button>
                </div>
                <div class="col-md-3 button-download" style="padding-left: 5px;">
                    <button id="download_data_upload_siaga" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="data_upload_siaga" value="Download">Download</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>