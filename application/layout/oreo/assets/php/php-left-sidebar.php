<?php 

$menu_dashboard = get_page_and_split("php-left-sidebar-menu-dashboard.php");
$info_admin = get_page_and_split("php-left-sidebar-info-admin.php");

?>
<aside id="leftsidebar" class="sidebar">
    <ul class="nav nav-tabs">
        <?php 
        
        echo isset($menu_dashboard) && isset($menu_dashboard[0]) ? $menu_dashboard[0] : "";
        echo isset($info_admin) && isset($info_admin[0]) ? $info_admin[0] : "";
        
        ?>
        
    </ul>
    <div class="tab-content">
        <!-- Menu Dashboard -->
        <?php 
        
        echo isset($menu_dashboard) && isset($menu_dashboard[1]) ? $menu_dashboard[1] : "";
        
        ?>
        <!-- Info Admin -->
        <?php 
        
        echo isset($info_admin) && isset($info_admin[1]) ? $info_admin[1] : "";
        
        ?>
    </div>    
</aside>