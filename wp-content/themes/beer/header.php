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
<header id="header">
    <div class="wrap hor-wrap">
        <div class="header-logo">
            <a href="/"><img src="<?php bloginfo('template_url'); ?>/assets/images/logo.svg"></a>
        </div>
        <nav class="header-nav">
            <div class="row">
                <div class="float-l margin-r-40">
                    <ul>
                        <li><a href="#">пиво</a></li>
                        <li><a href="#">производители</a></li>
                        <li><a href="#">новости</a></li>
                    </ul>
                </div>
                <div class="float-l margin-l-40">
                    <ul>
                        <li><a href="#">доставка и оплата</a></li>
                        <li><a href="#">контакты</a></li>
                        <li><a href="#">написать нам</a></li>
                    </ul>
                </div>
            </div> 
        </nav>
        <clear></clear>
    </div>
</header>