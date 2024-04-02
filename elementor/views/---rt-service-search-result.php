<?php
$thumb_size = 'tripfery-size3';
$number_of_post = $data['itemnumber'];
$post_orderby = $data['post_orderby'];
$post_order = $data['post_order'];
$p_ids = array();
foreach ($data['posts_not_in'] as $p_idsn) {
	$p_ids[] = $p_idsn['post_not_in'];
}
$posts_in = [];
if (isset($_GET['rating_value'])) {
	$args = array(
		'post_type'            => 'to_book',
		'posts_per_page'     => -1,
		'meta_key'     => '_rating',
		'meta_value'     => $_GET['rating_value'],
	);
	$query = new WP_Query($args);
	if ($query->have_posts()) :
		while ($query->have_posts()) : $query->the_post();
			$posts_in[] = get_the_ID();
		endwhile;
	endif;
	wp_reset_postdata();
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
$args = wp_parse_args($args, array(
	'request_search_results' 	=> '',
	'date_from' 				 	=> '',
	'date_to' 					 	=> '',
	'time_from' 				 	=> '00:00',
	'time_to' 					 	=> '00:00',
	'categories' 				 	=> [],
	'terms' 						 	=> [],
	'search_results_sort_by' 	=> 'title_asc',
	'keyword' 					 	=> '',
	'return_total_count'     	=> 1
));

$args = wp_parse_args($_GET, $args);
$args = apply_filters('babe_search_result_args', $args);
if (isset($_GET['guests'])) {
	$guests = array_map('absint', $_GET['guests']);
	$args['guests'] = array_sum($guests);
}
foreach ($args as $arg_key => $arg_value) {
	$args[sanitize_title($arg_key)] = is_array($arg_value) ? array_map('absint', $arg_value) : sanitize_text_field($arg_value);
}
if (class_exists('BABE_Functions')) {
	if (!empty(BABE_Search_From::$search_form_tabs) && is_array(BABE_Search_From::$search_form_tabs) && isset($_GET['search_tab']) && isset(BABE_Search_From::$search_form_tabs[$_GET['search_tab']])) {
		$args['categories'] = BABE_Search_From::$search_form_tabs[$_GET['search_tab']]['categories'];
	}
	$args = apply_filters('babe_search_result_args', $args);
	$args = BABE_Post_types::search_filter_to_get_posts_args($args);
	$args['categories'] = [$data['catid']];
	if (!empty($posts_in)) {
		$args['post__in'] = $posts_in;
	}
	$posts = BABE_Post_types::get_posts($args);
	$results['posts_count']    = BABE_Post_types::$get_posts_count;
	$results['sort_by_filter'] = $sort_by_filter = BABE_html::input_select_field_with_order('sr_sort_by', '', BABE_Post_types::get_search_filter_sort_by_args(), $args['search_results_sort_by']);
	$col_class = "col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-xs-{$data['col_xs']}"; ?>
	<div class="rt-fillter-inner babe_search_results <?php echo esc_attr( $data['post_layout'] )?>">
		<div class="d-flex align-items-center justify-content-between view-switch-bar position-relative">
			<p class="search-result mb-0">
				<?php echo esc_html($results['posts_count']) . ' ';
					$terms = get_terms(array(
						'taxonomy' => 'categories',
						'include'  => $data['catid'],
						'orderby' => 'include',
					));
					foreach ($terms as $term) {
						echo esc_html($term->name);
					}
				echo esc_html__(' Found', 'tripfery-core'); ?>
			</p>
			<div class="d-flex view-switch-right">
				<?php if (isset($results['posts_count']) && !empty($results['posts_count'])) { ?>
					<div class="babe_search_results_filters">
						<div class="sort-and-filter">
							<?php if (isset($results['sort_by_filter']) && !empty($results['sort_by_filter'])) {
								printf('<div class="filter-sort d-flex"><span>' . esc_html__('Sort by', 'tripfery-color') . '</span>%s</div>', $results['sort_by_filter']);
							} ?>
						</div>
					</div>
				<?php } ?>
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
						$ba_info 	= BABE_Post_types::get_post($post_id);
						$tripfery_per_rate = get_post_meta($post_id, 'tripfery_per_rate', true);
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
						} 
				$booking = array(
					'post_id' 					=> $post_id,
					'ba_info' 					=> $ba_info,
					'tripfery_per_rate' 		=> $tripfery_per_rate,
					'gea_text' 					=> $gea_text,
					'guide_id' 					=> $guide_id,
					'featured_text' 			=> $featured_text,
					'group_max_size' 			=> $group_max_size,
					'url' 						=> $url,
					'item_terms' 				=> $item_terms,
					'discount' 					=> $discount,
					'price_from_with_taxes' 	=> $price_from_with_taxes,
					'price_old' 				=> $price_old,
				); ?>

				<!--  Car Style	-->
				<?php if ($data['sec_style'] == 'style2') { ?>
				<div class="<?php echo esc_attr($col_class); ?> card-item mb-4"><?php include('booking-style/car-style.php'); ?></div>
				<!-- Tour Style -->
				<?php } elseif ($data['sec_style'] == 'style3') { ?>
				<div class="<?php echo esc_attr($col_class); ?> card-item mb-4"><?php include('booking-style/tour-style.php'); ?></div>
				<!-- Activity Style	2 -->
				<?php } elseif ($data['sec_style'] == 'style7') { ?>
				<div class="<?php echo esc_attr($col_class); ?> card-item mb-4"><?php include('booking-style/activity-style2.php'); ?></div>
				<!-- Style Activity Style -->
				<?php } elseif ($data['sec_style'] == 'style4') { ?>
				<div class="<?php echo esc_attr($col_class); ?> card-item mb-4"><?php include('booking-style/activity-style.php'); ?></div>	
				<!-- Rental Style	 -->
				<?php } elseif ($data['sec_style'] == 'style5') { ?>
				<div class="<?php echo esc_attr($col_class); ?> card-item mb-4"><?php include('booking-style/rental-style.php'); ?></div>	
				<!-- Restaurants Style	 -->
				<?php } elseif ($data['sec_style'] == 'style6') { ?>
				<div class="<?php echo esc_attr($col_class); ?> card-item mb-4"><?php include('booking-style/restaurants-style.php'); ?></div>
				<!-- Hotel Style	 -->	
				<?php } else { ?>
				<div class="<?php echo esc_attr($col_class); ?> card-item mb-4">
					<?php include('booking-style/hotel-style.php'); ?>
				</div>
				<?php } ?>
			<?php }
			$posts_pages = BABE_Post_types::$get_posts_pages;
			$pagination = BABE_Functions::pager($posts_pages);
			echo $pagination;
			?>
		</div>
	</div>
<?php } ?>