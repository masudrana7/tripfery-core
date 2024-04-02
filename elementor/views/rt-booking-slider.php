<?php
use Rtrs\Models\Review;
use Rtrs\Helpers\Functions;
if (class_exists('BABE_Functions')) { ?>
	<div class="rt-booking-slider  <?php echo esc_attr($data['nav_position']) ?>">
		<div class="swiper rt-swiper-slider rt-swiper-nav" data-xld="<?php echo esc_attr($data['swiper_data']); ?>">
			<div class="swiper-wrapper">
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
							<?php if($data['featured_display'] == 'yes'){ ?>
								<?php if($featured_text == 'on'){?>
									<!--  Car Style	-->
									<?php if ($cat['sec_style'] == 'style2') { ?>
									<div class="swiper-slide"><?php include('booking-style/car-style.php'); ?></div>
									<!-- Tour Style -->
									<?php } elseif ($cat['sec_style'] == 'style3') { ?>
									<div class="swiper-slide"><?php include('booking-style/tour-style.php'); ?></div>
									<!-- Activity Style	2 -->
									<?php } elseif ($cat['sec_style'] == 'style7') { ?>
									<div class="swiper-slide"><?php include('booking-style/activity-style2.php'); ?></div>
									<!-- Style Activity Style -->
									<?php } elseif ($cat['sec_style'] == 'style4') { ?>
									<div class="swiper-slide"><?php include('booking-style/activity-style.php'); ?></div>	
									<!-- Rental Style	 -->
									<?php } elseif ($cat['sec_style'] == 'style5') { ?>
									<div class="swiper-slide"><?php include('booking-style/rental-style.php'); ?></div>	
									<!-- Restaurants Style	 -->
									<?php } elseif ($cat['sec_style'] == 'style6') { ?>
									<div class="swiper-slide"><?php include('booking-style/restaurants-style.php'); ?></div>
									<!-- Hotel Style	 -->	
									<?php } else { ?>
									<div class="swiper-slide"><?php include('booking-style/hotel-style.php'); ?></div>
									<?php } ?>
								<?php } ?>
							<?php } else { ?>
								<!--  Car Style	-->
								<?php if ($cat['sec_style'] == 'style2') { ?>
								<div class="swiper-slide"><?php include('booking-style/car-style.php'); ?></div>
								<!-- Tour Style -->
								<?php } elseif ($cat['sec_style'] == 'style3') { ?>
								<div class="swiper-slide"><?php include('booking-style/tour-style.php'); ?></div>
								<!-- Activity Style	2 -->
								<?php } elseif ($cat['sec_style'] == 'style7') { ?>
								<div class="swiper-slide"><?php include('booking-style/activity-style2.php'); ?></div>
								<!-- Style Activity Style -->
								<?php } elseif ($cat['sec_style'] == 'style4') { ?>
								<div class="swiper-slide"><?php include('booking-style/activity-style.php'); ?></div>	
								<!-- Rental Style	 -->
								<?php } elseif ($cat['sec_style'] == 'style5') { ?>
								<div class="swiper-slide"><?php include('booking-style/rental-style.php'); ?></div>	
								<!-- Restaurants Style	 -->
								<?php } elseif ($cat['sec_style'] == 'style6') { ?>
								<div class="swiper-slide"><?php include('booking-style/restaurants-style.php'); ?></div>
								<!-- Hotel Style	 -->	
								<?php } else { ?>
								<div class="swiper-slide"><?php include('booking-style/hotel-style.php'); ?></div>
								<?php } ?>
							<?php } ?>
						<?php }
					}
				}
				wp_reset_query(); ?>
			</div>
			<?php if ($data['display_arrow'] == 'yes') { ?>
				<div class="swiper-navigation">
					<div class="swiper-button-prev"><i class="fa-solid fa-chevron-left"></i></div>
					<div class="swiper-button-next"><i class="fa-solid fa-chevron-right"></i></div>
				</div>
			<?php } ?>
			<?php if ($data['display_buttet'] == 'yes') { ?>
				<div class="swiper-pagination"></div>
			<?php } ?>
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
