<?php


class alp_admin_setting {
  
  
  function __construct($parent){
        $this->parent = $parent;
        add_action('admin_enqueue_scripts', array($this, 'alp_enqueue_scripts'));
        add_action('admin_menu' , array($this, 'add_alp_menu'));
        add_action('admin_init' , array($this, 'alp_plugin_settings'));
    }
  
  public function add_alp_menu() {
    add_menu_page( 
        'Ajax load product', 
        'Ajax load product', 
        'manage_options', 
        'ajax-load-product', 
        array($this, 'ajax_load_product_menu')); 
  }
  
  public function ajax_load_product_menu(){
      require $this->parent->plugin_dir_path.'admin/alp-admin-frame.php';
  }
  
  public function alp_enqueue_scripts(){
    wp_enqueue_style('alp-admin-style', $this->parent->plugin_dir_url.'admin/asset/admin.css', array(), '1.0.1', false);
    wp_enqueue_style('animate-style-admin', $this->parent->plugin_dir_url.'inc/asset/animate.css', array(), '1.0.2',false);
  }
  
  function alp_plugin_settings() {
      register_setting( 'alp-settings-group', 'alp_setting_field' );
  }
  
} 
