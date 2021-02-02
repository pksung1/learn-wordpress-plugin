<?php
/**
 * Plugin Name: learn-plugin
 */

defined( 'ABSPATH' ) or die( 'cant access' );

class LearnPlugin
{
    function __construct () {
        add_action('init', array($this, 'custom_post_type'));
    }

    function activate () {
        $this->custom_post_type();
        flush_rewrite_rules( );
    }
    function deactivate () {
        flush_rewrite_rules( );
    }
    function unintall () {}

    function custom_post_type () {
        register_post_type( 'book', [
            'public' => true,
            'label' => 'Book'
        ] );
    }
}

if (class_exists( 'LearnPlugin' )) {
    $learnPluin = new LearnPlugin();
}

register_activation_hook( __FILE__, array( $learnPluin, 'activate') );

register_deactivation_hook( __FILE__, array( $learnPluin, 'deactivate') );
