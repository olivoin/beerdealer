<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div <?php post_class(array('katalog-beer', 'col-3-6','hide','wow','fadeIn')); ?>>
    <div class="dis-flex flex-wrap-wrap">
        <?php 
        /**
         * woocommerce_before_shop_loop_item_title hook.
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         */
        do_action( 'woocommerce_before_shop_loop_item_title' );
        ?>

        <div class="col-2 padding-l-10">

        <?php 
        /**
         * woocommerce_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_product_title - 10
         */
        do_action( 'woocommerce_shop_loop_item_title' );
            
        ?>
            
             
        <div class="katalog-beer-grade margin-b-20">
            <?php
               $terms = get_the_terms( $post->ID, 'pa_sort' );
               if ( $terms && ! is_wp_error( $terms ) ) { 
                  foreach ( $terms as $term ) {
                     echo " $term->name ";
                  }
               } 
               else {echo " ";}
            ?>
        </div>
            
        <?php 
        /**
         * woocommerce_after_shop_loop_item_title hook.
         *
         * @hooked woocommerce_template_loop_price - 10
         */
        do_action( 'woocommerce_after_shop_loop_item_title' );

        /**
         * woocommerce_after_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_product_link_close - 5
         * @hooked woocommerce_template_loop_add_to_cart - 10
         */
    
            
        do_action( 'woocommerce_after_shop_loop_item' );
        ?>
            
            
            <ul>
                <li><span class="katalog-beer-params-title">OG:</span> <?php the_field('og'); ?></li>
                <li><span class="katalog-beer-params-title">ABV:</span> <?php the_field('abv'); ?></li>
                <li><span class="katalog-beer-params-title">IBU:</span> <?php the_field('ibu'); ?></li>
                <li><span class="katalog-beer-params-title">Объем:</span> <?php the_field('volume'); ?></li>
                <li><span class="katalog-beer-params-title">Кол-во единиц в таре:</span> <?php the_field('tara_count'); ?></li>
            </ul>
            
        </div>
    </div>
</div>
