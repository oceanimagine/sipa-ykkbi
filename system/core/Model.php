<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright		Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @copyright		Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Model {

	/**
	 * Constructor
	 *
	 * @access public
	 */
        protected $where_project = "";
        function __construct()
	{
            if(isset($_GET["sSearch"]) && $_GET["sSearch"] != ""){
                $_GET["sSearch"] = strtolower($_GET["sSearch"]);
            }
            
		log_message('debug', "Model Class Initialized");
	}
        
        function where_project($clouse){
            if(isset($GLOBALS['kode_project']) && $GLOBALS['kode_project'] != ""){
                return (!$clouse ? " where kode = '".$GLOBALS['kode_project']."' " : " and kode = '".$GLOBALS['kode_project']."' ");
            } else {
                return "";
            }
        }

	/**
	 * __get
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param	string
	 * @access private
	 */
	function __get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}
}
// END Model Class

/* End of file Model.php */
/* Location: ./system/core/Model.php */