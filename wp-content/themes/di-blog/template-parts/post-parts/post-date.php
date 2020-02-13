<div class="post-date updated" itemprop="dateModified">
	<p>
		<?php
		if( get_theme_mod( 'dispostdt', 'published' ) == 'published' ) {
			the_date();
		} else {
			the_modified_date();
		}
		?>
	</p>
</div>
