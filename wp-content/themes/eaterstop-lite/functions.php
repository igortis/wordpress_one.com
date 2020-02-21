<?php    
/**
 * Eaterstop Lite functions and definitions
 *
 * @package Eaterstop Lite
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'eaterstop_lite_setup' ) ) : 
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function eaterstop_lite_setup() {
	if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */

	load_theme_textdomain( 'eaterstop-lite', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('woocommerce');
	add_theme_support('html5');
	add_theme_support( 'post-thumbnails' );	
	add_theme_support( 'title-tag' );	
	add_theme_support( 'custom-logo', array(
		'height'      => 62,
		'width'       => 190,
		'flex-height' => true,
	) );	
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'eaterstop-lite' ),
		'footer' => __( 'Footer Menu', 'eaterstop-lite' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_editor_style( 'editor-style.css' );
} 
endif; // eaterstop_lite_setup
add_action( 'after_setup_theme', 'eaterstop_lite_setup' );

function eaterstop_lite_widgets_init() { 	
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'eaterstop-lite' ),
		'description'   => __( 'Appears on blog page sidebar', 'eaterstop-lite' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
}
add_action( 'widgets_init', 'eaterstop_lite_widgets_init' );


function eaterstop_lite_font_url(){
		$font_url = '';		
		
		/* Translators: If there are any character that are not
		* supported by Roboto, trsnalate this to off, do not
		* translate into your own language.
		*/
		$roboto = _x('on','roboto:on or off','eaterstop-lite');	
		
		if('off' !== $roboto ){
			$font_family = array();			
			if('off' !== $roboto){
				$font_family[] = 'Roboto:300,400,600,700,800,900';
			}						
			$query_args = array(
				'family'	=> urlencode(implode('|',$font_family)),
			);			
			$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
		}
		
	return $font_url;
	}


function eaterstop_lite_scripts() {
	wp_enqueue_style('eaterstop-lite-font', eaterstop_lite_font_url(), array());
	wp_enqueue_style( 'eaterstop-lite-basic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'nivo-slider', get_template_directory_uri()."/css/nivo-slider.css" );
	wp_enqueue_style( 'eaterstop-lite-responsive-style', get_template_directory_uri()."/css/responsive.css" );		
	wp_enqueue_style( 'eaterstop-lite-base-style', get_template_directory_uri()."/css/style_base.css" );
	wp_enqueue_script( 'jquery-nivo', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
	wp_enqueue_script( 'eaterstop-lite-custom-js', get_template_directory_uri() . '/js/custom.js' );
	wp_enqueue_style( 'animate', get_template_directory_uri()."/css/animation.css" );
		

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'eaterstop_lite_scripts' );

function eaterstop_lite_ie_stylesheet(){
	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style('eaterstop-lite-ie', get_template_directory_uri().'/css/ie.css', array( 'eaterstop-lite-style' ), '20160928' );
	wp_style_add_data('eaterstop-lite-ie','conditional','lt IE 10');
	
	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'eaterstop-lite-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'eaterstop-lite-style' ), '20160928' );
	wp_style_add_data( 'eaterstop-lite-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'eaterstop-lite-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'eaterstop-lite-style' ), '20160928' );
	wp_style_add_data( 'eaterstop-lite-ie7', 'conditional', 'lt IE 8' );	
	}
add_action('wp_enqueue_scripts','eaterstop_lite_ie_stylesheet');


define('EATERSTOP_LITE_PROTHEME_URL','https://www.gracethemes.com/themes/eaterstop-restaurant-wordpress-theme/','eaterstop-lite');
define('EATERSTOP_LITE_THEME_DOC','https://www.gracethemes.com/documentation/eaterstop-doc/#homepage-lite','eaterstop-lite');
define('EATERSTOP_LITE_LIVE_DEMO','https://gracethemes.com/demo/eaterstop/','eaterstop-lite');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template for about theme.
 */
 if ( is_admin() ) { 
require get_template_directory() . '/inc/about-themes.php';
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


// Custom Logo
if ( ! function_exists( 'eaterstop_lite_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function eaterstop_lite_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function eaterstop_lite_skip_link_focus_fix() {  
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'eaterstop_lite_skip_link_focus_fix' );
