<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if (class_exists('BABE_Functions')) {
	$args = array(
		'post_type' => 'to_book',
	);
	$args = array(
		'posts_per_page' 	=> $data['itemlimit']['size'],
		'order' 			=> $data['post_ordering'],
		'orderby' 			=> $data['post_orderby'],
		'post_type'			=> 'to_book',
		'post_status'		=> 'publish',
	);
	if (!empty($data['catid'])) {
		if ($data['query_type'] == 'category') {
			$args['tax_query'] = [
				[
					'taxonomy' => 'categories',
					'field' => 'term_id',
					'terms' => $data['catid'],
				],
			];
		}
	}
	if (!empty($data['postid'])) {
		if ($data['query_type'] == 'posts') {
			$args['post__in'] = $data['postid'];
		}
	}
	$posts = BABE_Post_types::get_posts($args);
	$col_class = "col-xl-{$data['col_xl']} col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-xs-{$data['col_xs']}";
	$thumb_size = 'tripfery-size5';
?>
	<div class="row <?php echo esc_attr($data['item_gutter']); ?>">
		<?php foreach ($posts as $post) {
			$post_id = $post['ID'];
			$item_url = BABE_Functions::get_page_url_with_args($post_id, $_GET);
			$image_srcs = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $thumb_size);
			$image = $image_srcs ? '<figure class="item-img"><a href="' . $item_url . '"><img src="' . $image_srcs[0] . '"></a></figure>' : '';
			$url = BABE_Functions::get_page_url_with_args($post_id, $_GET); ?>
			<div class="col-md-12 <?php echo esc_attr($col_class); ?>">
				<div class="hotel-info-card d-flex flex-column align-items-center <?php echo esc_attr($data['animation']); ?> <?php echo esc_attr($data['animation_effect']); ?>" data-wow-delay="<?php echo esc_attr($data['delay']); ?>s" data-wow-duration="<?php echo esc_attr($data['duration']); ?>s">
					<?php echo wp_kses_post($image); ?>
					<div class="hotel-short-info d-flex flex-column align-items-center">
						<?php if ($data['subtitle']) { ?>
							<span class="info-subtitle"><?php echo wp_kses_post($data['subtitle']); ?></span>
						<?php } ?>

						<h3 class="info-title"><a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a></h3>
						<?php echo BABE_Rating::post_stars_rendering($post['ID']); ?>
					</div>
				</div>
			</div>
	<?php }
	} ?>
	</div>