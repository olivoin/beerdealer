<?php get_header(); ?>
	<div id="content">
		<?php if ( have_posts() ) :
			/* Start the Loop */
			$reddish_post_count = 0;
			while ( have_posts() ) : the_post(); $reddish_post_count++;
				get_template_part( 'content', get_post_format() );
			endwhile;
			reddish_numeric_posts_nav(); /* post navigation */
		else : /* have posts */
			get_template_part( 'no-results', 'index' );
		endif; /* have_posts() */ ?>
	</div><!-- #content -->
<?php get_sidebar();
get_footer();