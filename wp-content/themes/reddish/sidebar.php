<div id="secondary" class="widget-area">
	<?php if ( is_active_sidebar( 'primary' ) ) :
		dynamic_sidebar( 'primary' );
	else : /* is_active_sidebar */ ?>
		<div class="widget">
			<h4 class="widget-title" ><?php _e( 'recent posts', 'reddish' ); ?></h4>
			<ul>
				<?php $args = array( 'numberposts' => 5,'order' => 'ASC',);
				$recent_posts = wp_get_recent_posts( $args );
				foreach ( array_reverse( $recent_posts ) as $recent ) :
					echo '<li><a href="' . get_permalink( $recent["ID"] ) . '" title="Look ' . esc_attr( $recent["post_title"] ) . '" >' . $recent["post_title"] . '</a></li> ';
				endforeach;	?>
			</ul>
		</div><!-- widget -->
		<div class="widget">
			<h4 class="widget-title"><?php _e( 'recent comments', 'reddish' ); ?></h4>
			<ul>
				<?php	$args = array( 'number' => 5, );
				$comments = get_comments( $args );
				foreach( $comments as $comment ) :
					echo( '<li><a href="' . esc_url( $comment->comment_author_url ) . '">' . $comment->comment_author . ' </a><span class="on"> ' . _x( ' on', 'comment_on', 'reddish' ) . '</span><a href="' . get_permalink( $comment->comment_post_ID ) . ' "> ' . get_the_title( $comment->comment_post_ID ) . '</a></li>' );
				endforeach;	?>
			</ul>
		</div>
		<div class="widget">
			<h4 class="widget-title"><?php _e( 'archives', 'reddish' ); ?></h4>
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
			</ul>
		</div>
		<div class="widget">
			<h4 class="widget-title"><?php _e( 'categories','reddish' ); ?></h4>
			<ul>
				<?php	$args = array( 'orderby' => 'name',	'parent' => 0 );
				$categories = get_categories();
				foreach ( $categories as $category ) :
					echo '<li><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></li>';
				endforeach;	?>
			</ul>
		</div>
	<?php endif; /* is_active_sidebar */ ?>
</div><!-- #secondary -->