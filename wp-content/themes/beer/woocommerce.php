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
                <?php woocommerce_content(); ?>
            </section>

        </div>
    </div>
</section>
<?php get_footer(); ?>