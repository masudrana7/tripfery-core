<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
if (class_exists('BABE_Functions')) {
?>
<div class="rt-car-categories">
	<div class="row justify-content-center <?php echo esc_attr($data['item_space']); ?>">
		<?php
		$m = $data['delay'];
		$n = $data['duration'];
		foreach ($data['rt-service-booking'] as $item) :
			$term = get_term($item['category_list'], 'ba_booking-car');
			$image_id = $item['image']['id'];
			$image_attributes = wp_get_attachment_image_src($image_id, 'full');
			$category_link = get_term_link($term);
		?>
			<article class="col-sm-6 col-md-4 col-xl mb-4 mb-lg-0 <?php echo esc_attr($data['animation']); ?> <?php echo esc_attr($data['animation_effect']); ?>" data-wow-delay="<?php echo esc_attr($m); ?>s" data-wow-duration="<?php echo esc_attr($n); ?>s">
				<div class="single-car-category d-flex flex-column align-items-center m-auto">
					<?php if (!empty($item['image']['id'])) { ?>
						<a href="<?php echo esc_url($category_link); ?>" class="car-category-thumb-wrapper">
							<?php echo wp_get_attachment_image($item['image']['id'], 'full') ?>
						</a>
					<?php } ?>
					<?php if (!empty($term->name)) { ?>
						<h4 class="car-category-name"><a href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($term->name); ?></a></h4>
					<?php } ?>
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