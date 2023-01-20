<!doctype html>
<html class="no-js " lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

        <title>:: Oreo Hospital :: Sign In</title>
        <!-- Favicon-->
        <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
        <!-- Custom Css -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/authentication.css">
        <link rel="stylesheet" href="assets/css/color_skins.css">
    </head>

    <body class="theme-cyan authentication sidebar-collapse">
        <!-- Navbar -->
        <?php 
        
        include_once "assets/php/php-navbar.php";
        
        ?>
        <div class="page-header">
            <div class="page-header-image" style="background-image:url(assets/images/login.jpg)"></div>
            <!-- Page -->
            <?php 
        
            include_once "page/page-login.php";

            ?>
            <!-- Footer -->
            <?php 
        
            include_once "assets/php/php-footer.php";

            ?>
        </div>

        <!-- Jquery Core Js -->
        <script src="assets/js/libscripts.bundle.js"></script>
        <script src="assets/js/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->

        <script>
            $(".navbar-toggler").on('click', function () {
                $("html").toggleClass("nav-open");
            });
            //=============================================================================
            $('.form-control').on("focus", function () {
                $(this).parent('.input-group').addClass("input-group-focus");
            }).on("blur", function () {
                $(this).parent(".input-group").removeClass("input-group-focus");
            });
        </script>
    </body>
</html>