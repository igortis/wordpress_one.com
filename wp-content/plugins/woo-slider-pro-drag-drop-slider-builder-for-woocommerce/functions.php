<?php
/**
 * Created by PhpStorm.
 * User: myn
 * Date: 9/27/18
 * Time: 11:11 AM
 */

include_once 'inc/actions.php';
include_once 'inc/shortcode.php';
include_once 'inc/WooSlideProSingleProduct.php';
include_once 'inc/WooSlideProSlider.php';

add_action('admin_menu', 'woo_slide_pro_main_add_menu');

function woo_slide_pro_main_add_menu() { add_menu_page('Woo Slide Pro', 'Woo Slide Pro', 'edit_posts', 'woo-slider-pro', 'woo_slide_pro_main'); }


function woo_slide_pro_main()
{
    include_once 'ui/main-ui.php';
}





add_action('admin_enqueue_scripts', 'woo_slide_pro_load_backend_scripts', 1000);

function woo_slide_pro_load_backend_scripts()
{
    wp_register_style('backend-bundle-style', plugins_url( 'bundle/css/backend.css', __FILE__ ));


    wp_register_script( 'backend-bundle-handler', plugins_url( 'bundle/js/backend-bundle.js', __FILE__ ), array(
        'jquery',
        'jquery-ui-core',
        'jquery-effects-core',
        'jquery-ui-widget',
        'jquery-ui-draggable',
        'jquery-ui-droppable',
        'jquery-ui-sortable',
        'jquery-ui-tabs',
        'underscore',
        'backbone'
    ), false, true );

    wp_enqueue_script('backend-bundle-handler', '', array(), false, true);
    wp_enqueue_style('backend-bundle-style');
}




add_action('wp_enqueue_scripts', 'woo_slide_pro_load_frontend_scripts', 1000);

function woo_slide_pro_load_frontend_scripts()
{
    wp_register_style('frontend-bundle-style', plugins_url( 'bundle/css/front.css', __FILE__ ));
    wp_enqueue_style('frontend-bundle-style');

    wp_register_script( 'frontend-bundle-handler', plugins_url( 'bundle/js/front-bundle.js', __FILE__ ), array(
        'jquery',
        'underscore',
        'backbone'
    ), false, true );

    wp_enqueue_script('frontend-bundle-handler', '', array(), false, true);

}


//register post type
