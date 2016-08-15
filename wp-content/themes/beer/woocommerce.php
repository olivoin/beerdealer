<?php get_header(); /* Template Name: Страница Каталог */ ?>
<section class="katalog-page">
    <div class="wrap hor-wrap">
        <div class="dis-flex">
            <aside class="katalog-filter col-2-6">
                <div class="katalog-filter-title">
                    <span class="wow hide fadeInUp">Фильтр</span>
                </div>
                <div class="filter-list wow hide fadeInLeft">
                    <?php dynamic_sidebar('shop-sidebar'); ?>
                </div> 
            </aside>
            <div class="katalog-wrapper col-4-6">
                <?php woocommerce_content(); ?> 
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>