<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Eaterstop Lite
 */
$show_social_sections 	= get_theme_mod('show_social_sections', false);
?>
<div id="footer-wrapper">
<?php
$disablefooter = get_theme_mod('disabled_footer', '1');
if( $disablefooter == ''){
?>
  <div class="footer">
    	<div class="container">
        
             <div class="cols-4 widget-column-1">               
               <?php
                   $about_title = get_theme_mod('about_title');
                   if( !empty($about_title) ){ ?>
                    <h5><?php echo esc_html($about_title); ?></h5>
                 <?php } ?> 
                 
                  <?php
                   $about_description = get_theme_mod('about_description');
                   if( !empty($about_description) ){ ?>
                    <p><?php echo esc_html($about_description); ?></p>
                 <?php } ?> 
            </div><!--end .widget-column-1-->                 
			         
             
             <div class="cols-4 widget-column-2"> 
              <?php
                   $menu_title = get_theme_mod('menu_title');
                   if( !empty($menu_title) ){ ?>
                    <h5><?php echo esc_html($menu_title); ?></h5>
                 <?php } ?>               
               
                <div class="menu">
                  <?php wp_nav_menu(array('theme_location' => 'footer')); ?>
                </div>                        	
                       	
              </div><!--end .widget-column-2-->     
                      
               <div class="cols-4 widget-column-3">               
                <?php
                   $latestpost_title = get_theme_mod('latestpost_title');
                   if( !empty($latestpost_title) ){ ?>
                    <h5><?php echo esc_html($latestpost_title); ?></h5>
                 <?php } ?> 
				
                 <?php query_posts('post_type=post&showposts=4'); ?>
                    <?php  while( have_posts() ) : the_post(); ?>
                  	<div class="recent-post">                    
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<span><?php echo get_the_date(); ?></span>
                    </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                    
                </div><!--end .widget-column-3-->
                
                <div class="cols-4 widget-column-4">
               <?php
                   $contact_title = get_theme_mod('contact_title');
                   if( !empty($contact_title) ){ ?>
                    <h5><?php echo esc_html($contact_title); ?></h5>
                 <?php } ?> 
                 
                 <?php
                   $contact_add = get_theme_mod('contact_add');
                   if( !empty($contact_add) ){ ?>
                    <p><?php echo esc_html($contact_add); ?></p>
                 <?php } ?> 
                
                
              <div class="phone-no">
               <?php
                   $contact_no = get_theme_mod('contact_no');
                   if( !empty($contact_no) ){ ?>
                    <p><?php echo esc_html($contact_no); ?></p>
                 <?php } ?> 
                 
                 <?php
				   $contact_mail = get_theme_mod('contact_mail');
				   if( !empty($contact_mail) ){ ?>
           		  <?php esc_html_e('Email','eaterstop-lite'); ?>
                     <a href="<?php echo esc_url('mailto:'.get_theme_mod('contact_mail')); ?>"><?php echo esc_html(get_theme_mod('contact_mail')); ?></a>               
	  	       <?php } ?>   
              
           </div>
                
            
             <div class="clear"></div>  
             <?php if( $show_social_sections != ''){ ?>              
                  <div class="social-icons">
                    <?php $fb_link = get_theme_mod('fb_link');
                        if( !empty($fb_link) ){ ?>
                        <a title="facebook" class="fb" target="_blank" href="<?php echo esc_url($fb_link); ?>"></a>
                    <?php } ?>
                    
                    <?php $twitt_link = get_theme_mod('twitt_link');
                        if( !empty($twitt_link) ){ ?>
                        <a title="twitter" class="tw" target="_blank" href="<?php echo esc_url($twitt_link); ?>"></a>
                    <?php } ?>
                    
                    <?php $gplus_link = get_theme_mod('gplus_link');
                        if( !empty($gplus_link) ){ ?>
                        <a title="google-plus" class="gp" target="_blank" href="<?php echo esc_url($gplus_link); ?>"></a>
                    <?php } ?>
                    
                     <?php $linked_link = get_theme_mod('linked_link');
                        if( !empty($linked_link) ){ ?>
                        <a title="linkedin" class="in" target="_blank" href="<?php echo esc_url($linked_link); ?>"></a>
                    <?php } ?>
                  </div>  
              <?php } ?>
                   
                </div><!--end .widget-column-4-->
                
                
            <div class="clear"></div>
         </div><!--end .container-->   
        </div><!--end .footer-->   
        <?php } ?>
        <div class="copyright-wrapper">
        	<div class="container">
            	<div class="copyright-txt">				
                <?php
                   $copyright_text = get_theme_mod('copyright_text');
                   if( !empty($copyright_text) ){ ?>
                   <?php echo esc_html($copyright_text); ?>
                 <?php } ?>                               
       			 </div>
                <div class="design-by">
                 <a href="<?php echo esc_url( 'https://gracethemes.com/themes/free-restaurant-wordpress-theme/', 'eaterstop-lite' ); ?>">
                 <?php esc_html_e('Theme by Grace Themes', 'eaterstop-lite');?>				 
                 </a>
                              
                </div>
                <div class="clear"></div>
            </div>            
        </div>
        
             
    </div><!--#footer-wrapper-->

<?php wp_footer(); ?>
</body>
</html>