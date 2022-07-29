<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SIPA YKKBI</title>
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
        </script>
    </head>
    <body>
        <link rel="stylesheet" href="css/add-anggaran-css.css"  type="text/css" />
        <script src="js/add-anggaran-js.js" referrerpolicy="origin"></script>
        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
            <div class="box-body" style="min-width: 1400px;"><?php /*
                <div class="form-group">
                    <label for="kode_project" class="col-md-2 control-label merah">Kode Project</label>
                    <div class="col-md-10">
                        <input type="text" id="kode_project" class="form-control" name="kode_project" placeholder="Kode Project" value="{replace_project_modal}" disabled>
                        <input type="hidden" name="kode" value="{replace_project_modal}" />
                    </div>
                </div> */ ?>
                <div class="form-group">
                    <label for="satuan_kerja" class="col-xs-2 control-label">Satuan Kerja</label>
                    <div class="col-xs-10 autocomplete">
                        <?php if(isset($data_satker) && is_array($data_satker)){ ?>
                        <?php if(sizeof($data_satker) > 1){ ?>
                        <select required id="satuan_kerja" class="form-control tambah-margin-bawah" name="satuan_kerja" value="<?php echo isset($satuan_kerja) ? $satuan_kerja : ""; ?>">
                            <option value="">-- PILIH --</option>
                            <?php
                            
                            if(isset($data_satker) && is_array($data_satker)){
                                foreach($data_satker as $satker){
                                    $selected = isset($satuan_kerja) && $satuan_kerja == "(".$satker->satkerid.") ".$satker->nama1 ? " selected='selected'" : "";
                                    echo "<option value='(".$satker->satkerid.") ".$satker->nama1."'".$selected.">(".$satker->satkerid.") ".$satker->nama1."</option>\n";
                                }
                            }
                            ?>
                        </select>
                        <?php } else if(sizeof($data_satker) > 0){ ?>
                        <input required type="text" id="satuan_kerja_display" class="form-control tambah-margin-bawah" name="satuan_kerja_display" placeholder="Satuan Kerja" value="<?php echo "(" . $data_satker[0]->satkerid . ") " . $data_satker[0]->nama1; ?>" autocomplete="off" disabled>
                        <input type="hidden" id="satuan_kerja" name="satuan_kerja" value="<?php echo "(" . $data_satker[0]->satkerid . ") " . $data_satker[0]->nama1; ?>" />
                        <?php } ?>
                        <?php } ?>
                        <input type="hidden" name="kode_project_hidden" value="{replace_project_modal}" />
                    </div>
                    
                </div>
                
                <div class="form-group">
                    <label for="kegiatan_program_kerja_rincian" class="col-xs-2 control-label">Rincian Kegiatan</label>
                    <div class="col-xs-8 autocomplete">
                        <input required type="text" id="kegiatan_program_kerja_rincian" class="form-control tambah-margin-bawah" name="kegiatan_program_kerja_rincian" placeholder="Rincian Kegiatan" value="<?php echo isset($kegiatan_program_kerja) ? $kegiatan_program_kerja : ""; ?>" autocomplete="off" disabled>
                        <input type="hidden" id="kegiatan_program_kerja_rincian_hidden" name="kegiatan_program_kerja_rincian_hidden" />
                    </div>
                    <div class="col-xs-2">
                        <button id="buka_dialog_rincian_kegiatan" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="search" value="Search">Search</button>
                    </div>
                </div>
                <div class="form-group" id="form_group_a">
                    <label for="mata_anggaran" class="col-xs-2 control-label">Mata Anggaran</label>
                    <div class="col-xs-8 autocomplete">
                        <input required type="text" id="mata_anggaran" class="form-control tambah-margin-bawah" name="mata_anggaran" placeholder="Mata Anggaran" value="<?php echo isset($mata_anggaran) ? $mata_anggaran : ""; ?>" autocomplete="off" disabled>
                        <input type="hidden" id="mata_anggaran_hidden" name="mata_anggaran_hidden" />
                        <input type="hidden" name="inisial_all" id="inisial_all" value="_1" />
                    </div>
                    <div class="col-xs-2">
                        <button id="buka_dialog_mata_anggaran" style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="search" value="Search">Search</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <table class="styled-table" style="border: #f1f1f1 1px solid; min-width: 1300px;">
                            <thead>
                                <tr>
                                    <th colspan="8" style="text-align: center; border-right: #f1f1f1 1px solid; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Rincian Mata Anggaran</th>
                                    <th colspan="9" style="text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap; border-right: #f1f1f1 1px solid;">RPPT</th>
                                </tr>
                                <tr>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2" colspan="2">Nomor</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2">Nama</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Ref. Tarif</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2">Q</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2">F</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Tarif</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Sub Total</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;" colspan="2">TW I</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;" colspan="2">TW II</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;" colspan="2">TW III</th>
                                    <th style="border-bottom: #f1f1f1 1px solid; text-align: center; white-space: nowrap; border-right: #f1f1f1 1px solid;" colspan="2">TW IV</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2"><i class="fa fa-info"></i></th>
                                </tr>
                                <tr>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Nom</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Nom</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Nom</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Nom</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Nom</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Nom</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">%</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Nom</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="induk_group_1">
                                    <td style="border-left: #f1f1f1 1px solid; text-align: center; border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid;"><i class="fa fa-minus" onclick="min_group(this, '_1', 1);" style="cursor: pointer;"></i></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid;"><i class="fa fa-plus" onclick="add_group(this, '_1', 1);" style="cursor: pointer;"></i></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid; background-color: rgb(220,230,241);" colspan="15"><input type="text" style="box-sizing: border-box;border: none;outline: none;height: 32px; width: 100%;background-color: rgb(220,230,241);color:  black;font-weight: bold;height: 100%;" placeholder="GROUP DEFAULT" name="group_default[]"></td>
                                    <?php /* <td style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f0f0f0 1px solid;"><i class="fa fa-plus"></i></td> */ ?>
                                </tr>
                                <tr style="border-bottom: rgb(242,220,219) 2px solid;" class="anakan_group_1">
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;" colspan="2" class="td_number_1">1</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 25%;"><input autocomplete="off" name="nama_1[]" class="textinput" type="text" style="box-sizing: border-box; border: none; outline: none;height: 32px; width: 88%;" placeholder="NAMA"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;">LOOKUP</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input autocomplete="off" name="Q_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="Q" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input autocomplete="off" name="F_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="F" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input autocomplete="off" name="tarif_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input autocomplete="off" name="subtotal_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input autocomplete="off" name="persen_tw1_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input autocomplete="off" name="tw1_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input autocomplete="off" name="persen_tw2_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input autocomplete="off" name="tw2_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input autocomplete="off" name="persen_tw3_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input autocomplete="off" name="tw3_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 3%;"><input autocomplete="off" name="persen_tw4_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6%;"><input autocomplete="off" name="tw4_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="border-right: #f1f1f1 1px solid; text-align: center; width: 40px; padding: 0px; vertical-align: middle; width: 3%;"><i class="fa fa-minus" onclick="kurangi_anak_grup(this,'_1',1);" style="cursor: pointer;"></i></td>
                                </tr>
                                <tr class="jumlah_anakan_1" style="border-bottom: rgb(220,230,241) 2px solid; box-shadow: inset 0 1px 0 rgb(242 220 219), inset 0 -1px 0 rgb(220 230 241);">
                                    <td style="text-align: right; border-right: #f0f0f0 1px solid;" colspan="7">Total</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);">&nbsp;</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);">&nbsp;</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);">&nbsp;</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);">&nbsp;</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid;">&nbsp;</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; background-color: rgb(242,220,219);">&nbsp;</td>
                                    <td style="border-right: #f1f1f1 1px solid; text-align: center; width: 40px"><i class="fa fa-plus" urutan_grup="tombol_anakan_1" style="cursor: pointer;" onclick="tambah_anak_grup(this,'_1',1);"></i></td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td colspan="16" style="text-align: center;"><a href="../../../index.php/luckyexcel" target="_blank" style="text-decoration: none;">Show Template</a></td>
                                </tr>
                            </tbody>
                        </table>
                        <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad; margin-top: 15px; border-radius: 0px;" type="submit" class="btn btn-info pull-right bg-light-blue-gradient" name="add_anggaran" value="Add Anggaran">Add Anggaran</button>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>