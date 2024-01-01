<?php

use Rtrs\Models\Review;
use Rtrs\Helpers\Functions;

if (class_exists('BABE_Functions')) { ?>
	<div class="rt-case-isotope case-multi-isotope-1 rt-isotope-wrapper">
		<?php if ($data['cat_display'] == 'yes') { ?>
			<div class="row justify-content-center">
				<div class="col-auto">
					<div class="listing-filter-btns d-flex align-items-center justify-content-center flex-wrap">
						<?php
						if (!empty($data['tab_items'])) {
							foreach ($data['tab_items'] as $cat) {
								$cats = explode(',', $cat['sec_cat']);
								$terms = get_terms(array(
									'taxonomy' => 'categories',
									'include'  => $cats,
									'orderby' => 'include',
								));
								$name_list = $terms[0]; ?>
								<button data-filter=".<?php echo esc_attr($name_list->slug); ?>" class="filter-btn <?php echo esc_attr($name_list->slug); ?>">
									<i class="<?php echo esc_attr($cat['cat_icon']); ?>"></i>
									<?php echo $name_list->name; ?>
								</button>
						<?php }
							echo "<div class='rt-color-track'></div>";
						} ?>

					</div>
				</div>
			</div>
		<?php } ?>
		<div class="row justify-content-center cardContainer">
			<?php
			if (!empty($data['tab_items'])) {
				foreach ($data['tab_items'] as $cat) {
					$cats = explode(',', $cat['sec_cat']);
					$terms = get_terms(array(
						'taxonomy' => 'categories',
						'include'  => $cats,
						'orderby' => 'include',
					));
					$name_list = $terms[0];
					$thumb_size = 'tripfery-size3';
					$number_of_post = $data['itemnumber'];
					$post_orderby = $data['post_orderby'];
					$post_order = $data['post_order'];
					$p_ids = array();
					foreach ($data['posts_not_in'] as $p_idsn) {
						$p_ids[] = $p_idsn['post_not_in'];
					}
					$args = array(
						'post_type'            => 'to_book',
						'posts_per_page'     => $number_of_post,
						'order'             => $post_order,
						'orderby'             => $post_orderby,
						'post__not_in'       => $p_ids,
					);
					if (!empty($cats)) {
						$args['tax_query'] = [
							[
								'taxonomy' => 'categories',
								'field' => 'term_id',
								'terms' => $cats,
							],
						];
					}
					$post_in = [];
					$query = new WP_Query($args);
					if ($query->have_posts()) :
						while ($query->have_posts()) : $query->the_post();
							$post_in[] = get_the_ID();
						endwhile;
					endif;
					unset($args['tax_query']);
					$args['post__in'] = $post_in;

					$posts = BABE_Post_types::get_posts($args);
					$col_class = "col-xl-{$data['col_lg']} col-lg-{$data['col_md']} col-md-{$data['col_sm']} col-sm-{$data['col_xs']}";

					foreach ($posts as $post) {
						$post_id 	= $post['ID'];
						$ba_info 	= BABE_Post_types::get_post($post_id);
						$thumbnail = apply_filters('babe_search_result_img_thumbnail', 'full');
						$item_url = BABE_Functions::get_page_url_with_args($post['ID'], $_GET);
						$image_srcs = wp_get_attachment_image_src(get_post_thumbnail_id($post['ID']), $thumbnail);
						$image = $image_srcs ? '<a class="text-decoration-none listing-thumb-wrapper" href="' . $item_url . '">
						<img class="text-decoration-none listing-thumb-wrapper" src="' . $image_srcs[0] . '">
						</a>' : '';
						$gea_text = get_post_meta($post_id, 'tripfery_gea_text', true);
						$guide_id = get_post_meta($post['ID'], 'booking_guided', true);
						$featured_text = get_post_meta($post['ID'], 'tripfery_featured_check', true);
						if ($guide_id) {
							$guided_title = get_the_title($guide_id);
							$guided_link = get_the_permalink($guide_id);
							$post_thumbnail_url = get_the_post_thumbnail_url($guide_id, 'full');
						}
						$group_max_size = $ba_info['guests'];
						$url   		= BABE_Functions::get_page_url_with_args($post_id, $_GET);
						$item_terms = get_the_terms($post_id, 'categories');
						$discount = $post['discount'] ? '<div class="item_info_price_discount">-' . $post['discount'] . '% Off</div>' : '';
						$price_from_with_taxes = ($post['price_from'] * (100 + $post['categories_add_taxes'] * $post['categories_tax'])) / 100;
						$price_old = $post['discount_price_from'] < $price_from_with_taxes ? '<span class="item_info_price_old">' . BABE_Currency::get_currency_price($price_from_with_taxes) . '</span>' : '';
						'';
						if (!empty($post['discount_price_from'])) {
							$item_info_price =
								'' . $price_old . '
							<span class="price-text item_info_price_new">' . BABE_Currency::get_currency_price($post['discount_price_from']) . '</span>';
						} ?>

						<!--  Car Style	-->
						<?php if ($cat['sec_style'] == 'style2') { ?>
							<div class="rt_booking_<?php echo esc_attr($cat['sec_style']); ?> <?php echo esc_attr($col_class); ?> card-item <?php echo esc_attr($name_list->slug); ?> mb-4 rt-car-style">
								<div class="listing-card">
									<div class="top-title">
										<h3 class="listing-card-title">
											<a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
										</h3>
										<div class="d-flex justify-content-between">
											<?php $address = isset($ba_info['address']) ? $ba_info['address'] : false;
											if ($address) {
											?>
												<div class="badge2 bage-pink">
													<span class="badge-text"><?php echo esc_html($address['address']); ?></span>
												</div>
											<?php } ?>
											<?php if (class_exists('RTWishlist')) {
												echo RTWishlist::wishlist_html($post_id);
											} ?>
										</div>
									</div>
									<?php if (!empty($image_srcs)) { ?>
										<a class="<?php if (!empty($discount)) {
														echo 'discount_available ';
													} ?> text-decoration-none listing-thumb-wrapper" href="<?php echo esc_url($item_url); ?>">
											<img src="<?php echo esc_attr($image_srcs[0]); ?>" alt="featured-image" />
											<?php echo wp_kses_post($discount); ?>

											<?php if ('on' == $featured_text) { ?>
												<div class="feature-text"><?php echo wp_kses_post('Featured', 'tripfery') ?></div>
											<?php } ?>
										</a>
									<?php } ?>
									<div class="listing-card-content">
										<div class="d-flex align-items-center justify-content-between price-area">
											<div class="card-bottom-info-left d-flex">
												<?php if ($group_max_size) { ?>
													<span class="car-seat">
														<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M7.63314 9.05857C7.5498 9.05023 7.4498 9.05023 7.35814 9.05857C5.3748 8.9919 3.7998 7.3669 3.7998 5.3669C3.7998 3.32523 5.4498 1.6669 7.4998 1.6669C9.54147 1.6669 11.1998 3.32523 11.1998 5.3669C11.1915 7.3669 9.61647 8.9919 7.63314 9.05857Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M13.6747 3.3331C15.2914 3.3331 16.5914 4.64143 16.5914 6.24977C16.5914 7.82477 15.3414 9.1081 13.7831 9.16644C13.7164 9.1581 13.6414 9.1581 13.5664 9.16644" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M3.4666 12.1331C1.44993 13.4831 1.44993 15.6831 3.4666 17.0248C5.75827 18.5581 9.5166 18.5581 11.8083 17.0248C13.8249 15.6748 13.8249 13.4748 11.8083 12.1331C9.52493 10.6081 5.7666 10.6081 3.4666 12.1331Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M15.2832 16.6669C15.8832 16.5419 16.4499 16.3002 16.9165 15.9419C18.2165 14.9669 18.2165 13.3586 16.9165 12.3836C16.4582 12.0336 15.8999 11.8002 15.3082 11.6669" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
														</svg>
														<span class="valu"><?php echo esc_attr($group_max_size); ?></span>
													</span>
												<?php } ?>
												<?php if (!empty($gea_text)) { ?>
													<span class="manual">
														<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M16.6667 11.6667C17.5871 11.6667 18.3333 10.9205 18.3333 10C18.3333 9.07952 17.5871 8.33333 16.6667 8.33333C15.7462 8.33333 15 9.07952 15 10C15 10.9205 15.7462 11.6667 16.6667 11.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M16.6667 5C17.5871 5 18.3333 4.25381 18.3333 3.33333C18.3333 2.41286 17.5871 1.66667 16.6667 1.66667C15.7462 1.66667 15 2.41286 15 3.33333C15 4.25381 15.7462 5 16.6667 5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M16.6667 18.3333C17.5871 18.3333 18.3333 17.5871 18.3333 16.6667C18.3333 15.7462 17.5871 15 16.6667 15C15.7462 15 15 15.7462 15 16.6667C15 17.5871 15.7462 18.3333 16.6667 18.3333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M3.33366 11.6667C4.25413 11.6667 5.00033 10.9205 5.00033 10C5.00033 9.07952 4.25413 8.33333 3.33366 8.33333C2.41318 8.33333 1.66699 9.07952 1.66699 10C1.66699 10.9205 2.41318 11.6667 3.33366 11.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M5 10H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M15.0003 3.33333H11.667C10.0003 3.33333 9.16699 4.16667 9.16699 5.83333V14.1667C9.16699 15.8333 10.0003 16.6667 11.667 16.6667H15.0003" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
														</svg>
														<span class="valu"><?php echo wp_kses_post($gea_text); ?></span>
													</span>
												<?php } ?>
											</div>
											<?php if ($data['price_display'] == 'yes') { ?>
												<div class="rt-price">
													<?php echo wp_kses_post($item_info_price); ?><?php if (!empty($cat['activity_text'])) { ?><span class="activity-person"><?php echo $cat['activity_text'] ?></span>
													<?php } ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<!-- Tour Style -->
						<?php } elseif ($cat['sec_style'] == 'style3') { ?>
							<div class="rt_booking_<?php echo esc_attr($cat['sec_style']); ?> <?php echo esc_attr($col_class); ?> card-item <?php echo esc_attr($name_list->slug); ?> mb-4">
								<div class="listing-card">
									<?php
									if (!empty($image_srcs)) { ?>
										<a class="<?php if (!empty($discount)) {
														echo 'discount_available ';
													} ?>text-decoration-none listing-thumb-wrapper" href="<?php echo esc_url($item_url); ?>">
											<img src="<?php echo esc_attr($image_srcs[0]); ?>" alt="featured-image" />
											<?php echo wp_kses_post($discount); ?>
											<?php if ('on' == $featured_text) { ?>
												<div class="feature-text"><?php echo wp_kses_post('Featured', 'tripfery') ?></div>
											<?php } ?>
										</a>
									<?php } ?>

									<div class="listing-card-content">
										<div class="d-flex justify-content-between">
											<?php $address = isset($ba_info['address']) ? $ba_info['address'] : false;
											if ($address) {
											?>
												<div class="badge bage-pink">
													<svg class="badge-icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M5.99994 6.71503C6.86151 6.71503 7.55994 6.0166 7.55994 5.15503C7.55994 4.29347 6.86151 3.59503 5.99994 3.59503C5.13838 3.59503 4.43994 4.29347 4.43994 5.15503C4.43994 6.0166 5.13838 6.71503 5.99994 6.71503Z" stroke="currentColor" stroke-opacity="0.99" />
														<path d="M1.8101 4.24506C2.7951 -0.0849378 9.2101 -0.0799377 10.1901 4.25006C10.7651 6.79006 9.1851 8.94006 7.8001 10.2701C6.7951 11.2401 5.2051 11.2401 4.1951 10.2701C2.8151 8.94006 1.2351 6.78506 1.8101 4.24506Z" stroke="currentColor" stroke-opacity="0.99" />
													</svg>
													<span class="badge-text"><?php echo esc_html($address['address']); ?></span>
												</div>
											<?php } ?>
											<?php if (class_exists('RTWishlist')) {
												echo RTWishlist::wishlist_html($post_id);
											} ?>
										</div>

										<h3 class="listing-card-title">
											<a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
										</h3>

										<div class="d-flex justify-content-between tour-info-middle">
											<?php if ($data['price_display'] == 'yes') { ?>
												<div class="d-flex flex-column">
													<span class="text-gray"><?php echo esc_html('Start from', 'tripfery-core') ?></span>
													<div class="rt-price">
														<?php echo wp_kses_post($item_info_price); ?>
														<?php if (!empty($cat['activity_text'])) { ?>
															<span class="activity-person"><?php echo $cat['activity_text'] ?>
															</span>
														<?php } ?>
													</div>
												</div>
											<?php } ?>

											<?php if ($guide_id) { ?>
												<div class="d-flex flex-column">
													<span class="text-gray"><?php echo esc_html('Guided By', 'tripfery-core') ?></span>
													<div class="d-flex align-items-center">
														<?php if (!empty($post_thumbnail_url)) { ?>
															<div>
																<img src="<?php echo esc_html($post_thumbnail_url); ?>" class="author-avatar" alt="People">
															</div>
														<?php } ?>

														<h4><a href="<?php echo esc_url($guided_link); ?>" class="author-name"><?php echo esc_html($guided_title); ?></a></h4>

													</div>
												</div>
											<?php } ?>
										</div>
										<?php if ($data['rating_display'] == 'yes' && class_exists(Review::class) && $avg_rating = Review::getAvgRatings($post_id)) { ?>
											<div class="d-flex align-item listing-card-review-area">
												<div class="listing-card-review-text">
													<?php echo esc_html('Excellent', 'tripfery-core') ?>
												</div>
												<div class="rtrs-rating-item">
													<div class="rating-icon">
														<?php echo Functions::review_stars($avg_rating); ?>
														<span class="rating-percent">
															(<?php $total_rating = Review::getTotalRatings($post_id);
																printf(
																	esc_html(_n('%s Review', '%s Reviews', $total_rating, 'revieweb')),
																	esc_html($total_rating)
																); ?>)
														</span>
													</div>
												</div>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>

							<!-- Activity Style	 -->
						<?php } elseif ($cat['sec_style'] == 'style4') { ?>
							<div class="rt_booking_<?php echo esc_attr($cat['sec_style']); ?> <?php echo esc_attr($col_class); ?> card-item <?php echo esc_attr($name_list->slug); ?> mb-4">
								<div class="listing-card">
									<?php
									if (!empty($image_srcs)) { ?>
										<a class="<?php if (!empty($discount)) {
														echo 'discount_available ';
													} ?> text-decoration-none listing-thumb-wrapper" href="<?php echo esc_url($item_url); ?>">
											<img src="<?php echo esc_attr($image_srcs[0]); ?>" alt="featured-image" />
											<?php echo wp_kses_post($discount); ?>
											<?php if ($data['rating_display'] == 'yes' && class_exists(Review::class)) {
												echo '<span class="booking-top-rating">';
												echo '<i class="fa-solid fa-star"></i>';
												if ($avg_rating = Review::getAvgRatings(get_the_ID())) {
													echo esc_html($avg_rating);
												}
												echo '</span>';
											} ?>
											<?php if ('on' == $featured_text) { ?>
												<div class="feature-text"><?php echo wp_kses_post('Featured', 'tripfery') ?></div>
											<?php } ?>
										</a>
									<?php } ?>

									<div class="listing-card-content">
										<h3 class="listing-card-title mt-0 mb-2">
											<a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
										</h3>
										<div class="d-flex justify-content-between">
											<?php $address = isset($ba_info['address']) ? $ba_info['address'] : false;
											if ($address) {
											?>
												<div class="badge2 bage-pink">
													<svg class="badge-icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M5.99994 6.71503C6.86151 6.71503 7.55994 6.0166 7.55994 5.15503C7.55994 4.29347 6.86151 3.59503 5.99994 3.59503C5.13838 3.59503 4.43994 4.29347 4.43994 5.15503C4.43994 6.0166 5.13838 6.71503 5.99994 6.71503Z" stroke="currentColor" stroke-opacity="0.99" />
														<path d="M1.8101 4.24506C2.7951 -0.0849378 9.2101 -0.0799377 10.1901 4.25006C10.7651 6.79006 9.1851 8.94006 7.8001 10.2701C6.7951 11.2401 5.2051 11.2401 4.1951 10.2701C2.8151 8.94006 1.2351 6.78506 1.8101 4.24506Z" stroke="currentColor" stroke-opacity="0.99" />
													</svg>
													<span class="badge-text"><?php echo esc_html($address['address']); ?></span>
												</div>
											<?php } ?>
											<?php if (class_exists('RTWishlist')) {
												echo RTWishlist::wishlist_html($post_id);
											} ?>
										</div>
										<div class="d-flex align-items-center justify-content-between price-area">
											<?php if ($data['price_display'] == 'yes') { ?>
												<div class="rt-price">
													<?php echo wp_kses_post($item_info_price); ?><?php if (!empty($cat['activity_text'])) { ?><span class="activity-person"><?php echo $cat['activity_text'] ?>
														</span>
													<?php } ?>
												</div>
											<?php } ?>
											<?php if ($data['button_display'] == 'yes') { ?>
												<a href="<?php echo esc_url($url); ?>" class="btn-light-sm btn-light-animated">
													<?php echo esc_html($cat['button_text']) ?>
												</a>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>

							<!-- Rental Style	 -->
						<?php } elseif ($cat['sec_style'] == 'style5') { ?>
							<div class="rt_booking_<?php echo esc_attr($cat['sec_style']); ?> <?php echo esc_attr($col_class); ?> card-item <?php echo esc_attr($name_list->slug); ?> mb-4">
								<div class="listing-card">
									<?php
									if (!empty($image_srcs)) { ?>
										<a class="<?php if (!empty($discount)) {
														echo 'discount_available ';
													} ?>text-decoration-none listing-thumb-wrapper" href="<?php echo esc_url($item_url); ?>">
											<img src="<?php echo esc_attr($image_srcs[0]); ?>" alt="featured-image" />
											<?php echo wp_kses_post($discount); ?>
											<?php if (class_exists('RTWishlist')) {
												echo RTWishlist::wishlist_html($post_id);
											} ?>
											<?php if ('on' == $featured_text) { ?>
												<div class="feature-text"><?php echo wp_kses_post('Featured', 'tripfery') ?></div>
											<?php } ?>
										</a>
									<?php } ?>

									<div class="listing-card-content">
										<h3 class="listing-card-title">
											<a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
										</h3>

										<div class="d-flex justify-content-between">
											<?php $address = isset($ba_info['address']) ? $ba_info['address'] : false;
											if ($address) {	?>
												<div class="badge2 bage-pink">
													<svg class="badge-icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M5.99994 6.71503C6.86151 6.71503 7.55994 6.0166 7.55994 5.15503C7.55994 4.29347 6.86151 3.59503 5.99994 3.59503C5.13838 3.59503 4.43994 4.29347 4.43994 5.15503C4.43994 6.0166 5.13838 6.71503 5.99994 6.71503Z" stroke="currentColor" stroke-opacity="0.99" />
														<path d="M1.8101 4.24506C2.7951 -0.0849378 9.2101 -0.0799377 10.1901 4.25006C10.7651 6.79006 9.1851 8.94006 7.8001 10.2701C6.7951 11.2401 5.2051 11.2401 4.1951 10.2701C2.8151 8.94006 1.2351 6.78506 1.8101 4.24506Z" stroke="currentColor" stroke-opacity="0.99" />
													</svg>
													<span class="badge-text"><?php echo esc_html($address['address']); ?></span>
												</div>
											<?php } ?>
										</div>

										<div class="d-flex align-items-center justify-content-between price-area">
											<?php if ($data['price_display'] == 'yes') { ?>
												<div class="rt-price">
													<?php echo wp_kses_post($item_info_price); ?>
													<?php if (!empty($cat['activity_text'])) { ?>
														<span class="activity-person"><?php echo $cat['activity_text'] ?>
														</span>
													<?php } ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<!-- Restaurants Style	 -->
						<?php } elseif ($cat['sec_style'] == 'style6') { ?>
							<div class="rt_booking_<?php echo esc_attr($cat['sec_style']); ?> <?php echo esc_attr($col_class); ?> card-item <?php echo esc_attr($name_list->slug); ?> mb-4">
								<div class="listing-card">
									<?php
									if (!empty($image_srcs)) { ?>
										<a class="<?php if (!empty($discount)) {
														echo 'discount_available ';
													} ?>text-decoration-none listing-thumb-wrapper" href="<?php echo esc_url($item_url); ?>">
											<img src="<?php echo esc_attr($image_srcs[0]); ?>" alt="featured-image" />
											<?php echo wp_kses_post($discount); ?>
											<?php if ('on' == $featured_text) { ?>
												<div class="feature-text"><?php echo wp_kses_post('Featured', 'tripfery') ?></div>
											<?php } ?>
										</a>
									<?php } ?>

									<div class="listing-card-content">
										<div class="d-flex justify-content-between">
											<?php $address = isset($ba_info['address']) ? $ba_info['address'] : false;
											if ($address) {
											?>
												<div class="badge bage-pink">
													<svg class="badge-icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M5.99994 6.71503C6.86151 6.71503 7.55994 6.0166 7.55994 5.15503C7.55994 4.29347 6.86151 3.59503 5.99994 3.59503C5.13838 3.59503 4.43994 4.29347 4.43994 5.15503C4.43994 6.0166 5.13838 6.71503 5.99994 6.71503Z" stroke="currentColor" stroke-opacity="0.99" />
														<path d="M1.8101 4.24506C2.7951 -0.0849378 9.2101 -0.0799377 10.1901 4.25006C10.7651 6.79006 9.1851 8.94006 7.8001 10.2701C6.7951 11.2401 5.2051 11.2401 4.1951 10.2701C2.8151 8.94006 1.2351 6.78506 1.8101 4.24506Z" stroke="currentColor" stroke-opacity="0.99" />
													</svg>
													<span class="badge-text"><?php echo esc_html($address['address']); ?></span>
												</div>
											<?php } ?>
											<?php if (class_exists('RTWishlist')) {
												echo RTWishlist::wishlist_html($post_id);
											} ?>
										</div>

										<h3 class="listing-card-title">
											<a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
										</h3>

										<?php if ($data['rating_display'] == 'yes' && class_exists(Review::class) && $avg_rating = Review::getAvgRatings($post_id)) { ?>
											<div class="d-flex align-item listing-card-review-area">
												<div class="listing-card-review-text"><?php echo esc_html('Excellent', 'tripfery-core') ?></div>
												<div class="rtrs-rating-item">
													<div class="rating-icon">
														<?php echo Functions::review_stars($avg_rating); ?>
														<span class="rating-percent">
															(<?php $total_rating = Review::getTotalRatings($post_id);
																printf(
																	esc_html(_n('%s Review', '%s Reviews', $total_rating, 'revieweb')),
																	esc_html($total_rating)
																); ?>)
														</span>
													</div>
												</div>
											</div>
										<?php } ?>
										<div class="d-flex align-items-center justify-content-between price-area">
											<?php if ($data['button_display'] == 'yes') { ?>
												<a href="<?php echo esc_url($url); ?>" class="btn-light-sm btn-light-animated">
													<?php echo esc_html($cat['button_text']) ?>
												</a>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						<?php } else { ?>
							<div class="rt_booking_<?php echo esc_attr($cat['sec_style']); ?> <?php echo esc_attr($col_class); ?> card-item <?php echo esc_attr($name_list->slug); ?> mb-4">
								<div class="listing-card">
									<?php
									if (!empty($image_srcs)) { ?>
										<a class="<?php if (!empty($discount)) {
														echo 'discount_available ';
													} ?>text-decoration-none listing-thumb-wrapper" href="<?php echo esc_url($item_url); ?>">
											<img src="<?php echo esc_attr($image_srcs[0]); ?>" alt="featured-image" />
											<?php echo wp_kses_post($discount); ?>
											<?php if ('on' == $featured_text) { ?>
												<div class="feature-text"><?php echo wp_kses_post('Featured', 'tripfery') ?></div>
											<?php } ?>
										</a>
									<?php } ?>

									<div class="listing-card-content">
										<div class="d-flex justify-content-between">
											<?php $address = isset($ba_info['address']) ? $ba_info['address'] : false;
											if ($address) {
											?>
												<div class="badge bage-pink">
													<svg class="badge-icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M5.99994 6.71503C6.86151 6.71503 7.55994 6.0166 7.55994 5.15503C7.55994 4.29347 6.86151 3.59503 5.99994 3.59503C5.13838 3.59503 4.43994 4.29347 4.43994 5.15503C4.43994 6.0166 5.13838 6.71503 5.99994 6.71503Z" stroke="currentColor" stroke-opacity="0.99" />
														<path d="M1.8101 4.24506C2.7951 -0.0849378 9.2101 -0.0799377 10.1901 4.25006C10.7651 6.79006 9.1851 8.94006 7.8001 10.2701C6.7951 11.2401 5.2051 11.2401 4.1951 10.2701C2.8151 8.94006 1.2351 6.78506 1.8101 4.24506Z" stroke="currentColor" stroke-opacity="0.99" />
													</svg>
													<span class="badge-text"><?php echo esc_html($address['address']); ?></span>
												</div>
											<?php } ?>
											<?php if (class_exists('RTWishlist')) {
												echo RTWishlist::wishlist_html($post_id);
											} ?>
										</div>
										<h3 class="listing-card-title">
											<a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
										</h3>
										<?php if ($data['rating_display'] == 'yes' && class_exists(Review::class) && $avg_rating = Review::getAvgRatings($post_id)) { ?>
											<div class="d-flex align-item listing-card-review-area">
												<div class="listing-card-review-text"><?php echo esc_html('Excellent', 'tripfery-core') ?></div>
												<div class="rtrs-rating-item">
													<div class="rating-icon">
														<?php echo Functions::review_stars($avg_rating); ?>
														<span class="rating-percent">
															(<?php $total_rating = Review::getTotalRatings($post_id);
																printf(
																	esc_html(_n('%s Review', '%s Reviews', $total_rating, 'revieweb')),
																	esc_html($total_rating)
																); ?>)
														</span>
													</div>
												</div>
											</div>
										<?php } ?>
										<div class="d-flex align-items-center justify-content-between price-area">
											<?php if ($data['price_display'] == 'yes') { ?>
												<div class="rt-price">
													<?php echo wp_kses_post($item_info_price); ?><?php if (!empty($cat['activity_text'])) { ?><span class="activity-person"><?php echo $cat['activity_text'] ?></span>
													<?php } ?>
												</div>
											<?php } ?>
											<?php if ($data['button_display'] == 'yes') { ?>
												<a href="<?php echo esc_url($url); ?>" class="btn-light-sm btn-light-animated">
													<?php echo $cat['button_text'] ?>
												</a>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
			<?php }
				}
			}
			wp_reset_query(); ?>
		</div>
	</div>
<?php } ?>

<?php

if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
?>
	<script>
		jQuery('.cardContainer').isotope();
	</script>
<?php
}
