<?php

namespace Inc;

// final 이 있으면 extend불가
final class Init
{
    /**
     * 모든 class 를 내부에서 배열로 가지고있음
     * @return Array 서비스리스트
     */
    public static function get_services () {
        return [
            Pages\Admin::class,
            Base\Enqueue::class,
            Base\SettingsLinks::class
        ];
    }

    /**
     * 모든 서비스를 register함
     * @return
     */
    public static function register_services()
    {
        foreach (self::get_services() as $class) {
            $service = self::instantiate($class);
            if (method_exists ($service, 'register')) {
                $service->register();
            }
        }
    }

    /**
     * 서비스객체를 생성하여 반환
     * @return Object 서비스객체
     */
    private static function instantiate($class)
    {
        $service = new $class();
        return $service;
    }
}

// if (!class_exists( 'LearnPlugin' )) {
//     class LearnPlugin
//     {

//         public $plugin;

//         function __construct () {
//             add_action('init', array($this, 'custom_post_type'));
//             $this->plugin = plugin_basename( __FILE__ );
//         }

//         function register () {
//             add_action( 'admin_enqueue_scripts', array($this, 'enqueue') );
//             add_action( 'admin_menu', array ($this, 'add_admin_pages'));
//             add_filter("plugin_action_links_$this->plugin", array( $this, 'settings_link'));
//         }

//         public function settings_link($links) {
//             // add custom settings link
//             $settings_link = '<a href="admin.php?page=learn_plugin">Settings</a>';
//             array_push( $links, $settings_link);
//             return $links;
//         } 

//         public function add_admin_pages () {
//             // slug는 _만 이용가능
//             add_menu_page( 'Learn Plugin', 'Learn', 'manage_options', 'learn_plugin', array( $this, 'admin_index'), 'dashicons-store', 110 );
//         }

//         public function admin_index () {
//             // require template
//             require_once plugin_dir_path( __FILE__ ) . '/templates/admin.php';
//         }

//         function activate () {
//             Activate::activate();
//             $this->custom_post_type();
//         }
//         function deactivate () {
//             Deactivate::deactivate();
//         }
//         function unintall () {}

//         function custom_post_type () {
//             register_post_type( 'book', [
//                 'public' => true,
//                 'label' => 'Book'
//             ] );
//         }

//         function enqueue () {
//             wp_enqueue_style('mypluginstyle', plugins_url( '/assets/mystyle.css', __FILE__ ));
//             wp_enqueue_script('mypluginscript', plugins_url( '/assets/myscript.js', __FILE__ ));
//         }
//     }

//     $learnPluin = new LearnPlugin();
//     $learnPluin->register();

//     register_activation_hook( __FILE__, array( $learnPluin, 'activate') );

//     register_deactivation_hook( __FILE__, array( $learnPluin, 'deactivate') );

// }