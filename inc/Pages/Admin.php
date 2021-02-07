<?php

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use \Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{
    public $settings;
    public $subpages = array();
    public $pages = array();

    public function __construct ()
    {
        parent::__construct();
    }

    function setPages () {
        $this->pages = array(
            array(
                'page_title' => 'Learn Plugin', 
                'menu_title' => 'Learn',
                'capability' => 'manage_options', 
                'menu_slug' => 'learn_plugin',
                'callback' => array($this->callbacks, 'adminDashboard'),
                'icon_url' => 'dashicons-store',
                'position' => 110
            )
        );
    }

    public function setSubPages () {
        $this->subpages = array (
            array(
                'parent_slug' => 'learn_plugin',
                'page_title' => 'subpage', 
                'menu_title' => 'CPT',
                'capability' => 'manage_options', 
                'menu_slug' => 'learn_cpt',
                'callback' => function () { echo '<h1>CPT Subpage</h1>'; }
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

    public function setSettings ()
    {
        $args = array (
            array (
                'option_group' => 'learn_options_group',
                'option_name' => 'text_examplse',
                'sanitize_callback' => array($this->callbacks, 'learnOptionsGroup')
            )
        );

        $this->settings->setSettings($args);
    }

    public function setSections ()
    {
        $args = array(
            array (
                'id' => 'learn_admin_index',
                'title' => 'Settings',
                'callback' => array($this->callbacks, 'learnAdminSection'),
                'page' => 'learn_plugin',
            )
        );
        $this->settings->setSections($args);
    }

    
    public function setFields ()
    {
        $args = array(
            array (
                'id' => 'text_examplse',
                'title' => 'Text Example Field',
                'callback' => array($this->callbacks, 'learnAdminTextExample'),
                'page' => 'learn_plugin',
                'section' => 'learn_admin_index',
                'args' => array (
                    'label_for' => 'text_example',
                    'class' => 'example-class'
                )
            )
        );
        $this->settings->setFields($args);
    }

    

    function register () {
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();
        $this->setPages();
        $this->setSubPages();

        $this->setSettings();
        $this->setSections();
        $this->setFields();
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