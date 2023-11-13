<?php
$thumb_size = 'tripfery-size3';
$number_of_post = $data['itemnumber'];
$post_orderby = $data['post_orderby'];
$post_order = $data['post_order'];
$p_ids = array();
foreach ($data['posts_not_in'] as $p_idsn) {
	$p_ids[] = $p_idsn['post_not_in'];
}
if (get_query_var('paged')) {
	$paged = get_query_var('paged');
} else if (get_query_var('page')) {
	$paged = get_query_var('page');
} else {
	$paged = 1;
}
$args = array(
	'post_type'            => 'to_book',
	'posts_per_page'     => $number_of_post,
	'order'             => $post_order,
	'orderby'             => $post_orderby,
	'post__not_in'       => $p_ids,
	'post_status'		=> 'publish',
	'paged'             => $paged,
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
	$total_post = count($posts);
	$col_class = "col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-xs-{$data['col_xs']}"; ?>
	<div class="rt-fillter-inner">
		<div class="d-flex justify-content-between view-switch-bar position-relative">

			<p class="search-result">
				<?php echo esc_attr($total_post) . ' ';
				$terms = get_terms(array(
					'taxonomy' => 'categories',
					'include'  => $data['catid'],
					'orderby' => 'include',
				));
				foreach ($terms as $term) {
					echo esc_html($term->name);
				}
				echo esc_html(' found', 'tripfery');
				?>
			</p>
			
			<div class="d-flex view-switch-right">
				<div class="d-flex sort-and-filter">
					<div class="d-flex align-items-center sort-wrapper">
						<label for="sort" class="sort-label">Sort:</label>
						<select class="select-dropdown" id="sort">
							<option value="">Recommended</option>
							<option value="">Top Rated</option>
						</select>
					</div>
				</div>
				<ul class="nav" id="pills-tab" role="tablist">
					<li class="rt_grid_btn nav-item" role="presentation">
						<button class="nav-btn">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M5 10H7C9 10 10 9 10 7V5C10 3 9 2 7 2H5C3 2 2 3 2 5V7C2 9 3 10 5 10Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M17 10H19C21 10 22 9 22 7V5C22 3 21 2 19 2H17C15 2 14 3 14 5V7C14 9 15 10 17 10Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M17 22H19C21 22 22 21 22 19V17C22 15 21 14 19 14H17C15 14 14 15 14 17V19C14 21 15 22 17 22Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M5 22H7C9 22 10 21 10 19V17C10 15 9 14 7 14H5C3 14 2 15 2 17V19C2 21 3 22 5 22Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</button>
					</li>
					<li class="rt_list_btn nav-item" role="presentation">
						<button class="nav-btn">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M12.3711 8.88H17.6211" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M6.37891 8.88L7.12891 9.63L9.37891 7.38" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M12.3711 15.88H17.6211" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M6.37891 15.88L7.12891 16.63L9.37891 14.38" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</button>
					</li>
				</ul>
			</div>
		</div>
		<div class="row rt-search-services">
			<?php
			foreach ($posts as $post) {
				$post_id 	= $post['ID'];
				$thumbnail = apply_filters('babe_search_result_img_thumbnail', 'full');
				$item_url = BABE_Functions::get_page_url_with_args($post['ID'], $_GET);
				$image_srcs = wp_get_attachment_image_src(get_post_thumbnail_id($post['ID']), $thumbnail);
				$image = $image_srcs ? '<a class="text-decoration-none listing-thumb-wrapper" href="' . $item_url . '"><img class="text-decoration-none listing-thumb-wrapper" src="' . $image_srcs[0] . '"></a>' : '';
				$url = BABE_Functions::get_page_url_with_args($post_id, $_GET);
				$item_terms = get_the_terms($post_id, 'categories');
				$price_from_with_taxes = ($post['price_from'] * (100 + $post['categories_add_taxes'] * $post['categories_tax'])) / 100;
				$price_old = $post['discount_price_from'] < $price_from_with_taxes ? '<span class="item_info_price_old">' . BABE_Currency::get_currency_price($price_from_with_taxes) . '</span>' : '';
				$discount = $post['discount'] ? '<div class="item_info_price_discount">-' . $post['discount'] . '%</div>' : '';
				$item_info_price = '';
				$ba_info 	= BABE_Post_types::get_post($post_id);
				if (!empty($post['discount_price_from'])) {
					$item_info_price = '
					<div class="rt-price">	
						' . $price_old . '
						<span class="price-text item_info_price_new">' . BABE_Currency::get_currency_price($post['discount_price_from']) . '</span>
						' . $discount . ' 
						
					</div>';
				}
			?>
			<div class="<?php echo esc_attr($col_class); ?> mb-4">
				<div class="listing-card">
					<div class="rt-service-image">
						<?php echo wp_kses_post($image); ?>
					</div>
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
							<div class="wishlist">
								<svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M10.5167 16.3416C10.2334 16.4416 9.76675 16.4416 9.48341 16.3416C7.06675 15.5166 1.66675 12.075 1.66675 6.24165C1.66675 3.66665 3.74175 1.58331 6.30008 1.58331C7.81675 1.58331 9.15841 2.31665 10.0001 3.44998C10.8417 2.31665 12.1917 1.58331 13.7001 1.58331C16.2584 1.58331 18.3334 3.66665 18.3334 6.24165C18.3334 12.075 12.9334 15.5166 10.5167 16.3416Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
								</svg>
							</div>
						</div>
						<h3 class="listing-card-title">
							<a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
						</h3>
						<div class="d-flex align-item listing-card-review-area">
							<div class="listing-card-review-text"><?php echo esc_html('Excellent', 'tripfery-core') ?></div>
							<div class="rt-bookoing-rating">
								<?php echo BABE_Rating::post_stars_rendering($post['ID']); ?>
							</div>
						</div>
						<div class="d-flex align-items-center justify-content-between price-area">
							<?php echo wp_kses_post($item_info_price); ?>
							<a href="<?php echo esc_url($url); ?>" class="btn-light-sm btn-light-animated"><?php echo esc_html('View Availability', 'tripfery-core') ?></a>
						</div>
					</div>
				</div>
			</div>
			<?php }
				$posts_pages = BABE_Post_types::$get_posts_pages;
				$pagination = BABE_Functions::pager($posts_pages);
				echo $pagination;
			?>
		</div>
	</div>
<?php } ?>