<?php get_header(); /* Template Name: Страница Каталог */ ?>
<section class="katalog-page">
    <div class="wrap hor-wrap">
        <div class="dis-flex">
            <aside class="katalog-filter col-2-6">
                <?php if (is_page_template('woocommerce.php')) { ?>
                <h2 class="katalog-filter-title">
                    Фильтры
                </h2>
                <?php }else { ?>
                <?php } ?>
                <div class="filter-list">
                    <?php dynamic_sidebar( 'shop-sidebar' ); ?>
                </div> 
            </aside>
            <div class="katalog-wrapper col-4-6">
                <?php woocommerce_content(); ?> 
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>