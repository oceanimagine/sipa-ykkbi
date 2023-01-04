<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Rincian Anggaran</title>
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
            /* Script Goes Here */
             function move_url(link){
                document.location = "../../../index.php/" + link;
            }
        </script>
    </head>
    <body>
        
        <?php $CI =& get_instance(); ?>
        <?php 

        $disabled = "";
        if(!isset($data_rincian_kegiatan_display)){
            if($CI->allow_create == "0"){
                $disabled = " disabled=''";
            }
        }
        if(isset($data_rincian_kegiatan_display)){
            if($CI->allow_update == "0"){
                $disabled = " disabled=''";
            }
        }

        ?>
        
        <?php 
        
        $size_group_edit = 1;
        $size_rincian_edit = 1;
        $initial_hidden = "_1";
        $kumpulan_alphabet = "";
        if(isset($data_rincian_edit)){
            // cetak_html($data_rincian_edit);
            // cetak_html($data_group_edit);
            // cetak_html($data_rincian_kegiatan_edit);
            // cetak_html($data_mata_anggaran_edit);
            $size_group_edit = sizeof($data_group_edit);
            $size_rincian_edit = sizeof($data_rincian_edit);
            
            $comma = "";
            $initial_hidden = "";
            for($i = 0; $i < sizeof($data_group_edit); $i++){
                $initial_hidden = $initial_hidden . $comma . "_" . ($i + 1);
                $comma = ",";
            }
            
            $inisial_alphabet = 1;
            $comma_alphabet = "";
            $inisial_lanjutan = array();
            $alphabet_lanjutan = array();
            $keys_ma = array_keys($mata_anggaran_lanjutan_display);
            for($i = 0; $i < sizeof($keys_ma); $i++){
                $keys_rincian_lanjutan = array_keys($rincian_lanjutan);
                for($j = 0; $j < sizeof($keys_rincian_lanjutan); $j++){
                    if(substr($keys_rincian_lanjutan[$j], 0, strlen($keys_ma[$i])) == $keys_ma[$i]){
                        if(!isset($inisial_lanjutan[$keys_ma[$i]])){
                            $comma = "";
                            $address = 1;
                            $inisial_lanjutan[$keys_ma[$i]] = "_" . $address;
                            $comma = ",";
                            $address++;
                        } else {
                            $inisial_lanjutan[$keys_ma[$i]] = $inisial_lanjutan[$keys_ma[$i]] . $comma . "_" . $address;
                            $address++;
                        }
                    }
                }
                $alphabet_lanjutan[$keys_ma[$i]] = convert_alphabet($inisial_alphabet)[0];
                $kumpulan_alphabet = $kumpulan_alphabet . $comma_alphabet . convert_alphabet($inisial_alphabet)[0];
                $comma_alphabet = ",";
                $inisial_alphabet++;
            }
            // echo "<pre>\n";
            // print_r($inisial_lanjutan);
            // echo "</pre>\n";
            
        }
        
        if($initial_hidden == ""){
            $initial_hidden = "_1";
        }
        
        if($size_group_edit == 0){
            $size_group_edit = 1;
        }
        
        if($size_rincian_edit == 0){
            $size_group_edit = 1;
        }
        
        ?>
        <link rel="stylesheet" href="css/add-anggaran-css.css"  type="text/css" />
        <script src="js/add-anggaran-js.js" referrerpolicy="origin"></script>
        <?php if(isset($konfirmasi_hapus) && $konfirmasi_hapus){ ?>
        <style type="text/css">
            thead {
                top: 50px !important;
            }
        </style>
        <?php } ?>
        <form novalidate class="form-horizontal" method="POST" enctype="multipart/form-data" id="form-anggaran-tahunan">
           
                <?php 
                $disabled_input = "";
                if(isset($konfirmasi_hapus) && $konfirmasi_hapus){
                    $disabled_input = " disabled";
                    $default_redaksi = "Jika anda yakin ingin menghapus data di bawah silahkan klik tombol <b>Hapus Anggaran</b>.";
                    if($CI->allow_read == "1" && $CI->allow_delete == "0"){
                        $default_redaksi = "Berikut adalah data detail <b>Anggaran</b>.";
                    }
                    cetak_html("
                        <script type=\"text/javascript\">var konfirmasi_hapus = true;</script>
                        <div class=\"form-group\" style=\"position: sticky; top: 0px; z-index: 99;\">
                        <div class=\"col-xs-12\">
                        <pre style='margin: 0px; border-radius: 0px; text-align: center; font-size: 20px; width: 100%; border: white 1px solid;'>".$default_redaksi."</pre>
                        </div>
                        </div>
                    ");
                }
                ?>
                <div class="form-group" style="min-width: 1350px;">
                    <div class="col-md-12">
                        <div style="border: #f1f1f1 1px solid; box-shadow: 0 0 20px rgb(0 0 0 / 15%); padding: 12px 15px; margin-top: 15px; min-width: 1350px;">
                            <?php /* <i class="fa fa-file" onclick="tambah_table();" style="cursor: pointer;"></i>&nbsp;&nbsp;Form Anggaran */ ?>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-group" style="margin-bottom:0px;">
                                    <label for="satuan_kerja" class="col-xs-2 control-label" style="padding-left: 8px;">Satker</label>
                                        <div class="col-xs-10 autocomplete" style="padding-right: 0px;">
                                            <?php if(isset($data_satker) && is_array($data_satker)){ ?>
                                            <?php if(sizeof($data_satker) > 1){ ?>
                                            <select <?php echo $disabled_input; ?> required="" id="satuan_kerja" class="form-control tambah-margin-bawah" name="satuan_kerja" value="">
                                                <option value="">PILIH</option>
                                                <?php

                                                if(isset($data_satker) && is_array($data_satker)){
                                                    foreach($data_satker as $satker){
                                                        $selected = isset($id_satker_edit) && $id_satker_edit == $satker->satkerid ? " selected='selected'" : "";
                                                        echo "<option value='(".$satker->satkerid.") ".$satker->nama1."'".$selected.">(".$satker->satkerid.") ".$satker->nama1."</option>\n";
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <?php } else if(sizeof($data_satker) > 0){ ?>
                                            <input required type="text" id="satuan_kerja_display" class="form-control tambah-margin-bawah" name="satuan_kerja_display" placeholder="Satuan Kerja" value="<?php echo "(" . $data_satker[0]->satkerid . ") " . $data_satker[0]->nama1; ?>" autocomplete="off" disabled>
                                            <input required="" type="hidden" id="satuan_kerja" name="satuan_kerja" value="<?php echo "(" . $data_satker[0]->satkerid . ") " . $data_satker[0]->nama1; ?>" />
                                            <?php } ?>
                                            <?php } ?>
                                            <input type="hidden" name="kode_project_hidden" value="{replace_project_modal}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-group" style="margin-bottom:0px;">
                                        <label for="kegiatan_program_kerja_rincian" class="col-xs-2 control-label" style="padding-left: 8px;">Rincian Kegiatan <?php /* echo convert_alphabet($inisial_alphabet)[0]; */ ?></label>
                                        <div class="col-xs-9 autocomplete">
                                            <input required="" type="text" id="kegiatan_program_kerja_rincian" class="form-control tambah-margin-bawah" name="kegiatan_program_kerja_rincian" placeholder="Rincian Kegiatan" value="<?php echo isset($data_rincian_kegiatan_display) ? $data_rincian_kegiatan_display : ""; ?>" title="<?php echo isset($data_rincian_kegiatan_display) ? $data_rincian_kegiatan_display : ""; ?>" autocomplete="off" disabled="">
                                            <input required="" type="hidden" id="kegiatan_program_kerja_rincian_hidden" name="kegiatan_program_kerja_rincian_hidden" value="<?php echo isset($data_rincian_kegiatan_hidden) ? $data_rincian_kegiatan_hidden : ""; ?>">
                                        </div>
                                        <div class="col-xs-1" style="padding: 0px;">
                                            <button <?php echo $disabled_input; ?> id="buka_dialog_rincian_kegiatan" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="search" value="Search"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                    
                        </div>
                    </div>
                </div>
                
                
                <?php 
                
                if(isset($data_mata_anggaran_display)){
                    $explode_ = explode(" # ", $data_mata_anggaran_display);
                    $nilai_ma = $explode_[0];
                    ?>
                    <script type="text/javascript">
                        
                        choosen_ma['default'] = '<?php echo $nilai_ma; ?>';
                    </script>
                    <?php 
                }
                
                ?>
            
                <div class="form-group">
                    <div class="col-md-12" id="tempat_utama_table">
                        <div style="border: #f1f1f1 1px solid; box-shadow: 0 0 20px rgb(0 0 0 / 15%); padding: 12px 15px; /* margin-bottom: 15px; */ min-width: 1350px;">
                            <?php /* <i class="fa fa-plus" onclick="tambah_table();" style="cursor: pointer;"></i>&nbsp;&nbsp;Add Table */ ?>
                            <div class="form-group" style="margin-bottom: 0px;">
                                <div class="col-xs-12" style="padding-left: 0px;">
                                    <div class="form-group" style="margin-bottom: 0px;">
                                        <label for="mata_anggaran" class="col-xs-2 control-label" style="padding-left: 0px;"><i class="fa fa-plus" onclick="tambah_table();" style="cursor: pointer;"></i>&nbsp;&nbsp;Mata Anggaran</label>
                                        <div class="col-xs-9 autocomplete" id="tempat_inisial_hidden" style="padding-left: 30px;">
                                            <input required="" type="text" id="mata_anggaran" class="form-control tambah-margin-bawah" name="mata_anggaran" placeholder="Mata Anggaran" value="<?php echo isset($data_mata_anggaran_display) ? $data_mata_anggaran_display : ""; ?>" title="<?php echo isset($data_mata_anggaran_display) ? $data_mata_anggaran_display : ""; ?>" autocomplete="off" disabled="">
                                            <input required="" type="hidden" id="mata_anggaran_hidden" name="mata_anggaran_hidden" value="<?php echo isset($data_mata_anggaran_hidden) ? $data_mata_anggaran_hidden : ""; ?>">
                                            <input required="" type="hidden" name="inisial_all" id="inisial_all" value="<?php echo $initial_hidden; ?>">
                                        </div>
                                        <div class="col-xs-1" style="padding:0px;">
                                            <button <?php echo $disabled_input; ?> id="buka_dialog_mata_anggaran" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="search" value="Search"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="kumpulan_alphabet" name="kumpulan_alphabet" value="<?php echo $kumpulan_alphabet; ?>" />
                        </div>
                        <table class="styled-table" style="border: #f1f1f1 1px solid; min-width: 1350px;" id="table-anggaran-tahunan">
                            <thead>
                                <tr>
                                    <th colspan="7" style="text-align: center; border-right: #f1f1f1 1px solid; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Rincian Mata Anggaran</th>
                                    <th colspan="8" style="text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap; border-right: #f1f1f1 1px solid;">RPPT</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="3"><i class="fa fa-info"></i></th>
                                </tr>
                                <tr>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2" colspan="2">Nomor</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2">Nama</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2">Q</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2">F</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Tarif</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Sub Total</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;" colspan="2">TW I</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;" colspan="2">TW II</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;" colspan="2">TW III</th>
                                    <th style="border-bottom: #f1f1f1 1px solid; text-align: center; white-space: nowrap; border-right: #f1f1f1 1px solid;" colspan="2">TW IV</th>
                                </tr>
                                <tr>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Rp</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Rp</th><?php /*
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Nom</th>*/ ?>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Rp</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Rp</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Rp</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Rp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i = 0; $i < $size_group_edit; $i++){ ?>
                                <tr class="induk_group_<?php echo ($i + 1); ?>">
                                    <td style="border-left: #f1f1f1 1px solid; text-align: center; border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid;"><i class="fa fa-minus" onclick="min_group(this, '_<?php echo ($i + 1); ?>', <?php echo $size_group_edit; ?>);" style="cursor: pointer;"></i></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid;"><i class="fa fa-plus" onclick="add_group(this, '_<?php echo ($i + 1); ?>', <?php echo $size_group_edit; ?>);" style="cursor: pointer;"></i></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid; background-color: rgb(220,230,241);" colspan="14"><input <?php echo $disabled_input; ?> required="" type="text" style="box-sizing: border-box;border: none;outline: none;height: 32px; width: 100%;background-color: rgb(220,230,241);color:  black;font-weight: bold;height: 100%;" placeholder="GROUP DEFAULT" name="group_default[]" value="<?php echo isset($data_group_edit) && isset($data_group_edit[$i]->group) ? $data_group_edit[$i]->group : ""; ?>"></td>
                                    <?php /* <td style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f0f0f0 1px solid;"><i class="fa fa-plus"></i></td> */ ?>
                                </tr>
                                <?php $no = 1; ?>
                                
                                <?php 
                                
                                $jumlah_rincian = /* ($size_group_edit > 1) ? 0 : 1 */ isset($data_rincian_edit) ? 0 : 1;
                                for($j = 0; $j < $size_rincian_edit; $j++){
                                    if((isset($data_rincian_edit) && $data_rincian_edit[$j]->group == $data_group_edit[$i]->group)){
                                        $jumlah_rincian++;
                                    }
                                } 
                                $total_rintotal = 0;
                                $total_rppt1nom = 0;
                                $total_rppt2nom = 0;
                                $total_rppt3nom = 0;
                                $total_rppt4nom = 0;
                                $total_perkalian = 0;
                                ?> 
                                
                                
                                <?php for($j = 0; $j < $size_rincian_edit; $j++){ ?>
                                <?php if((isset($data_rincian_edit) && $data_rincian_edit[$j]->group == $data_group_edit[$i]->group) || (!isset($data_rincian_edit))){ ?>
                                <tr <?php echo $no == $jumlah_rincian ? 'style="border-bottom: rgb(242,220,219) 2px solid;"' : ""; ?> class="anakan_group_<?php echo ($i + 1); ?>">
                                    <?php 
                                    
                                    if($size_rincian_edit == 1){
                                        $total_perkalian = $data_rincian_edit[$j]->rintotal;
                                    }
                                    
                                    if($size_rincian_edit > 1){
                                        $total_perkalian = ($data_rincian_edit[$j]->rinkuantitas * $data_rincian_edit[$j]->rinfrekwensi * $data_rincian_edit[$j]->rintarif); 
                                    }
                                    
                                    ?>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;" colspan="2" class="td_number_<?php echo ($i + 1); ?>"><?php echo $no; ?></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 25%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="nama_<?php echo ($i + 1); ?>[]" class="textinput" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; width: 88%;" placeholder="NAMA" value="<?php echo isset($data_rincian_edit) && isset($data_rincian_edit[$j]->rincian) ? $data_rincian_edit[$j]->rincian : ""; ?>"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="Q_<?php echo ($i + 1); ?>[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="Q" value="<?php echo isset($data_rincian_edit) && isset($data_rincian_edit[$j]->rinkuantitas) ? $data_rincian_edit[$j]->rinkuantitas : "0"; ?>"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="F_<?php echo ($i + 1); ?>[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="F" value="<?php echo isset($data_rincian_edit) && isset($data_rincian_edit[$j]->rinfrekwensi) ? $data_rincian_edit[$j]->rinfrekwensi : "0"; ?>"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;">
                                        <input <?php echo $disabled_input; ?> autocomplete="off" name="tarif_<?php echo ($i + 1); ?>[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 34px; text-align: right;width: 82%;" placeholder="NOM" value="<?php echo isset($data_rincian_edit) && isset($data_rincian_edit[$j]->rintarif) ? $data_rincian_edit[$j]->rintarif : "0,00"; ?>">
                                        <a class="fa fa-question-circle" onclick="show_master_tarif(this.parentNode.getElementsByTagName('input')[0]);" style="vertical-align: middle; cursor: pointer; font-size: 14px;"></a>
                                    </td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="subtotal_<?php echo ($i + 1); ?>[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="<?php echo isset($data_rincian_edit) && isset($data_rincian_edit[$j]->rintotal) ? $total_perkalian : "0,00"; ?>"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="persen_tw1_<?php echo ($i + 1); ?>[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="<?php echo isset($data_rincian_edit) && isset($data_rincian_edit[$j]->rppt1perc) ? $data_rincian_edit[$j]->rppt1perc : "0,00"; ?>"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="tw1_<?php echo ($i + 1); ?>[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="<?php echo isset($data_rincian_edit) && isset($data_rincian_edit[$j]->rppt1nom) ? remove_comma_decimal($data_rincian_edit[$j]->rppt1nom) : "0,00"; ?>"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="persen_tw2_<?php echo ($i + 1); ?>[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="<?php echo isset($data_rincian_edit) && isset($data_rincian_edit[$j]->rppt2perc) ? $data_rincian_edit[$j]->rppt2perc : "0,00"; ?>"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="tw2_<?php echo ($i + 1); ?>[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="<?php echo isset($data_rincian_edit) && isset($data_rincian_edit[$j]->rppt2nom) ? remove_comma_decimal($data_rincian_edit[$j]->rppt2nom) : "0,00"; ?>"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="persen_tw3_<?php echo ($i + 1); ?>[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="<?php echo isset($data_rincian_edit) && isset($data_rincian_edit[$j]->rppt3perc) ? $data_rincian_edit[$j]->rppt3perc : "0,00"; ?>"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="tw3_<?php echo ($i + 1); ?>[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="<?php echo isset($data_rincian_edit) && isset($data_rincian_edit[$j]->rppt3nom) ? remove_comma_decimal($data_rincian_edit[$j]->rppt3nom) : "0,00"; ?>"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="persen_tw4_<?php echo ($i + 1); ?>[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="<?php echo isset($data_rincian_edit) && isset($data_rincian_edit[$j]->rppt4perc) ? $data_rincian_edit[$j]->rppt4perc : "0,00"; ?>"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="tw4_<?php echo ($i + 1); ?>[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="<?php echo isset($data_rincian_edit) && isset($data_rincian_edit[$j]->rppt4nom) ? remove_comma_decimal($data_rincian_edit[$j]->rppt4nom) : "0,00"; ?>"></td>
                                    <td style="border-right: #f1f1f1 1px solid; text-align: center; width: 40px; padding: 0px; vertical-align: middle; width: 3%;"><i class="fa fa-minus" onclick="kurangi_anak_grup(this,'_<?php echo ($i + 1); ?>',<?php echo $jumlah_rincian; ?>);" style="cursor: pointer;"></i></td>
                                </tr>
                                <?php  
                                if($size_rincian_edit == 1){
                                    $total_rintotal = $data_rincian_edit[$j]->rintotal;
                                    $total_rppt1nom = $data_rincian_edit[$j]->rppt1nom;
                                    $total_rppt2nom = $data_rincian_edit[$j]->rppt2nom;
                                    $total_rppt3nom = $data_rincian_edit[$j]->rppt3nom;
                                    $total_rppt4nom = $data_rincian_edit[$j]->rppt4nom;
                                }
                                if($size_rincian_edit > 1){ $no++; 
                                    $total_rintotal = $total_rintotal + $total_perkalian;
                                    $total_rppt1nom = $total_rppt1nom + $data_rincian_edit[$j]->rppt1nom;
                                    $total_rppt2nom = $total_rppt2nom + $data_rincian_edit[$j]->rppt2nom;
                                    $total_rppt3nom = $total_rppt3nom + $data_rincian_edit[$j]->rppt3nom;
                                    $total_rppt4nom = $total_rppt4nom + $data_rincian_edit[$j]->rppt4nom;
                                    
                                }} 
                                ?>
                                <?php } ?>
                                <tr class="jumlah_anakan_<?php echo ($i + 1); ?>" style="border-bottom: rgb(220,230,241) 2px solid; box-shadow: inset 0 1px 0 rgb(242 220 219), inset 0 -1px 0 rgb(220 230 241);">
                                    <td style="text-align: right; border-right: #f0f0f0 1px solid;" colspan="6">Total</td>
                                    <td style="text-align: right; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);" info="total_rintotal"><?php echo set_titik($total_rintotal); ?></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                                    <td style="text-align: right; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);" info="total_rppt1nom"><?php echo set_titik($total_rppt1nom); ?></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                                    <td style="text-align: right; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);" info="total_rppt2nom"><?php echo set_titik($total_rppt2nom); ?></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                                    <td style="text-align: right; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);" info="total_rppt3nom"><?php echo set_titik($total_rppt3nom); ?></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                                    <td style="text-align: right; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);" info="total_rppt4nom"><?php echo set_titik($total_rppt4nom); ?></td>
                                    <td style="border-right: #f1f1f1 1px solid; text-align: center; width: 40px"><i class="fa fa-plus" urutan_grup="tombol_anakan_<?php echo ($i + 1); ?>" style="cursor: pointer;" onclick="tambah_anak_grup(this,'_<?php echo ($i + 1); ?>',<?php echo ($size_rincian_edit > 1) ? ($no - 1) : $no; ?>);"></i></td>
                                </tr>
                                <?php } ?>
                                
                            </tbody>
                        </table>
                        
                        <script type="text/javascript">
                            var kumpulan_alphabet = "<?php echo $kumpulan_alphabet; ?>";
                            var kondisi_page = "add";
                        </script>
                        <?php 
                        
                        if(isset($data_mata_anggaran_display)){
                            ?>
                            <script type="text/javascript">
                                kondisi_page = "edit";
                            </script>
                            <?php
                        }
                        
                        if(isset($keys_ma)){
                            ?>
                            <script type="text/javascript">
                                next_inisial_global = 2;
                            </script>
                            <?php 
                            for($i = 0; $i < sizeof($keys_ma); $i++){
                                
                                $explode_ = explode(" # ", $mata_anggaran_lanjutan_display[$keys_ma[$i]]);
                                $nilai_ma = $explode_[0];
                                ?>
                                <script type="text/javascript">
                                    choosen_ma['<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>'] = '<?php echo $nilai_ma; ?>';
                                </script>
                                
                                <div style="border: #f1f1f1 1px solid; box-shadow: 0 0 20px rgb(0 0 0 / 15%); padding: 12px 15px; /* margin-bottom: 15px; */ margin-top: 15px; min-width: 1350px;">
                                    <?php /* <i class="fa fa-minus" onclick="kurangi_table('<?php echo ($i + 2); ?>',this);" style="cursor: pointer;"></i>&nbsp;&nbsp;Remove Table */ ?>
                                    <div class="form-group" style="margin-bottom: 0px;">
                                        <div class="col-xs-12" style="padding-left: 0px;">
                                            <div class="form-group" style="margin-bottom: 0px;">
                                                <label for="mata_anggaran<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>" class="col-xs-2 control-label" style="padding-left: 0px;"><i class="fa fa-minus" onclick="kurangi_table('<?php echo ($i + 2); ?>',this);" style="cursor: pointer;"></i>&nbsp;&nbsp;Mata Anggaran</label>
                                                <div class="col-xs-9 autocomplete" id="tempat_inisial_hidden" style="padding-left: 30px;">
                                                    <input required="" type="text" id="mata_anggaran<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>" class="form-control tambah-margin-bawah" name="mata_anggaran<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>" placeholder="Mata Anggaran" value="<?php echo $mata_anggaran_lanjutan_display[$keys_ma[$i]]; ?>" title="<?php echo $mata_anggaran_lanjutan_display[$keys_ma[$i]]; ?>" autocomplete="off" disabled="">
                                                    <input required="" type="hidden" id="mata_anggaran<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>_hidden" name="mata_anggaran<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>_hidden" value="<?php echo $mata_anggaran_lanjutan_hidden[$keys_ma[$i]]; ?>">
                                                    <input required="" type="hidden" name="inisial_all_<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>" id="inisial_all_<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>" value="<?php echo $inisial_lanjutan[$keys_ma[$i]]; ?>">
                                                </div>
                                                <div class="col-xs-1" style="padding:0px;">
                                                    <button <?php echo $disabled_input; ?> id="buka_dialog_mata_anggaran<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="search" value="Search"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <table class="styled-table" style="border: #f1f1f1 1px solid; min-width: 1350px;" id="table-anggaran-tahunan<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>">
                                    <thead>
                                        <tr>
                                            <th colspan="7" style="text-align: center; border-right: #f1f1f1 1px solid; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Rincian Mata Anggaran</th>
                                            <th colspan="8" style="text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap; border-right: #f1f1f1 1px solid;">RPPT</th>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="3"><i class="fa fa-info"></i></th>
                                        </tr>
                                        <tr>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2" colspan="2">Nomor</th>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2">Nama</th>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2">Q</th>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2">F</th>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Tarif</th>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Sub Total</th>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;" colspan="2">TW I</th>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;" colspan="2">TW II</th>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;" colspan="2">TW III</th>
                                            <th style="border-bottom: #f1f1f1 1px solid; text-align: center; white-space: nowrap; border-right: #f1f1f1 1px solid;" colspan="2">TW IV</th>
                                        </tr>
                                        <tr>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Rp</th>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Rp</th><?php /*
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Nom</th>*/ ?>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Rp</th>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Rp</th>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Rp</th>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                                            <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Rp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $size_group_edit = sizeof($group_lanjutan[$keys_ma[$i]]); ?>
                                        <?php $data_group_edit_ = $group_lanjutan[$keys_ma[$i]]; ?>
                                        <?php for($j = 0; $j < $size_group_edit; $j++){ ?>
                                        <tr class="induk_group_<?php echo ($j + 1); ?>">
                                            <td style="border-left: #f1f1f1 1px solid; text-align: center; border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid;"><i class="fa fa-minus" onclick="min_group(this, '_<?php echo ($j + 1); ?>', <?php echo $size_group_edit; ?>);" style="cursor: pointer;"></i></td>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid;"><i class="fa fa-plus" onclick="add_group(this, '_<?php echo ($j + 1); ?>', <?php echo $size_group_edit; ?>);" style="cursor: pointer;"></i></td>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid; background-color: rgb(220,230,241);" colspan="14"><input <?php echo $disabled_input; ?> required="" type="text" style="box-sizing: border-box;border: none;outline: none;height: 32px; width: 100%;background-color: rgb(220,230,241);color:  black;font-weight: bold;height: 100%;" placeholder="GROUP DEFAULT" name="group_<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>_default[]" value="<?php echo $data_group_edit_[$j]->group; ?>"></td>
                                            <?php /* <td style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f0f0f0 1px solid;"><i class="fa fa-plus"></i></td> */ ?>
                                        </tr>
                                        <?php $no = 1; ?>

                                        <?php 
                                        $data_rincian_edit_ = $rincian_lanjutan[$keys_ma[$i].$data_group_edit_[$j]->group];
                                        // echo "<pre>\n";
                                        // print_r($data_rincian_edit_);
                                        // echo "</pre>\n";
                                        $size_rincian_edit = sizeof($data_rincian_edit_);
                                        $jumlah_rincian = 0;
                                        for($k = 0; $k < $size_rincian_edit; $k++){
                                            if($data_rincian_edit_[$k]->group == $data_group_edit_[$j]->group){
                                                $jumlah_rincian++;
                                            }
                                        } 
                                        $total_rintotal = 0;
                                        $total_rppt1nom = 0;
                                        $total_rppt2nom = 0;
                                        $total_rppt3nom = 0;
                                        $total_rppt4nom = 0;
                                        $total_perkalian = 0;
                                        ?> 


                                        <?php for($k = 0; $k < $size_rincian_edit; $k++){ ?>
                                        <?php if(($data_rincian_edit_[$k]->group == $data_group_edit_[$j]->group) || (!isset($data_rincian_edit_))){ ?>
                                        <tr <?php echo $no == $jumlah_rincian ? 'style="border-bottom: rgb(242,220,219) 2px solid;"' : ""; ?> class="anakan_group_<?php echo ($j + 1); ?>">
                                            <?php 

                                            if($size_rincian_edit == 1){
                                                $total_perkalian = $data_rincian_edit_[$k]->rintotal;
                                            }

                                            if($size_rincian_edit > 1){
                                                $total_perkalian = ($data_rincian_edit_[$k]->rinkuantitas * $data_rincian_edit_[$k]->rinfrekwensi * $data_rincian_edit_[$k]->rintarif); 
                                            }

                                            ?>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;" colspan="2" class="td_number_<?php echo ($j + 1); ?>"><?php echo $no; ?></td>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 25%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="nama_<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>_<?php echo ($j + 1); ?>[]" class="textinput" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; width: 88%;" placeholder="NAMA" value="<?php echo $data_rincian_edit_[$k]->rincian; ?>"></td>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="Q_<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>_<?php echo ($j + 1); ?>[]" class="numberonly" type="number" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="Q" value="<?php echo $data_rincian_edit_[$k]->rinkuantitas; ?>"></td>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="F_<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>_<?php echo ($j + 1); ?>[]" class="numberonly" type="number" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="F" value="<?php echo $data_rincian_edit_[$k]->rinfrekwensi; ?>"></td>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;">
                                                <input <?php echo $disabled_input; ?> autocomplete="off" name="tarif_<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>_<?php echo ($j + 1); ?>[]" class="numberonly" type="number" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 34px; text-align: right;width: 82%;" placeholder="NOM" value="<?php echo $data_rincian_edit_[$k]->rintarif; ?>">
                                                <a class="fa fa-question-circle" onclick="show_master_tarif(this.parentNode.getElementsByTagName('input')[0]);" style="vertical-align: middle; cursor: pointer; font-size: 14px;"></a>
                                            </td>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="subtotal_<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>_<?php echo ($j + 1); ?>[]" class="numberonly" type="number" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="<?php echo $total_perkalian; ?>"></td>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="persen_tw1_<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>_<?php echo ($j + 1); ?>[]" class="numberonly" type="number" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="<?php echo $data_rincian_edit_[$k]->rppt1perc; ?>"></td>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="tw1_<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>_<?php echo ($j + 1); ?>[]" class="numberonly" type="number" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="<?php echo remove_comma_decimal($data_rincian_edit_[$k]->rppt1nom); ?>"></td>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="persen_tw2_<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>_<?php echo ($j + 1); ?>[]" class="numberonly" type="number" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="<?php echo $data_rincian_edit_[$k]->rppt2perc; ?>"></td>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="tw2_<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>_<?php echo ($j + 1); ?>[]" class="numberonly" type="number" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="<?php echo remove_comma_decimal($data_rincian_edit_[$k]->rppt2nom); ?>"></td>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="persen_tw3_<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>_<?php echo ($j + 1); ?>[]" class="numberonly" type="number" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="<?php echo $data_rincian_edit_[$k]->rppt3perc; ?>"></td>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="tw3_<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>_<?php echo ($j + 1); ?>[]" class="numberonly" type="number" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="<?php echo remove_comma_decimal($data_rincian_edit_[$k]->rppt3nom); ?>"></td>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="persen_tw4_<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>_<?php echo ($j + 1); ?>[]" class="numberonly" type="number" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="<?php echo $data_rincian_edit_[$k]->rppt4perc; ?>"></td>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input <?php echo $disabled_input; ?> autocomplete="off" name="tw4_<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>_<?php echo ($j + 1); ?>[]" class="numberonly" type="number" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="<?php echo remove_comma_decimal($data_rincian_edit_[$k]->rppt4nom); ?>"></td>
                                            <td style="border-right: #f1f1f1 1px solid; text-align: center; width: 40px; padding: 0px; vertical-align: middle; width: 3%;"><i class="fa fa-minus" onclick="kurangi_anak_grup(this,'_<?php echo ($j + 1); ?>',<?php echo $jumlah_rincian; ?>);" style="cursor: pointer;"></i></td>
                                        </tr>
                                        <?php  
                                        if($size_rincian_edit == 1){
                                            $total_rintotal = $data_rincian_edit_[$k]->rintotal;
                                            $total_rppt1nom = $data_rincian_edit_[$k]->rppt1nom;
                                            $total_rppt2nom = $data_rincian_edit_[$k]->rppt2nom;
                                            $total_rppt3nom = $data_rincian_edit_[$k]->rppt3nom;
                                            $total_rppt4nom = $data_rincian_edit_[$k]->rppt4nom;
                                        }
                                        if($size_rincian_edit > 1){ $no++; 
                                            $total_rintotal = $total_rintotal + $total_perkalian;
                                            $total_rppt1nom = $total_rppt1nom + $data_rincian_edit_[$k]->rppt1nom;
                                            $total_rppt2nom = $total_rppt2nom + $data_rincian_edit_[$k]->rppt2nom;
                                            $total_rppt3nom = $total_rppt3nom + $data_rincian_edit_[$k]->rppt3nom;
                                            $total_rppt4nom = $total_rppt4nom + $data_rincian_edit_[$k]->rppt4nom;

                                        }} 
                                        ?>
                                        <?php } ?>
                                        <tr class="jumlah_anakan_<?php echo ($j + 1); ?>" style="border-bottom: rgb(220,230,241) 2px solid; box-shadow: inset 0 1px 0 rgb(242 220 219), inset 0 -1px 0 rgb(220 230 241);">
                                            <td style="text-align: right; border-right: #f0f0f0 1px solid;" colspan="6">Total</td>
                                            <td style="text-align: right; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);" info="total_rintotal"><?php echo set_titik($total_rintotal); ?></td>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                                            <td style="text-align: right; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);" info="total_rppt1nom"><?php echo set_titik($total_rppt1nom); ?></td>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                                            <td style="text-align: right; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);" info="total_rppt2nom"><?php echo set_titik($total_rppt2nom); ?></td>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                                            <td style="text-align: right; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);" info="total_rppt3nom"><?php echo set_titik($total_rppt3nom); ?></td>
                                            <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                                            <td style="text-align: right; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);" info="total_rppt4nom"><?php echo set_titik($total_rppt4nom); ?></td>
                                            <td style="border-right: #f1f1f1 1px solid; text-align: center; width: 40px"><i class="fa fa-plus" urutan_grup="tombol_anakan_<?php echo ($j + 1); ?>" style="cursor: pointer;" onclick="tambah_anak_grup(this,'_<?php echo ($j + 1); ?>',<?php echo ($size_rincian_edit > 1) ? ($no - 1) : $no; ?>);"></i></td>
                                        </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                                
                                <script type="text/javascript">

                                window.addEventListener("load", function(){
                                    // console.log("COBA ADDEVENT");
                                    var buka_dialog_mata_anggaran = document.getElementById("buka_dialog_mata_anggaran<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>");
                                    buka_dialog_mata_anggaran.next_inisial = "<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>";
                                    $( "#buka_dialog_mata_anggaran<?php echo $alphabet_lanjutan[$keys_ma[$i]]; ?>").click(function(){
                                        set_loading();
                                        var tombol = this;
                                        $.get("../../../index.php/add-anggaran/get-sp-search-mataanggaran", function(data, status){
                                            if(status === "success"){
                                                if(check_session(data)){
                                                    var mata_anggaran = document.getElementById("mata_anggaran" + tombol.next_inisial);
                                                    temporary_input_mata_anggaran_ = mata_anggaran;
                                                    temporary_inisial_mata_anggaran_ = tombol.next_inisial;
                                                    // console.log(mata_anggaran);
                                                    var tbody_hasil_data_mata_anggaran = document.getElementById("tbody_hasil_data_mata_anggaran");
                                                    tbody_hasil_data_mata_anggaran.innerHTML = data;
                                                    $('#modal-mata-anggaran').modal('show');
                                                    set_tr_click_inside_tbody(tbody_hasil_data_mata_anggaran,mata_anggaran,'modal-mata-anggaran','2,3', tombol.next_inisial);
                                                    removeLoading_regular();
                                                }
                                            }
                                        });
                                    });
                                    // console.log(choosen_ma);
                                });

                                </script>
                                <script type="text/javascript">
                                    next_inisial_global++;
                                </script>
                                <?php
                            }
                        }
                        
                        
                        ?>
                        
                        <div class="form-group" id="footer_utama_table" style="min-width: 1350px;">
                            <div class="col-xs-6" style="padding-left: 0px; padding-right: 4px;">
                                <?php if(isset($konfirmasi_hapus) && $konfirmasi_hapus){ ?>
                                <button <?php echo $disabled; ?> style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad; margin-top: 15px; border-radius: 0px;" type="submit" class="btn btn-info pull-right bg-light-blue-gradient" name="hapus_anggaran" id="hapus_anggaran" value="Hapus Anggaran">Hapus Anggaran</button>
                                <?php } else if(isset($update) && $update){ ?>
                                <button <?php echo $disabled; ?> style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad; margin-top: 15px; border-radius: 0px;" type="submit" class="btn btn-info pull-right bg-light-blue-gradient" name="update_anggaran" id="update_anggaran" value="Update Anggaran">Update Anggaran</button>
                                <?php } else { ?>
                                <button <?php echo $disabled; ?> style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad; margin-top: 15px; border-radius: 0px;" type="submit" class="btn btn-info pull-right bg-light-blue-gradient" name="add_anggaran" id="update_anggaran" value="Add Anggaran">Input Anggaran</button>
                                <?php } ?>
                            </div>
                            <div class="col-xs-6" style="padding-right: 0px; padding-left: 4px;">
                                <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad; margin-top: 15px; border-radius: 0px;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="show_data" id="show_data_form_anggaran" value="Show Data">Show Data</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div id="duplikasi_table_raw" style="display: none;">
            <table class="styled-table" style="border: #f1f1f1 1px solid; min-width: 1350px;" id="table-anggaran-tahunan{newname}">
                <thead>
                    <tr>
                        <th colspan="7" style="text-align: center; border-right: #f1f1f1 1px solid; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Rincian Mata Anggaran</th>
                        <th colspan="8" style="text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap; border-right: #f1f1f1 1px solid;">RPPT</th>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="3"><i class="fa fa-info"></i></th>
                    </tr>
                    <tr>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2" colspan="2">Nomor</th>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2">Nama</th>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2">Q</th>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2">F</th>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Tarif</th>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Sub Total</th>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;" colspan="2">TW I</th>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;" colspan="2">TW II</th>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;" colspan="2">TW III</th>
                        <th style="border-bottom: #f1f1f1 1px solid; text-align: center; white-space: nowrap; border-right: #f1f1f1 1px solid;" colspan="2">TW IV</th>
                    </tr>
                    <tr>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Rp</th>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Rp</th><?php /*
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Nom</th>*/ ?>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Rp</th>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Rp</th>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Rp</th>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                        <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Rp</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="induk_group_1">
                        <td style="border-left: #f1f1f1 1px solid; text-align: center; border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid;"><i class="fa fa-minus" onclick="min_group(this, '_1', 1);" style="cursor: pointer;"></i></td>
                        <td style="text-align: center; border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid;"><i class="fa fa-plus" onclick="add_group(this, '_1', 1);" style="cursor: pointer;"></i></td>
                        <td style="text-align: center; border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid; background-color: rgb(220,230,241);" colspan="14"><input required="" type="text" style="box-sizing: border-box;border: none;outline: none;height: 32px; width: 100%;background-color: rgb(220,230,241);color:  black;font-weight: bold;height: 100%;" placeholder="GROUP DEFAULT" name="group_{newname}_default[]" value=""></td>
                    </tr>
                    
                    <tr style="border-bottom: rgb(242,220,219) 2px solid;" class="anakan_group_1">
                        <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;" colspan="2" class="td_number_1">1</td>
                        <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 25%;"><input autocomplete="off" name="nama_{newname}_1[]" class="textinput" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; width: 88%;" placeholder="NAMA" value=""></td>
                        <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input autocomplete="off" name="Q_{newname}_1[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="Q" value="0"></td>
                        <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input autocomplete="off" name="F_{newname}_1[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="F" value="0"></td>
                        <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;">
                            <input autocomplete="off" name="tarif_{newname}_1[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 34px; text-align: right;width: 82%;" placeholder="NOM" value="0.00">
                            <a class="fa fa-question-circle" onclick="show_master_tarif(this.parentNode.getElementsByTagName('input')[0]);" style="vertical-align: middle; cursor: pointer; font-size: 14px;"></a>
                        </td>
                        <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input autocomplete="off" name="subtotal_{newname}_1[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                        <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input autocomplete="off" name="persen_tw1_{newname}_1[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                        <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input autocomplete="off" name="tw1_{newname}_1[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                        <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input autocomplete="off" name="persen_tw2_{newname}_1[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                        <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input autocomplete="off" name="tw2_{newname}_1[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                        <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input autocomplete="off" name="persen_tw3_{newname}_1[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                        <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input autocomplete="off" name="tw3_{newname}_1[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                        <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input autocomplete="off" name="persen_tw4_{newname}_1[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                        <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input autocomplete="off" name="tw4_{newname}_1[]" class="numberonly" type="text" style="background-color: white; box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                        <td style="border-right: #f1f1f1 1px solid; text-align: center; width: 40px; padding: 0px; vertical-align: middle; width: 3%;"><i class="fa fa-minus" onclick="kurangi_anak_grup(this,'_1',1);" style="cursor: pointer;"></i></td>
                    </tr>
                    <tr class="jumlah_anakan_1" style="border-bottom: rgb(220,230,241) 2px solid; box-shadow: inset 0 1px 0 rgb(242 220 219), inset 0 -1px 0 rgb(220 230 241);">
                        <td style="text-align: right; border-right: #f0f0f0 1px solid;" colspan="6">Total</td>
                        <td style="text-align: right; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);" info="total_rintotal"></td>
                        <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                        <td style="text-align: right; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);" info="total_rppt1nom"></td>
                        <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                        <td style="text-align: right; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);" info="total_rppt2nom"></td>
                        <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                        <td style="text-align: right; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);" info="total_rppt3nom"></td>
                        <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                        <td style="text-align: right; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);" info="total_rppt4nom"></td>
                        <td style="border-right: #f1f1f1 1px solid; text-align: center; width: 40px"><i class="fa fa-plus" urutan_grup="tombol_anakan_1" style="cursor: pointer;" onclick="tambah_anak_grup(this,'_1',1);"></i></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </body>
</html>