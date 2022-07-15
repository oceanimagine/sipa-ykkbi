<?php
if(!defined("base_url")){
    exit("
        <html>
        <head>
        <meta charset='utf-8' />
        <title>DIRECT ACCESS.</title>
        </head>
        <body style='font-family: consolas, monospace; cursor: dewfault;'>
        DIRECT ACCESS NOT ALLOWED.
        </body>
        </html>
    ");
}
function get_url($param){
    return '../../../index.php/' . $param;
}

function get_template(){
    return '../../../upload/xlsx_excel/TEMPLATE.xlsx';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <base href="<?php echo base_url; ?>layout/luckyexcel/" />
        <link rel="shortcut icon" href="plugins/images/LOGOYKKBI.png" type="image/x-icon">
        <title>Excel</title>
        <link rel='stylesheet' href='luckysheet/plugins/css/pluginsCss.css' />
        <link rel='stylesheet' href='luckysheet/plugins/plugins.css' />
        <link rel='stylesheet' href='luckysheet/css/luckysheet.css' />
        <link rel='stylesheet' href='luckysheet/assets/iconfont/iconfont.css' />
        <script src="luckysheet/plugins/js/plugin.js"></script>
        <script src="luckysheet/luckysheet.umd.js"></script>
        <script>
            $(function () {
                var options = {
                    container: 'luckysheet',
                    showinfobar: false,
                }
                luckysheet.create(options)
            });
        </script>
        <style type="text/css">
            html, body {
                font-family: consolas, monospace;
            }
            input, textarea, select {
                font-family: consolas, monospace;
            }
        </style>
    </head>
    <body>
        <div id="lucky-mask-demo" style="position: absolute;z-index: 1000000;left: 0px;top: 0px;bottom: 0px;right: 0px; background: rgba(255, 255, 255, 0.8); text-align: center;font-size: 40px;align-items:center;justify-content: center;display: none;">Downloading</div>
        <div id="lucky-mask-export" style="position: absolute;z-index: 1000000;left: 0px;top: 0px;bottom: 0px;right: 0px; background: rgba(255, 255, 255, 0.8); text-align: center;font-size: 40px;align-items:center;justify-content: center;display: none;">Exporting</div>
        <p style="text-align:center; font-family: consolas, monospace;"> 
            <input style="font-size: 16px; width: 102px;" type="file" id="Luckyexcel-demo-file" name="Luckyexcel-demo-file" change="demoHandler" /> 
            <a href="javascript:void(0)" id="Luckyexcel-export-xlsx" style="text-decoration: none;">Export</a>
        </p>
        <div id="luckysheet" style="margin:0px;padding:0px;position:absolute;width:100%;left: 0px;top: 50px;bottom: 0px;outline: none;"></div>
        <script src="luckysheet/luckyexcel.umd.js"></script>
        <script>
            function demoHandler() {
                let upload = document.getElementById("Luckyexcel-demo-file");
                let export_ = document.getElementById("Luckyexcel-export-xlsx");
                let export_mask = document.getElementById("lucky-mask-export");
                if (upload) {

                    window.onload = () => {
                        
                        setTimeout(function(){
                            LuckyExcel.transformExcelToLuckyByUrl("<?php echo get_template(); ?>", "TEMPLATE.xlsx", function (exportJson, luckysheetfile) {

                                if (exportJson.sheets == null || exportJson.sheets.length == 0) {
                                    alert("Failed to read the content of the excel file, currently does not support xls files!");
                                    return;
                                }
                                window.luckysheet.destroy();
                                console.log(exportJson.sheets);
                                window.luckysheet.create({
                                    container: 'luckysheet', //luckysheet is the container id
                                    showinfobar: false,
                                    data: exportJson.sheets,
                                    title: exportJson.info.name,
                                    userInfo: exportJson.info.name.creator
                                });
                            });
                        }, 500);
                        
                        upload.addEventListener("change", function (evt) {
                            var files = evt.target.files;
                            if (files == null || files.length == 0) {
                                alert("No files wait for import");
                                return;
                            }

                            let name = files[0].name;
                            let suffixArr = name.split("."), suffix = suffixArr[suffixArr.length - 1];
                            if (suffix != "xlsx") {
                                alert("Currently only supports the import of xlsx files");
                                return;
                            }
                            LuckyExcel.transformExcelToLucky(files[0], function (exportJson, luckysheetfile) {

                                if (exportJson.sheets == null || exportJson.sheets.length == 0) {
                                    alert("Failed to read the content of the excel file, currently does not support xls files!");
                                    return;
                                }
                                window.luckysheet.destroy();
                                console.log(exportJson.sheets);
                                window.luckysheet.create({
                                    container: 'luckysheet', //luckysheet is the container id
                                    showinfobar: false,
                                    data: exportJson.sheets,
                                    title: exportJson.info.name,
                                    userInfo: exportJson.info.name.creator
                                });
                            });
                        });
                        
                        export_.addEventListener("click", function () {
                            export_mask.style.display = "flex";
                            var isi_excel = window.luckysheet.getAllSheets();
                            console.log(this);
                            console.log(isi_excel);
                            $.ajax({
                                type:'post',
                                url:'<?php echo get_url("globals/export"); ?>',
                                data: {json_luckyexcel:isi_excel},
                                success: function(response) {
                                    response;
                                    console.log('SUCCESS BLOCK');
                                    export_mask.style.display = "none";
                                },
                                error: function(response) {
                                    console.log('ERROR BLOCK');
                                    console.log(response);
                                }
                            });
                        });
                    }
                }
            }
            demoHandler();
        </script>
    </body>
</html>