<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checker extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function check_internet(){
        $connected = @fsockopen("www.google.com", 80); 
        if ($connected){
            $is_conn = true;
            fclose($connected);
        }else{
            $is_conn = false;
        }
        return $is_conn;
    }
    public function index(){
        $url = $this->input->post("url");
        $uri = parse_url($url);
        $dns = array("8.8.8.8","8.8.4.4");
        $txt = $this->check_internet();
        if($txt && isset($uri['host'])){
            $rsl = dns_get_record($uri['host'], DNS_ALL, $dns);
            if(is_array($rsl) && sizeof($rsl) > 0){
                $context = stream_context_create([
                    "ssl"=>array(
                        "verify_peer"=>false,
                        "verify_peer_name"=>false,
                    ),
                    "http" => [
                        "ignore_errors" => true
                    ]
                ]);
                file_get_contents($url, false, $context);
                if(isset($http_response_header)){
                    $status_line = $http_response_header[0];
                    $match = array();
                    preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);

                    $status = $match[1];
                    if ($status === "200") {
                        echo $url;
                    } else {
                        echo "../../../index.php/checker/failed_show";
                    }
                }
                exit();
            }
            echo "../../../index.php/checker/failed_show";
        } else {
            echo "../../../index.php/checker/failed_show";
        }
    }
    public function failed(){
        $filename = basename(dir_upload() . "404-File.jpg");
        $file_extension = strtolower(substr(strrchr($filename,"."),1));

        switch( $file_extension ) {
            case "gif": $ctype="image/gif"; break;
            case "png": $ctype="image/png"; break;
            case "jpeg":
            case "jpg": $ctype="image/jpeg"; break;
            case "svg": $ctype="image/svg+xml"; break;
            default:
        }

        header('Content-type: ' . $ctype);
        echo file_get_contents(__DIR__ . "/../../../upload/404-File.jpg");
    }
    public function failed_show(){
        $this->load->view('failed_show');
    }
}