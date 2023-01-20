<?php 

function get_page_and_split($page){
    ob_start();
    include_once __DIR__ . "/assets/php/" . $page;
    $page = ob_get_clean();
    $explode_page = explode("<!-- SPLIT -->", $page);
    return $explode_page;
}

function get_url_oreo($param){
    return '../../../index.php/oreo/' . $param;
}

?>
<!doctype html>
<html class="no-js " lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <base href="<?php echo base_url; ?>layout/oreo/" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

        <title>{title}</title>
        <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
        <!-- Favicon-->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- Custom Css -->
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/timeline.css">
        <link rel="stylesheet" href="assets/css/color_skins.css">
        <link rel="stylesheet" href="assets/css/menu.css">
    </head>
    <body class="theme-cyan">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/logo.svg" width="48" height="48" alt="Oreo"></div>
                <p>Please wait...</p>        
            </div>
        </div>
        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>
        <!-- Top Bar -->
        <?php 
        
        include_once "assets/php/php-top-bar.php"
        
        ?>
        <!-- Left Sidebar -->
        <?php 
        
        include_once "assets/php/php-left-sidebar.php"
        
        ?>
        <!-- Right Sidebar -->
        <?php 
        
        include_once "assets/php/php-right-sidebar.php"
        
        ?>
        <!-- Chat launcher -->
        <?php 
        
        include_once "assets/php/php-chat-launcher.php"
        
        ?>
        <!-- Profile Page -->
        <?php 
        
        include_once "page/page-profile.php"
        
        ?>
        <!-- Jquery Core Js --> 
        <script src="assets/js/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
        <script src="assets/js/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

        <script src="assets/js/knob.bundle.js"></script> <!-- Jquery Knob Plugin Js -->

        <script src="assets/js/mainscripts.bundle.js"></script><!-- Custom Js -->
        <script src="assets/js/jquery-knob.js"></script>
    </body>
</html>