<?php
/**
 *
 * Plugin Name: WooCommerce product management dashboard
 * Plugin URI:
 * Description:Ravand Soft WooCommerce product management dashboard Plugin
 * Version: 2.0
 * Author: Arefeh yazdizadeh
 * text-domain: wpm-plugin
 */
if (!defined('ABSPATH')) {
    exit;
}
require_once 'shortcode.php';
require_once 'function.php';

function ap_action_init()
 {
    load_plugin_textdomain('wpm-plugin', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}
add_action('init', 'ap_action_init');


// // Define menu page
add_action('admin_menu', 'plugin_menu');
function plugin_menu()
{
     add_menu_page('My Plugin Settings', __('WPM dashboard', 'wpm-plugin'), 'manage_options', 'my-plugin-settings', 'plugin_settings_page');
     // add_submenu_page('my-plugin-settings', 'Help', 'Help', 'manage_options', 'my-plugin-help', 'my_plugin_help_page');
 }

function plugin_settings_page()
{
    do_shortcode('[products_list]');
}
