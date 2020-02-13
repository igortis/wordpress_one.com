<?php
/**
 * Created by PhpStorm.
 * User: myn
 * Date: 9/28/18
 * Time: 12:43 AM
 */

add_shortcode('woo-slider-pro', 'woo_slider_display_shortcode');

function woo_slider_display_shortcode($atts)
{
    $id = $atts['id'];

    if (!get_post_status($id))
        return '';
    $slider = new \inc\WooSlideProSlider($id);


//    return rawurldecode($slider->getParsedHTML());
    return $slider->generateHTML();
}