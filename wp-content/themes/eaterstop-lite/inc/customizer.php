<?php
/**
 * Eaterstop Lite Theme Customizer
 *
 * @package Eaterstop Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function eaterstop_lite_customize_register( $wp_customize ) {	
	//Add a class for titles
    function eaterstop_lite_sanitize_dropdown_pages( $page_id, $setting ) {
	  // Ensure $input is an absolute integer.
	  $page_id = absint( $page_id );
	
	  // If $page_id is an ID of a published page, return it; otherwise, return the default.
	  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	function eaterstop_lite_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}  
		
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	$wp_customize->add_setting('color_scheme',array(
			'default'	=> '#D66200',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => __('Color Scheme','eaterstop-lite'),			
			 'description'	=> __('More color options in PRO Version','eaterstop-lite'),	
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);
	
	// Slider Section		
	$wp_customize->add_section( 'slider_section', array(
            'title' => __('Slider Settings', 'eaterstop-lite'),
            'priority' => null,
            'description'	=> __('Featured Image Size Should be ( 1400x580 ).','eaterstop-lite'),		
        )
    );
	
	
	$wp_customize->add_setting('page-setting7',array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'eaterstop_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('page-setting7',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide one:','eaterstop-lite'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting8',array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'eaterstop_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('page-setting8',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide two:','eaterstop-lite'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting9',array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'eaterstop_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('page-setting9',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide three:','eaterstop-lite'),
			'section'	=> 'slider_section'
	));	// Slider Section
	
	$wp_customize->add_setting('disabled_slides',array(
				'default' => false,
				'sanitize_callback' => 'eaterstop_lite_sanitize_checkbox',
				'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'disabled_slides', array(
			   'settings' => 'disabled_slides',
			   'section'   => 'slider_section',
			   'label'     => __('Check To show This Section','eaterstop-lite'),
			   'type'      => 'checkbox'
	 ));//Show Slider Section	
	
	
	// Home Welcome Section 	
	$wp_customize->add_section('section_welcome',array(
			'title'	=> __('Homepage Todays Special Menu ','eaterstop-lite'),
			'description'	=> __('Select Page from the dropdown for first section','eaterstop-lite'),
			'priority'	=> null
	));
	
	$wp_customize->add_setting('page-setting1',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'eaterstop_lite_sanitize_dropdown_pages'
		));
 
	$wp_customize->add_control(	'page-setting1',array(
			'type' => 'dropdown-pages',			
			'section' => 'section_welcome',
	));
	
	$wp_customize->add_setting('disabled_welcomepage',array(
			'default' => false,
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'eaterstop_lite_sanitize_checkbox'
	));	 
	
	$wp_customize->add_control( 'disabled_welcomepage', array(
			   'settings' => 'disabled_welcomepage',
			   'section'   => 'section_welcome',
			   'label'     => __('Check To show This Section','eaterstop-lite'),
			   'type'      => 'checkbox'
	 ));//show Todays Special Menu Section	
	
	// Home four Boxes Section 	
	$wp_customize->add_section('section_second', array(
		'title'	=> __('Homepage Four Boxes Section','eaterstop-lite'),
		'description'	=> __('Select Pages from the dropdown for homepage four boxes section','eaterstop-lite'),
		'priority'	=> null
	));	
	
	
	$wp_customize->add_setting('page-column1',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'eaterstop_lite_sanitize_dropdown_pages'
		));
 
	$wp_customize->add_control(	'page-column1',array(
			'type' => 'dropdown-pages',			
			'section' => 'section_second',
	));	
	
	
	$wp_customize->add_setting('page-column2',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'eaterstop_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'page-column2',array(
			'type' => 'dropdown-pages',			
			'section' => 'section_second',
	));
	
	$wp_customize->add_setting('page-column3',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'eaterstop_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'page-column3',array(
			'type' => 'dropdown-pages',			
			'section' => 'section_second',
	));	
	
	$wp_customize->add_setting('page-column4',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'eaterstop_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'page-column4',array(
			'type' => 'dropdown-pages',			
			'section' => 'section_second',
	));	//end four column part
	
	$wp_customize->add_setting('disabled_pageboxes',array(
			'default' => false,
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'eaterstop_lite_sanitize_checkbox'
	));	 
	
	$wp_customize->add_control( 'disabled_pageboxes', array(
			   'settings' => 'disabled_pageboxes',
			   'section'   => 'section_second',
			   'label'     => __('Check To Show This Section','eaterstop-lite'),
			   'type'      => 'checkbox'
	 ));//show page boxes Section	
	
		
	//Social Section
	$wp_customize->add_section('social_sec',array(
			'title'	=> __('Social Settings','eaterstop-lite'),				
			'description'	=> __('More social icon available in PRO Version','eaterstop-lite'),		
			'priority'		=> null
	));
	
	
	$wp_customize->add_setting('fb_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'	
	));
	
	$wp_customize->add_control('fb_link',array(
			'label'	=> __('Add facebook link here','eaterstop-lite'),
			'section'	=> 'social_sec',
			'setting'	=> 'fb_link'
	));	
	$wp_customize->add_setting('twitt_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('twitt_link',array(
			'label'	=> __('Add twitter link here','eaterstop-lite'),
			'section'	=> 'social_sec',
			'setting'	=> 'twitt_link'
	));
	$wp_customize->add_setting('gplus_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('gplus_link',array(
			'label'	=> __('Add google plus link here','eaterstop-lite'),
			'section'	=> 'social_sec',
			'setting'	=> 'gplus_link'
	));
	$wp_customize->add_setting('linked_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('linked_link',array(
			'label'	=> __('Add linkedin link here','eaterstop-lite'),
			'section'	=> 'social_sec',
			'setting'	=> 'linked_link'
	));	
	
	$wp_customize->add_setting('show_social_sections',array(
			'default' => false,
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'eaterstop_lite_sanitize_checkbox'
	));	 
	
	$wp_customize->add_control( 'show_social_sections', array(
			   'settings' => 'show_social_sections',
			   'section'   => 'social_sec',
			   'label'     => __('Check To Show This Section','eaterstop-lite'),
			   'type'      => 'checkbox'
	 ));//show social Section	
	
	
	//Footer Section
	$wp_customize->add_section('footer_area',array(
			'title'	=> __('Footer Area','eaterstop-lite'),
			'priority'	=> null,			
	));	
	
	$wp_customize->add_setting('about_title',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('about_title',array(
			'label'	=> __('Add title for about us','eaterstop-lite'),
			'section'	=> 'footer_area',
			'setting'	=> 'about_title'
	));	
		
	$wp_customize->add_setting( 'about_description', array(
			'default'	=> null,
			'sanitize_callback' => 'esc_textarea',
	) );

	$wp_customize->add_control( 'about_description', array(
			'type' => 'textarea',
			'label' => __( 'About Description', 'eaterstop-lite' ),   
			'section' => 'footer_area',   
			'setting'	=> 'about_description',
	) );
	
	$wp_customize->add_setting('menu_title',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('menu_title',array(
			'label'	=> __('Add title for menu','eaterstop-lite'),
			'section'	=> 'footer_area',
			'setting'	=> 'menu_title'
	));	
	
	$wp_customize->add_setting('latestpost_title',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('latestpost_title',array(
			'label'	=> __('Add title for footer latest posts','eaterstop-lite'),
			'section'	=> 'footer_area',
			'setting'	=> 'latestpost_title'
	));	
	
	$wp_customize->add_setting('contact_title',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('contact_title',array(
			'label'	=> __('Add title for footer contact info','eaterstop-lite'),
			'section'	=> 'footer_area',
			'setting'	=> 'contact_title'
	));	
	
	$wp_customize->add_setting('contact_add',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_textarea',
	));
	
	$wp_customize->add_control(	'contact_add', array(
				'type' => 'textarea',
				'label'	=> __('Add contact address here','eaterstop-lite'),
				'section'	=> 'footer_area',
				'setting'	=> 'contact_add'
	));
	$wp_customize->add_setting('contact_no',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('contact_no',array(
			'label'	=> __('Add contact number here.','eaterstop-lite'),
			'section'	=> 'footer_area',
			'setting'	=> 'contact_no'
	));
	$wp_customize->add_setting('contact_mail',array(			
			'sanitize_callback'	=> 'sanitize_email'
	));
	
	$wp_customize->add_control('contact_mail',array(
			'type' => 'text',
			'label'	=> __('Add you email here','eaterstop-lite'),
			'section'	=> 'footer_area',
			'setting'	=> 'contact_mail'
	));
	
	$wp_customize->add_setting('disabled_footer',array(
				'default' => true,
				'sanitize_callback' => 'eaterstop_lite_sanitize_checkbox',
				'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'disabled_footer', array(
			   'settings' => 'disabled_footer',
			   'section'   => 'footer_area',
			   'label'     => __('Check To hide This Section','eaterstop-lite'),
			   'type'      => 'checkbox'
	 ));//Disable Todays Special Menu Section
	
	
	//Copyright section
	$wp_customize->add_section('copyright_section',array(
			'title'	=> __('Footer Copyright','eaterstop-lite'),
			'priority'	=> null,			
	));	
	
	$wp_customize->add_setting('copyright_text',array(
			'default'	=> null,	
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('copyright_text',array(
			'label'	=> __('Change Copyright Text','eaterstop-lite'),
			'section'	=> 'copyright_section',
			'setting'	=> 'copyright_text'
	));	
   	
}
add_action( 'customize_register', 'eaterstop_lite_customize_register' );

//Custom css
function eaterstop_lite_custom_css(){
		?>
        	<style type="text/css"> 
					
					a, .blog_lists h2 a:hover,
					#sidebar ul li a:hover,								
					.cols-4 ul li a:hover, .cols-4 ul li.current_page_item a,					
					.phone-no strong,					
					.sitenav ul li a:hover, .sitenav ul li.current_page_item a,
					.slide_info h2 span,
					.logo h1 a,
					.headertop .left a:hover,
					.services-wrap .one_third h4,
					.cols-4 h5 span,
					.welcomewrap h2 span,
					.logo h1,
					div.recent-post a:hover,
					.design-by a:hover		
					{ color:<?php echo esc_html( get_theme_mod('color_scheme','#D66200')); ?>;}
					 
					
					.pagination ul li .current, .pagination ul li a:hover,
					#commentform input#submit:hover,					
					.nivo-controlNav a.active,				
					h3.widget-title,				
					.wpcf7 input[type='submit'],
					.headertop .right a,
					.services-wrap .one_third:hover,
					#sidebar .search-form input.search-submit
					{ background-color:<?php echo esc_html( get_theme_mod('color_scheme','#D66200')); ?>;}
					
						
					.header,
					section#home_slider,
					.social-icons a:hover
					{ border-color:<?php echo esc_html( get_theme_mod('color_scheme','#D66200')); ?>;}
					
			</style> 
<?php                    
}
         
add_action('wp_head','eaterstop_lite_custom_css');	

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function eaterstop_lite_customize_preview_js() {
	wp_enqueue_script( 'eaterstop_lite_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'eaterstop_lite_customize_preview_js' );