<?php 
/*Plugin Name: wp-custom-login
Plugin URI: none
Description: This plugin supports the tutorial in wptutsplus. It customizes the WordPress login screen.
Version: 1.0
Author: Sergey Shilov
Author URI: http://p-motion.ru/team/ss
License: GPLv2
*/

// add a new logo to the login page
function wptutsplus_login_logo() { ?>
	<style type="text/css">
        body.login.login-action-login {
            background: url(http://beerdealer.ru/wp-content/plugins/wp-login/media/body.jpg) center center no-repeat;
            background-size: cover;
        }
		.login #login h1 a {
            background-image: url(http://beerdealer.ru/wp-content/plugins/wp-login/media/logo.svg);
            background-size: cover;
            width: 200px;
            height: 260px;
		}
		.login #nav a, .login #backtoblog a {
			color: #27adab !important;
		}
		.login #nav a:hover, .login #backtoblog a:hover {
			color: #d228bc !important;
		}
		.login .button-primary {
			background: #27adab; /* Old browsers */
			background: -moz-linear-gradient(top, #27adab 0%, #135655 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#27adab), color-stop(100%,#135655)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top, #27adab 0%,#135655 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top, #27adab 0%,#135655 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(top, #27adab 0%,#135655 100%); /* IE10+ */
			background: linear-gradient(to bottom, #27adab 0%,#135655 100%); /* W3C */
		}
		.login .button-primary:hover {
			background: #85aaaa; /* Old browsers */
			background: -moz-linear-gradient(top, #85aaaa 0%, #208e8c 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#85aaaa), color-stop(100%,#208e8c)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top, #85aaaa 0%,#208e8c 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top, #85aaaa 0%,#208e8c 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(top, #85aaaa 0%,#208e8c 100%); /* IE10+ */
			background: linear-gradient(to bottom, #85aaaa 0%,#208e8c 100%); /* W3C */
		}
        
        .login form {
            -webkit-box-shadow: 0 0px 40px rgb(0, 0, 0) !important;
            box-shadow: 0 0px 40px rgb(0, 0, 0) !important;
        }
        
        .login #nav a {
            color: #fafafa !important;    
        }
        
        .login #backtoblog a:hover {
            color: #fafafa !important;  
            text-decoration: underline !important;
        }
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'wptutsplus_login_logo' );
?>