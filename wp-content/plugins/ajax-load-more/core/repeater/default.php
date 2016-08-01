<?php
                  $paged = (get_query_var('page')) ? get_query_var('page') : 1;
                  $args = array(
                    'post_type'         =>  'product',
                    'posts_per_page'    =>  12,
                    'paged'             =>  $paged,
                  ); 
                  $my_query = new WP_Query( $args );
                  while( $my_query->have_posts() ) :
                       $my_query->the_post();
                ?>
                <?php
                    global $woocommerce;
                    $currency = get_woocommerce_currency_symbol();
                    $price = get_post_meta( get_the_ID(), '_regular_price', true);
                    $sale = get_post_meta( get_the_ID(), '_sale_price', true);
                ?>
                <div class="katalog-beer col-3-6">
                    <div class="dis-flex">
                        <div class="col-2 padding-r-10">
                           <?php the_post_thumbnail(); ?>
                        </div>
                        <div class="col-2 padding-l-10">
                            <h3 class="katalog-beer-title"><?php the_title(); ?></h3>
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
                                            <span class="katalog-beer-price-total">
                                                <?php echo $currency; echo $price; ?>
                                                <?php echo $currency; echo $sale; ?>
                                            </span><img src="<?php bloginfo('template_url'); ?>/assets/images/rub.svg" style="width:11.4px;">/бутылка
                                        </li>
                                        <?php elseif($price) : ?>
                                        <li>
                                            <span class="katalog-beer-price-total">
                                                <?php echo $currency; echo $price; ?>
                                            </span><img src="<?php bloginfo('template_url'); ?>/assets/images/rub.svg"style="width:11.4px;">/бутылка
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>