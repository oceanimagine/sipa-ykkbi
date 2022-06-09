<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Dashboard Helpdesk</title>
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
    <?php 
    global $prioritas_kejadian;
    global $prioritas_status;
    ?>
    <div class="row">
    <?php
    $array_keys_prioritas_kejadian = array_keys($prioritas_kejadian);
    for($i = 0; $i < sizeof($array_keys_prioritas_kejadian); $i++){
        ?>
        <div class="col-xs-12">
            <div class="box box-info" style="border-top:  #adadad 2px solid; border-right: #adadad 2px solid;border-left: #adadad 2px solid;border-bottom: #adadad 2px solid;">
                <div class="box-header with-border">
                    <h3 class="box-title">Prioritas <?php echo ucfirst($array_keys_prioritas_kejadian[$i]); ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body" style="overflow-x: auto;">
                    <div class="row" style="margin: 0px;">
                        <?php 
                        for($j = 0; $j < sizeof($prioritas_status); $j++){
                            ?>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="small-box <?php echo $prioritas_kejadian[$array_keys_prioritas_kejadian[$i]]; ?>">
                                    <div class="inner">
                                        <?php  
                                        $jumlah_data = $controller->get_jumlah($array_keys_prioritas_kejadian[$i], $prioritas_status[$j]);
                                        ?>
                                        <h3><?php echo $jumlah_data; ?><sup style="font-size: 20px;">Data</sup></h3>
                                        <p><?php echo ucfirst($prioritas_status[$j]); ?></p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="#" style="pointer-events: none; cursor: default;" class="small-box-footer"></a>
                                </div>
                            </div>
                            <?php

                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    </div>
</body>
</html>