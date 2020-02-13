<?php
/**
 * Include the TGM_Plugin_Activation class. (included in init.php)
 */

function di_blog_register_required_plugins() {
	$plugins = array(

		array(
			'name'      => __( 'Elementor Page Builder', 'di-blog'),
			'slug'      => 'elementor',
			'required'  => false,
		),
		
		array(
			'name'      => __( 'WooCommerce (For E-Commerce)', 'di-blog'),
			'slug'      => 'woocommerce',
			'required'  => false,
		),
		
		array(
			'name'      => __( 'Contact Form 7 (For Forms)', 'di-blog'),
			'slug'      => 'contact-form-7',
			'required'  => false,
		),

		array(
			'name'      => __( 'Regenerate Thumbnails', 'di-blog'),
			'slug'      => 'regenerate-thumbnails',
			'required'  => false,
		),

		array(
			'name'      => __( 'Di Themes Demo Site Importer', 'di-blog'),
			'slug'      => 'di-themes-demo-site-importer',
			'required'  => false,
		),

		array(
			'name'      => __( 'MailOptin - Popups, Email Optin Forms & Newsletters for MailChimp, Aweber etc.', 'di-blog'),
			'slug'      => 'mailoptin',
			'required'  => false,
		),
		
	);
	
	
	$config = array(
		'id'			=> 'di-blog',
		'default_path'	=> '',
		'menu'			=> 'di-blog-install-plugins',
		'has_notices'	=> true,
		'dismissable'	=> true,
		'dismiss_msg'	=> '',
		'is_automatic'	=> false,
		'message'		=> '',
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'di_blog_register_required_plugins' );

