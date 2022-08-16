<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>View Help</title>
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
    <script src="js/download-view-help.js" referrerpolicy="origin"></script>
    <form class="form-horizontal" method="POST">
        <div class="box-body">
            
            <div class="form-group" style="margin-bottom: 5px;">
                <label style="text-align: left; padding-top: 10px; overflow: hidden; text-overflow: ellipsis;" for="view_help_aplikasi_sipa" class="col-md-6 control-label">1. Dokumen Help Aplikasi Sipa</label>
                <div class="col-md-3 button-preview" style="padding-right: 0px;">
                    <button id="preview_view_help_aplikasi_sipa" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient button-button-preview" name="preview_view_help_aplikasi_sipa" value="Preview">Preview</button>
                </div>
                <div class="col-md-3 button-download" style="padding-left: 5px;">
                    <button id="download_view_help_aplikasi_sipa" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="download_view_help_aplikasi_sipa" value="Download">Download</button>
                </div>
            </div>
            
        </div>
    </form>
</body>
</html>