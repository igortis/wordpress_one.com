<?php
/**
 * @package Eaterstop Lite
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
 <?php 
        if (has_post_thumbnail() ){
			echo '<div class="post-thumb">';
            the_post_thumbnail();
			echo '</div>';
		}
        ?>
    
    <header class="entry-header">       
        <?php the_title( '<h2 class="single_title">', '</h2>' ); ?>
    </header><!-- .entry-header -->
    
     <div class="postmeta">
            <div class="post-date"><?php the_date(); ?></div><!-- post-date -->
            <div class="post-comment"> &nbsp;|&nbsp; <a href="<?php echo esc_url( comments_link() ); ?>"><?php comments_number(); ?></a></div>               
    </div><!-- postmeta -->
    
   

    <div class="entry-content">		
        <?php the_content(); ?>       
        <div class="postmeta">           
            <div class="post-tags"><?php the_tags(); ?></div>
            <div class="clear"></div>
        </div><!-- postmeta -->
    </div><!-- .entry-content -->
   
    <footer class="entry-meta">
       <?php edit_post_link(); ?>
    </footer><!-- .entry-meta -->

</article>