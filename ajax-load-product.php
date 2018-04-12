<?php
/*
* Plugin Name: ajax load product
* Description: 
* Author: Kyrie
* Author URI: 
* Network: false    
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

require_once('admin/admin_setting.php');

class ajax_load_product{
  
    public $plugin_dir_url;
    public $plugin_dir_path;

    function __construct(){
        $this->alp_admin   = new alp_admin_setting($this);
        $this->plugin_dir_url 	= plugin_dir_url(__FILE__);
		    $this->plugin_dir_path 	= plugin_dir_path(__FILE__);
      	add_action('wp_footer', array($this, 'print_script_in_footer'));
        add_action('wp_enqueue_scripts', array($this, 'alp_enqueue_scripts'));

    }
    
  	function print_script_in_footer() {
		    require_once $this->plugin_dir_path.'/inc/alp_js.php';
	  }
    
		function alp_enqueue_scripts() {
				wp_enqueue_style('alp-ftont-style', $this->plugin_dir_url.'inc/asset/alp_front.css', array(),'1.0.3',false);
				wp_enqueue_style('animate-style', $this->plugin_dir_url.'inc/asset/animate.css', array(), '1.0.2',false);
	  }
  	
		function get_animation_style() {
				require_once $this->plugin_dir_path.'inc/animation-style.php';
				return $this->animation_styles;
		}
  
}

$ajax_load_product = new ajax_load_product();