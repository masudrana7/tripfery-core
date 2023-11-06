<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core; ?>
<div class="rt-locations-default rt-locations-layout-1">
	<div class="row <?php echo esc_attr($data['item_space']); ?>">
		<div class="cards-row d-flex">
			<?php
			$m = $data['delay'];
			$n = $data['duration'];
			foreach ($data['rt-service-locations'] as $item) :
				$term = get_term($item['category_list'], 'ba_booking-locations');
				$image_id = $item['image']['id'];
				$image_attributes = wp_get_attachment_image_src($image_id, 'full');
			?>
			<div class="panel <?php echo esc_attr($data['animation']); ?> <?php echo esc_attr($data['animation_effect']); ?>" data-wow-delay="<?php echo esc_attr($m); ?>s" data-wow-duration="<?php echo esc_attr($n); ?>s" style="background-image: url('<?php echo esc_attr($image_attributes['0']); ?>')">
				<?php if (!empty($term->name)) { ?>
					<h3 class="panel-title"><a href="<?php the_permalink(); ?>"><?php echo esc_html($term->name); ?></a></h3>
				<?php } ?>
				<div class="panel-content">
					<ul class="d-flex flex-wrap justify-content-center feature-list">
						<?php if (!empty($term->count)) { ?>
							<li><span class="feature-name"><?php echo esc_html($term->count); ?> Activities</span></li>
						<?php } ?>

						<?php if (!empty($tripfery_location_cars)) { ?>
							<li><span class="feature-name"><?php echo esc_html($tripfery_location_cars); ?></span></li>
						<?php } ?>

						<?php if (!empty($tripfery_location_hotel)) { ?>
							<li><span class="feature-name"><?php echo esc_html($tripfery_location_hotel); ?></span></li>
						<?php } ?>

						<?php if (!empty($tripfery_location_tours)) { ?>
							<li><span class="feature-name"><?php echo esc_html($tripfery_location_tours); ?></span></li>
						<?php } ?>

						<?php if (!empty($tripfery_location_rentals)) { ?>
							<li><span class="feature-name"><?php echo esc_html($tripfery_location_rentals); ?></span></li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<?php 
				$m = $m + 0.2;
				$n = $n + 0.1;
				endforeach; 
			?>
		</div>
	</div>
</div>