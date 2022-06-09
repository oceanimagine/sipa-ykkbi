<?php 

class message {
    
    public static function set($message){
        $_SESSION['message_alert'] = $message;
    }
    
}