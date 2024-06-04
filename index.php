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
    }
    public function admin_enqueue_callback(){
        wp_enqueue_style( 'gmf-css', GMF_URL . 'assets/css/style.css' );
        wp_enqueue_script( 'gmf-js', GMF_URL . 'assets/js/main.js', array('jquery'), time(), true);
    }
    public function wp_enqueue_callback(){
        wp_enqueue_style( 'gmf-css', GMF_URL . 'assets/css/style.css' );
        wp_enqueue_script( 'gmf-js', GMF_URL . 'assets/js/main.js', array('jquery'), time(), true);
    }
}
new Gmf();