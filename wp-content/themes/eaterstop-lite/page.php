<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Eaterstop Lite
 */

get_header(); ?>
<?php
$disabled_welcomepage 	= get_theme_mod('disabled_welcomepage', false);
$disabled_pageboxes 	= get_theme_mod('disabled_pageboxes', false);
?>
<?php if ( is_front_page() && ! is_home() ) { ?>
<?php if( $disabled_welcomepage != ''){ ?>
<section id="wrapfirst">
  <div class="container">
    <div class="welcomewrap">     
      <?php 
	if( get_theme_mod('page-setting1',false)) {     
	$queryvar = new WP_Query('page_id='.absint(get_theme_mod('page-setting1',true)) );			
		while( $queryvar->have_posts() ) : $queryvar->the_post(); ?>                     
		  <h2><?php the_title(); ?></h2>   
		 <?php the_content(); ?>
          <div class="clear"></div>	                                    
		<?php endwhile;
		 wp_reset_postdata(); ?>                                    
       <?php } ?>        
      
    </div> <!-- welcomewrap-->
    <div class="clear"></div>
  </div> <!-- container -->
</section>
<div class="clear"></div>
<?php } ?>


<?php if( $disabled_pageboxes != ''){ ?>
  <div id="ourservices">
     <div class="container">        
       <?php 
        for($n=1; $n<=4; $n++) {    
        if( get_theme_mod('page-column'.$n,false)) {      
            $queryvar = new WP_Query('page_id='.absint(get_theme_mod('page-column'.$n,true)) );		
            while( $queryvar->have_posts() ) : $queryvar->the_post(); ?>     
            <div class="cols2 <?php if($n % 4 == 0) { echo "lastcols"; } ?>">                                       
                <?php if(has_post_thumbnail() ) { ?>
                <div class="servicesthumb"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>        
                <?php } ?>                      	
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                 <?php the_excerpt(); ?>                        
            </div>
            <?php endwhile;
            wp_reset_postdata();                                  
        } } ?>                                 
    <div class="clear"></div>  
   </div><!-- .container -->
</div><!-- #ourservices -->              
<?php } } ?>

<div class="container">
      <div id="page_content">
    		 <section class="site-main">               
            		<?php while( have_posts() ) : the_post(); ?>
                            	<h1 class="entry-title"><?php the_title(); ?></h1>
                                <div class="entry-content">
                                			<?php the_content(); ?>
                                            <?php
												//If comments are open or we have at least one comment, load up the comment template
												if ( comments_open() || '0' != get_comments_number() )
													comments_template();
												?>
                                </div><!-- entry-content -->
                      		<?php endwhile; ?>
                    
            </section><!-- section-->
   
     <?php get_sidebar();?>      
    <div class="clear"></div>
    </div><!-- .page_content --> 
 </div><!-- .container --> 
<?php get_footer(); ?>