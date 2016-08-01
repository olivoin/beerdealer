<?php
/**
* The Template for displaying all single posts.
*
*/ 
get_header(); ?>
	<div id="content">
		<?php while( have_posts() ) : the_post();
			get_template_part( 'content', 'page' );
			/* If comments are open or we have at least one comment, load up the comment template */
			if ( comments_open() || '0' != get_comments_number() ) :
				comments_template( '', true );
			endif;
		endwhile; ?>
	</div><!--#content-->
<?php get_sidebar();
get_footer();