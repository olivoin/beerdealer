<div class="video-block-wrap col col-3 relative post-additionals">
									<div class="relative">
										<a href="<?php the_permalink(); ?>">
											<div class="video-block-info absolute full-width padding-30 text-center color-white middle-parent">
												<div class="middle-children">
													<h1 class="post-title"><?php the_title(); ?></h1>
													<div class="more-button">
														<?php the_excerpt(); ?>
													</div>
												</div>
											</div>
										</a>
										<div class="post-image">
											<?php the_post_thumbnail(array(345,230)); ?>
										</div>
										<div style="display: none;" class="post-content">
											<?php the_content(); ?>
										</div>
									</div>
								</div>