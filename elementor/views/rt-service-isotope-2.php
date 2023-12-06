<?php
if (class_exists('BABE_Functions')) { ?>
	<div class="rt-case-isotope case-multi-isotope-1 rt-isotope-wrapper">
		<?php if ($data['cat_display'] == 'yes') { ?>
			<div class="row justify-content-center">
				<div class="col-auto">
					<div class="listing-filter-btns d-flex align-items-center justify-content-center flex-wrap">
						<?php
						if (!empty($data['tab_items'])) {
							foreach ($data['tab_items'] as $cat) {

								// $get_color = get_term_meta($term->term_id, 'rt_category_color', true);
								// $hexcolor = tripferyTheme_Helper::hex2rgb($get_color);
								// $r = hexdec(substr($get_color, 0, 2));
								// $g = hexdec(substr($get_color, 2, 2));
								// $b = hexdec(substr($get_color, 4, 2));

								$cats = explode(',', $cat['sec_cat']);
								$terms = get_terms(array(
									'taxonomy' => 'categories',
									'include'  => $cats,
									'orderby' => 'include',
								));

								$name_list = $terms[0]; ?>

								<button style="--tripfery-red: <?php //echo absint($r); 
																?>;--tripfery-green: <?php //echo absint($g); 
																						?>; --tripfery-blue: <?php //echo absint($b); 
																												?>;" data-filter=".<?php echo esc_attr($name_list->slug); ?>" class="filter-btn <?php echo esc_attr($name_list->slug); ?>">
									<i class="icon-tripfery-hotel"></i>
									<?php echo $name_list->name; ?>
								</button>

						<?php }
						}	?>
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
					$col_class = "col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-xs-{$data['col_xs']}";

					foreach ($posts as $post) {
						$post_id 	= $post['ID'];
						$ba_info 	= BABE_Post_types::get_post($post_id);
						$thumbnail = apply_filters('babe_search_result_img_thumbnail', 'full');
						$item_url = BABE_Functions::get_page_url_with_args($post['ID'], $_GET);
						$image_srcs = wp_get_attachment_image_src(get_post_thumbnail_id($post['ID']), $thumbnail);
						$image = $image_srcs ? '<a class="text-decoration-none listing-thumb-wrapper" href="' . $item_url . '">
						<img class="text-decoration-none listing-thumb-wrapper" src="' . $image_srcs[0] . '">
						</a>' : '';



						$group_max_size = $ba_info['guests'];

						$url   		= BABE_Functions::get_page_url_with_args($post_id, $_GET);
						$item_terms = get_the_terms($post_id, 'categories');
						$price_from_with_taxes = ($post['price_from'] * (100 + $post['categories_add_taxes'] * $post['categories_tax'])) / 100;
						$price_old = $post['discount_price_from'] < $price_from_with_taxes ? '<span class="item_info_price_old">' . BABE_Currency::get_currency_price($price_from_with_taxes) . '</span>' : '';
						$discount = $post['discount'] ? '<div class="item_info_price_discount">-' . $post['discount'] . '%</div>' : '';



						if (!empty($post['discount_price_from'])) {
							$item_info_price =
								'' . $price_old . '
							<span class="price-text item_info_price_new">' . BABE_Currency::get_currency_price($post['discount_price_from']) . '</span>
							' . $discount . '';
						}


			?>

						<!-- Style One	-->
						<?php if ($cat['sec_style'] == 'style2') { ?>
							<div class="<?php echo esc_attr($col_class); ?> card-item <?php echo esc_attr($name_list->slug); ?> mb-4 rt-car-style">
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
											<div class="wishlist">
												<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M13.1455 21.6771C12.7913 21.8021 12.208 21.8021 11.8538 21.6771C8.83301 20.6459 2.08301 16.3438 2.08301 9.05215C2.08301 5.8334 4.67676 3.22923 7.87467 3.22923C9.77051 3.22923 11.4476 4.1459 12.4997 5.56257C13.5518 4.1459 15.2393 3.22923 17.1247 3.22923C20.3226 3.22923 22.9163 5.8334 22.9163 9.05215C22.9163 16.3438 16.1663 20.6459 13.1455 21.6771Z" fill="#F12C5B"></path>
												</svg>
											</div>
										</div>
									</div>

									<?php if (!empty($image_srcs)) { ?>
										<a class="text-decoration-none listing-thumb-wrapper" href="<?php echo esc_url($item_url); ?>">
											<img src="<?php echo esc_attr($image_srcs[0]); ?>" alt="featured-image" />
										</a>
									<?php } ?>

									<div class="listing-card-content title_postion_<?php echo esc_attr($data['title_position']); ?>">
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
												<?php if ($data['manual']) { ?>
													<span class="manual">
														<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M16.6667 11.6667C17.5871 11.6667 18.3333 10.9205 18.3333 10C18.3333 9.07952 17.5871 8.33333 16.6667 8.33333C15.7462 8.33333 15 9.07952 15 10C15 10.9205 15.7462 11.6667 16.6667 11.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M16.6667 5C17.5871 5 18.3333 4.25381 18.3333 3.33333C18.3333 2.41286 17.5871 1.66667 16.6667 1.66667C15.7462 1.66667 15 2.41286 15 3.33333C15 4.25381 15.7462 5 16.6667 5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M16.6667 18.3333C17.5871 18.3333 18.3333 17.5871 18.3333 16.6667C18.3333 15.7462 17.5871 15 16.6667 15C15.7462 15 15 15.7462 15 16.6667C15 17.5871 15.7462 18.3333 16.6667 18.3333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M3.33366 11.6667C4.25413 11.6667 5.00033 10.9205 5.00033 10C5.00033 9.07952 4.25413 8.33333 3.33366 8.33333C2.41318 8.33333 1.66699 9.07952 1.66699 10C1.66699 10.9205 2.41318 11.6667 3.33366 11.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M5 10H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M15.0003 3.33333H11.667C10.0003 3.33333 9.16699 4.16667 9.16699 5.83333V14.1667C9.16699 15.8333 10.0003 16.6667 11.667 16.6667H15.0003" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
														</svg>
														<span class="valu"><?php echo wp_kses_post($data['manual']); ?></span>
													</span>
												<?php } ?>
											</div>
											<?php if ($data['price_display'] == 'yes') { ?>
												<div class="rt-price">
													<?php echo wp_kses_post($item_info_price); ?>
													<?php if (!empty($cat['activity_text'])) { ?>
														<span class="activity-person">
															<?php echo $cat['activity_text'] ?>
														</span>
													<?php } ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>

							<!-- Style Two	-->
						<?php } else { ?>
							<div class="<?php echo esc_attr($col_class); ?> card-item <?php echo esc_attr($name_list->slug); ?> mb-4">
								<div class="listing-card">
									<?php if (!empty($image_srcs)) { ?>
										<a class="text-decoration-none listing-thumb-wrapper" href="<?php echo esc_url($item_url); ?>">
											<img src="<?php echo esc_attr($image_srcs[0]); ?>" alt="featured-image" />
											<?php if ($data['rating_display'] == 'yes') { ?>
												<?php if ($data['rating_position'] == 'top') {
													echo '<span class="booking-top-rating">';
													echo '<i class="fa-solid fa-star"></i>';
													echo BABE_Rating::get_post_total_rating($post_id);
													echo '</span>';
												} ?>
											<?php } ?>
											<?php if ($data['wishlist_position'] == 'top') { ?>
												<div class="wishlist">
													<i class="fa-regular fa-heart"></i>
												</div>
											<?php } ?>
										</a>
									<?php } ?>

									<div class="listing-card-content title_postion_<?php echo esc_attr($data['title_position']); ?>">
										<?php if ($data['title_position'] == 'top') { ?>
											<h3 class="listing-card-title">
												<a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
											</h3>
										<?php } ?>
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

											<?php if ($data['wishlist_position'] == 'bottom') { ?>
												<div class="wishlist">
													<svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M10.5167 16.3416C10.2334 16.4416 9.76675 16.4416 9.48341 16.3416C7.06675 15.5166 1.66675 12.075 1.66675 6.24165C1.66675 3.66665 3.74175 1.58331 6.30008 1.58331C7.81675 1.58331 9.15841 2.31665 10.0001 3.44998C10.8417 2.31665 12.1917 1.58331 13.7001 1.58331C16.2584 1.58331 18.3334 3.66665 18.3334 6.24165C18.3334 12.075 12.9334 15.5166 10.5167 16.3416Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
													</svg>
												</div>
											<?php } ?>

										</div>

										<?php if ($data['title_position'] == 'bottom') { ?>
											<h3 class="listing-card-title">
												<a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
											</h3>
										<?php } ?>
										<?php if ($data['rating_display'] == 'yes') { ?>
											<?php if ($data['rating_position'] == 'bottom') { ?>
												<?php if (!empty(BABE_Rating::post_stars_rendering($post['ID']))) { ?>
													<div class="d-flex align-item listing-card-review-area">
														<div class="listing-card-review-text"><?php echo esc_html('Excellent', 'tripfery-core') ?></div>
														<div class="rt-bookoing-rating">
															<?php echo BABE_Rating::post_stars_rendering($post['ID']); ?>
														</div>
													</div>
												<?php } ?>
											<?php } ?>
										<?php } ?>


										<div class="d-flex align-items-center justify-content-between price-area">
											<?php if ($data['price_display'] == 'yes') { ?>
												<div class="rt-price">
													<?php echo wp_kses_post($item_info_price); ?>
													<?php if (!empty($cat['activity_text'])) { ?>
														<span class="activity-person">
															<?php echo $cat['activity_text'] ?>
														</span>
													<?php } ?>
												</div>
											<?php } ?>

											<?php if ($data['button_display'] == 'yes') { ?>
												<a href="<?php echo esc_url($url); ?>" class="btn-light-sm btn-light-animated">
													<?php echo esc_html($data['btn_text']) ?>
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