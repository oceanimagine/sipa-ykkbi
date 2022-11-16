<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo get_url("home"); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>SI</b>PA</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>SIPA</b> YKKBI</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="<?php echo get_url("home"); ?>" class="sidebar-toggle" id="amenu" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
		<li class="dropdown notifications-menu" style="border-right: #eee 1px solid;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning" id="span_notif"></span>
                    </a>
                    <ul class="dropdown-menu" style="width: 320px;">
                        <li class="header" id="jumlah_notif">You have 0 notifications</li>
                        <li id="isi_notif" style="display: none;"></li>
                        <!-- REPLACE NOTIF -->
                    </ul>
                </li>
                <li class="dropdown user user-menu">
                    <a href="<?php echo get_url("home"); ?>" class="dropdown-toggle" data-toggle="dropdown" style="padding-bottom: 6px; padding-top: 12px; border-left: 0px solid #eee;">
                        <?php /*
                        <img src="image/LOGOYKKBI.png" class="user-image" alt="User Image" style="width: 28px !important; height: inherit !important;"> */ ?>
                        <div style="display: table;">
                            <i class="fa fa-user-circle-o" aria-hidden="true" style="font-size: 25px;"></i>&nbsp;
                            <span style="display: table-cell; vertical-align: middle;">{user}</span>
                        </div><?php /*
                        <span class="hidden-xs"></span> */ ?>
                    </a>
                    <ul class="dropdown-menu" style="right: 0px;">
                        <!-- User image -->
                        <li class="user-header" style="white-space: nowrap;">
                            <?php if($_SESSION['PRI'] == "SUPERADMIN"){ ?>
                            <img src="image/LOGOYKKBI.png" class="img-circle" alt="User Image">
                            <?php } else { ?>
                            <?php if($_SESSION['photo_admin'] != "" && file_exists("upload/photo_user_admin/" . $_SESSION['photo_admin'])){ ?>
                            <img src="../../../upload/photo_user_admin/<?php echo $_SESSION['photo_admin']; ?>" class="img-circle" alt="User Image" style="width: inherit;">
                            <?php } else { ?>
                            <img src="image/LOGOYKKBI.png" class="img-circle" alt="User Image">
                            <?php } ?>
                            <?php } ?>
                            <p>
                                {priviledge}
                                <small>Location : <?php echo "Jakarta"; ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <?php if($_SESSION['PRI'] == "SUPERADMIN"){ ?>
                            <div class="pull-right" style="width: 100%;">
                                <a href="<?php echo get_url("logout"); ?>" class="btn btn-default btn-flat" style="width: 100%;">Sign out</a>
                            </div>
                            <?php } else { ?>
                            <div class="pull-left" style="width: 48%;">
                                <a href="<?php echo get_url("useradmin/profile/" . $_SESSION['id']); ?>" class="btn btn-default btn-flat" style="width: 100%;">Profile</a>
                            </div>
                            <div class="pull-right" style="width: 48%;">
                                <a href="<?php echo get_url("logout"); ?>" class="btn btn-default btn-flat" style="width: 100%;">Sign out</a>
                            </div>
                            <?php } ?>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <!-- 
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li> -->
            </ul>
        </div>
    </nav>
</header>