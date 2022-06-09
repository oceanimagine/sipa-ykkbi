<?php 

define("base_url", $_GET['base_url']);

function get_url($param){
	return '../../../index.php/' . $param;
}