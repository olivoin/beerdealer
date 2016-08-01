<?php get_header(); /* Template Name: Страница Каталог */ ?>
<section class="katalog-page">
    <div class="wrap hor-wrap">
        <div class="dis-flex">
            <aside class="katalog-filter col-2-6">
                <?php echo do_shortcode('[widget id="woocommerce_price_filter-2"]'); ?>
                <?php echo do_shortcode('[widget id="yith-woo-ajax-navigation-2"]'); ?>
                <?php echo do_shortcode('[widget id="yith-woo-ajax-navigation-3"]'); ?>
                <?php echo do_shortcode('[widget id="yith-woo-ajax-reset-navigation-2"]'); ?>
            </aside>
            <section class="katalog-grid col-4-6 dis-flex flex-wrap-wrap">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 12
                    );
                $loop = new WP_Query( $args );
                if ( $loop->have_posts() ) {
                    while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    <div class="katalog-beer col-3-6">
                        <div class="dis-flex">
                            <div class="col-2 padding-r-10">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                            </div>
                            <div class="col-2 padding-l-10">
                                <h3 class="katalog-beer-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
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
                                            <?php if($sale) : ?>
                                            <li>
                                                <span class="katalog-beer-price-sale">
                                                    <?php echo $currency; echo $price; ?>
                                                    <?php echo $currency; echo $sale; ?>
                                                </span><img src="<?php bloginfo('template_url'); ?>/assets/images/rub.svg" style="width:11.4px;">/бутылка
                                            </li>
                                            <?php elseif($price) : ?>
                                            <li>
                                                <span class="katalog-beer-price-total">
                                                    <?php echo $currency; echo $price; ?>
                                                </span><img class="svg" src="<?php bloginfo('template_url'); ?>/assets/images/rub.svg"style="width:11.4px;">/бутылка
                                            </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <?php endwhile;
                    } else {
                    echo __( 'No products found' );
                    }
                    wp_reset_postdata();
                    ?>
            </section>

        </div>
    </div>
</section>
<?php get_footer(); ?>