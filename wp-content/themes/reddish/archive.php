<?php
/**
* The template for displaying Archive pages.
*
*/
get_header(); ?>
<div id="content">
		<?php if ( have_posts() ) : ?>
			<h1 class="larger_title">
				<?php if ( is_day() ) :
					printf( __( 'Daily Archives: %s', 'reddish' ), '<span>' . get_the_date() . '</span>' );
				elseif ( is_month() ) :
					printf( __( 'Monthly Archives: %s', 'reddish' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'reddish' ) ) . '</span>' );
				elseif ( is_year() ) :
					printf( __( 'Yearly Archives: %s', 'reddish' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'reddish' ) ) . '</span>' );
				elseif ( is_tag() ) :
					printf( __( 'Tag Archives: %s', 'reddish' ), '<span>' .single_cat_title( '', false ) . '</span>' );
				elseif ( is_category() ) :
					printf( __( 'Category Archives: %s', 'reddish' ), '<span>' . single_cat_title( '', false ) . '</span>' );
				elseif ( is_author() ) :
					printf( __( 'Author&#8217;s Archive: %s', 'reddish' ), '<span>' . esc_attr( get_the_author() ) . '</span>' );
				else :
					_e( 'Archives', 'reddish' );
				endif;	?>
			</h1><!-- .larger_title -->
			<?php if ( is_category() && category_description() ) : ?><!-- Show an optional category description -->
				<div class="category_description"><?php echo category_description(); ?></div>
			<?php endif;
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
			endwhile;
			reddish_numeric_posts_nav(); /* post navigation */
		else :/* .have posts */
			get_template_part( 'no-results', 'archive' );
		endif; /* .have posts */ ?>
</div><!-- #content -->
<?php get_sidebar();
get_footer();