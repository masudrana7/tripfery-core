<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core; ?>
<div class="rt-locations-default rt-locations-layout-2">
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

				<article class="col-sm-6 col-md-4 col-xl mb-4 mb-lg-0 <?php echo esc_attr($data['animation']); ?> <?php echo esc_attr($data['animation_effect']); ?>" data-wow-delay="<?php echo esc_attr($m); ?>s" data-wow-duration="<?php echo esc_attr($n); ?>s">
					<div class="destination-wrapper">
						<div class="destination-thumb-wrapper">
							<?php echo wp_get_attachment_image($item['image']['id'], 'full', false, array('class' => 'destination-thumb')) ?>

						</div>
						<span class="star">
							<i class="fa-solid fa-star"></i>
							<span class="star-number">5</span>
						</span>
						<div class="destination-info text-center">
							<?php if (!empty($term->name)) { ?>
								<h3 class="destination-name"><a href="<?php the_permalink(); ?>"><?php echo esc_html($term->name); ?></a></h3>
							<?php } ?>
							<p class="destination-tour">14 Tours</p>
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