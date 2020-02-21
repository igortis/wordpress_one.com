<?php
/**
 * Eaterstop Lite About Theme
 *
 * @package Eaterstop Lite
 */

//about theme info
add_action( 'admin_menu', 'eaterstop_lite_abouttheme' );
function eaterstop_lite_abouttheme() {    	
	add_theme_page( __('About Theme Info', 'eaterstop-lite'), __('About Theme Info', 'eaterstop-lite'), 'edit_theme_options', 'eaterstop_lite_guide', 'eaterstop_lite_mostrar_guide');   
} 

//Info of the theme
function eaterstop_lite_mostrar_guide() { 	
?>
<div class="wrap-GT">
	<div class="gt-left">
   		   <div class="heading-gt">
			  <h3><?php esc_html_e('About Theme Info', 'eaterstop-lite'); ?></h3>
		   </div>
          <p><?php esc_html_e('Eaterstop Lite is a free Restaurant WordPress themes specially designed and developed to suit the requirements of restaurant and cafe websites. EaterStop Lite is a sophisticated and innovative free WordPress theme that can be used for creating different websites for restaurant, cafeteria, pub, bar, wine shop and other food related business. ','eaterstop-lite'); ?></p>
<div class="heading-gt"> <?php esc_html_e('Theme Features', 'eaterstop-lite'); ?></div>
 

<div class="col-2">
  <h4><?php esc_html_e('Theme Customizer', 'eaterstop-lite'); ?></h4>
  <div class="description"><?php esc_html_e('The built-in customizer panel quickly change aspects of the design and display changes live before saving them.', 'eaterstop-lite'); ?></div>
</div>

<div class="col-2">
  <h4><?php esc_html_e('Responsive Ready', 'eaterstop-lite'); ?></h4>
  <div class="description"><?php esc_html_e('The themes layout will automatically adjust and fit on any screen resolution and looks great on any device. Fully optimized for iPhone and iPad.', 'eaterstop-lite'); ?></div>
</div>

<div class="col-2">
<h4><?php esc_html_e('Cross Browser Compatible', 'eaterstop-lite'); ?></h4>
<div class="description"><?php esc_html_e('Our themes are tested in all mordern web browsers and compatible with the latest version including Chrome,Firefox, Safari, Opera, IE11 and above.', 'eaterstop-lite'); ?></div>
</div>

<div class="col-2">
<h4><?php esc_html_e('E-commerce', 'eaterstop-lite'); ?></h4>
<div class="description"><?php esc_html_e('Fully compatible with WooCommerce plugin. Just install the plugin and turn your site into a full featured online shop and start selling products.', 'eaterstop-lite'); ?></div>
</div>
<hr />  
</div><!-- .gt-left -->
	
<div class="gt-right">			
        <div>				
            <a href="<?php echo esc_url( EATERSTOP_LITE_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'eaterstop-lite'); ?></a> | 
            <a href="<?php echo esc_url( EATERSTOP_LITE_PROTHEME_URL ); ?>"><?php esc_html_e('Purchase Pro', 'eaterstop-lite'); ?></a> | 
            <a href="<?php echo esc_url( EATERSTOP_LITE_THEME_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation', 'eaterstop-lite'); ?></a>
        </div>		
</div><!-- .gt-right-->
<div class="clear"></div>
</div><!-- .wrap-GT -->
<?php } ?>