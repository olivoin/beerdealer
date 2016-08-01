 <?php
/**
* The template for displaying Search Results pages.
*
*/ 
get_header(); ?>
	<div id="content">
		<?php if ( have_posts() ) :
			/* Start the Loop */ ?>
			<h1 class="larger_title">
				<?php printf( __( 'Search Results for: %s', 'reddish' ), '<span>' . get_search_query() . '</span>' ); ?>
			</h1>
			<?php while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
			endwhile;
			reddish_numeric_posts_nav(); /* post navigation */
		else :/* have post */
			get_template_part( 'no-results', 'search' );
		endif; ?><!--have_posts()-->
	</div><!--content-->
<?php get_sidebar();
get_footer();
