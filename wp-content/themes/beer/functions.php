<?php
function new_excerpt_length($length) {
	return 50;
}
add_filter('excerpt_length', 'new_excerpt_length');
/* jчищаем wp_head(); */
function remove_recent_comments_style() {  
  global $wp_widget_factory;  
  remove_action( 'wp_head', array( $wp_widget_factory->
widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );  
}  
add_action( 'widgets_init', 'remove_recent_comments_style' );  
remove_action( 'wp_head', 'feed_links_extra', 3 ); 
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );


if(function_exists('register_sidebar'))
	register_sidebar(array('name' => 'Sidebar' )); 
if ( function_exists( 'add_theme_support' ) ) { 
  add_theme_support( 'post-thumbnails' );
}

function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

// woo

add_theme_support( 'woocommerce' );

// single product unhooks
remove_action('woocommerce_after_single_product_summary','woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary','woocommerce_output_related_products', 20);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart', 10);

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


function woocommerce_template_loop_product_thumbnail(){
    $product_link = get_the_permalink();
    $product_img = get_the_post_thumbnail();
    echo '
    
        <div class="col-2 padding-r-10">
            <a href="' . $product_link . '"> ' . $product_img . ' </a>
        </div>
    
          
    ';
}

// Добавляем значение сэкономленных процентов рядом с ценой у товаров
add_filter( 'woocommerce_sale_price_html', 'woocommerce_custom_sales_price', 10, 2 );
    function woocommerce_custom_sales_price( $price, $product ) {
    $percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
    return $price . sprintf( __('<div class="sale-persent">SALE -%s</div>', 'woocommerce' ), $percentage . '%' );
}

// Добавляем атрибуты на единичный товар

add_filter( 'woocommerce_single_product_summary', 'woocommerce_single_attr', 10, 2 );
    function woocommerce_single_attr() {
    $og = get_field('og');
    $abv = get_field('abv');
    $ibu = get_field('ibu');
    $volume = get_field('volume');
    $tara_count = get_field('tara_count');
    echo '
        <div class="attr-name">
            Характеристики:
        </div>
        <ul class="product-single-attr">
            <li><span class="katalog-beer-params-title">OG:</span> ' . $og . '</li>
            <li><span class="katalog-beer-params-title">ABV:</span> ' . $abv . '</li>
            <li><span class="katalog-beer-params-title">IBU:</span> ' . $ibu . '</li>
            <li><span class="katalog-beer-params-title">Объем:</span> ' . $volume . '</li>
            <li><span class="katalog-beer-params-title">Кол-во единиц в таре:</span> ' . $tara_count . '</li>
        </ul>
    ';
}


// custom rub

add_filter( 'woocommerce_currencies', 'add_my_currency' );
function add_my_currency( $currencies ) {
$currencies['ABC'] = __( 'Российский рубль-хуюбль', 'woocommerce' );
return $currencies;
}
add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);
function add_my_currency_symbol( $currency_symbol, $currency ) {
switch( $currency ) {
case 'ABC': $currency_symbol = '<img class="svg" src="http://beerdiller.com/wp-content/themes/beer/assets/images/rub.svg"style="width:11.4px;">'; break;
}
return $currency_symbol;
}   

// dynamic sidebar 

register_sidebar( array(
	'id'          => 'shop-sidebar') );

// styles and scripts connected 

function my_theme_load_resources() {
    
    $theme_uri = get_template_directory_uri();
    
    // style connected
    
    wp_register_style('my-theme-style', $theme_uri.'/assets/css/production_post.css', false, '1.0');
    wp_enqueue_style('my-theme-style');

    // scripts connected

    wp_register_script('my_theme_functions', $theme_uri.'/assets/js/production.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('my_theme_functions'); 
    }
add_action('wp_enqueue_scripts', 'my_theme_load_resources');
?>