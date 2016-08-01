<?php
/**
* The Template for displaying all single posts.
*/
get_header(); ?>
	<div id="content">
		<?php while( have_posts() ) : the_post(); /* Start the Loop */
			get_template_part( 'content', get_post_format() ); ?>
			<div class="nav-single navigation">
				<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'reddish' ) . '</span> %title' ); ?></span>
				<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'reddish' ) . '</span>' ); ?></span>
			</div><!-- .nav-single -->
			<!--If comments are open or we have at least one comment, load up the comment template-->
			<?php if ( comments_open() || '0' != get_comments_number() ) :
				comments_template( '', true );
			endif; /* if comments open */
		endwhile; /* have_posts() */ ?>
	</div><!--#content-->
<?php get_sidebar();
get_footer();