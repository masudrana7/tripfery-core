<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core; ?>
<div class="rt-activity-default top-activity ">
	<div class="row justify-content-center <?php echo esc_attr($data['item_space']); ?>">

		<?php
		$m = $data['delay'];
		$n = $data['duration'];
		foreach ($data['rt-service-locations'] as $item) :
			$term = get_term($item['category_list'], 'ba_our-activitys');
			$image_id = $item['image']['id'];
			$image_attributes = wp_get_attachment_image_src($image_id, 'full');
		?>
			<article class="col-sm-6 col-md-4 col-xl mb-4 mb-lg-0 <?php echo esc_attr($data['animation']); ?> <?php echo esc_attr($data['animation_effect']); ?>" data-wow-delay="<?php echo esc_attr($m); ?>s" data-wow-duration="<?php echo esc_attr($n); ?>s">
				<div class="top-activity-wrapper d-flex flex-column m-auto align-items-center">

					<?php if (!empty($item['image']['id'])) { ?>
						<div class="top-activity-thumb-wrapper">
							<?php echo wp_get_attachment_image($item['image']['id'], 'full') ?>
						</div>
					<?php } ?>

					<div class="activity-info text-center">
						<h3 class="activity-name">
							<?php echo esc_html($term->name); ?>
						</h3>
						<?php if (!empty($term->name)) { ?>
							<span class="activity-place"><?php echo esc_html($term->name); ?></span>
						<?php } ?>
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