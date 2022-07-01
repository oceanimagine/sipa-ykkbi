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
            <div class="box-body">
                <div class="form-group">
                    <label for="kode_project" class="col-md-2 control-label merah">Kode Project</label>
                    <div class="col-md-10">
                        <input type="text" id="kode_project" class="form-control" name="kode_project" placeholder="Kode Project" value="{replace_project_modal}" disabled>
                        <input type="hidden" name="kode" value="{replace_project_modal}" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="satuan_kerja" class="col-md-2 control-label">Satuan Kerja</label>
                    <div class="col-md-10">
                        <input required type="text" id="satuan_kerja" class="form-control tambah-margin-bawah" name="satuan_kerja" placeholder="Satuan Kerja" value="<?php echo isset($satuan_kerja) ? $satuan_kerja : ""; ?>">
                    </div>
                    
                </div>
                
                <div class="form-group">
                    <label for="kegiatan_program_kerja" class="col-md-2 control-label">Kegiatan Program Kerja</label>
                    <div class="col-md-8">
                        <input required type="text" id="kegiatan_program_kerja" class="form-control tambah-margin-bawah" name="kegiatan_program_kerja" placeholder="Kegiatan Program Kerja" value="<?php echo isset($kegiatan_program_kerja) ? $kegiatan_program_kerja : ""; ?>">
                    </div>
                    <div class="col-md-2">
                        <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="search" value="Search">Search</button>
                    </div>
                </div>
                <div class="form-group" id="form_group_a">
                    <label for="mata_anggaran" class="col-md-2 control-label">Mata Anggaran</label>
                    <div class="col-md-8">
                        <input required type="text" id="satuan_kerja" class="form-control tambah-margin-bawah" name="mata_anggaran" placeholder="Mata Anggaran" value="<?php echo isset($mata_anggaran) ? $mata_anggaran : ""; ?>">
                        <input type="hidden" name="inisial_all" id="inisial_all" value="_1" />
                    </div>
                    <div class="col-md-2">
                        <button style="width: 100%; background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;" type="button" class="btn btn-info pull-right bg-light-blue-gradient" name="search" value="Search">Search</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <table class="styled-table" style="border: #f1f1f1 1px solid; ">
                            <thead>
                                <tr>
                                    <th colspan="8" style="text-align: center; border-right: #f1f1f1 1px solid; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Rincian Mata Anggaran</th>
                                    <th colspan="9" style="text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">RPPT</th>
                                </tr>
                                <tr>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2" colspan="2">Nomor</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" rowspan="2">Nama</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Ref. Tarif</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Q</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">F</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Tarif</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;">Sub Total</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;" colspan="2">TW I</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;" colspan="2">TW II</th>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f1f1f1 1px solid; white-space: nowrap;" colspan="3">TW III</th>
                                    <th style="border-bottom: #f1f1f1 1px solid; text-align: center; white-space: nowrap;" colspan="2">TW IV</th>
                                </tr>
                                <tr>
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;">Nom</th>
                                    <th style="border-right: #f1f1f1 1px solid; white-space: nowrap;">&nbsp;</th>
                                    <th style="border-right: #f1f1f1 1px solid; white-space: nowrap;">&nbsp;</th>
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
                                    <th style="border-right: #f1f1f1 1px solid; text-align: center; white-space: nowrap;"><i class="fa fa-info"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="induk_group_1">
                                    <td style="border-left: #f1f1f1 1px solid; text-align: center; border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid;"><i class="fa fa-minus" onclick="min_group(this, '_1', 1);" style="cursor: pointer;"></i></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid;"><i class="fa fa-plus" onclick="add_group(this, '_1', 1);" style="cursor: pointer;"></i></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; border-bottom: #f0f0f0 1px solid; background-color: rgb(220,230,241);" colspan="15"><b>GROUP DEFAULT</b></td>
                                    <?php /* <td style="border-right: #f1f1f1 1px solid; text-align: center; border-bottom: #f0f0f0 1px solid;"><i class="fa fa-plus"></i></td> */ ?>
                                </tr>
                                <tr style="border-bottom: rgb(242,220,219) 2px solid;" class="anakan_group_1">
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 4.25%;" colspan="2" class="td_number_1">1</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;">&nbsp;</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;">LOOKUP</td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="Q_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="Q" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="F_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="F" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="tarif_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="subtotal_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="persen_tw1_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="tw1_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="persen_tw2_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="tw2_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="persen_tw3_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="tw3_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="persen_tw4_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="text-align: center; border-right: #f0f0f0 1px solid; padding: 0px; vertical-align: middle; width: 6.25%;"><input autocomplete="off" name="tw4_1[]" class="numberonly" type="number" style="box-sizing: border-box; border: none; outline: none;height: 32px; text-align: right;width: 88%;" placeholder="NOM" value="0.00"></td>
                                    <td style="border-right: #f1f1f1 1px solid; text-align: center; width: 40px; padding: 0px; vertical-align: middle; width: 4.25%;"><i class="fa fa-minus" onclick="kurangi_anak_grup(this,'_1',1);" style="cursor: pointer;"></i></td>
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
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>