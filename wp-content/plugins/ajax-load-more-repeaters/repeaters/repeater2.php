<div class="video-block-wrap col col-4 relative post-additionals">
									<div class="relative">
										<a href="<?php the_permalink(); ?>"><div class="video-block-info absolute full-height full-width padding-30 text-center color-white">
											<h1 class="post-title"><?php the_title(); ?></h1>
											<div class="more-button">
												Подробнее.
											</div>
										</div></a>
										<div class="post-image">
											<?php the_post_thumbnail(); ?>
										</div>
										<div style="display: none;" class="post-content">
											<?php the_content(); ?>
										</div>
									</div>
								</div>