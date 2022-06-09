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
        <base href="<?php echo base_url; ?>layout/login/" />
        <link rel="shortcut icon" href="image/LOGOYKKBI.png">
        <title>Login</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="css/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page" style="cursor: default;">
        
        <!-- jQuery 2.1.4 -->
        <script src="js/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="js/icheck.min.js"></script>
        
        {replace_body}
        
    </body>
</html>
