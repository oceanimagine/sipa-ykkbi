<!Doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <style type="text/css">
            html, body {
                font-family: consolas,monospace;
                cursor: default;
                width: 100%;
                height: 100%;
                padding: 0px;
                margin: 0px;
            }
            pre {
                font-family: consolas, monospace;
            }
        </style>
    </head>
    <body>
        <div class="login-box">
            <div class="login-box-body">
                <p class="login-box-msg"><img src="image/LOGOYKKBI.JPG" style="width:200px;"></p><?php /*
                <p style="text-align: center;">USERNAME : helpdesk<br />PASSWORD : helpdesk</p> */ ?>
                <form method="POST">
                    <div id="alert_message" class="alert alert-danger">Username atau password salah.</div>
                    <div class="form-group has-feedback">
                        <input type="text" autocomplete="off" class="form-control" placeholder="Username" name="username" value="<?php echo filter_input(INPUT_POST, "username"); ?>">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo filter_input(INPUT_POST, "password"); ?>">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-danger btn-block btn-flat">Sign In</button>
                        </div><!-- /.col -->
                    </div>
                </form>
                <p class="footer"></p>

                <div class="social-auth-links text-center">
                    <hr />
                    <p>© <?php echo date("Y"); ?> YKKBI SIPA</p>
                </div>
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->
        <script type="text/javascript">
            if(typeof $ !== "undefined"){
                $(document).ready(function () {
                    $('input').iCheck({
                        checkboxClass: 'icheckbox_square-blue',
                        radioClass: 'iradio_square-blue',
                        increaseArea: '20%'
                    });
                    $('.alert').hide();
                    var login_state = '<?php echo isset($check) && $check == "salah" ? $check : ""; ?>';

                    if (login_state === 'salah') {
                        
                        $('.alert').show();
                        $(".alert").delay(3000).fadeOut("slow");
                        login_state = '';
                    }
                });
            }
        </script>
    </body>
</html>