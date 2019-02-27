<?php

function theme_scripts()
{
	wp_enqueue_style('bootstrap-styles', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.1.3');
	wp_enqueue_style('theme-styles', get_template_directory_uri() . '/assets/css/styles.min.css', array(), ASSET_VERSION);
    wp_enqueue_script('theme-vendor', get_template_directory_uri() . '/assets/js/vendor.min.js', array('jquery'), ASSET_VERSION, true);
    wp_enqueue_script('theme-scripts', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery'), ASSET_VERSION, true);

    // enable ajax
//    wp_localize_script( 'e-mobility-scripts', 'ajax_object',
//        array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
}

add_action('wp_enqueue_scripts', 'theme_scripts');
