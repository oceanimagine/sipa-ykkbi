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
    
    <?php $CI =& get_instance(); ?>
    <?php 
    
    $disabled = "";
    if(!isset($sbpkode_hidden)){
        if($CI->allow_create == "0"){
            $disabled = " disabled=''";
        }
    }
    if(isset($sbpkode_hidden)){
        if($CI->allow_update == "0"){
            $disabled = " disabled=''";
        }
    }
    
    ?>
    
    <?php if(isset($merah) && $merah == "merah"){ ?>
    <script type="text/javascript">
    var merah = "merah";
    </script>
    <?php } ?>
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
                    <div style="display: table; width: 100%; margin-top: 15px; display: none;" id="filter_sbp_container">
                        <div style="width: 2.5%; float: left;">
                            <input <?php echo $disabled; ?> type="checkbox" name="sbpps_kode_filter" id="sbpps_kode_filter" style="width: 20px; margin: 0px !important; padding: 0px; display: block; overflow: hidden; height: 18px;">
                        </div>
                        <div style="display: table;height: 18px;">
                            <span style="display: table-cell; vertical-align: middle;font-size: 14px;">Filter Kegiatan Berdasarkan SBP.</span>
                        </div>
                    </div>
                    
                </div>
                <div class="col-xs-1" style="padding-left:0px;">
                    <button <?php echo $disabled; ?> id="buka_dialog_sbpps_kode" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="search" value="Search"><i class="fa fa-search"></i></button>
                </div>
            </div>
            
            <div class="form-group">
                <label for="pktkrk" class="col-xs-2 control-label">Tipe</label>
                <div class="col-xs-10">
                    <select <?php echo $disabled; ?> name="pktkrk" id="pktkrk" class="form-control">
                        <option value="K" <?php echo isset($pktkrk) && $pktkrk == "K" ? " selected" : ""; ?>>Kegiatan</option>
                        <option value="RK" <?php echo isset($pktkrk) && $pktkrk == "RK" ? " selected" : ""; ?>>Rincian Kegiatan</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group" id="tempat_kegiatan_kode" style="display: none;">
                <label for="kegiatan_kode" class="col-xs-2 control-label">Kode Kegiatan</label>
                <div class="col-xs-9 autocomplete">
                    <input required="" type="text" id="kegiatan_kode" class="form-control tambah-margin-bawah" name="kegiatan_kode" placeholder="Kode Kegiatan" value="<?php echo isset($kegiatan_kode_display) ? $kegiatan_kode_display : ""; ?>" autocomplete="off" disabled="" <?php echo isset($merah) && $merah == "merah" ? " style='color: red;'" : ""; ?>>
                    <input required="" type="hidden" id="kegiatan_kode_hidden" name="kegiatan_kode_hidden" value="<?php echo isset($kegiatan_kode_hidden) ? $kegiatan_kode_hidden : ""; ?>">
                </div>
                <div class="col-xs-1" style="padding-left:0px;">
                    <button <?php echo $disabled; ?> id="buka_dialog_kegiatan_kode" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="search" value="Search"><i class="fa fa-search"></i></button>
                </div>
            </div>
            
            <div class="form-group">
                <label for="satker_pkt_kode" class="col-xs-2 control-label">PKT Kode</label>
                <div class="col-xs-5" id="tempat_satker_pkt_kode" style="padding-right: 6px;">
                    <select <?php echo $disabled; ?> name="satker_pkt_kode" id="satker_pkt_kode" class="form-control">
                        <option value="">PILIH SATKER</option>
                        <?php foreach($satker_view as $data){ ?>
                        <?php $selected = isset($satker_display) && $satker_display == $data->satkerid ? " selected='selected'" : ""; ?>
                        <option value="<?php echo $data->satkerid; ?>"<?php echo $selected; ?>><?php echo "(" . $data->satkerid . ")" . " " . $data->nama1; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-xs-5" id="tempat_nokegiatan_pkt_kode" style="padding-left: 6px;">
                    <select <?php echo $disabled; ?> name="nokegiatan_pkt_kode" id="nokegiatan_pkt_kode" class="form-control">
                        <option value="">NOKEGIATAN</option>
                        <?php for($i = 1; $i <= 99; $i++){ ?>
                        <?php $selected = isset($urutan_kegiatan) && $urutan_kegiatan == samakan($i, 99) ? " selected='selected'" : ""; ?>
                        <option value="<?php echo samakan($i, 99); ?>"<?php echo $selected; ?>><?php echo samakan($i, 99); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-xs-5" id="tempat_norinciankegiatan_pkt_kode" style="display: none;">
                    <select <?php echo $disabled; ?> name="norinciankegiatan_pkt_kode" id="norinciankegiatan_pkt_kode" class="form-control">
                        <option value="">NORINCIANKEGIATAN</option>
                        <?php for($i = 1; $i <= 99; $i++){ ?>
                        <?php $selected = isset($urutan_rincian_kegiatan) && $urutan_rincian_kegiatan == samakan($i, 99) ? " selected='selected'" : ""; ?>
                        <option value="<?php echo samakan($i, 99); ?>"<?php echo $selected; ?>><?php echo samakan($i, 99); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="pktnama" class="col-xs-2 control-label">PKT Nama</label>
                <div class="col-xs-10">
                    <input <?php echo $disabled; ?> type="text" id="pktnama" class="form-control" name="pktnama" placeholder="PKT Nama" value="<?php echo isset($pktnama) ? $pktnama : ""; ?>" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="pktoutput" class="col-xs-2 control-label">PKT Output</label>
                <div class="col-xs-10">
                    <input <?php echo $disabled; ?> type="text" id="pktoutput" class="form-control" name="pktoutput" placeholder="PKT Output" value="<?php echo isset($pktoutput) ? $pktoutput : ""; ?>" />
                </div>
            </div>
            
            <div class="box-footer"></div>
            
            <div class="form-group">
                <div class="col-lg-6 col-md-6" style="margin-bottom: 40px;">
                    <button <?php echo $disabled; ?> style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="submit" class="btn btn-info pull-right bg-light-blue-gradient" name="input_daftar_program_kerja_tahunan" value="Input Daftar Program Kerja Tahunan" disabled>Input Daftar Program Kerja Tahunan</button>
                </div>
                <div class="col-lg-6 col-md-6">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important;" type="button" class="btn btn-default bg-aqua-gradient" onclick="move_url('daftar-program-kerja-tahunan');">Lihat Data</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>