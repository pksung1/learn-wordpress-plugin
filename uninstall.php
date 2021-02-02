<?php

if ( !defined('WP_UNINSTALL_PLUGIN')) { die; }

global $wpdb;
$wpdb->query("DELETE FROM wp_posts WHERE pst_type='book'");
$wpdb->query("DELETE FROM wp_post_meta WHERE post_id NOT IN (SELECT id FROM wp_posts)");
$wpdb->query("DELETE FROM wp_term_relationship WHERE object_id NOT IN (SELECT id FROM wp_posts)");

