<?php
/**
* The template part for displaying a message that posts cannot be found.
*
*/
?>
	<div class="post no-results not-found">
		<h2 class="larger_title">
			<?php if ( is_404() ) :
				_e( 'Page Not Found', 'reddish' );
			elseif ( is_search() ) :
				printf( __( 'Search Results for: %s', 'reddish' ), '<span>' . get_search_query() . '</span>' );
			else : /* for all other pages except for 404 page and Search Result page */
				_e( 'Nothing Found', 'reddish' );
			endif; /* is_404 */ ?>
		</h2><!-- .larger_title -->
		<?php if ( is_search() ) : ?>
			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'reddish' ); ?></p>
		<?php elseif ( is_404() ) : ?>
			<p><?php _e( 'We&rsquo;re very sorry, but the page you requested has not been found!', 'reddish' ); ?></p>
			<p><?php _e( 'You could try searching the website for the content you were looking for.', 'reddish' ); ?></p>
		<?php else : ?><!-- for all other pages except for 404 page and Search Result page -->
			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'reddish' ); ?></p>
		<?php endif; /* is_search() */ ?>
		<div class="search_form">
			<?php get_search_form(); ?>
		</div><!-- .search_form -->
	</div><!-- .post .no-results .not-found -->