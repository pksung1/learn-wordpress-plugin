<?php

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

class Admin extends BaseController
{

    public $settings;
    public function __construct ()
    {
        $this->settings = new SettingsApi();
        $this->pages = array(
            array(
                'page_title' => 'Learn Plugin', 
                'menu_title' => 'Learn',
                'capability' => 'manage_options', 
                'menu_slug' => 'learn_plugin',
                'callback' => function () {echo '<h1>Learn Plugin</h1>';},
                'icon_url' => 'dashicons-store',
                'position' => 110
            )
        );
        
        $this->subpages = array (
            array(
                'parent_slug' => 'learn_plugin',
                'page_title' => 'subpage', 
                'menu_title' => 'CPT',
                'capability' => 'manage_options', 
                'menu_slug' => 'learn_cpt',
                'callback' => function () {echo '<h1>CPT Manager</h1>';}
            ),
            array(
                'parent_slug' => 'learn_plugin',
                'page_title' => 'custom Taxonomi', 
                'menu_title' => 'Custom Taxonomi',
                'capability' => 'manage_options', 
                'menu_slug' => 'custom_Taxonomi',
                'callback' => function () {echo '<h1>custom Taxonomi</h1>';}
            )
        );
    }

    function register () {
        $this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubpages($this->subpages)->register();
    }
    
    public function add_admin_pages () {
        // slug는 _만 이용가능
        add_menu_page( 'Learn Plugin', 'Learn', 'manage_options', 'learn_plugin', array( $this, 'admin_index'), 'dashicons-store', 110 );
    }


    public function admin_index () {
        // require template
        require_once $this->plugin_path . '/templates/admin.php';
    }
}