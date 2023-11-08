<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

?>
<div class="rt-locations-default rt-service-location-slider">
	<div class="rt-destionation-slider swiper">
		<div class="swiper-wrapper">
			<?php
			$m = $data['delay'];
			$n = $data['duration'];
			foreach ($data['rt-service-locations'] as $item) :
				$term = get_term($item['category_list'], 'ba_booking-locations');
				$term_link = get_term_link($term);
			?>
				<div class="swiper-slide <?php echo esc_attr($data['animation']); ?> <?php echo esc_attr($data['animation_effect']); ?>" data-wow-delay="<?php echo esc_attr($m); ?>s" data-wow-duration="<?php echo esc_attr($n); ?>s">
					<div class="destination-wrapper">
						<figure class="item-img">
							<a href="<?php echo esc_url($term_link); ?>" class="destination-thumb-wrapper">
								<?php echo wp_get_attachment_image($item['image']['id'], 'full') ?>
							</a>
						</figure>
						<div class="destination-info">
							<?php if (!empty($term->name)) { ?>
								<h4 class="hotel-name"><a href="<?php echo esc_url($term_link); ?>"><?php echo esc_html($term->name); ?></a></h4>
							<?php } ?>

							<?php if (is_array($item['sec_cat']) && count($item['sec_cat'])) {  ?>


								<?php foreach ($item['sec_cat'] as $term_id) {

									$catterm = get_term($term_id, 'categories');
									$args = array(
										'post_type' => 'to_book',
										'tax_query' => array(
											'relation' => 'AND',
											array(
												'taxonomy' => 'ba_booking-locations',
												'field' => 'term_id',
												'terms' => $item['category_list'],
											),
											array(
												'taxonomy' => 'categories',
												'field' => 'term_id',
												'terms' => $term_id
											),
										),
									);

									
									$post_query = new \WP_Query($args);
									if (!empty($post_query->found_posts)) { ?>
										<span class="total-hotel"> <?php echo esc_html($post_query->found_posts); ?> <?php echo $catterm->name; ?></span>
							<?php }
								}
							} ?>



						</div>
					</div>
				</div>
			<?php
				$m = $m + 0.2;
				$n = $n + 0.1;
			endforeach;
			?>
		</div>
		<?php if($data['post_category'] == 'yes'){ ?>
		<div class="topDestinationNav">
			<div class="swiper-button-next active">
				<i class="fa-solid fa-arrow-right"></i>
			</div>
			<div class="swiper-button-prev">
				<i class="fa-solid fa-arrow-left"></i>
			</div>
		</div>
		<?php } ?>
	</div>
</div>