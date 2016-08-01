<?php
/**
* The template for displaying Comments.
*/
/*
* If the current post is protected by a password and
* the visitor has not yet entered the password it will
* return early without loading the comments.
*/
if ( post_password_required() )
	return;
?>
<div id="comments" class="comments-area">
	<?php // You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _n( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'reddish' ),
				number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2><!-- .comments-title -->
		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'reddish_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : /* are there comments to navigate through */ ?>
			<div id="comment-nav-below" class="navigation" role="navigation">
				<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'reddish' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'reddish' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'reddish' ) ); ?></div>
			</div><!-- .navigation -->
		<?php endif; /* get_comment_pages_count() > 1 (check for comment navigation) */
		/* If there are no comments and comments are closed, leave a note. */
		if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="nocomments"><?php _e( 'Comments are closed.' , 'reddish' ); ?></p>
		<?php endif; /* ! comments_open() */
	endif; /* have_comments() */
	$commenter = wp_get_current_commenter(); // display comment form
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? "aria-required='true'" : '' );
	$comments_args = array(
		'title_reply'					=>  __( 'Please give us your valuable comment', 'reddish' ),
		'title_reply_to'			=>  __( 'Leave a Reply to %s', 'reddish' ),
		'cancel_reply_link'		=>  __( 'Cancel Reply','reddish' ),
		'label_submit'				=>  __( 'Send My Comment' , 'reddish' ),
		'comment_field'				=>  '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'reddish' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		'logged_in_as'				=>  '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'reddish' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		'comment_notes_after' =>  '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'reddish' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>'
	);
	comment_form( $comments_args ); ?>
</div><!-- #comments .comments-area -->