<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core; ?>
<div class="rt-booking-layout-2">
	<div class="row <?php echo esc_attr($data['item_space']); ?>">
		<div class="cards-row d-flex">
			<?php
			$m = $data['delay'];
			$n = $data['duration'];

			foreach ($data['rt-service-booking'] as $item) :
				$term = get_term($item['category_list'], 'ba_locations');
				$term_link = get_term_link($term);
				$image_id = $item['image']['id'];
				$image_attributes = wp_get_attachment_image_src($image_id, 'full');
			?>
				<article class="col-sm-6 col-md-4 col-xl mb-4 mb-lg-0 <?php echo esc_attr($data['animation']); ?> <?php echo esc_attr($data['animation_effect']); ?>" data-wow-delay="<?php echo esc_attr($m); ?>s" data-wow-duration="<?php echo esc_attr($n); ?>s">
					<div class="destination-wrapper">
						<?php if (!empty($item['image']['id'])) { ?>
							<div class="destination-thumb-wrapper">
								<?php echo wp_get_attachment_image($item['image']['id'], 'full', false, array('class' => 'destination-thumb')) ?>
							</div>
						<?php } ?>
						<div class="destination-info text-center">
							<?php if (!empty($term->name)) { ?>
								<h4 class="destination-name"><a href="<?php if (!is_wp_error($term_link)) { echo esc_url($term_link); }; ?>"><?php echo esc_html($term->name); ?></a></h4>
							<?php } ?>
							<?php if (is_array($item['sec_cat']) && count($item['sec_cat'])) {  ?>
								<?php foreach ($item['sec_cat'] as $term_id) {
									$catterm = get_term($term_id, 'categories');
									$loc_term = get_term($term_id, 'ba_locations');
									$args = array(
										'post_type' => 'to_book',
										'tax_query' => array(
											'relation' => 'AND',
											array(
												'taxonomy' => 'ba_locations',
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
											<p class="destination-tour"><?php echo esc_html($post_query->found_posts); ?> <?php echo $catterm->name; ?></p>
									<?php }
								}
							} ?>
						</div>
					</div>

				</article>
			<?php
				$m = $m + 0.2;
				$n = $n + 0.1;
			endforeach;
			?>
		</div>
	</div>
</div>