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
    <?php $CI =& get_instance(); ?>
    <?php 
    
    $disabled = "";
    if(!isset($kode_ps)){
        if($CI->allow_create == "0"){
            $disabled = " disabled=''";
        }
    }
    if(isset($kode_ps)){
        if($CI->allow_update == "0"){
            $disabled = " disabled=''";
        }
    }
    
    ?>
    <script src="js/daftar-strategic-business-plan.js" referrerpolicy="origin"></script>
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
                <label for="jenis_entri" class="col-xs-2 control-label">Jenis Entri</label>
                <div class="col-xs-10">
                    <select <?php echo $disabled; ?> name="jenis_entri" id="jenis_entri" class="form-control">
                        <option value="PS">PS (Program Strategis)</option>
                        <option value="PKS" <?php echo isset($penanda_non_operasional) && $penanda_non_operasional == "1" ? " selected='selected'" : ""; ?>>PKS (Program Kerja Strategis)</option>
                        <option value="PKNS" <?php echo isset($penanda_non_operasional) && $penanda_non_operasional == "2" ? " selected='selected'" : ""; ?>>PKNS (Program Non Kerja Strategis)</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group" id="tempat_kode_ps_input" <?php echo isset($penanda_non_operasional) && ($penanda_non_operasional == "1" || $penanda_non_operasional == "2") ? " style='display: none;'" : ""; ?>>
                <label for="kode_ps_program_strategis" class="col-xs-2 control-label">Kode PS</label>
                <div class="col-xs-10">
                    <select <?php echo $disabled; ?> required id="kode_ps_program_strategis" class="form-control" name="kode_ps">
                        <option value="">PILIH</option>
                        <?php 
                        for($i = 1; $i <= 99; $i++){
                            $selected = isset($sbpkode) && $sbpkode == samakan($i, 99) ? " selected=''" : "";
                            echo "<option ".$selected." value='".samakan($i, 99)."'>". samakan($i, 99)."</option>\n";
                        }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group" id="tempat_kode_ps_pilih" <?php echo isset($penanda_non_operasional) && ($penanda_non_operasional == "1" || $penanda_non_operasional == "2") ? "" : " style='display: none;'"; ?>>
                <label for="kode_ps_pilih" class="col-xs-2 control-label">Kode PS</label>
                <div class="col-xs-9 autocomplete">
                    <input required="" type="text" id="kode_ps_pilih" class="form-control tambah-margin-bawah" name="kode_ps_pilih" placeholder="Kode PS" value="<?php echo isset($kode_ps_display) ? $kode_ps_display : ""; ?>" autocomplete="off" disabled="" <?php echo isset($merah) && $merah == "merah" ? " style='color: red;'" : ""; ?>>
                    <input disabled="" required="" type="hidden" id="kode_ps_pilih_hidden" name="kode_ps" value="<?php echo isset($sbp_kode_param_edit) ? $sbp_kode_param_edit : ""; ?>">
                </div>
                <div class="col-xs-1" style="padding-left:0px;">
                    <button <?php echo $disabled; ?> id="buka_dialog_kode_ps" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="search" value="Search"><i class="fa fa-search"></i></button>
                </div>
            </div>
            
            <div class="form-group">
                <label for="kode_pks_pkns_display" class="col-xs-2 control-label">Kode PKS/PKNS</label>
                <div class="col-xs-10">
                    <input disabled="" type="text" id="kode_pks_pkns_display" pattern="\d*" class="form-control numberonly-no-comma" name="kode_pks_pkns_display" placeholder="Kode PKS/PKNS" value="<?php echo isset($penanda_non_operasional) ? $penanda_non_operasional : "0"; ?>" maxlength="1">
                    <input type="hidden" name="kode_pks_pkns" id="kode_pks_pkns" value="<?php echo isset($penanda_non_operasional) ? $penanda_non_operasional : "0"; ?>" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="nomor_pks_pkns" class="col-xs-2 control-label">Nomor PKS/PKNS</label>
                <div class="col-xs-10">
                    <select disabled="" id="nomor_pks_pkns" name="nomor_pks_pkns" class="form-control">
                        <option value="">PILIH</option>
                        <?php 
                        for($i = 1; $i <= 99; $i++){
                            $selected = isset($nomor_pks_pkns) && $nomor_pks_pkns == samakan($i, 99) ? " selected=''" : "";
                            echo "<option ".$selected." value='".samakan($i, 99)."'>". samakan($i, 99)."</option>\n";
                        }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="sbp_nourut" class="col-xs-2 control-label">SBP Nourut</label>
                <div class="col-xs-10">
                    <input disabled="" type="text" id="sbp_nourut_display" class="form-control numberonly-no-comma" name="sbp_nourut_display" placeholder="SBP Nourut" value="<?php echo isset($sbp_nourut) ? $sbp_nourut : "A"; ?>">
                    <input type="hidden" name="sbp_nourut" id="sbp_nourut" value="<?php echo isset($sbp_nourut) ? $sbp_nourut : "A"; ?>" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="keterangan" class="col-xs-2 control-label">Keterangan</label>
                <div class="col-xs-10">
                    <input <?php echo $disabled; ?> required type="text" id="keterangan" class="form-control" name="keterangan" placeholder="Keterangan" value="<?php echo isset($sbp_keterangan) ? $sbp_keterangan : ""; ?>">
                </div>
            </div>
            
            <div class="box-footer"></div>
            
            <div class="form-group">
                <div class="col-xs-6" style="margin-bottom: 40px;">
                    <button <?php echo $disabled; ?> style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="submit" class="btn btn-info pull-right bg-light-blue-gradient" name="input_daftar_strategic_business_plan" value="Input Daftar Strategic Business Plan" disabled="">Input Daftar Strategic Business Plan</button>
                </div>
                <div class="col-xs-6">
                    <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important;" type="button" class="btn btn-default bg-aqua-gradient" onclick="move_url('daftar-strategic-business-plan');">Lihat Data</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>