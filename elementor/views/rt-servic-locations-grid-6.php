<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
$col_class = "col-xl-{$data['col_xl']} col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-xs-{$data['col_xs']}";
?>
<div class="rt-destination-style6">
	<div class="row <?php echo esc_attr($data['item_space']) ?>">
		<?php
		$terms  = get_terms(array(
			'taxonomy' => 'ba_locations',
			'fields' => 'id=>name',
			'hide_empty' => false,
		));
		$m = $data['delay'];
		$n = $data['duration'];
		foreach ($data['rt-service-booking'] as $item) :
			$term = get_term($item['category_list'], 'ba_locations');
			$term_link = get_term_link($term);
		?>
			<div class="<?php echo esc_attr($col_class); ?> <?php echo esc_attr($data['animation']); ?> <?php echo esc_attr($data['animation_effect']); ?>" data-wow-delay="<?php echo esc_attr($m); ?>s" data-wow-duration="<?php echo esc_attr($n); ?>s">
				<div class="destination-wrapper">
					<figure class="item-img">
						<a href="<?php if (!is_wp_error($term_link)) { echo esc_url($term_link); }; ?>" class="destination-thumb-wrapper">
							<?php echo wp_get_attachment_image($item['image']['id'], 'full') ?>
						</a>
					</figure>
					<div class="destination-info">
						<?php if (!empty($term->name)) { ?>
							<h4 class="hotel-name"><a href="<?php if (!is_wp_error($term_link)) { echo esc_url($term_link); }; ?>"><?php echo esc_html($term->name); ?></a></h4>
						<?php } ?>
						<?php
						if ($item['view_all']) { ?>
							<a class="view-link" href="<?php if (!is_wp_error($term_link)) { echo esc_url($term_link); }; ?>"><?php echo esc_html($item['view_all']); ?></a>
						<?php }
						?>
					</div>
				</div>
			</div>
		<?php
			$m = $m + 0.2;
			$n = $n + 0.1;
		endforeach;
		?>
	</div>
</div>