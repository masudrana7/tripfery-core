<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;

use TripferyTheme;
use TripferyTheme_Helper;
use \WP_Query;

$thumb_size  = 'tripfery-size4';

if (get_query_var('paged')) {
	$paged = get_query_var('paged');
} else if (get_query_var('page')) {
	$paged = get_query_var('page');
} else {
	$paged = 1;
}
$args = array(
	'post_type'      	=> 'to_book',
	'posts_per_page' 	=> $data['number'],
	'order' 			=> $data['post_ordering'],
	'orderby' 			=> $data['post_orderby'],
	'paged' 			=> $paged
);

if (!empty($data['cat'])) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'ba_booking-locations',
			'field' => 'term_id',
			'terms' => $data['cat'],
		)
	);
}
$query = new WP_Query($args);
$temp = TripferyTheme_Helper::wp_set_temp_query($query);

$col_class = "col-xl-{$data['col_xl']} col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-xs-{$data['col_xs']}"; ?>
<div class="rt-locations-default rt-locations-layout-1 locations-grid-<?php echo esc_attr($data['style']); ?>">
	<div class="row <?php echo esc_attr($data['item_space']); ?>">
		<div class="cards-row d-flex">

			<?php 
				$m = $data['delay'];
				$n = $data['duration']; 
				foreach ($data['rt-service-locations'] as $rt_service_locations) :
				$image_id = $rt_service_locations['image']['id'];
				$image_attributes = wp_get_attachment_image_src($image_id, 'full');
		
				?>

				<div class="panel <?php echo esc_attr($data['animation']); ?> <?php echo esc_attr($data['animation_effect']); ?>" data-wow-delay="<?php echo esc_attr($m); ?>s" data-wow-duration="<?php echo esc_attr($n); ?>s" style="background-image: url('<?php echo esc_attr($image_attributes['0']); ?>')">

					<h3 class="panel-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<div class="panel-content">

						<ul class="d-flex flex-wrap justify-content-center feature-list">
							<?php if (!empty($tripfery_location_activities)) { ?>
								<li><span class="feature-name"><?php echo esc_html($tripfery_location_activities); ?></span></li>
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
			<?php $m = $m + 0.2; $n = $n + 0.1; endforeach; ?>

		</div>
	</div>
	<?php if ($data['more_button'] == 'show') { ?>
		<?php if (!empty($data['see_button_text'])) { ?>
			<div class="locations-button"><a class="button-style-2 btn-common" aria-label="Locations" href="<?php echo esc_url($data['see_button_link']); ?>"><?php echo esc_html($data['see_button_text']); ?></a></div>
		<?php } ?>
	<?php } else { ?>
		<?php TripferyTheme_Helper::pagination(); ?>
	<?php } ?>
	<?php TripferyTheme_Helper::wp_reset_temp_query($temp); ?>
</div>