<?php get_header(); /* Template Name: Страница Каталог */ ?>
<section class="katalog-page">
    <div class="wrap hor-wrap">
        <div class="dis-flex">
            <aside class="katalog-filter col-2-6">
                <?php dynamic_sidebar( 'shop-sidebar' ); ?>
            </aside>
            <div class="katalog-wrapper col-4-6">
                <?php woocommerce_content(); ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>