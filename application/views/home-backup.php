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
        <div style="text-align: left;">
            <?php /* echo str_replace("?","/",current_url());
              <img src="image/LOGOYKKBI.png" style="width: 25%;"> */ ?>
            <div class="row">
                <?php foreach($data as $data_inside) { ?>
                
                <div class="col-md-6 col-sm-6  col-xs-12" style="padding-bottom: 10px;">
                    <div class="card" style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.4rem; padding: 2rem; background-color: white;">  
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $data_inside->sbpkode; ?></h4>
                            <p class="card-text"><?php echo $data_inside->sbpdesc; ?></p>
                            <button type="button" class="btn btn-primary btn-sm" style="min-width: 190px;">
                                PKS <span class="badge badge-light"><?php echo $data_inside->pks; ?></span>  Kegiatan <span class="badge badge-light"><?php echo $data_inside->keg_pks; ?></span>
                            </button>
                            <button type="button" class="btn btn-success btn-sm" style="min-width: 190px;">
                                PKNS <span class="badge badge-light"><?php echo $data_inside->pkns; ?></span>  Kegiatan <span class="badge badge-light"><?php echo $data_inside->keg_pkns; ?></span>
                            </button>
                        </div>
                    </div>
                </div>
                
                <?php } ?>
                <?php /*
                <div class="col-md-6 col-sm-6  col-xs-12" style="padding-bottom: 15px;">
                    <div class="card" style="border: 2px solid rgba(0,0,0,.125); border-radius: 1rem; padding: 2rem; background-color: white;">  
                        <div class="card-body">
                            <h4 class="card-title">PS 02</h4>
                            <p class="card-text">Some example text some example text. John Doe is an architect and engineer</p>
                            <button type="button" class="btn btn-primary">
                                PKS <span class="badge badge-light">4</span>  Kegiatan <span class="badge badge-light">20</span>
                            </button>
                            <button type="button" class="btn btn-danger">
                                PKNS <span class="badge badge-light">2</span>  Kegiatan <span class="badge badge-light">5</span>
                            </button>
                        </div>
                    </div>
                </div> */ ?>
            </div>
        </div>
    </body>
</html>