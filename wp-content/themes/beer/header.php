<!DOCTYPE html>
<html lang="ru-RU">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/assets/images/favicon.png" type="image/x-icon">
<meta name="Keywords" content="<?php the_field('ключевые_слова'); ?>">
<link href='https://fonts.googleapis.com/css?family=Roboto+Slab|Roboto+Condensed' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header id="header" class="wow hide fadeIn">
    <div class="wrap hor-wrap">
        <div class="header-logo">
            <a href="/"><img src="<?php bloginfo('template_url'); ?>/assets/images/logo.svg"></a>
            <div class="margin-l-20">
                <div class="margin-b-10"><a href="">8 800 345 23 23</a></div>
                <div class="margin-b-10"><a href="">shop@beerdealer.ru</a></div>
            </div>
        </div>
        <div class="header-cart">
            <?php global $woocommerce; ?>
            <a class="cart-contents" href="/cart" title="Посмотреть Вашу корзину">
                <div class="cart-count"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'),$woocommerce->cart->cart_contents_count);?></div>
                <img src="<?php bloginfo('template_url'); ?>/assets/images/cart.svg">
            </a>  
        </div>
        <nav class="header-nav">
            <div class="row">
                <div class="float-l margin-r-40">
                    <?php echo do_shortcode('[widget id="nav_menu-2"]'); ?>
                </div>
                <div class="float-l margin-l-40">
                    <?php echo do_shortcode('[widget id="nav_menu-3"]'); ?>
                </div>
            </div> 
        </nav>
        <clear></clear>
    </div>
</header>