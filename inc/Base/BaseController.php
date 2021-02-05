<?php

namespace Inc\Base;

class BaseController
{
    public $plugin_path;

    public function __construct () {
        // dirname(__FILE__, 2) => 상위폴더 2개이동 (learn-wordpress-plugin)
        $this->plugin_path = plugin_dir_path( dirname(__FILE__, 2));
        $this->plugin_url = plugin_dir_url( dirname(__FILE__, 2));
        $this->plugin = plugin_basename( dirname(__FILE__, 3)) . '/learn-plugin.php';
    }
}