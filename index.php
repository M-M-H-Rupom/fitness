<?php
/**
 * Plugin Name: G Fitness
 * Description: hello
 * Version: 1.0
 * Author: Rupom
 * Text Domain: gmf
 * 
 */
if( !defined('ABSPATH') ) exit;
define('GMF_PATH', plugin_dir_path(__FILE__));
define('GMF_URL',plugin_dir_url(__FILE__));
include GMF_PATH . 'includes/includes.php';
class Gmf{
    public function __construct(){
        add_action('admin_enqueue_scripts', array($this,'admin_enqueue_callback'));
        add_action('wp_enqueue_scripts', array($this,'wp_enqueue_callback'));
        add_action( 'admin_menu', array($this,'admin_menu_callback'));
    }
    public function admin_enqueue_callback(){
        wp_enqueue_style( 'gmf-css', GMF_URL . 'assets/css/style.css' );
        wp_enqueue_script('jquery');
        wp_enqueue_script( 'gmf-js', GMF_URL . 'assets/js/main.js', array('jquery'), time(), true);
        wp_localize_script( 'gmf-js', 'localize_data', array(
            'url' => admin_url('admin-ajax.php'),
        ) );
        $parent_args = [
            'taxonomy'     => 'package',
            'parent'        => 0,
            'hide_empty'    => false
        ];
        $package_terms = get_terms( $parent_args );
        wp_localize_script('gmf-js', 'terms_data', array(
            $package_terms
        ) );
    }
    public function wp_enqueue_callback(){
        wp_enqueue_style( 'gmf-css', GMF_URL . 'assets/css/style.css' );
        wp_enqueue_script( 'gmf-js', GMF_URL . 'assets/js/main.js', array('jquery'), time(), true);
    }
    public function admin_menu_callback(){
        add_menu_page( 'Customer Table', 'Customer Table', 'manage_options', 'customer_table', array($this,'customer_table_callback'),null,12);
    }
    public function customer_table_callback(){
        include GMF_PATH . 'templates/customer_table_template.php';
    }
}
new Gmf();