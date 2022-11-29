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
        <style type="text/css">
            th {
                white-space: nowrap;
            }
            td {
                white-space: nowrap;
                white-space: nowrap;
                text-overflow: ellipsis;
                overflow: hidden;
                max-width: 0;
            }
        </style>
        <div style="text-align: left;">
            <div class="container" style="margin-left: 5px; margin-right: 5px; width: 100%;">
                <div style="width: 100%; overflow-x: auto; overflow-y: hidden;">
                    <div style="width: 100%; min-width: 1170px;">
                        <div style="float: left;width: 50%;">
                            <h4>Anggaran Program Strategis</h4>
                        </div>
                        <div style="float: left; width: 50%; text-align: right; height: 30px; display: table;">
                            <span style="display: table-cell; vertical-align: bottom;"><i>(Rp.juta)</i></span>
                        </div>
                    </div>
                    <table class="table table-condensed" style="background-color: white; min-width: 1170px;">
                        <thead>
                            <?php /*
                            <tr>
                                <th rowspan="2" style="vertical-align: middle;">Kode</th>
                                <th rowspan="2" style="vertical-align: middle;">Nama</th>
                                <th rowspan="2" style="vertical-align: middle; text-align: center;">PKS (Keg)</th>
                                <th rowspan="2" style="vertical-align: middle; text-align: center; border-right: 2px solid #f4f4f4;">PKNS (Keg)</th>
                                <th colspan="4" style="text-align: center;">Rp.(JUTA)</th>
                            </tr>
                            <tr>
                                
                                <th style="text-align: right;">Pendapatan</th>
                                <th style="text-align: right;">Beban</th>
                                <th style="text-align: right;">Investasi</th>
                                <th style="text-align: right;">Renc.Korporasi</th>
                            </tr> */ ?>
                            <tr class="info" style="height: 40px;">
                                <th style="vertical-align: middle;">Kode</th>
                                <th style="vertical-align: middle;">Nama</th>
                                <th style="vertical-align: middle; text-align: center;">PKS (Keg)</th>
                                <th style="vertical-align: middle; text-align: center;">PKNS (Keg)</th>
                                <th style="vertical-align: middle; text-align: right;">Pendapatan</th>
                                <th style="vertical-align: middle; text-align: right;">Beban</th>
                                <th style="vertical-align: middle; text-align: right;">Investasi</th>
                                <th style="vertical-align: middle; text-align: right;">Renc.Korporasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 
                            $jumlah_pks = 0;
                            $jumlah_pkns = 0;
                            $jumlah_pks_keg = 0;
                            $jumlah_pkns_keg = 0;
                            $nom_pendapatan = 0;
                            $nom_biaya = 0;
                            $nom_investasi = 0;
                            $nom_rencana_korporasi = 0;
                            foreach($data as $data_inside) { 
                            $jumlah_pks = $jumlah_pks + $data_inside->pks;
                            $jumlah_pkns = $jumlah_pkns + $data_inside->pkns;
                            $jumlah_pks_keg = $jumlah_pks_keg + $data_inside->keg_pks;
                            $jumlah_pkns_keg = $jumlah_pkns_keg + $data_inside->keg_pkns;
                            $nom_pendapatan = $nom_pendapatan + tolong_jadiin_dua_angka_aja_di_belakang_koma($data_inside->nom_pendapatan);
                            $nom_biaya = $nom_biaya + tolong_jadiin_dua_angka_aja_di_belakang_koma($data_inside->nom_biaya);
                            $nom_investasi = $nom_investasi + tolong_jadiin_dua_angka_aja_di_belakang_koma($data_inside->nom_investasi);
                            $nom_rencana_korporasi = $nom_rencana_korporasi + tolong_jadiin_dua_angka_aja_di_belakang_koma($data_inside->nom_rencana_korporasi);
                            ?>
                            <tr>
                                <td style="width: 5%;"><?php echo $data_inside->sbpkode; ?></td>
                                <td title="<?php echo $data_inside->sbpdesc; ?>"><?php echo $data_inside->sbpdesc; ?></td>
                                <td style="width: 8%; text-align: center;"><?php echo $data_inside->pks; ?> <span class="badge badge-light"><?php echo $data_inside->keg_pks; ?></span></td>
                                <td style="width: 8%; text-align: center;"><?php echo $data_inside->pkns; ?> <span class="badge badge-light"><?php echo $data_inside->keg_pkns; ?></span></td>
                                <td style="width: 10%; text-align: right; background-color: rgb(0, 0, 255, 0.05);"><?php echo set_titik_gaya_indonesia($data_inside->nom_pendapatan, true); ?></td>
                                <td style="width: 10%; text-align: right;"><?php echo set_titik_gaya_indonesia($data_inside->nom_biaya, true); ?></td>
                                <td style="width: 10%; text-align: right; background-color: rgb(0, 0, 255, 0.05);"><?php echo set_titik_gaya_indonesia($data_inside->nom_investasi, true); ?></td>
                                <td style="width: 10%; text-align: right;"><?php echo set_titik_gaya_indonesia($data_inside->nom_rencana_korporasi, true); ?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="2" style="text-align: right;">Total : </td>
                                <td style="text-align: center;"><?php echo $jumlah_pks; ?> <span class="badge badge-light"><?php echo $jumlah_pks_keg; ?></span></td>
                                <td style="text-align: center;"><?php echo $jumlah_pkns; ?> <span class="badge badge-light"><?php echo $jumlah_pkns_keg; ?></span></td>
                                <td style="text-align: right; background-color: rgb(0, 0, 255, 0.05);"><?php echo set_titik_gaya_indonesia($nom_pendapatan, true); ?></td>
                                <td style="text-align: right;"><?php echo set_titik_gaya_indonesia($nom_biaya, true); ?></td>
                                <td style="text-align: right; background-color: rgb(0, 0, 255, 0.05);"><?php echo set_titik_gaya_indonesia($nom_investasi, true); ?></td>
                                <td style="text-align: right;"><?php echo set_titik_gaya_indonesia($nom_rencana_korporasi, true); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>