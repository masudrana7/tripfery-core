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
						$content = apply_filters( $post['post_content'], get_the_excerpt() );
						$content = wp_trim_words($content, $data['count'], '');
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
						$tripfery_kids = get_post_meta($post_id, 'tripfery_kids', true);
						$tripfery_room_square = get_post_meta($post_id, 'tripfery_room_square', true);
						$tripfery_bed_room = get_post_meta($post_id, 'tripfery_bed_room', true);
						$group_peoples = ($ba_info['guests'] == '1') ? "Guest" : "Guests";
						$group_max_size = $ba_info['guests'] . ' ' . $group_peoples;

						if ($guide_id) {
							$guided_title = get_the_title($guide_id);
							$guided_link = get_the_permalink($guide_id);
							$post_thumbnail_url = get_the_post_thumbnail_url($guide_id, 'full');
						}
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
							'content' 				    => $content,
							'tripfery_bed_room' 		=> $tripfery_bed_room,
							'tripfery_room_square' 		=> $tripfery_room_square,
							'tripfery_kids' 		=> $tripfery_kids,
						); ?>

						<!--  Car Style	-->
						<?php if ($cat['sec_style'] == 'style2') { ?>
						<div class="<?php echo esc_attr($col_class); ?> card-item <?php echo esc_attr($name_list->slug); ?> mb-4"><?php include('booking-style/car-style.php'); ?></div>
						<!-- Tour Style -->
						<?php } elseif ($cat['sec_style'] == 'style3') { ?>
						<div class="<?php echo esc_attr($col_class); ?> card-item <?php echo esc_attr($name_list->slug); ?> mb-4"><?php include('booking-style/tour-style.php'); ?></div>
						<!-- Activity Style -->
						<?php } elseif ($cat['sec_style'] == 'style4') { ?>
						<div class="<?php echo esc_attr($col_class); ?> card-item <?php echo esc_attr($name_list->slug); ?> mb-4"><?php include('booking-style/activity-style.php'); ?></div>	
						<!-- Rental Style	 -->
						<?php } elseif ($cat['sec_style'] == 'style5') { ?>
						<div class="<?php echo esc_attr($col_class); ?> card-item <?php echo esc_attr($name_list->slug); ?> mb-4"><?php include('booking-style/rental-style.php'); ?></div>	
						<!-- Restaurants Style	 -->
						<?php } elseif ($cat['sec_style'] == 'style6') { ?>
						<div class="<?php echo esc_attr($col_class); ?> card-item <?php echo esc_attr($name_list->slug); ?> mb-4"><?php include('booking-style/restaurants-style.php'); ?></div>
						<!-- Style Activity 2 -->	
						<?php } elseif ($cat['sec_style'] == 'style7') { ?>
						<div class="<?php echo esc_attr($col_class); ?> card-item <?php echo esc_attr($name_list->slug); ?> mb-4"><?php include('booking-style/activity-style2.php'); ?></div>
						<!-- Style Room Style -->
						<?php } elseif ($cat['sec_style'] == 'style8') { ?>
						<div class="<?php echo esc_attr($col_class); ?> card-item <?php echo esc_attr($name_list->slug); ?> mb-4"><?php include('booking-style/room-style.php'); ?></div>
						<!-- Style Hotel Style -->
						<?php } else { ?>
						<div class="<?php echo esc_attr($col_class); ?> card-item <?php echo esc_attr($name_list->slug); ?> mb-4"><?php include('booking-style/hotel-style.php'); ?></div>
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
