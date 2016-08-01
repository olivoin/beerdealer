<?php
/**
* The template for displaying 404 pages (Not Found).
*
*/
get_header(); ?>
	<div id="content">
		<?php get_template_part( 'no-results', 'index' ); ?>
	</div><!--content-->
<?php get_sidebar();
get_footer();