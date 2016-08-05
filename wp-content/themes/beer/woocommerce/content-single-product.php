<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(array('dis-flex','flex-wrap-wrap', 'align-items-start', 'relative')); ?>>

	<?php
		/**
		 * woocommerce_before_single_product_summary hook.
		 * @hooked woocommerce_custom_sales_price - 20
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
         * @hooked woocommerce_custom_sales_price - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary text-block col-2 padding-l-20">
        
		<?php
			/**
			 * woocommerce_single_product_summary hook.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_attr - 20
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
             * @hooked woocommerce_template_single_price - 10
			 */
			do_action( 'woocommerce_single_product_summary' );
		?>
	</div><!-- .summary -->

	<?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->
<div class="katalog-grid">
    <div class="section-title dis-flex justify-content-between align-items-center">
        <h2>Популярное</h2>
    </div>                 
    <div class="dis-flex flex-wrap-wrap">
        <div class="katalog-beer col-4-6">
            <div class="dis-flex">
                <div class="col-2">
                   <img src="http://pivo-artel.ru/userfiles/shop/large/289_penza-beer-originalnoe-stekl.png">
                </div>
                <div class="col-2">
                    <h3 class="katalog-beer-title">KABINET Brewery</h3>
                    <div class="katalog-beer-grade margin-b-20">
                        ipa
                    </div>
                    <div class="katalog-beer-params">
                        <ul>
                            <li><span class="katalog-beer-params-title">производитель:</span> Сербия</li>
                            <li><span class="katalog-beer-params-title">плотность:</span> 12.4%</li>
                            <li><span class="katalog-beer-params-title">алкоголь:</span> 5.4%</li>
                            <li><span class="katalog-beer-params-title">IBU:</span> 54я</li>
                            <li><span class="katalog-beer-params-title">упаковка:</span>  bottle 0.33 l, keg 30 l</li>
                            <li><span class="katalog-beer-params-title">цвет:</span> <div class="beer-color"></div></li>
                        </ul>
                        <div class="katalog-beer-price">
                            <ul>
                                <li><span class="katalog-beer-price-total">120</span> р/бутылка</li>
                                <li><span class="katalog-beer-price-total">200</span> р/бутылка</li>
                                <li><span class="katalog-beer-price-total">6000</span> р/keg 30l</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="katalog-beer col-2-6">
            <div class="dis-flex">
                <div class="col-2">
                   <img src="http://pivo-artel.ru/userfiles/shop/large/289_penza-beer-originalnoe-stekl.png">
                </div>
                <div class="col-2">
                    <h3 class="katalog-beer-title">KABINET Brewery</h3>
                    <div class="katalog-beer-grade margin-b-20">
                        ipa
                    </div>
                    <div class="katalog-beer-params">
                        <ul>
                            <li><span class="katalog-beer-params-title">производитель:</span> Сербия</li>
                            <li><span class="katalog-beer-params-title">плотность:</span> 12.4%</li>
                            <li><span class="katalog-beer-params-title">алкоголь:</span> 5.4%</li>
                            <li><span class="katalog-beer-params-title">IBU:</span> 54я</li>
                            <li><span class="katalog-beer-params-title">упаковка:</span>  bottle 0.33 l, keg 30 l</li>
                            <li><span class="katalog-beer-params-title">цвет:</span> <div class="beer-color"></div></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="katalog-beer col-3-6">
            <div class="dis-flex">
                <div class="col-2">
                   <img src="http://pivo-artel.ru/userfiles/shop/large/289_penza-beer-originalnoe-stekl.png">
                </div>
                <div class="col-2">
                    <h3 class="katalog-beer-title">KABINET Brewery</h3>
                    <div class="katalog-beer-grade margin-b-20">
                        ipa
                    </div>
                    <div class="katalog-beer-params">
                        <ul>
                            <li><span class="katalog-beer-params-title">производитель:</span> Сербия</li>
                            <li><span class="katalog-beer-params-title">плотность:</span> 12.4%</li>
                            <li><span class="katalog-beer-params-title">алкоголь:</span> 5.4%</li>
                            <li><span class="katalog-beer-params-title">IBU:</span> 54я</li>
                            <li><span class="katalog-beer-params-title">упаковка:</span>  bottle 0.33 l, keg 30 l</li>
                            <li><span class="katalog-beer-params-title">цвет:</span> <div class="beer-color"></div></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="katalog-beer col-3-6">
            <div class="dis-flex">
                <div class="col-2">
                   <img src="http://pivo-artel.ru/userfiles/shop/large/289_penza-beer-originalnoe-stekl.png">
                </div>
                <div class="col-2">
                    <h3 class="katalog-beer-title">KABINET Brewery</h3>
                    <div class="katalog-beer-grade margin-b-20">
                        ipa
                    </div>
                    <div class="katalog-beer-params">
                        <ul>
                            <li><span class="katalog-beer-params-title">производитель:</span> Сербия</li>
                            <li><span class="katalog-beer-params-title">плотность:</span> 12.4%</li>
                            <li><span class="katalog-beer-params-title">алкоголь:</span> 5.4%</li>
                            <li><span class="katalog-beer-params-title">IBU:</span> 54я</li>
                            <li><span class="katalog-beer-params-title">упаковка:</span>  bottle 0.33 l, keg 30 l</li>
                            <li><span class="katalog-beer-params-title">цвет:</span> <div class="beer-color"></div></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php do_action( 'woocommerce_after_single_product' ); ?>
