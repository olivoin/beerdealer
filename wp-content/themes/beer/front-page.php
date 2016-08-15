<?php get_header(); ?>
<div class="front-slider hide wow fadeIn">
    <div class="wrap hor-wrap">
        <div class="dis-flex align-items-center color-white">
            <div class="col-2-6 front-slider-desc text-block">
                <h3 class="katalog-beer-title">KABINET Brewery</h3>
                <div class="katalog-beer-grade margin-b-20">
                    ipa
                </div>
                <div class="katalog-beed-desc margin-b-20">
                    Самодержавная нападение на жару.
                    Принести цитрусовая свежесть в каждый
                    теплый день и что более важно
                    расслабиться с подогревом ситуация со
                    свежестью Ситра-хоп
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
            <div class="col-4-6 front-slider-image">  
                <img src="http://lyx.se/z/wp-content/uploads/2015/02/SuperNova_BrrKaaa_Citra_light_featured-1050x700.jpg">
            </div>
        </div>
    </div>
</div>
<div class="front-future hide wow fadeIn">
    <div class="wrap hor-wrap">
        <div class="dis-flex justify-content-end">
            <?php
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 1,
                'order_by' => 'date'
                );
            $loop = new WP_Query( $args );
            if ( $loop->have_posts() ) {
            while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <div class="front-future-newest dis-flex col-3-6">
                <span class="onsale">NEW</span>
                <div class="front-future-newest-image col-3-6 padding-r-40">
                    <?php the_post_thumbnail(); ?>
                </div>
                <div class="front-future-newest-desc col-3-6">
                    <h3 class="katalog-beer-title"><?php the_title(); ?></h3>
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
                    <div class="katalog-beed-desc margin-b-20 text-block">
                        <?php the_excerpt(); ?>
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
            <?php endwhile;
            } else {
            echo __( 'No products found' );
            }
            wp_reset_postdata();
            ?>
            <!-- popular products -->
            <?php
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 1,
                'order_by' => 'date'
                );
            $loop = new WP_Query( $args );
            if ( $loop->have_posts() ) {
            while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <div class="front-future-popular col-1-6">
                <span class="onsale">popular</span>
                <div class="katalog-beer-image">
                    <?php the_post_thumbnail(); ?>
                </div>
                <h3 class="katalog-beer-title"><?php the_title(); ?></h3>
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
                <div class="katalog-beer-price">
                    9600 / кег
                </div>
            </div>
            <?php endwhile;
            } else {
            echo __( 'No products found' );
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>
<div class="front-about hide wow fadeIn">
    <div class="wrap hor-wrap">
        <div class="dis-flex justify-content-end">
            <div class="col-3-6">
                <div class="dis-flex align-items-end">
                    <div class="col-2-6"><h2>beer dealer</h2></div>
                    <div class="col-4-6 front-about-desc">ОФИЦИАЛЬНЫЙ ДИСТРИБЬЮТОР КРАФТОВОГО ПИВА В МОСКВЕ.</div>
                </div>
                <div class="dis-flex justify-content-end">
                    <div class="col-2-6"></div>
                    <div class="col-4-6 padding-20">Более 100 сортов эксклюзивного крафтрового пива. Заказать пиво или сидр, а также забронировать готовящиеся варки вы можете на нашем сайте или по телефону – 8 (812) 240-10-40. Доставка по Санкт-Петербургу осуществляется в течении 24 часов, а если Вы хотите получить заказ в другом городе – мы отправим его Вам транспортной компанией!</div>
                </div>
            </div>  
            <div class="col-1-6">
                
            </div>  
        </div> 
    </div>
</div>
<div class="front-sale hide wow fadeIn">
    <div class="wrap hor-wrap"> 
        <div class="dis-flex justify-content-end">
            <div class="col-4-6">
                <div class="section-title dis-flex justify-content-between align-items-center">
                    <h2>sale</h2>
                    <div class="section-more">
                        <a href="#"><img src="<?php bloginfo('template_url'); ?>/assets/images/list-menu.svg" class="svg"> перейти в полный каталог</a>
                    </div>
                </div>                 
                <?php echo do_shortcode('[sale_products per_page="4"]'); ?>
            </div>
        </div>
    </div>
</div>
<div class="front-desc hide wow fadeIn">
    <div class="wrap hor-wrap">
        <div class="dis-flex justify-content-end">
            <div class="col-4-6">
                <div class="section-title">
                    <h2>Крафтовое пиво</h2>
                </div>  
                <div class="section-content text-block">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>