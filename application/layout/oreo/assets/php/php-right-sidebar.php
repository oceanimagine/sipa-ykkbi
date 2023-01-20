<?php 

$setting = get_page_and_split("php-right-sidebar-icon-setting.php");
$chat = get_page_and_split("php-right-sidebar-icon-chat.php");
$activity = get_page_and_split("php-right-sidebar-icon-activity.php");

?>
<aside id="rightsidebar" class="right-sidebar">
    <ul class="nav nav-tabs">
        
        <?php 
        
        echo isset($setting) && isset($setting[0]) ? $setting[0] : "";
        echo isset($chat) && isset($chat[0]) ? $chat[0] : "";
        echo isset($activity) && isset($activity[0]) ? $activity[0] : "";
        
        ?>
        
    </ul>
    <div class="tab-content">
        <!-- Setting -->
        <?php 
        
        echo isset($setting) && isset($setting[1]) ? $setting[1] : "";
        
        ?>
        <!-- Chat -->
        <?php 
        
        echo isset($chat) && isset($chat[1]) ? $chat[1] : "";
        
        ?>
        <!-- Activity -->
        <?php 
        
        echo isset($activity) && isset($activity[1]) ? $activity[1] : "";
        
        ?>
    </div>
</aside>