 <!DOCTYPE html>
<head>
	<!-- <meta charset="utf-8" /> -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title ( "|",true, "right" ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/ie7-8.css" type="text/css" media="screen, projection" />
	<![endif]-->
	<?php wp_head(); ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <script src="http://vk.com/js/api/openapi.js" type="text/javascript"></script>
</head>
<body <?php body_class(); ?>>
	<div class="wrapper"><!-- used to keep footer at the bottom of the browser window -->
		<div id ="menu_wrapper">
			<div id="page_top" class="container">
				<a href="#"><img class="main-logo" width="150" src="http://rem-gsm.ru/wp-content/uploads/2016/03/logo-1.jpg"></a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => ' menu site-navigation main-navigation' ) ); ?>
                <div class="page-top-contacts">
                    <i class="fa fa-mobile"></i> +7 (925) 123-23-23
                </div>
				<div class="clear"></div>
			</div><!-- .container-->
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<div class="container"><!-- start tag of the main-content block; end tag is in footer -->