<?php

namespace Inc\Pages;

class Admin
{
    function register () {
        add_action( 'admin_menu', array ($this, 'add_admin_pages'));
    }
    
    public function add_admin_pages () {
        // slug는 _만 이용가능
        add_menu_page( 'Learn Plugin', 'Learn', 'manage_options', 'learn_plugin', array( $this, 'admin_index'), 'dashicons-store', 110 );
    }


    public function admin_index () {
        // require template
        require_once PLUGIN_PATH . '/templates/admin.php';
    }
}