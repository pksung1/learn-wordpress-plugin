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
define ('PLUGIN_BASENAME', plugin_basename( __FILE__ ));

function activate_learn_plugin () {
    Inc\Base\Activate::activate();
}

function deactivate_learn_plugin () {
    Inc\Base\Deactivate::deactivate();
}

register_activation_hook( __FILE__, 'activate_learn_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_learn_plugin' );

if (class_exists('Inc\\Init')) {
    Inc\Init::register_services();
}