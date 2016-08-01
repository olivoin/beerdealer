<?php
/**
* Sets up the content width value based on the theme's design and stylesheet.
*/
global $reddish_post_count; /* counting posts for displaying 'top link' */
/**
 * Adds support for a custom header image.
 */
if ( ! isset( $content_width ) )
	$content_width = 625;

function reddish_setup() {
	global $reddish_slider_options;
	// Adds RSS feed links to <head> for posts and comments.
	load_theme_textdomain( 'reddish', get_template_directory() . '/languages' );/* Load files for localization*/
	// This theme uses wp_nav_menu() in two locations.
	add_image_size( 'slider-thumb', 0, 406, true );
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'reddish' ),
	'secondary' => __( 'Secondary Navigation', 'reddish' ),
	) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'	=>		'444',
		'default-image'			=>		'',
		// Set height and width, with a maximum value for the width.
		'height'				=>		360,
		'width'					=>		960,
		'max-width'				=>		2000,
		// Support flexible height and width.
		'flex-height'			=>		true,
		'flex-width'			=>		true,
		'header-text'            => true,
		// Random image rotation off by default.
		'random-default'		=>	false,
		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'	=>	'reddish_admin_header_style',
	 	'admin-head-callback'	=>	'reddish_admin_header_style',
		'admin-preview-callback'=>	'reddish_admin_header_image',
	);
	add_theme_support( 'custom-header', $args );
	add_theme_support( 'custom-background' ); 
	add_editor_style( 'custom-editor-style.css' );

	$reddish_slider_options = array (
		'show_on_front_page'		=> 1,
		'show_on_single_posts'	=> 0,
		'show_on_single_pages'	=> 0,
		'show_on_other_pages'		=> 0,
		'post_checked'					=> 1
	);
}
/* Declaring variables used in JavaScript-code so that text can be translated */
function reddish_variable_js_script() { ?>
	<script type="text/javascript">
		var submitButtontexteng = 'SUBMIT';
		var submitButtontext = '<?php _e( 'SUBMIT','reddish' ); ?>';
		var clearButtontexeng = 'CLEAR';
	 	var clearButtontext = '<?php _e( 'CLEAR', 'reddish' ); ?>';
		var fileNotselected = '<?php _e( 'File is not selected','reddish' ); ?>';
		var fileSelected = '<?php _e( 'File is selected','reddish' ); ?>';
		var chooseFile = '<?php _e( 'Choose file','reddish' ); ?>';
	</script>
<?php }
/**
* Adding CSS and JavaScript files
*/
function reddish_scripts_styles() {
	if ( ! is_admin() ) {
		wp_enqueue_script( 'variables', reddish_variable_js_script() );
		wp_enqueue_script( 'theme_script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ) );
		wp_enqueue_style( 'reddish-style', get_stylesheet_directory_uri(). '/style.css');
	}
}
/* Loading 'comment-reply script' before form */
function reddish_enqueue_comment_reply_script() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
function reddish_ie_rounded_corners() {
	$str = '<style type="text/css">
	.entry_content textarea,
	input[type="text"],
	.navigation li a,
	.navigation li a:hover,
	.navigation li.active a,
	.navigation li.disabled,
	.upload_file, 
	.sel_styled_cont,
	.file_styled_cont,
	.comments-link a,
	a.post-edit-link,
	a.comment-reply-link,
	a.comment-edit-link,
	#cancel-comment-reply-link,
	input[type="reset"],
	input[type="submit"]{
	behavior: url('. get_template_directory_uri(). '/js/pie.htc);} </style>'; 
	echo '<!--[if lt IE 9]>' . $str . '<![endif]-->';
}

/* Display Home page in Pages list in Menu panel*/
function reddish_home_page_menu_args( $args ) {
	$args[ 'show_home' ] = true;
	return $args;
}
function reddish_register_sidebars() {
	/* Register the 'primary' sidebar. */
	register_sidebar( array(
		'id'			=>		'primary',
		'name'			=>		__( 'Primary' , 'reddish' ),
		'description'	=>		__( 'A short description of the sidebar.', 'reddish' ),
		'before_widget'	=>		'<div class="widget">',
		'after_widget'	=>		'</div>',
		'before_title'	=>		'<h4 class="widget-title">',
		'after_title'	=>		'</h4>'
		)
	);
}

/**
* Used as a callback by wp_list_comments() for displaying the comments.
*/
function reddish_comment( $comment, $args, $depth ) {
	$GLOBALS[ 'comment' ] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
			// Display trackbacks differently than normal comments.
			?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<p>
					<?php _e( 'Pingback:', 'reddish' ); comment_author_link();
					edit_comment_link( __( 'Edit', 'reddish' ), '<span class="edit-link">', '</span>' ); ?>
				</p>
			<?php break;
		default :
			// Proceed with normal comments.
			global $post;?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<div id="comment-<?php comment_ID(); ?>" class="comment comment-article">
					<div class="comment-meta comment-author vcard">
						<?php echo get_avatar( $comment, 44 );
						printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'reddish' ) . '</span>' : '' );
						printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'reddish' ), get_comment_date(), get_comment_time() ) ); ?>
					</div><!-- .comment-meta -->
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'reddish' ); ?></p>
					<?php endif; /* '0' == $comment->comment_approved */ ?>
					<div class="comment-content comment">
						<?php comment_text(); ?>
					</div><!-- .comment-content -->
					<?php edit_comment_link( _x( 'Edit', 'comment', 'reddish' ), '<div class="edit-link">', '</div>' ); ?>
					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'reddish' ), 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ] ) ) ); ?>
					</div><!-- .reply -->
				</div><!-- #comment-## -->
			<?php break;
	endswitch; // end comment_type check
}

// Displaying featured image title
function reddish_featured_img_title() {
	global $post;
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnail_image = get_posts( array( 'p' => $thumbnail_id, 'post_type' => 'attachment', 'post_status' => 'any' ) );
	if ( $thumbnail_image && isset( $thumbnail_image[0] ) ) {
		return $thumbnail_image[0]->post_title;
	}
}
// Display breadcrumbs
function reddish_breadcrumbs() {
	echo '<ul id="breadcrumbs">';
	if ( ( ! is_front_page() ) && ( ! is_404() ) ) {/* if it is Front Page 'Home' is not displayed */
		echo '<li><a href="' . esc_url( get_home_url( null, '/' ) ) . '">'; /* link to Front Page */
		echo __( 'Home', 'reddish' );
		echo "</a>&thinsp;&#8211;&thinsp;</li>";
	}/* endif is_front_page() */
	if ( is_single() ) {
		echo '<li>'; the_category( ',&thinsp;</li><li>' );/* display list of categories */
		/* show title differently depending on whether list of categories is displayed  */
		if ( has_category() ) { /* check if the post belongs to any categories */
			echo '</li><li>&thinsp;&#8211;&thinsp;' . get_the_title() . '</li>';
		} else {
			echo '</li><li>' . get_the_title() . '</li>';
		}
		if ( isset( $_GET[ 'page' ] ) && ! empty( $_GET[ 'page' ] ) ) { /* if it is a page of a paginated post */
		
		if ( ! is_front_page() ) { /* if it is not home page add hyphen before 'page'*/
			$symbol_before_page = '&thinsp;&#8211;&thinsp;';
		}
		else {
			$symbol_before_page = '';
		}
		echo '<li>' . $symbol_before_page; _e( 'Page ','reddish' ); echo $_GET[ 'page' ] . '</li>';
	}
	} elseif ( is_category() ) {
		echo'<li>'; printf( __( 'Category Archives:&thinsp;%s', 'reddish' ), single_cat_title( '', false ) ); echo '</li>';
	} elseif ( is_attachment() ) {
		echo '<li>' . get_the_title() . '</li>';
	} elseif ( is_page() ) {
		global $post;
		if( $post->ancestors ) {
			/* reverse order of a parent pages array for the current page */
			$ancestors = array_reverse( $post->ancestors );
			/* display links to parent pages of the current page */
			for( $i = 0; $i < count( $ancestors); $i++ ) {
				if ( 0 == $i ) {
					echo '<li><a href=' . get_permalink( $ancestors[ $i ] ) . '>' . get_the_title( $ancestors[ $i ] ) . '</a></li>';  
				} else {
					echo '<li>&thinsp;&#8211;&thinsp;<a href=' . get_permalink( $ancestors[ $i ] ) . '>' . get_the_title( $ancestors[ $i ] ) . '</a></li>';  
				}
			}
			echo '<li>&thinsp;&#8211;&thinsp;' . get_the_title() . '</li>';  
		} else {
			echo '<li>' . get_the_title() . '</li>';  
		}
	} elseif ( is_tag() ) { /* if it is a tags archive page */
		echo'<li>'; printf( __( 'Tag Archives:&thinsp;%s', 'reddish' ), single_tag_title( '', false ) ); echo '</li>';
	} elseif ( is_day() ) {
		echo'<li>' . __( 'Archive for &thinsp;', 'reddish' ); the_time( 'F jS, Y' ); echo '</li>';
	} elseif ( is_month() ) {
		echo'<li>' . __( 'Archive for &thinsp;', 'reddish' ); the_time( 'F, Y' ); echo '</li>';
	} elseif ( is_year() ) {
		echo'<li>' . __( 'Archive for &thinsp;', 'reddish' ); the_time( 'Y' ); echo '</li>';
	} elseif ( is_author() ) {
		echo'<li>' . __( 'Author&#8217;s Archive', 'reddish' ) . '</li>';
	} elseif ( is_search() ) {
		echo'<li>' . __( 'Search Results', 'reddish' ) . '</li>';
	} elseif ( is_404() ) { 
		echo'<li>' . __( 'Page not found', 'reddish' ) . '</li>';
	}
	if ( isset( $_GET[ 'paged' ] ) && ! empty( $_GET[ 'paged' ] ) ) { /* if it is a page of the post list */
		if ( ! is_front_page() ) { /* if it is not home page add hyphen before 'page'*/
			$symbol_before_page = '&thinsp;&#8211;&thinsp;';
		}
		else {
			$symbol_before_page = '';
		}
		echo '<li>' . $symbol_before_page; _e( 'Page ','reddish' ); echo $_GET[ 'paged' ] . '</li>';
	}
	echo '<li></li></ul>';
}

/* Customize the excerpt lenght*/
function reddish_custom_excerpt_length( $length ) {
	return 20;
}

/* Customizing 'More link' in posts */
function reddish_custom_excerpt_more( $more ) {
	return ' ';
}

/* Customizing the title displayed on browsers' tabs and title bars */
function reddish_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;
	// Add the site name.
	$title .= get_bloginfo( 'name' );
	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_front_page() ) )
		$title = "$title $sep $site_description";
	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'reddish' ), max( $paged, $page ) );
	return $title;
}

/* Change the excerpt lenght and strip it from tags and shortcodes*/
function reddish_get_the_excerpt( $excerpt_word_count = 55 ) {
	global $post;
	$excerpt = $post->post_excerpt;
	if ( '' == $excerpt ) {
		$excerpt = $post->post_content;
		$excerpt = strip_shortcodes( $excerpt );
		$excerpt = str_replace( ']]>', ']]&gt;', $excerpt );
		$excerpt = strip_tags( $excerpt );
	}
	$words = explode( ' ', $excerpt, $excerpt_word_count + 1 );
	if ( count( $words ) > $excerpt_length ) {
		array_pop( $words );
		$excerpt = implode( ' ', $words );
	}
	return $excerpt;
}
/* This function displays bloginfo name in logo block*/
function reddish_display_bloginfo_name() {
		$title = get_bloginfo( 'name' );
		$num = strlen( $title );
		$num = $num/2;
		$first_half = substr( $title,0, $num );
		$second_half = substr( $title, $num );
		echo '<h3 class="logo"><a href="' . esc_url( home_url( '/' ) ) . '">' . $first_half . '<span>' . $second_half . '</span></a></h3>';
}

/* Pagination of posts */
function reddish_numeric_posts_nav() {
	if ( is_singular() )
		return;
	global $wp_query;
	/** Stop execution if there's only 1 page */
	if ( $wp_query->max_num_pages <= 1 )
		return;
	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max = intval( $wp_query->max_num_pages );
	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;
	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}
	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}
	echo '<div class="navigation"><ul>' . "\n";
	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link( __( 'Previous Page', 'reddish' ) ) );
	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
		if ( ! in_array( 2, $links ) )
			echo '<li>&#8230;</li>' . "\n";
	}
	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( ( array ) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}
	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>&#8230;</li>' . "\n";
		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}
	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link( __( 'Next Page', 'reddish' ) ) );
	echo '</ul></div>' . "\n";
}

/* Styles the header image displayed on the Appearance > Header admin panel. */
function reddish_admin_header_style() { ?>
	<style type="text/css">
	.appearance_page_custom-header #custom-header { 
		border: none; 
	} 
	#custom-header {
		position: relative;
	}
	#custom-header h1,
	#custom-header h2 {
		margin: 0;
		padding: 0;
	}
	#custom-header h1 a {
		text-decoration:none;
	}
	#custom-header h1 a:hover {
		color: #21759b;
	}
	#custom-header img {
		max-width: <?php echo get_theme_support( 'custom-header', 'max-width' ); ?>px;
		width: <?php echo get_theme_support( 'custom-header', 'width' ); ?>px;
		height: <?php echo get_theme_support( 'custom-header', 'height' ); ?>px;
	}
	#custom-header h1 a {
		color: #757575;
	}
	
	</style><?php
}

/* Outputs markup for the Custom Header Image and Text */
function reddish_admin_header_image() { ?>
	<div <?php if ( '' == get_header_image() || false == get_header_image() ) { echo "style ='height:100px;'";} ?> id="custom-header"><?php
	$path = get_header_image();
		$style = '';
		if ( ! display_header_text() ) {
				$style = ' style="display:none;';
			} else {
				$style = ' style="color:#' . get_header_textcolor() . ';';
			} ?>
		<h1><a id="name" <?php echo $style. 'position: absolute; top: 18px; left: 15px; font-size: 25px;"' ; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<h2 id="desc"<?php echo $style. 'position: absolute; top: 52px; left:15px; "' ?>><?php bloginfo( 'description' ); ?></h2>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) { ?>
				<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
	<?php }?>
	</div><?php
} 

// Create an options page in Settings area 
function reddish_add_page() {
	add_theme_page( 'Slideshow settings', __( ' Image Slider', 'reddish'), 'manage_options', 'reddish_slider_settings', 'reddish_slider_option_page' );
}
// Register and define the settings 
 function reddish_slider_admin_init() {
	add_settings_section (
		'slider_settings_main',
		'',
		'reddish_slider_section_text',
		'reddish_slider_settings'
	);
	register_setting ( 
		'reddish_slider_options',
		'reddish_slider_options',
		'reddish_slider_validate_options'
	); 
}
// Draw the option page
function reddish_slider_option_page() { 
	global $reddish_slider_options;
	if ( ! isset( $_REQUEST[ 'settings-updated' ] ) )
		$_REQUEST[ 'settings-updated' ] = false; // This checks whether the form has just been submitted. ?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php _e( 'Image slider settings', 'reddish'); ?></h2>
		<?php if ( false !== $_REQUEST[ 'settings-updated' ] ) : ?>
			<div class="updated"><p><strong><?php _e( 'Options saved', 'reddish' ); ?></strong></p></div>
		<?php endif; // If the form has just been submitted, this shows the notification ?>
		<form action="options.php" method="post">
			<?php settings_fields( 'reddish_slider_options' ); /* This function outputs some hidden fields required by the form, including a nonce,
			a unique number used to ensure the form has been submitted from the admin page
			and not somewhere else, very important for security */ ?>
			<?php do_settings_sections( 'reddish_slider_settings' ); 
			$settings = get_option( 'reddish_slider_options', $reddish_slider_options );
			?>
			<table class="form-table">
				<tr valign="top"><th scope="row"><?php _e( 'Front Page', 'reddish' ); ?></th>
					<td>
						<input type="checkbox" id="show_on_front_page" name="reddish_slider_options[show_on_front_page]" value="1" <?php checked( true, $settings[ 'show_on_front_page' ] ); ?> />
						<label for="show_on_front_page"><?php _e( 'Display image slider on the Front Page', 'reddish' ) ?> </label>
					</td>
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'Single Posts', 'reddish' ); ?></th>
					<td>
					<input type="checkbox" id="show_on_single_posts" name="reddish_slider_options[show_on_single_posts]" value="1" <?php checked( true, $settings[ 'show_on_single_posts' ] ); ?> />
					<label for="show_on_single_posts"><?php _e( 'Display image slider on all single Posts', 'reddish' ) ?> </label><br />
					</td>
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'Single Pages', 'reddish' ); ?></th>
					<td>
						<input type="checkbox" id="show_on_single_pages" name="reddish_slider_options[show_on_single_pages]" value="1" <?php checked( true, $settings[ 'show_on_single_pages' ] ); ?> />
						<label for="show_on_single_pages"><?php _e( 'Display image slider on all single Pages', 'reddish' ) ?> </label><br />
					</td>
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'All other types of pages', 'reddish' ); ?></th>
					<td>
						<input type="checkbox" id="show_on_other_pages" name="reddish_slider_options[show_on_other_pages]" value="1" <?php checked( true, $settings[ 'show_on_other_pages' ] ); ?> />
						<label for="show_on_other_pages"><?php _e( 'Display image slider on all other pages (Search result page, Archives, 404 Page Not Found)', 'reddish' ); ?> </label><br />
					</td>
				</tr>
				<tr valign="top"><th scope="row"><?php _e( 'Display slider with checked and unchecked posts(pages)', 'reddish' ); ?></th>
					<td>
						<input type="radio" id="post_checked_one" name="reddish_slider_options[post_checked]" value="1" <?php checked( 1, $settings[ 'post_checked' ] ); ?>/>
						<label for="post_checked_one"><?php _e( 'Do not display image slider with Posts and Pages for which "Do not display Image slider with this post (page)" checkbox is checked', 'reddish' ); ?> </label><br />
						<input type="radio" id="post_checked_two" name="reddish_slider_options[post_checked]" value="2" <?php checked( 2, $settings[ 'post_checked' ] ); ?>/>
						<label for="post_checked_two"><?php _e( 'Display image slider only with Posts and Pages for which "Do not display Image slider with this post (page)" checkbox is checked', 'reddish' ); ?> </label><br />
						<input type="radio" id="post_checked_three" name="reddish_slider_options[post_checked]" value="3" <?php checked( 3, $settings[ 'post_checked' ] ); ?>/>
						<label for="post_checked_three"><?php _e( 'Display image slider with all Posts and Pages(regardless of whether "Do not display Image slider with this post (page)" checkbox is checked)', 'reddish' ); ?> </label><br />
					</td>
				</tr>
			</table>
			<p class="submit"><input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'reddish') ?>" /></p>
		</form>
	</div><?php
}

function reddish_slider_validate_options( $input ) {
	// Check if value has been submitted. If submitted, assign it 1, else assign 0 and return for processing
	$input[ 'show_on_front_page' ] = ( isset( $input[ 'show_on_front_page' ] ) ? 1 : 0 );
	$input[ 'show_on_single_posts' ] = ( isset( $input[ 'show_on_single_posts' ] ) ? 1 : 0 ); 
	$input[ 'show_on_single_pages' ] = ( isset( $input[ 'show_on_single_pages' ] ) ? 1 : 0 ); 
	$input[ 'show_on_other_pages' ] = ( isset( $input[ 'show_on_other_pages' ] ) ? 1 : 0 ); 
	return $input;
}

// display meta box
function reddish_meta_box_add() {
		add_meta_box(
			'reddish_post_meta_checkbox', // id attribute
			__( 'Image Slider', 'reddish' ), // title
			'reddish_meta_box_cb',
			'post', 'side', 'low' // post type, position, priority
		);
		add_meta_box(
			'reddish_post_meta_checkbox', // id attribute
			'Image Slider', // title
			'reddish_meta_box_cb',
			'page', 'side', 'low' // post type, position, priority
		);
}

// callback function for meta box
function reddish_meta_box_cb() { 
	global $post;
	$reddish_post_meta_checkbox = get_post_meta( $post->ID, 'reddish_post_meta_checkbox', true ); // return saved value of meta box
	$reddish_post_meta_checkbox['display_in_slider'] = isset($reddish_post_meta_checkbox['display_in_slider'] )? $reddish_post_meta_checkbox['display_in_slider'] : '';//if the values doesn't exists, use defaults
	$reddish_post_meta_checkbox['slider_with_post'] = isset($reddish_post_meta_checkbox['slider_with_post'] )? $reddish_post_meta_checkbox['slider_with_post'] : '';
	wp_nonce_field( 'reddish_post_meta_checkbox_nonce', 'meta_box_nonce' ); // validation, add nonce field 
	?>
	<p> 
		<input type="checkbox" id="reddish_post_meta_checkbox[display_in_slider]" name="reddish_post_meta_checkbox[display_in_slider]" <?php checked( $reddish_post_meta_checkbox['display_in_slider'], 'show_item' ); ?> />
		<label for="reddish_post_meta_checkbox[display_in_slider]"><?php _e( 'Display this post(page) in Image slider', 'reddish' ); ?> </label>
 	</p>
	<p> 
		<input type="checkbox" id="reddish_post_meta_checkbox[slider_with_post]" name="reddish_post_meta_checkbox[slider_with_post]" <?php checked( $reddish_post_meta_checkbox['slider_with_post'], 'on' ); ?> />
		<label for="reddish_post_meta_checkbox[slider_with_post]"><?php _e( 'Do not display Image slider with this post (page)', 'reddish' ); ?> </label>
 	</p>
	<?php
}

// save meta box data
function reddish_meta_box_save( $post_id ) {
	// Bail if it is an auto save
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	// if nonce is not available or we can't verify it, bail
	if ( ! isset( $_POST[ 'meta_box_nonce' ] ) || ! wp_verify_nonce( $_POST[ 'meta_box_nonce' ], 'reddish_post_meta_checkbox_nonce' ) ) return;
	$reddish_post_meta_checkbox['slider_with_post'] = isset( $_POST[ 'reddish_post_meta_checkbox' ]['slider_with_post'] ) ? 'on' : ''; // check if meta box has been submitted
	$reddish_post_meta_checkbox['display_in_slider'] = isset( $_POST[ 'reddish_post_meta_checkbox' ]['display_in_slider'] ) ? 'show_item' : '';
	update_post_meta( $post_id, 'reddish_post_meta_checkbox', $reddish_post_meta_checkbox );
}

// Draw the section header
function reddish_slider_section_text() {
	echo '<p>'. __( 'You can select checkboxes below to specify where you want to display image slider.
	Edit Page or Edit Post pages include a checkbox "Do not display image slider with this post (page)" that is unchecked by default.
	Below you can specify whether to display image slider depending on the state of this checkbox.', 'reddish' ) . '</p>';
}

/* Displaying text and images on the Image Slider */
function reddish_slider_template() {
	// Query Arguments
	$args = array(
	'post_type' => 'post',
	'posts_per_page' => -1,
	'ignore_sticky_posts'=> 1,
	'meta_query' => array(
								array(
									'key' => 'reddish_post_meta_checkbox',
									'value' => 'show_item',
									'compare' => 'LIKE'
								)
								)
  
	);
	// The Query
	global $wp_query;
	/* save old value of variable wp_query */
	$original_query = $wp_query;
	/*add new variable and change value of variable wp_query*/
	$wp_query = null;
	$wp_query = new WP_Query( $args ); ?>
	<!-- Check if the Query returns any posts -->
	<?php if ( $wp_query->have_posts() ) :?>
		<!-- Start the Slider-->
		<div id="image_slideshow" class="slider">
			<ul class="cycle">
				<?php // The Loop
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
					$post_thumbnail_id = get_post_thumbnail_id(); 
					$alt_text = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
					$image_attributes = wp_get_attachment_image_src( $post_thumbnail_id, 'slider-thumb' );
					$margin_value = $image_attributes[1]/2;?> 
					<li  class="slide">
						<?php /* check if the post has thumbnail and if this thumbnail is available */
						if ( has_post_thumbnail() && false !== $image_attributes ) : ?>
							<img src="<?php echo $image_attributes[0]; ?>" alt="<?php echo $alt_text; ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" <?php  echo 'style="width:' . $image_attributes[1] . 'px; margin-left: -' . $margin_value . 'px;"'; ?>>
							<?php /* the_post_thumbnail( 'slider-thumb' ); */ ?>
							<div class="slider_link"><a href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'reddish' ) ?></a></div>
							<div class="slider_main_text"><?php the_title(); ?></div>
							<div class="slider_text"><?php the_excerpt(); ?></div>
						<?php else : ?>
								<div class='slider-no-image-text'><?php _e( 'Featured image has not been uploaded', 'reddish' ) ?></div>
						<?php endif; ?>
					</li><!-- .slide -->
				<?php endwhile; ?>
			</ul><!-- .cycle -->
			<div id="cycle_pager"></div>
		</div><!-- .slider -->
	<?php endif;
	/* restore the old value of variable wp_query*/
	$wp_query = null;
	$wp_query = $original_query;
	// Reset Post Data
	wp_reset_postdata();
}


add_action( 'after_setup_theme', 'reddish_setup' );
add_action( 'widgets_init', 'reddish_register_sidebars' ); 

add_action( 'wp_head', 'reddish_ie_rounded_corners' );
add_action( 'wp_enqueue_scripts', 'reddish_scripts_styles' );
add_filter( 'wp_title', 'reddish_wp_title', 10, 2 );
add_filter( 'wp_page_menu_args', 'reddish_home_page_menu_args' );
add_filter( 'excerpt_length', 'reddish_custom_excerpt_length', 999 );
add_filter( 'excerpt_more', 'reddish_custom_excerpt_more' );
add_action( 'comment_form_before', 'reddish_enqueue_comment_reply_script' );

add_action( 'admin_init', 'reddish_slider_admin_init' );
add_action( 'admin_menu', 'reddish_add_page' );
add_action( 'add_meta_boxes', 'reddish_meta_box_add' );
add_action( 'edit_attachment', 'reddish_meta_box_save' ); // for saving meta data in attachment
add_action( 'save_post', 'reddish_meta_box_save' );
