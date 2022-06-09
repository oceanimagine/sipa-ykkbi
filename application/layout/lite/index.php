<?php 
/* 
include_once '../connect.php'; */
if(!defined("base_url")){
    exit("
        <html>
        <head>
        <meta charset='utf-8' />
        <title>DIRECT ACCESS.</title>
        </head>
        <body style='font-family: consolas, monospace; cursor: dewfault;'>
        DIRECT ACCESS NOT ALLOWED.
        </body>
        </html>
    ");
}
function get_url($param){
    return '../../../index.php/' . $param;
}
?> 
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <base href="<?php echo base_url; ?>layout/lite/" />
        <link rel="shortcut icon" href="image/LOGOYKKBI.png">
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
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyB6Jrhaxw4AHqPPFlgdmAyVIuxCHUVfpA0&libraries=places"></script>
        <style type="text/css">
            ::-webkit-scrollbar {
                width: 8px;
                height: 4px;
            }
            /* Track */
            ::-webkit-scrollbar-track {
                box-shadow: inset 0 0 5px #f1f1f1; 
                border-radius: 0px;
            }
            /* Handle */
            ::-webkit-scrollbar-thumb {
                background: #d0d0d0; 
                border-radius: 0px;
            }
            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
                background: #d0d0d0; 
            }

            /* Firefox Scrollbar */
            html, body {
                scrollbar-color: #d0d0d0 grey;
                scrollbar-width: thin;
            }
            html, body {
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }
            .panel-success{
                border-color: #3c8dbc;
            }
            .pagination > .active > a {
                background-color: #222d32;
                border-color: #222d32;
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
            
            /* https://stackoverflow.com/questions/23660519/remove-check-box-blue-border */
            input[type="checkbox"]:focus{
                outline:0;
            }
            
            .panel-group {
                margin-bottom: 0px !important;
            }
            
            /* CSS used here will be applied after bootstrap.css */

            .nav-tabs .glyphicon:not(.no-margin) {
                margin-right: 10px;
            }

            .tab-pane .list-group-item:first-child {
                border-top-right-radius: 0px;
                border-top-left-radius: 0px;
            }

            .tab-pane .list-group-item:last-child {
                border-bottom-right-radius: 0px;
                border-bottom-left-radius: 0px;
            }

            .tab-pane .list-group .checkbox {
                display: inline-block;
                margin: 0px;
            }

            .tab-pane .list-group input[type="checkbox"] {
                margin-top: 2px;
            }

            .tab-pane .list-group .glyphicon {
                margin-right: 5px;
            }

            .tab-pane .list-group .glyphicon:hover {
                color: #FFBC00;
            }

            a.list-group-item.read {
                color: #222;
                background-color: #F3F3F3;
            }

            hr {
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .nav-pills>li>a {
                padding: 5px 10px;
            }

            .ad {
                padding: 5px;
                background: #F5F5F5;
                color: #222;
                font-size: 80%;
                border: 1px solid #E5E5E5;
            }

            .ad a.title {
                color: #15C;
                text-decoration: none;
                font-weight: bold;
                font-size: 110%;
            }

            .ad a.url {
                color: #093;
                text-decoration: none;
            }
            
            .form-group label {
                white-space: nowrap;
            }

            @media (min-width: 805px) {
                .pindah_baris {
                    display: none;
                }
            }

            @media (max-width: 804px) {
                .pindah_baris_button {
                    display: none;
                }
            }
            
            .youtube_punya {
                visibility: hidden;
            }
            
            .dataTables_scroll {
                border-bottom: 1px solid #f4f4f4;
            }
            
            .pagination>.active>a:focus, .pagination>.active>a:hover {
                 background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important;
                 color: black;
                 border-color: #222d32;
            }
            
        </style>
    </head>
    <!-- sidebar-mini sidebar-collapse -->
    <body class="skin-black sidebar-mini" style="font-family: consolas, monospace !important; visibility: hidden;">
        <form method="POST" id="set_lang">
            <input type="hidden" name="lang_id" id="lang_id" />
        </form>
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
                                <h4 class="modal-title">WARNING !!!!</h4>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure&hellip;?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="button-confirm" style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;">YA</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal fade" id="modal-success" style="z-index: 9999;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title">ALERT !!!!</h4>
                            </div>
                            <div class="modal-body">
                                <p id="pesan_modal">{message_db}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal" style="background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #f1f1f1), color-stop(1, #ffffff)) !important; color: black; border-color: #adadad;">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- https://www.youtube.com/embed/zD_J26Mb-v0 -->
                <div class="modal fade" id="modal-youtube" style="z-index: 9999;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title">VIDEO BOX</h4>
                            </div>
                            <div class="modal-body">
                                <iframe class="youtube_punya" style="width: 100%; height: 315px;" src="#" id="youtube_video" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
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
        <script type="text/javascript" src="js/langcheck.js"></script>
        <script type="text/javascript" src="js/jsonview.js"></script>
        <!-- 
        <script src="https://cdn.tiny.cloud/1/wmvp5vagut9oqlarxd3c5adghob7vcjhi2zkm0h3fsmsvpyy/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
        <script src="js/custom.js" referrerpolicy="origin"></script>
        <script type="text/javascript">
            /* $('#modal-success').modal('show'); */
            $(function () {
                
                /* call_modal */
                activate_select();
                
                /* initialize_languague(); */
                /* call_disabled */
                setTimeout(function(){
                    document.body.style.visibility = "";
		    <?php if(isset($_SESSION['message_alert']) && $_SESSION['message_alert'] != ""){ ?>
		    var pesan_modal = document.getElementById("pesan_modal");
		    pesan_modal.innerHTML = "<?php echo $_SESSION['message_alert']; ?>";
		    $('#modal-success').modal('show');
		    <?php unset($_SESSION['message_alert']); } ?>
                }, 500);
                
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
