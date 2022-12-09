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
           
            <div class="form-group" style="margin-bottom: 10px; margin-right: 15px; margin-left: 15px;">

                <div class="row">
                  <div class="col-md-8 " style="padding: 5px 10px 5px 5px;">
                        <label style="text-align: left; padding-top: 10px; overflow: hidden; text-overflow: ellipsis;" for="laporan_anggaran_berdasarkan_program_kerja" class="col-md-12 control-label">
                            1. Laporan Anggaran Berdasarkan Program Kerja
                            <ul style="color: green; font-weight: 400;">
                                <li style="margin-bottom: 4px; margin-top: 4px; white-space: normal;">
                                    Laporan Anggaran berdasarkan Program Strategis
                                </li>
                                <li style="margin-bottom: 4px; white-space: normal;">
                                    Laporan Anggaran berdasarkan Program Kerja 	


                                </li>
                                <li style="margin-bottom: 4px; white-space: normal;">
                                    Laporan Anggaran berdasarkan Kegiatan
                                </li>
                                <li style="margin-bottom: 4px; white-space: normal;">
                                    Laporan Anggaran berdasarkan Rincian Kegiatan
                                </li>
                                <li style="margin-bottom: 4px; white-space: normal; ">
                                    Laporan Anggaran per Mata Anggaran berdasarkan Rincian Kegiatan
                                </li>
                            </ul>
                        </label>       
                   </div>
                   <div class="col-md-4 button-preview" style="padding: 5px">
                        <div class="row">
                           <div class="col-md-12 button-preview" style="padding: 5px;">

                               <select id="select_laporan_anggaran_berdasarkan_program_kerja" style="padding: 6px;">
                                    <?php if(sizeof($data_satker) == $ukuran_satker){ ?>
                                    <option value="">ALL SATKER</option>
                                    <?php } ?>
                                    <?php
                                    if(isset($data_satker) && is_array($data_satker)){
                                        foreach($data_satker as $satker){
                                            echo "<option value='".$satker->satkerid."'>".$satker->nama1."</option>\n";
                                        }
                                    }
                                    ?>
                                </select>          
                           </div>                  
                        </div>
                       <div class="row">
                           <div class="col-md-6 button-preview" style="padding: 5px;">
                               <button id="preview_laporan_anggaran_berdasarkan_program_kerja" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient button-button-preview" name="preview_laporan_anggaran_berdasarkan_program_kerja" value="Preview">Preview</button>            
                           </div>
                            <div class="col-md-6 button-preview" style="padding: 5px;">
                               <button id="download_laporan_anggaran_berdasarkan_program_kerja"  style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient button-button-preview" name="download_laporan_anggaran_berdasarkan_program_kerja" value="Print">Print</button>            
                           </div> 
                        </div>
                   </div>

               </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 10px; margin-right: 15px; margin-left: 15px;">
                <div class="row">
                    <div class="col-md-8 " style="padding: 5px 10px 5px 5px;">
                        <label style="text-align: left; padding-top: 10px; overflow: hidden; text-overflow: ellipsis;" for="laporan_anggaran_berdasarkan_mata_anggaran" class="col-md-12 control-label">
                            2. Laporan Anggaran Berdasarkan Mata Anggaran
                            <ul style="color: green; font-weight: 400;">
                                <li style="margin-bottom: 4px; margin-top: 4px; white-space: normal;">
                                    Laporan Anggaran Operasional

                                </li>
                                <li style="margin-bottom: 4px; white-space: normal;">
                                    Laporan Rincian Anggaran Operasional
                                </li>
                                <li style="margin-bottom: 4px; white-space: normal;">
                                    Laporan Anggaran Investasi dan Rencana Korporasi
                                </li>
                                <li style="margin-bottom: 4px; white-space: normal;">
                                    Laporan Rincian Anggaran Investasi dan Rencana Korporasi
                                </li>
                                <li style="margin-bottom: 4px; white-space: normal; ">
                                    Laporan Rincian Anggaran per Mata Anggaran
                                </li>
                            </ul>
                        </label>       
                   </div>
                   <div class="col-md-4 button-preview" style="padding: 5px">
                        <div class="row">
                           <div class="col-md-12 button-preview" style="padding: 5px;">

                               <select id="select_laporan_anggaran_berdasarkan_mata_anggaran" style="padding: 6px;">
                                    <?php if(sizeof($data_satker) == $ukuran_satker){ ?>
                                    <option value="">ALL SATKER</option>
                                    <?php } ?>
                                    <?php
                                    if(isset($data_satker) && is_array($data_satker)){
                                        foreach($data_satker as $satker){
                                            echo "<option value='".$satker->satkerid."'>".$satker->nama1."</option>\n";
                                        }
                                    }
                                    ?>
                                </select>          
                           </div>                  
                        </div>
                       <div class="row">
                           <div class="col-md-6 button-preview" style="padding: 5px;">
                               <button id="preview_laporan_anggaran_berdasarkan_mata_anggaran" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient button-button-preview" name="preview_laporan_anggaran_berdasarkan_mata_anggaran" value="Preview">Preview</button>            
                           </div>
                            <div class="col-md-6 button-preview" style="padding: 5px;">
                               <button id="download_laporan_anggaran_berdasarkan_mata_anggaran"  style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient button-button-preview" name="download_laporan_anggaran_berdasarkan_mata_anggaran" value="Print">Print</button>            
                           </div> 
                        </div>
                   </div>
               </div>
            </div>
            
            
            <div class="form-group" style="margin-bottom: 0px; margin-right: 15px; margin-left: 15px;">
                <div class="row">
                    <div class="col-md-8 " style="padding: 5px 10px 5px 5px;">
                        <label style="text-align: left; padding-top: 12px; overflow: hidden; text-overflow: ellipsis;" for=laporan_aktivitas_keuangan" class="col-md-8 control-label">3. Laporan Aktivitas Keuangan</label>
                    </div>
                    <div class="col-md-4 button-preview" style="padding: 5px; padding-bottom: 0px;">
                        <div class="row">
                           <div class="col-md-6 button-preview" style="padding: 5px; padding-bottom: 0px;">
                               <button id="preview_laporan_aktivitas_keuangan" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient button-button-preview" name="preview_laporan_aktivitas_keuangan" value="Preview">Preview</button>            
                           </div>
                            <div class="col-md-6 button-preview" style="padding: 5px; padding-bottom: 0px;">
                               <button id="download_laporan_aktivitas_keuangan"  style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient button-button-preview" name="download_laporan_aktivitas_keuangan" value="Print">Print</button>            
                           </div> 
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 0px; margin-right: 15px; margin-left: 15px;">
                <div class="row">
                    <div class="col-md-8 " style="padding: 5px 10px 5px 5px;">
                        <label style="text-align: left; padding-top: 12px; overflow: hidden; text-overflow: ellipsis;" for=laporan_anggaran_iku" class="col-md-8 control-label">4. Laporan Anggaran Berdasarkan IKU</label>
                    </div>
                    <div class="col-md-4 button-preview" style="padding: 5px; padding-bottom: 0px;">
                        <div class="row">
                           <div class="col-md-6 button-preview" style="padding: 5px; padding-bottom: 0px;">
                               <button id="preview_laporan_anggaran_iku" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient button-button-preview" name="preview_laporan_anggaran_iku" value="Preview">Preview</button>            
                           </div>
                            <div class="col-md-6 button-preview" style="padding: 5px; padding-bottom: 0px;">
                               <button id="download_laporan_anggaran_iku"  style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient button-button-preview" name="download_laporan_anggaran_iku" value="Print">Print</button>            
                           </div> 
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 0px; margin-right: 15px; margin-left: 15px;">
                <div class="row">
                    <div class="col-md-8 " style="padding: 5px 10px 5px 5px;">
                        <label style="text-align: left; padding-top: 12px; overflow: hidden; text-overflow: ellipsis;" for=data_upload_siaga" class="col-md-8 control-label">5. Data Upload SIAGA</label>
                    </div>
                    <div class="col-md-4 button-preview" style="padding: 5px; padding-bottom: 0px;">
                        <div class="row">
                           <div class="col-md-6 button-preview" style="padding: 5px; padding-bottom: 0px;">
                               <button id="preview_data_upload_siaga" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient button-button-preview" name="data_upload_siaga" value="Preview">Preview</button>            
                           </div>
                            <div class="col-md-6 button-preview" style="padding: 5px; padding-bottom: 0px;">
                               <button id="download_data_upload_siaga"  style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient button-button-preview" name="download_data_upload_siaga" value="Print">Print</button>            
                           </div> 
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </form>
</body>
</html>