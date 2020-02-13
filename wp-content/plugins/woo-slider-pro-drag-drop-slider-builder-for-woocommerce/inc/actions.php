<?php
/**
 * Created by PhpStorm.
 * User: myn
 * Date: 9/28/18
 * Time: 12:04 AM
 */

add_action('wp_ajax_woo_slide_pro_save_slider', 'woo_slide_pro_save_slider');

function woo_slide_pro_save_slider()
{
    parse_str(file_get_contents('php://input'), $data);

    $slider = new \inc\WooSlideProSlider($data['sliderID']);
    $id = $slider->saveSlider(
        $data['sliderID'],
        $data['cssID'],
        $data['title'],
        $data['skeleton'],
        json_encode($data['options']),
        $data['content']
    );

    echo $id;
    die();


}

add_action('wp_ajax_woo_slide_pro_edit_slider', 'woo_slide_pro_edit_slider');

function woo_slide_pro_edit_slider()
{
    $allSliders = \inc\WooSlideProSlider::getAllSliders();

    $data = array();
    foreach ($allSliders as $slider)
    {
        $data[] = array(
            'id' => $slider->ID,
            'title' => $slider->post_title
        );
    }

    echo json_encode($data);
    die();
}

add_action('wp_ajax_woo_slide_pro_delete_slider', 'woo_slide_pro_delete_slider');

function woo_slide_pro_delete_slider()
{
    parse_str(file_get_contents("php://input"), $data);

    wp_delete_post($data['sliderID']);
    die();
}

add_action('wp_ajax_woo_slide_pro_get_slider_to_edit', 'woo_slide_pro_get_slider_to_edit');

function woo_slide_pro_get_slider_to_edit()
{
    parse_str(file_get_contents("php://input"), $data);

    $slider = new \inc\WooSlideProSlider($data['sliderID']);

    $sliderData = array(
        'id' => $data['sliderID'],
        'cssID' => $slider->getCSSID(),
        'content' => $slider->getPost()->post_content,
        'options' => $slider->getOptionsString(),
        'title' => $slider->getPost()->post_title
    );

    echo json_encode($sliderData);

    die();
}

add_action('wp_ajax_woo_slider_pro_create_draft_preview', 'woo_slider_pro_create_draft_preview');
function woo_slider_pro_create_draft_preview()
{
    parse_str(file_get_contents("php://input"), $data);

    if ($data['draftPreviewID'] != 0)
    {
           wp_update_post(array(
               'ID' => $data['draftPreviewID'],
               'post_content' => $data['content']
           ));

           $draft_post_id = $data['draftPreviewID'];
    } else
    {
        $draft_post_id = wp_insert_post(array(
            'post_status' => 'draft',
            'post_content' => $data['content']
        ));

    }
    echo json_encode(array(
        'id' => $draft_post_id,
        'url' => get_permalink($draft_post_id)
    ));

    die();

}

add_action('wp_ajax_woo_slide_pro_delete_draft_preview', 'woo_slide_pro_delete_draft_preview');

function woo_slide_pro_delete_draft_preview()
{
    parse_str(file_get_contents("php://input"), $data);

    wp_delete_post($data['id']);
    die();
}

add_action('wp_ajax_woo_slider_pro_get_affiliates_offers', 'woo_slider_pro_get_affiliates_offers');

function woo_slider_pro_get_affiliates_offers()
{
    $offers = wp_remote_get("https://binarycarpenter.com/wp-json/offers/woo-slider-pro");
    echo $offers['body'];
    die();

}

