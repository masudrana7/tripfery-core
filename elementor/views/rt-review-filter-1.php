<?php
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
if (!empty($data['catid'])) {
	$args['tax_query'] = [
		[
			'taxonomy' => 'categories',
			'field' => 'term_id',
			'terms' => $data['catid'],
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
if (class_exists('BABE_Functions')) {
	$posts = BABE_Post_types::get_posts($args);
	$col_class = "col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-xs-{$data['col_xs']}";
	if ($posts != null) {
?>
		<div class="rt-case-isotope case-multi-isotope-1 rt-isotope-wrapper">
			<?php if (is_array($data['select_reviews']) && $data['cat_display'] == 'yes') { ?>
				<div class="row justify-content-center">
					<div class="hotel-filter-btns d-flex align-items-center justify-content-center flex-wrap">
						<button data-filter="*" class="filter-btn active"><?php echo esc_html($data['all_text']); ?></button>
						<?php foreach ($data['select_reviews'] as $key => $value) { ?>
							<?php if ($value == 'top') {
								$display_value =  esc_html__('Top', 'tripfery-core');
							} elseif ($value == 'new') {
								$display_value =  esc_html__('New', 'tripfery-core');
							} elseif ($value == 'most_review') {
								$display_value =  esc_html__('Most Review', 'tripfery-core');
							} else {
								$display_value =  esc_html__('Offer', 'tripfery-core');
							} ?>
							<button data-filter=".<?php echo esc_attr($value); ?>" class="filter-btn"><?php echo esc_html($display_value); ?></button>
						<?php } ?>
					</div>
				</div>
			<?php } ?>

			<div class="row hotelCardContainer">
				<?php
				foreach ($posts as $post) {
					$post_id 	= $post['ID'];
					$ba_info 	= BABE_Post_types::get_post($post_id);
					$tripfery_per_rate = "";
					$tripfery_per_rate = get_post_meta($post_id, 'tripfery_per_rate', true);
					$thumbnail = apply_filters('babe_search_result_img_thumbnail', 'full');
					$item_url = BABE_Functions::get_page_url_with_args($post['ID'], $_GET);
					$image_srcs = wp_get_attachment_image_src(get_post_thumbnail_id($post['ID']), $thumbnail);
					$image = $image_srcs ? '<a class="text-decoration-none listing-thumb-wrapper" href="' . $item_url . '">
				<img class="text-decoration-none listing-thumb-wrapper" src="' . $image_srcs[0] . '">
				</a>' : '';
					$url   		= BABE_Functions::get_page_url_with_args($post_id, $_GET);
					$item_terms = get_the_terms($post_id, 'categories');
					$price_from_with_taxes = ($post['price_from'] * (100 + $post['categories_add_taxes'] * $post['categories_tax'])) / 100;
					$price_old = $post['discount_price_from'] < $price_from_with_taxes ? '<span class="item_info_price_old">' . BABE_Currency::get_currency_price($price_from_with_taxes) . '</span>' : '';
					$discount = $post['discount'] ? '<div class="item_info_price_discount">-' . $post['discount'] . '%</div>' : '';
					$item_info_price = '';

					if (!empty($post['discount_price_from'])) {
						$item_info_price = '
					<div class="rt-price">	
						' . $price_old . '
						<span class="price-text item_info_price_new">' . BABE_Currency::get_currency_price($post['discount_price_from']) . '</span>
						' . $discount . ' <span class="activity-person">' . $tripfery_per_rate . '</span>

					</div>';
					}
					$terms_of_item = '';
					foreach ($item_terms as $term) {
						$terms_of_item .= '' . $term->slug . ' ';
					} ?>
					<div class="<?php echo esc_attr($col_class); ?> card-item <?php echo esc_attr($terms_of_item); ?> mb-4">
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
									<?php if ($data['price_display'] == 'yes' && !empty($item_info_price)) { ?>
										<?php echo wp_kses_post($item_info_price); ?>
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
				<?php }
				wp_reset_query(); ?>
			</div>
		</div>
<?php }
} ?>