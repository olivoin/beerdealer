<?php
/**
* The template for displaying image attachments.
*
*/
get_header(); ?>
	<div id="content">
		<?php while ( have_posts() ) : the_post(); /* Start the Loop */ ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>
				<div class="entry_header">
					<h2 class="entry_title" ><?php echo get_the_title(); ?></h2>
				</div><!-- .entry_header -->
				<div class="entry-meta">
					<p class="date_category"><?php _e ( 'Posted on', 'reddish' ); ?>
						<?php // receive meta data on attachments
							$metadata = wp_get_attachment_metadata();
							printf( __( '<span class="color"> %1$s </span> at <a href="%2$s" title="Link to full-size image">%3$s &times; %4$s</a> in <a href="%5$s" title="Return to %6$s" rel="gallery">%7$s</a>.', 'reddish' ),
								esc_html( get_the_date() ),
								esc_url( wp_get_attachment_url() ),
								$metadata[ 'width' ],
								$metadata[ 'height' ],
								esc_url( get_permalink( $post->post_parent ) ),
								esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
								get_the_title( $post->post_parent ) );?>
						<!-- Displays a link to edit the current post, if a user is logged in and allowed to edit the post-->
						<?php edit_post_link( _x( 'Edit', 'post edit link', 'reddish' ), '<span class="edit-link">', '</span>' ); ?>
					</p><!-- .date_category -->
				</div><!-- .entry-meta -->
				<div class="entry_content">
					<div class="entry-attachment">
						<div class="attachment">
							<?php $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
							foreach ( $attachments as $k => $attachment ) :
								if ( $attachment->ID == $post->ID )
									break;
							endforeach;
							$k++;
							// If there is more than 1 attachment in a gallery
							if ( count( $attachments ) > 1 ) :
								if ( isset( $attachments[ $k ] ) ) :
									// get the URL of the next image attachment
									$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
								else :
									// or get the URL of the first image attachment
									$next_attachment_url = get_attachment_link( $attachments[0]->ID );
								endif;
							else :
								// or, if there's only 1 image, get the URL of the image
								$next_attachment_url = wp_get_attachment_url();
							endif; /* count( $attachments ) > 1 */ ?>
							<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment"><?php
								$attachment_size = apply_filters( 'reddish_attachment_size', array( 560, 560 ) );
								echo wp_get_attachment_image( $post->ID, $attachment_size ); ?>
							</a><!-- $next_attachment_url -->
							<?php if ( ! empty( $post->post_excerpt ) ) : ?>
								<div class="entry-caption">
									<?php the_excerpt(); ?>
								</div>
							<?php endif; ?>
						</div><!-- .attachment -->
					</div><!-- .entry-attachment -->
					<div class="entry-description">
						<?php the_content();
						wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'reddish' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-description -->
				</div><!-- .entry-content -->
				<div class="image-nav navigation" >
					<span class="previous-image"><?php previous_image_link( false, __( '&larr; Previous image', 'reddish' ) ); ?></span>
					<span class="next-image"><?php next_image_link( false, __( 'Next image &rarr;', 'reddish' ) ); ?></span>
				</div><!-- #image-navigation -->
			</div><!-- #post -->
			<?php comments_template();
		endwhile; // end of the loop. ?>
	</div><!-- #content -->
<?php get_sidebar();
get_footer();