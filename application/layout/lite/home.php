<?php 
include_once '../connect.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <base href="<?php echo base_url; ?>layout/lite/" />
        <link rel="shortcut icon" href="image/icon-nita.png">
        <title>{title}</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="css/dataTables.bootstrap.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="css/ionicons.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="css/select2.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="css/_all-skins.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="css/all.css">
        <link rel="stylesheet" href="css/flat/blue.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="css/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="css/jquery-jvectormap-1.2.2.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="css/datepicker3.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="css/daterangepicker-bs3.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="css/bootstrap3-wysihtml5.css">
        
        <link rel="stylesheet" href="css/jquery-clockpicker.min.css"  type="text/css" />
        <link rel="stylesheet" href="css/time.css"  type="text/css" />
        
        <!-- CSS Tambahan -->
        <link href="<?php echo base_url; ?>libs_client/style.css" rel="stylesheet"  type="text/css" />
        <!-- <link href="<?php echo base_url; ?>libs_client/table_design01.css" rel="stylesheet"  type="text/css" /> -->
        <!-- <link href="<?php echo base_url; ?>libs_client/table_design02.css" rel="stylesheet"  type="text/css" /> -->
        <link href="<?php echo base_url; ?>libs_client/jqueryui.css" rel="stylesheet"  type="text/css" />
        <link href="<?php echo base_url; ?>libs_client/table_codeio.css" rel="stylesheet"  type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <style type="text/css">
            .panel-success{
                border-color: #e47365;
            }
            .pagination > .active > a {
                background-color: #e47365;
                border-color: #e47365;
            }
            .modalDialog {
                position: fixed;
                font-family: Arial, Helvetica, sans-serif;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background: rgba(0, 0, 0, 0.9);
                z-index: 99999;
                opacity:0;
                -webkit-transition: opacity 400ms ease-in;
                -moz-transition: opacity 400ms ease-in;
                transition: opacity 400ms ease-in;
                pointer-events: none;
            }
            .modalDialog:target {
                opacity:1;
                pointer-events: auto;
            }
            .modalDialog > div {
                width: 40%;
                position: relative;
                margin: 10% auto;
                padding: 5px 20px 13px 20px;
                border-radius: 10px;
                background: #fff;
                background: -moz-linear-gradient(#fff, #999);
                background: -webkit-linear-gradient(#fff, #999);
                background: -o-linear-gradient(#fff, #999);
            }
            .close {
                background: #606061;
                color: #FFFFFF;
                line-height: 25px;
                position: absolute;
                right: -12px;
                text-align: center;
                top: -10px;
                width: 24px;
                text-decoration: none;
                font-weight: bold;
                -webkit-border-radius: 12px;
                -moz-border-radius: 12px;
                border-radius: 12px;
                -moz-box-shadow: 1px 1px 3px #000;
                -webkit-box-shadow: 1px 1px 3px #000;
                box-shadow: 1px 1px 3px #000;
            }
            .close:hover {
                background: #00d9ff;
            }
            #table-data > tbody {
                white-space: nowrap;
            }
            .dataTable > thead {
                white-space: nowrap;
            }
            /* https://stackoverflow.com/questions/19451183/cannot-remove-outline-dotted-border-from-firefox-select-drop-down */
            select:-moz-focusring {
                color: transparent;
                text-shadow: 0 0 0 #000;
            }
            option:not(:checked) {
              color: black; /* prevent <option>s from becoming transparent as well */
            }
        </style>
    </head>
    <!-- sidebar-mini sidebar-collapse -->
    <body class="skin-red sidebar-mini ">
        <div class="wrapper">
            <?php 
            include_once 'part_topmenu.php'; 
            echo "\n";
            ?>
            <?php 
            include_once 'part_leftmenu.php'; 
            echo "\n";
            ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?php 
                /* 
                do_include(4);
                echo "\n"; */
                include_once 'part_body.php'; 
                echo "\n";
                ?>
                <!-- <Dialog Tambahan> -->
                <div id="openModal" class="modalDialog">
                    <div>	
                        <a href="#close" title="Close" class="close" id="tutup">X</a>
                        <h2>Alert</h2>
                        <div id="Keterangan">
                        <p>Anda akan menghapus data yang terpilih secara permanen.</p>
                        <p>Apakah anda yakin ?</p>
                        </div>
                        <p><a href="#openModal" style="color: black;" id="confirm">Ya</a> - <a href="#" style="color: black;" id="noconfirm">Tidak</a></p>
                    </div>
                </div>
                <div id="samaModal" class="modalDialog">
                    <div>	
                        <a href="#close" title="Close" class="close" id="tutup">X</a>
                        <h2>Alert</h2>
                        <p id="Alertnya">Terdapat data yang sama, silahkan cek kembali.</p>
                        <p><a href="#" style="color: black;" id="noconfirm">Tutup</a></p>
                    </div>
                </div>
                <div class="modal fade" id="modal-default" style="z-index: 9999;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title">PERINGATAN !!!!</h4>
                            </div>
                            <div class="modal-body">
                                <p>Apakah anda yakin&hellip; ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary" id="button-confirm">YA</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </Dialog Tambahan> -->
                
            </div>
            <!-- /.content-wrapper -->
            <?php 
            include_once 'part_bottommenu.php';
            echo "\n";
            ?>

            <!-- Control Sidebar -->
            <?php /* 
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs"></ul>
                <!-- Tab panes -->
                <div class="tab-content"></div>
            </aside><!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div> */ ?>
        </div><!-- ./wrapper -->
        <!-- MAPS SEARCH -->
        <input type="text" class="form-control" id="search_map" placeholder="Cari Map" style="width: 50%; z-index: 9999; display: none;" />
        <!-- jQuery 2.1.4 -->
        <script src="js/jQuery-2.1.4.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/time.js"></script>
        <!-- jQuery UI Clockpicker 1.11.4 -->
        <script src="js/jquery-clockpicker.min.js"></script>
        <script type="text/javascript" src="js/tinymce/js/tinymce/tinymce.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.5 -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Morris.js charts
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/morris.min.js"></script>  -->
        <!-- Sparkline -->
        <!-- <script src="js/select2.full.min.js"></script> -->
        <script src="js/select2.full.js"></script>
        <script src="js/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="js/jquery-jvectormap-world-mill-en.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/jquery.knob.js"></script>
        <!-- daterangepicker  -->
        <script src="js/moment.min.js"></script>
        <!-- <script src="js/daterangepicker.js"></script> -->
        <!-- datepicker -->
        <!-- <script src="js/bootstrap-datepicker.js"></script> -->
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="js/icheck.min.js"></script>
        <!-- iCheck -->
        <script src="js/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="js/fastclick.min.js"></script>
        <!-- AdminLTE App -->
        <script src="js/app.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes)
        <script src="js/dashboard.js"></script> -->
        <!-- AdminLTE for demo purposes -->
        <script src="js/demo.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="js/webcam.js"></script>
        <script type="text/javascript">
            $(function () {
                $(".select2").select2();
                if(document.getElementById("campaign")){
                    $("#campaign").select2("enable",false);
                }
                if(document.getElementById("paket0")){
                    $("#paket0").select2("enable",false);
                }
                if(document.getElementById("produk")){
                    $("#produk").select2("enable",false);
                }
            });
        </script>
        <?php 
        /* 
        do_include_script(2);
        echo "\n"; */
        ?>
        <!-- <script src="js/addition.js"></script> -->
    </body>
</html>
