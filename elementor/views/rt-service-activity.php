<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
if (class_exists('BABE_Functions')) {
?>
<div class="rt-activity-default top-activity ">
	<div class="row justify-content-center <?php echo esc_attr($data['item_space']); ?>">
		<?php
		$m = $data['delay'];
		$n = $data['duration'];
		foreach ($data['rt-service-booking'] as $item) :

			$term = get_term($item['category_list'], 'ba_our-activitys');
			$term_link = get_term_link($term);
			$image_id = $item['image']['id'];
			$image_attributes = wp_get_attachment_image_src($image_id, 'full');
		?>
			<article class="col-sm-4 col-md-4 col-xl mb-4 mb-lg-0 <?php echo esc_attr($data['animation']); ?> <?php echo esc_attr($data['animation_effect']); ?>" data-wow-delay="<?php echo esc_attr($m); ?>s" data-wow-duration="<?php echo esc_attr($n); ?>s">
				<div class="top-activity-wrapper d-flex flex-column m-auto align-items-center">
					<?php if (!empty($item['image']['id'])) { ?>
						<div class="top-activity-thumb-wrapper">
							<?php echo wp_get_attachment_image($item['image']['id'], 'full') ?>
						</div>
					<?php } ?>

					<div class="activity-info text-center">
						<?php if (!empty($term->name)) { ?>
							<h3 class="activity-name">
								<?php echo esc_html($term->name); ?>
							</h3>
						<?php } ?>
						<?php
						$locterms = get_terms(array(
							'taxonomy' => 'ba_locations',
							'parent'   => 0
						));
						$terms_ids = [];
						foreach ($locterms as $locterm) {
							$terms_ids[] = $locterm->term_id;
						}
						$args = array(
							'post_type' => 'to_book',
							'tax_query' => array(
								'relation' => 'AND',
								array(
									'taxonomy' => 'ba_our-activitys',
									'field'    => 'term_id',
									'terms'    => $item['category_list'],
								),
								array(
									'taxonomy' => 'ba_locations',
									'field'    => 'term_id',
									'terms'    => $terms_ids,
								),
							),
						);
						$post_query = new \WP_Query($args);
						if ($post_query->have_posts()) :
							echo '<div class="activity">';
							while ($post_query->have_posts()) :
								$post_query->the_post();
								$location_terms = get_the_terms(get_the_ID(), 'ba_locations');
								if (!empty($location_terms)) {
									foreach ($location_terms as $location_term) {
										$term_link = get_term_link($location_term);
										echo '<a href="' . esc_url($term_link) . '"><span class="activity-place">' . esc_html($location_term->name) . '</span></a>';
									}
								}
							endwhile;
							echo '</div>';
							wp_reset_postdata();
						endif;
						?>
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
<?php } ?>