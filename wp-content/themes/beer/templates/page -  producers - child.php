<?php get_header() ; /* Template Name: Страница Производители дочерняя*/ ?>
<div class="page-producters wrap hor-wrap wow hide fadeIn">
    <div class="dis-flex justify-content-end flex-wrap-wrap">
        <article class="producter dis-flex col-4-6">
            <div class="producter-image">
                <?php the_post_thumbnail(array(300,300)); ?>
            </div>
            <div class="dis-flex justify-content-end flex-wrap-wrap">
                <div class="col-4-6 producter-desc text-block padding-r-30">
                    <h1 class="katalog-beer-title"><?php the_title(); ?></h1>
                    <div class="text-block">
                        <?php the_content(); ?>
                    </div>
                    
                </div>
                <div class="col-2-6 producter-goods text-block padding-l-30">
                    <ul>
                        <li>
                            <div class="producter-goods-title">
                                Страна
                            </div>
                            <div class="producter-goods-sort"><?php the_field('страна'); ?></div>
                        </li>
                        <li>
                            <div class="producter-goods-title">
                                Год основания
                            </div>
                            <div class="producter-goods-sort"><?php the_field('год_основания'); ?></div>
                        </li>
                        <li>
                            <div class="producter-goods-title">
                                Директор
                            </div>
                            <div class="producter-goods-sort"><?php the_field('директор'); ?></div>
                        </li>
                    </ul>
                </div>
            </div>
        </article>
    </div>
    <div class="producter-beer-list">
        <div class="katalog-grid">
            <?php echo do_shortcode('[product_attribute attribute="pivovarnja" filter="kabinet"]'); ?>
        </div>
    </div>
</div>
     
<?php get_footer(); ?>