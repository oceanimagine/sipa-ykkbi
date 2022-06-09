<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="overflow: hidden;">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="image/LOGOYKKBI.png" class="img-circle" alt="User Image" style="max-width: 85px;">
            </div>
            <div class="pull-left info" style="left: 90px;">
                <p>{user}</p>
                <a href="<?php echo get_url("home"); ?>"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <br />
        <!-- sidebar menu: : style can be found in sidebar.less -->
        
        <ul class="sidebar-menu">
            <li class="header">SIPA YKKBI</li>
            <li class='treeview<?php /* echo $this->get_active(); */  echo $this->CI->uri->segment(1) == "home" || $this->CI->uri->segment(1) == '' ? " active" : ""; ?>'>
                <a href="<?php echo get_url("home"); ?>"><i class="fa fa-home"></i> <span>Home</span></a>
            </li>
            <!-- Access Old : old/satuan/modul-satuan-list -->
            <!-- {MENU_REPLACE} -->
            
        </ul>
        
    </section>
    <!-- /.sidebar -->
</aside>