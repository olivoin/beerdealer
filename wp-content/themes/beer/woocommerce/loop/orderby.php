<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="woocommerce-page-head dis-flex flex-wrap-wrap justify-content-between align-items-center">
    
    <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

        <h1 class="page-title wow hide fadeInUp" data-wow-delay="0.1s"><?php woocommerce_page_title(); ?></h1>

    <?php endif; ?>
    
    <?php global $wp_query;

    if ( ! woocommerce_products_will_display() )
        return;
    ?>
    
    <p class="woocommerce-result-count wow hide fadeInUp" data-wow-delay="0.2s">
        <?php
        $paged    = max( 1, $wp_query->get( 'paged' ) );
        $per_page = $wp_query->get( 'posts_per_page' );
        $total    = $wp_query->found_posts;
        $first    = ( $per_page * $paged ) - $per_page + 1;
        $last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

        if ( $total <= $per_page || -1 === $per_page ) {
            printf( _n( 'Showing the single result', 'Showing all %d results', $total, 'woocommerce' ), $total );
        } else {
            printf( _nx( 'Showing the single result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, '%1$d = first, %2$d = last, %3$d = total', 'woocommerce' ), $first, $last, $total );
        }
        ?>
    </p>

    <form class="woocommerce-ordering wow hide fadeInUp" data-wow-delay="0.3s" method="get">
        <select name="orderby" class="orderby">
            <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
                <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
            <?php endforeach; ?>
        </select>
        <?php
            // Keep query string vars intact
            foreach ( $_GET as $key => $val ) {
                if ( 'orderby' === $key || 'submit' === $key ) {
                    continue;
                }
                if ( is_array( $val ) ) {
                    foreach( $val as $innerVal ) {
                        echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
                    }
                } else {
                    echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
                }
            }
        ?>
    </form>
</div>