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
                            <?php foreach($data as $data_inside) { ?>
                            <tr>
                                <td style="width: 5%;"><?php echo $data_inside->sbpkode; ?></td>
                                <td title="<?php echo $data_inside->sbpdesc; ?>"><?php echo $data_inside->sbpdesc; ?></td>
                                <td style="width: 8%; text-align: center;"><?php echo $data_inside->pks; ?> <span class="badge badge-light"><?php echo $data_inside->keg_pks; ?></span></td>
                                <td style="width: 8%; text-align: center;"><?php echo $data_inside->pkns; ?> <span class="badge badge-light"><?php echo $data_inside->keg_pkns; ?></span></td>
                                <td style="width: 10%; text-align: right; background-color: rgb(0, 0, 255, 0.05);"><?php echo number_format($data_inside->nom_pendapatan,2); ?></td>
                                <td style="width: 10%; text-align: right;"><?php echo number_format($data_inside->nom_biaya,2); ?></td>
                                <td style="width: 10%; text-align: right; background-color: rgb(0, 0, 255, 0.05);"><?php echo number_format($data_inside->nom_investasi,2); ?></td>
                                <td style="width: 10%; text-align: right;"><?php echo number_format($data_inside->nom_rencana_korporasi,2); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>