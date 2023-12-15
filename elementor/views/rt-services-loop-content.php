<div class="<?php echo esc_attr($col_class); ?> card-item <?php echo esc_attr($terms_of_item); ?> mb-4">
    <div class="listing-card">
        <a href="<?php the_permalink(); ?>" class="text-decoration-none listing-thumb-wrapper">
            <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail($thumb_size, ['class' => 'img-fluid mb-10 width-100']);
            } else {
                if (!empty(TripferyTheme::$options['no_preview_image']['id'])) {
                    echo wp_get_attachment_image(TripferyTheme::$options['no_preview_image']['id'], $thumb_size);
                } else {
                    echo '<img class="wp-post-image" src="' . TripferyTheme_Helper::get_img('noimage_442X500.jpg') . '" alt="' . get_the_title() . '">';
                }
            }
            ?>
        </a>
        <div class="listing-card-content">
            <div class="d-flex justify-content-between">
                <div class="badge bage-pink">
                    <svg class="badge-icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.99994 6.71503C6.86151 6.71503 7.55994 6.0166 7.55994 5.15503C7.55994 4.29347 6.86151 3.59503 5.99994 3.59503C5.13838 3.59503 4.43994 4.29347 4.43994 5.15503C4.43994 6.0166 5.13838 6.71503 5.99994 6.71503Z" stroke="currentColor" stroke-opacity="0.99" />
                        <path d="M1.8101 4.24506C2.7951 -0.0849378 9.2101 -0.0799377 10.1901 4.25006C10.7651 6.79006 9.1851 8.94006 7.8001 10.2701C6.7951 11.2401 5.2051 11.2401 4.1951 10.2701C2.8151 8.94006 1.2351 6.78506 1.8101 4.24506Z" stroke="currentColor" stroke-opacity="0.99" />
                    </svg>

                    <?php
                    $address = isset($ba_post['address']) ? $ba_post['address'] : false;
                    if ($address) { ?>
                        <span class="badge-text"><?php echo esc_html($address['address']); ?></span>
                    <?php } ?>


                </div>
                <?php if (class_exists('RTWishlist')) {
                    echo RTWishlist::wishlist_html($post_id);
                } ?>
            </div>
            <h3 class="listing-card-title">
                <a href="<?php the_permalink(); ?>"><?php //echo esc_html($title); 
                                                    ?></a>
            </h3>

            <div class="d-flex align-item listing-card-review-area">
                <div class="listing-card-review-text">Excellent</div>

                <div class="rt-bookoing-rating">
                    <?php echo BABE_Rating::post_stars_rendering(get_the_ID()); ?>
                </div>


                <!-- <div class="d-flex align-items-center rating-stars-area">
							<ul class="rating-stars d-flex">
								<li class="star-item">
								<i class="fa-solid fa-star"></i>
								</li>
								<li class="star-item">
								<i class="fa-solid fa-star"></i>
								</li>
								<li class="star-item">
								<i class="fa-solid fa-star"></i>
								</li>
								<li class="star-item">
								<i class="fa-solid fa-star"></i>
								</li>
								<li class="star-item">
								<i class="fa-solid fa-star"></i>
								</li>
							</ul>
							<div class="number-of-reviews">(3 Reviews)</div>
						</div> -->


            </div>
            <div class="d-flex align-items-center justify-content-between price-area">
                <span class="price-text">$80<span class="price-time">/Night</span></span>
                <a href="<?php the_permalink(); ?>" class="btn-light-sm btn-light-animated">View Availability</a>
            </div>
        </div>
    </div>
</div>