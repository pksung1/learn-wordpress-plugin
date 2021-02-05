<?php
/**
 * Plugin Name: learn-plugin
 */

defined( 'ABSPATH' ) or die( 'cant access' );

if (file_exists( dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__). '/vendor/autoload.php';
}

define ('PLUGIN_PATH', plugin_dir_path( __FILE__ ));
define ('PLUGIN_URL', plugin_dir_url( __FILE__ ));

if (class_exists('Inc\\Init')) {
    Inc\Init::register_services();
}