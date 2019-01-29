<?php
/*
 * Plugin Name: RandomPicures by Peter R. Stuhlmann
 * Description: Wordpress plugin, which inserts random images as placeholders via shortcode.
 * Version: 1.0.0
 * Author: Peter R. Stuhlmann
 * Author URI: https://peter-stuhlmann-webentwicklung.de
 * Plugin URI: https://peter-stuhlmann-webentwicklung.de/wp-plugin/random-pictures
 */


// Stylesheets and JavaScript files

function randomPicures_enqueue_scripts() {
    wp_enqueue_style( 'random-picures-styles', plugin_dir_url( __FILE__ ) . "/assets/css/style.css", '', '20190129');
}
add_action( 'wp_enqueue_scripts', 'randomPicures_enqueue_scripts' );


// Allows the integration of shortcodes in widget areas:

add_filter( 'widget_text', 'do_shortcode' );