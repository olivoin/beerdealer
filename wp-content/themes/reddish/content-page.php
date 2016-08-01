<?php
/**
* The template used for displaying page content in page.php
*
*/
?>
	<div id="single-page" <?php post_class(); ?>>
		<div class="entry_title">
			<h2><?php echo get_the_title(); ?></h2>
		</div><!--.entry_title"-->
		<div class="entry_content">
			<?php the_content();
			wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'reddish' ), 'after' => '</div>' ) ); ?>
		</div ><!-- .entry-content -->
		<div class="entry-meta">
			<?php edit_post_link( _x( 'Edit', 'post edit link', 'reddish' ), '<span class="edit-link">', '</span>' ); ?>
		</div ><!-- entry-meta -->
	</div><!--.post-->
