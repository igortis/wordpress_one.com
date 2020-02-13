<?php

/**
* Plugin Name: Drag Drop Slider & Carousel Builder For WooCommerce - Woo Slider Pro
* Plugin URI:  https://binarycarpenter.com/woo-slider-pro/
* Description: This plugin helps you create flexible sliders for your WooCommerce store. You can arrange elements around as you like.
* Version: 1.12
* Author: bc2018
* Author URI: https://binarycarpenter.com
* License: A "Slug" license name e.g. GPL2
* WC tested up to: 3.8.0
*/

namespace BinaryCarpenter\BC_SD;

include_once 'inc/Core.php';
include_once 'inc/Config.php';
include_once 'inc/SingleProduct.php';
include_once 'inc/Slider.php';
include_once 'inc/Helpers.php';


use BinaryCarpenter\BC_SD\Slider;

class Initiator
{
    private static $instance;

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        if (self::$instance == null)
            self::$instance = new self;
        return self::$instance;
    }

	public function __construct() {
		add_action('admin_menu', array($this, 'add_menu'));
		add_action('admin_enqueue_scripts', array($this, 'load_backend_scripts'), 10);
		add_action('wp_enqueue_scripts', array($this, 'load_frontend_scripts'), 10);

		add_action('wp_ajax_woo_slide_pro_delete_draft_preview', array($this, 'delete_draft_preview'));
		add_action('wp_ajax_woo_slider_pro_create_draft_preview', array($this, 'create_draft_preview'));
		add_action('wp_ajax_woo_slide_pro_get_slider_to_edit', array($this, 'get_slider_to_edit'));
		add_action('wp_ajax_woo_slide_pro_delete_slider', array($this, 'delete_slider'));
		add_action('wp_ajax_woo_slide_pro_save_slider', array($this, 'save_slider'));
		add_action('wp_ajax_woo_slide_pro_edit_slider', array($this, 'edit_slider'));


		add_action('init', array($this, 'add_slider_post_type'));
		add_shortcode('woo-slider-pro', array($this, 'shortcode'));

		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'action_links' ) );

		if (Config::IS_PRO)
			add_filter('pre_set_site_transient_update_plugins', array($this, 'check_for_plugin_update'));
	}


	public function action_links($links)
	{
		$custom_links = array();
		$custom_links[] = '<a href="' . admin_url( 'admin.php?page='. Config::SLUG ) . '">' . __( 'Get started', Config::TEXT_DOMAIN ) . '</a>';
		$custom_links[] = '<a target="_blank" href="https://tickets.binarycarpenter.com/open.php">' . __( 'Supports', Config::TEXT_DOMAIN ) . '</a>';
		return array_merge( $custom_links, $links );
	}


	/**
	 * Output the slider shortcode
	 *
	 * @param $atts
	 *
	 * @return string
	 */
	function shortcode($atts)
	{
		$id = $atts['id'];

		if (!get_post_status($id))
			return '';
		$slider = new Slider($id);

		return $slider->generateHTML();
	}


	public function add_slider_post_type()
	{
		Slider::createPostType();
	}

	public function add_menu() {
		Core::admin_menu();
		$image_tag  = ' <img  style="width: 14px; height: 14px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAMAAAD04JH5AAAAA3NCSVQICAjb4U/gAAAACXBIWXMAAAN2AAADdgF91YLMAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAPNQTFRF////MU5VMU5Van6CbYGGboCGZXl/f4+TWVVvYFxpYHV7f2Z2f4+ThJSYhZWZWVlniZiciml7jJueUldkTGRrnaisRVJiSGJon6uuRmBmQ11jQ11kmmGWqXKJqbO1qrS3QVxirre5QFphP1Jbtr7At7/AuL/CusLDOlVcvsXHOE9ZOVVbwsjKN1Nax8zONlJZyc7PNU9YyXyWyc7PNlJZztLTNVFY0tXWM05W1djZ19vcMlBWMk9W293eMk5VMk9WMk9W3+Hh4ePj4uPkMU5W4+Tl5OXl5OXl5ufnMU5VMU5VMU5V6enpMU5V0my66oal6urqM0/rkwAAAE10Uk5TACqvv7+/wMDBwcHBwcHBwsLCwsTGx8jIyMrMzMzMzMzOzs/Q0tLT1NbW2NjZ2tzd3d7e3t/h4uXm6Ors7e3v7/Dx9PT19vf4+vv8/v7rW4xzAAABl0lEQVR42u3a6VOCQBjHcaSLKLuTsrL7UMsOs/vWjs2o/v+/pqFnXWe25YWAPczw+75Chd3PjMo6gmUhhBBCKPPlbOGzJeycZfus2ZbgBQjLZ+4XUHVZqiqA+82SCwAAAAAAgAKE9OA+y12nTmMuOe21LTlUzRN/F6PQZuig8/f4q96BBHim1TC0RToon8S626CxRE+AJTpoPAlAncYy/h6oOIbuNMDsaOQ2NYCcr6IAzqehYw1w8hW5MQ0g53MAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAID0AArLhi40wPRK5CY1gJyvkJ6/atMLGKSDdhKY//qVxtrrBXB4Kf/kn2vHnb+Vl0Mt3BsAXsnYbvfqSqMUr9VHNdTLeudJTwFw0QoAAACIA6hNDM0/8QE+BoKrumfbfQc06eRZDrbLtN0MtkfohH5zFTw4ohdutf0TAdRpomKwXewur28tuaQMqwF9v6Tt30/AfmdN28gq4P/eAvYPIfvXMLUnohScigEAIBEA+229nPHf2s1+czv77f0IIYQQynw/TJjHvucZhWUAAAAASUVORK5CYII="> ';
		$menu_title = $image_tag . Config::MENU_NAME;//html content, with icon
		add_submenu_page(
			Core::MENU_SLUG,
			Config::NAME,
			$menu_title,
			'edit_posts',
			Config::SLUG,
			array( $this, 'main_ui' ) );
	}

	// Take over the update check
	function check_for_plugin_update($checked_data) {
		global $wp_version;

		$plugin_folder = basename(plugin_dir_path(__FILE__));
		$plugin_index_file_name = basename((__FILE__));

		//Comment out these two lines during testing.
		if (empty($checked_data->checked))
			return $checked_data;

		$license_data = Activation::get_license_details();

		if ( (!isset($license_data['key']) || $license_data['key'] == '') ||
		     (!isset($license_data['email']) || $license_data['email'] == '')

		)
			return $checked_data;

		$args = array(
			'slug' => Config::UPDATE_SLUG,
			'version' => $checked_data->checked[$plugin_folder .'/' . $plugin_index_file_name],
			'key' => $license_data['key'],
			'email' => $license_data['email'],
			'site_url' => get_site_url(),
		);

		$request_string = array(
			'body' => array(
				'action' => 'basic_check',
				'request' => serialize($args),
				'api-key' => md5(get_bloginfo('url'))
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
		);

		// Start checking for an update
		$raw_response = wp_remote_post(Config::UPDATE_CHECK_URL, $request_string);

		if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
			$response = unserialize($raw_response['body']);

		if (is_object($response) && !empty($response)) // Feed the update data into WP updater
			$checked_data->response[$plugin_folder .'/' . $plugin_index_file_name] = $response;

		return $checked_data;
	}


	public function main_ui() {
		include_once 'ui/main-ui.php';
	}
	public function load_backend_scripts() {
		wp_register_style( 'backend-bundle-style', plugins_url( 'bundle/css/backend.css', __FILE__ ) );


		wp_register_script( 'backend-bundle-handler', plugins_url( 'bundle/js/backend-bundle.min.js', __FILE__ ), array(
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

		wp_enqueue_script( 'backend-bundle-handler', '', array(), false, true );
		wp_enqueue_style( 'backend-bundle-style' );
	}
	public function load_frontend_scripts() {
		wp_register_style( 'frontend-bundle-style', plugins_url( 'bundle/css/frontend.css', __FILE__ ) );
		wp_enqueue_style( 'frontend-bundle-style' );

		wp_register_script( 'frontend-bundle-handler', plugins_url( 'bundle/js/frontend-bundle.min.js', __FILE__ ), array(
			'jquery',
			'underscore',
			'backbone'
		), false, true );

		wp_enqueue_script( 'frontend-bundle-handler', '', array(), false, true );

	}

	function save_slider()
	{
		parse_str(file_get_contents('php://input'), $data);

		$slider = new Slider($data['sliderID']);
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

	function edit_slider()
	{
		$allSliders = Slider::getAllSliders();

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



	function delete_slider()
	{
		parse_str(file_get_contents("php://input"), $data);

		wp_delete_post($data['sliderID']);
		die();
	}



	function get_slider_to_edit()
	{
		parse_str(file_get_contents("php://input"), $data);

		$slider = new Slider($data['sliderID']);

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


	function create_draft_preview()
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


	function delete_draft_preview()
	{
		parse_str(file_get_contents("php://input"), $data);

		wp_delete_post($data['id']);
		die();
	}

}

/**
 * Check if WooCommerce is activated
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
    function is_woocommerce_activated() {
        if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
    }
}

add_action('plugin_loaded', function(){
    if (is_woocommerce_activated())
        Initiator::getInstance();

});

