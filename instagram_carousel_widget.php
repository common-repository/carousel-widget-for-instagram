<?php
/**
 * Plugin Name: Carousel Widget For Instagram
 * Description: This plugin displays a list of recent Instagram medias from multiple accounts and hashtags
 * Version: 1.0.0
 * Author: Air Code Design inc.
 * Author URI: https://aircodedesign.com
 * License: GPLv2 or later
 */


if (!defined("ABSPATH")) exit;


require_once plugin_dir_path(__FILE__) . "Carousel_Widget_For_Instagram_Class.php";

/**
 *  add plugin assets
 */
function add_cwfig_assets()
{
    wp_register_style('cwfig_css', plugin_dir_url(__FILE__) . 'css/cwfig.css');
    wp_register_script('cwfig_bootstrap_carousel_js', plugin_dir_url(__FILE__) . 'js/bootstrap-carousel.min.js', ["jquery"]);
    wp_enqueue_style('cwfig_css');
    wp_enqueue_script('cwfig_bootstrap_carousel_js');
}

function add_cwfig_admin_assets()
{
    if (is_admin()) {
        $screen = get_current_screen();
        if ($screen->base == "widgets") {
            wp_register_style('cwfig_bootstrap_css', plugin_dir_url(__FILE__) . 'css/bootstrap.min.css');
            wp_enqueue_style('cwfig_bootstrap_css');

            wp_register_script('cwfig_bootstrap_js', plugin_dir_url(__FILE__) . 'js/bootstrap.min.js');
            wp_enqueue_script('cwfig_bootstrap_js');
        }
    }
}

add_action('wp_enqueue_scripts', 'add_cwfig_assets');
add_action('admin_enqueue_scripts', 'add_cwfig_admin_assets');