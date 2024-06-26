<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

?>
<div class="rt-booking-default rt-booking-layout-7">
	<div class="cards-row">
		<?php
		$m = $data['delay'];
		$n = $data['duration'];
		foreach ($data['rt-service-booking'] as $item) :
			$term = get_term($item['category_list'], 'ba_locations');
			$term_link = get_term_link($term);
			$image_id = $item['image']['id'];
			$image_attributes = wp_get_attachment_image_src($image_id, 'full');
		?>
		<div class="panel <?php echo esc_attr($data['animation']); ?> <?php echo esc_attr($data['animation_effect']); ?>" data-wow-delay="<?php echo esc_attr($m); ?>s" data-wow-duration="<?php echo esc_attr($n); ?>s" style="background-image: url('<?php echo esc_attr($image_attributes['0']); ?>')">
			<div class="rt-destination-content">
				
				<?php if (!empty($term->name)) {
					if( ! empty( $item['sec_cat'] ) ){
						$term_link = add_query_arg(
							[
								'category_ids' => $item['sec_cat'],
							] , $term_link 
						);
					}
					?>
					<h3 class="panel-title"><a href="<?php if (!is_wp_error($term_link)) { echo esc_url($term_link); }; ?>"><?php echo esc_html($term->name); ?></a></h3>
				<?php }

				if ( is_array( $item['sec_cat'] ) && count( $item['sec_cat'] ) ) {
				?>
				<div class="panel-content">
					<ul class="d-flex flex-wrap justify-content-center feature-list">
					<?php
						foreach ( $item['sec_cat'] as $term_id) {
						$catterm = get_term( $term_id, 'categories');
						$term_link = get_term_link($term_id, 'categories');
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
						if (! empty($post_query->found_posts )) {
							?>
							<li>
								<span class="feature-name"><?php echo esc_html($post_query->found_posts); ?> 
								<?php echo $catterm->name;?>
								</span>
							</li>
						<?php } 
						}
					?>
					</ul>
				</div>
			</div>

			<?php } ?>
		</div>
		<?php 
			$m = $m + 0.2;
			$n = $n + 0.1;
			endforeach; 
		?>
	</div>
</div>