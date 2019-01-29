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


// Display random pictures

function randomPicures_display_random_pictures($atts, $content = NULL) {
    $atts = shortcode_atts(
        [
            'width' => '450',
            'height' => '300',
            'tags' => 'landscapes',
            'color' => '',
        ], $atts, 'randomPictures' );
        
    $query = new WP_Query( $atts );
    
    $output = '<img src="https://loremflickr.com/'.esc_attr($atts['color']).'/'.esc_attr($atts['width']).'/'.esc_attr($atts['height']).'/'.esc_attr($atts['tags']).'/all">';
    
    wp_reset_query();

    return $output;
}
        
add_shortcode('randomPicture', 'randomPicures_display_random_pictures');


// Plugin row meta

function randomPicures_plugin_row_meta( $links, $file ) {    
    if ( plugin_basename( __FILE__ ) == $file ) {
        $row_meta = array(
          'donate' => '<a href="https://www.paypal.me/prstuhlmann/2" style="color: green" target="_blank">Donate</a>'
        );
 
        return array_merge( $links, $row_meta );
    }
    return (array) $links;
}

add_filter( 'plugin_row_meta', 'randomPicures_plugin_row_meta', 10, 2 );




// Admin Menu

function randomPicures_admin_menu() {
    $page_title = 'Random Pictures';
    $menu_title = 'Random Pictures';
    $capability = 'manage_options';
    $menu_slug = 'randompictures-settings';
    $function = 'randomPictures_settings';
    add_options_page($page_title, $menu_title, $capability, $menu_slug, $function);
}
add_action('admin_menu', 'randomPicures_admin_menu');