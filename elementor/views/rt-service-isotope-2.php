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
	if ($data['cat_display'] == 'yes') {
		$menuClass = "active";
	} else {
		$menuClass = "hide";
	}
	$col_class = "col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-xs-{$data['col_xs']}";
	if ($posts != null) {
?>
		<div class="rt-isotope-style2 rt-case-isotope case-multi-isotope-1 rt-isotope-wrapper">
			<?php if ($data['cat_display'] == 'yes') { ?>
				<div class="row justify-content-center rt-menu-cats-<?php echo esc_attr($menuClass); ?>">
					<div class="col-auto">
						<div class="listing-filter-btns d-flex align-items-center justify-content-center flex-wrap">
							<?php
							$terms = get_terms(array(
								'taxonomy' => 'categories',
								'include'  => $data['catid'],
								'orderby' => 'include',
							));
							foreach ($terms as $term) {
								$get_color = get_term_meta($term->term_id, 'rt_category_color', true);
								$hexcolor = tripferyTheme_Helper::hex2rgb($get_color);
								$r = hexdec(substr($get_color, 0, 2));
								$g = hexdec(substr($get_color, 2, 2));
								$b = hexdec(substr($get_color, 4, 2));
							?>
								<button style="--tripfery-red: <?php echo absint($r); ?>;--tripfery-green: <?php echo absint($g); ?>; --tripfery-blue: <?php echo absint($b); ?>;" data-filter=".<?php echo esc_attr($term->slug); ?>" class="filter-btn <?php echo esc_attr($term->slug); ?>"><i class="icon-tripfery-hotel">
									</i><?php echo esc_html($term->name); ?></button>
							<?php
							}
							?>
						</div>
					</div>
				</div>
			<?php } ?>

			<div class="row cardContainer">
				<?php
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
					$item_info_price = '';

					if (!empty($post['discount_price_from'])) {
						$item_info_price = '
						<div class="rt-price">	
							' . $price_old . '
							<span class="price-text item_info_price_new">' . BABE_Currency::get_currency_price($post['discount_price_from']) . '</span>
							' . $discount . '<span class="activity-person">' . $data['act_text'] . '</span>

						</div>';
					}
					$terms_of_item = '';
					foreach ($item_terms as $term) {
						$terms_of_item .= '' . $term->slug . ' ';
					} ?>
					<div class="<?php echo esc_attr($col_class); ?> card-item <?php echo esc_attr($terms_of_item); ?> mb-4">
						<div class="listing-card">
							<div class="top-title">
								<h3 class="listing-card-title">
									<a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
								</h3>
								<div class="d-flex justify-content-between">
									<?php $address = isset($ba_info['address']) ? $ba_info['address'] : false;
									if ($address) {
									?>
										<div class="badge bage-pink">
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
										<?php if($group_max_size){?>
										<span class="car-seat"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M7.63314 9.05857C7.5498 9.05023 7.4498 9.05023 7.35814 9.05857C5.3748 8.9919 3.7998 7.3669 3.7998 5.3669C3.7998 3.32523 5.4498 1.6669 7.4998 1.6669C9.54147 1.6669 11.1998 3.32523 11.1998 5.3669C11.1915 7.3669 9.61647 8.9919 7.63314 9.05857Z" stroke="#384BFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M13.6747 3.3331C15.2914 3.3331 16.5914 4.64143 16.5914 6.24977C16.5914 7.82477 15.3414 9.1081 13.7831 9.16644C13.7164 9.1581 13.6414 9.1581 13.5664 9.16644" stroke="#384BFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M3.4666 12.1331C1.44993 13.4831 1.44993 15.6831 3.4666 17.0248C5.75827 18.5581 9.5166 18.5581 11.8083 17.0248C13.8249 15.6748 13.8249 13.4748 11.8083 12.1331C9.52493 10.6081 5.7666 10.6081 3.4666 12.1331Z" stroke="#384BFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M15.2832 16.6669C15.8832 16.5419 16.4499 16.3002 16.9165 15.9419C18.2165 14.9669 18.2165 13.3586 16.9165 12.3836C16.4582 12.0336 15.8999 11.8002 15.3082 11.6669" stroke="#384BFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
											</svg>
											<span class="valu"><?php echo esc_attr($group_max_size); ?></span>
										</span>
										<?php } ?>
										<?php if ($data['manual']) { ?>
											<span class="manual">
												<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M16.6667 11.6667C17.5871 11.6667 18.3333 10.9205 18.3333 10C18.3333 9.07952 17.5871 8.33333 16.6667 8.33333C15.7462 8.33333 15 9.07952 15 10C15 10.9205 15.7462 11.6667 16.6667 11.6667Z" stroke="#384BFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M16.6667 5C17.5871 5 18.3333 4.25381 18.3333 3.33333C18.3333 2.41286 17.5871 1.66667 16.6667 1.66667C15.7462 1.66667 15 2.41286 15 3.33333C15 4.25381 15.7462 5 16.6667 5Z" stroke="#384BFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M16.6667 18.3333C17.5871 18.3333 18.3333 17.5871 18.3333 16.6667C18.3333 15.7462 17.5871 15 16.6667 15C15.7462 15 15 15.7462 15 16.6667C15 17.5871 15.7462 18.3333 16.6667 18.3333Z" stroke="#384BFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M3.33366 11.6667C4.25413 11.6667 5.00033 10.9205 5.00033 10C5.00033 9.07952 4.25413 8.33333 3.33366 8.33333C2.41318 8.33333 1.66699 9.07952 1.66699 10C1.66699 10.9205 2.41318 11.6667 3.33366 11.6667Z" stroke="#384BFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M5 10H15" stroke="#384BFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
													<path d="M15.0003 3.33333H11.667C10.0003 3.33333 9.16699 4.16667 9.16699 5.83333V14.1667C9.16699 15.8333 10.0003 16.6667 11.667 16.6667H15.0003" stroke="#384BFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
												</svg>
												<span class="valu"><?php echo wp_kses_post($data['manual']); ?></span>
											</span>
										<?php } ?>
									</div>
									<?php if ($data['price_display'] == 'yes') { ?>
									<?php echo wp_kses_post($item_info_price); ?>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				<?php }
				wp_reset_query();
				?>
			</div>
		</div>
<?php }
} ?>