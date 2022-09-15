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
    <?php $CI =& get_instance(); ?>
    <?php 
    
    $disabled = "";
    if(!isset($iku_kode)){
        if($CI->allow_create == "0"){
            $disabled = " disabled=''";
        }
    }
    if(isset($iku_kode)){
        if($CI->allow_update == "0"){
            $disabled = " disabled=''";
        }
    }
    
    ?>
    <script src="js/daftar-iku.js" referrerpolicy="origin"></script>
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
                    <input <?php echo $disabled; ?> type="text" id="ikunama" class="form-control" name="ikunama" placeholder="IKU Nama" value="<?php echo isset($iku_nama) ? $iku_nama : ""; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="ikurincian" class="col-xs-2 control-label">IKU Rincian</label>
                <div class="col-xs-10">
                    <textarea <?php echo $disabled; ?> class="form-control" id="ikurincian" name="ikurincian" placeholder="IKU Rincian" style="height: 150px;"><?php echo isset($iku_rincian) ? $iku_rincian : ""; ?></textarea>
                </div>
            </div>
            
            <div class="form-group" id="tempat_kegiatan_kode">
                <label for="kegiatan_kode" class="col-xs-2 control-label">Kode Kegiatan</label>
                <div class="col-xs-9 autocomplete">
                    <input required="" type="text" id="kegiatan_kode" class="form-control tambah-margin-bawah" name="kegiatan_kode" placeholder="Kode Kegiatan" value="<?php echo isset($kegiatan_kode_display) ? $kegiatan_kode_display : ""; ?>" autocomplete="off" disabled="" <?php echo isset($merah) && $merah == "merah" ? " style='color: red;'" : ""; ?>>
                    <input required="" type="hidden" id="kegiatan_kode_hidden" name="kegiatan_kode_hidden" value="<?php echo isset($kegiatan_kode_hidden) ? $kegiatan_kode_hidden : ""; ?>">
                </div>
                <div class="col-xs-1" style="padding-left:0px;">
                    <button <?php echo $disabled; ?> id="buka_dialog_kegiatan_kode" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="search" value="Search"><i class="fa fa-search"></i></button>
                </div>
            </div>
            
            <?php if(isset($collect_data_iku_pkt) && is_array($collect_data_iku_pkt) && sizeof($collect_data_iku_pkt) > 0){ ?>
            <script type="text/javascript">
            <?php for($i = 0; $i < sizeof($collect_data_iku_pkt); $i++){ ?>
            collection_array['<?php echo $collect_data_iku_pkt[$i]['attr_info']; ?>'] = true;
            <?php } ?>
            </script>
            <?php } ?>
            <div class="form-group">
                <label for="ikurincian" class="col-xs-2 control-label">IKU PKT</label>
                <div class="col-xs-10">
                    <table class="table table-bordered table-hover">
                        <thead style="background-color: white;">
                            <tr>
                                <th style="white-space: nowrap; width: 5%;">No</th>
                                <th style="white-space: nowrap; width: 10%;">SBP Kode</th>
                                <th style="white-space: nowrap; width: 10%;">PKT Kode</th>                      
                                <th style="white-space: nowrap; width: 70%;">PKT Nama</th>
                                <th style="white-space: nowrap; width: 5%;">Action</th>
                            </tr>

                        </thead>
                        <tbody style="white-space: pre-wrap;" id="pkt_detail">
                            <?php if(isset($collect_data_iku_pkt) && is_array($collect_data_iku_pkt) && sizeof($collect_data_iku_pkt) > 0){ ?>
                            <?php $no = 1; for($i = 0; $i < sizeof($collect_data_iku_pkt); $i++){ ?>
                            <tr>
                                <td style="text-align: right;" attr_data='<?php echo $collect_data_iku_pkt[$i]['attr_info']; ?>'><?php echo $no ?>.<input type="hidden" name="pkt_sbp[]" value="<?php echo $collect_data_iku_pkt[$i]['pktkode']; ?>,<?php echo $collect_data_iku_pkt[$i]['sbpkode']; ?>" /></td>
                                <td><?php echo $collect_data_iku_pkt[$i]['sbpkode']; ?></td>
                                <td><?php echo $collect_data_iku_pkt[$i]['pktkode']; ?></td>
                                <td><?php echo $collect_data_iku_pkt[$i]['pktnama']; ?></td>
                                <td><i class="fa fa-trash" style="cursor: pointer;" onclick="delete_row(this);"></i></td>
                            </tr>
                            <?php $no++; } ?>
                            <?php } else { ?>
                            <tr>
                                <td colspan="5">No Data.</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>  
                </div>
            </div>
            
            <div class="box-footer"></div>
            
            <div class="form-group">
                <div class="col-lg-6 col-md-6" style="margin-bottom: 40px;">
                    <button <?php echo $disabled; ?> style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="submit" class="btn btn-info pull-right bg-light-blue-gradient" name="input_daftar_iku" value="Input Daftar IKU">Input Daftar IKU</button>
                </div>
                <div class="col-lg-6 col-md-6">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important;" type="button" class="btn btn-default bg-aqua-gradient" onclick="move_url('daftar-iku');">Lihat Data</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>