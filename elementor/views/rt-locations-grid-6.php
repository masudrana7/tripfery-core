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

$thumb_size  = 'tripfery-size2';
if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
}
else if ( get_query_var('page') ) {
	$paged = get_query_var('page');
}
else {
	$paged = 1;
}

$args = array(
	'post_type'      	=> 'tripfery_booking',
	'posts_per_page' 	=> $data['number'],
	'order' 			=> $data['post_ordering'],
	'orderby' 			=> $data['post_orderby'],
	'paged' 			=> $paged
);

if ( !empty( $data['cat'] ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'tripfery_booking_category',
			'field' => 'term_id',
			'terms' => $data['cat'],
		)
	);
}

$query = new WP_Query( $args );
$temp = TripferyTheme_Helper::wp_set_temp_query( $query );
?>
<div class="rt-booking-default rt-booking-multi-layout-6 booking-grid-<?php echo esc_attr( $data['style'] );?>">
	<div class="row rt-booking-grid <?php echo esc_attr( $data['item_space'] );?>">
		<?php $m = $data['delay']; $n = $data['duration']; 
		$count = 1;
			if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
			$query->the_post();
			$id            	= get_the_id();
			if ( $data['contype'] == 'content' ) {
				$content = apply_filters( 'the_content', get_the_content() );
			}
			else {
				$content = apply_filters( 'the_excerpt', get_the_excerpt() );;
			}
			$content = wp_trim_words( $content, $data['count'], '' );
			$content = "$content";

			
		?>
		<div class="grid-item grid-item-<?php echo esc_attr($count) ?>">
		<div class="<?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $m );?>s" data-wow-duration="<?php echo esc_attr( $n );?>s">
			<div class="booking-item">
				<div class="booking-figure">
					<a aria-label="Locations" href="<?php the_permalink(); ?>">
						<?php
							if ( has_post_thumbnail() ){
								the_post_thumbnail( $thumb_size, ['class' => 'img-fluid width-100'] );
							} else {
								if ( !empty( TripferyTheme::$options['no_preview_image']['id'] ) ) {
									echo wp_get_attachment_image( TripferyTheme::$options['no_preview_image']['id'], $thumb_size );
								} else {
									echo '<img class="wp-post-image" src="' . TripferyTheme_Helper::get_img( 'noimage_960X520.jpg' ) . '" alt="'.get_the_title().'" loading="lazy" >';
								}
							}
						?>
					</a>			
				</div>
				<div class="booking-content port-hover-effect">
					<div class="content-info">
						<h3 class="entry-title"><a aria-label="Locations" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
						<?php if ( $data['category_display']  == 'yes' ) { ?>
						<span class="booking-cat"><?php
							$i = 1;
							$term_lists = get_the_terms( get_the_ID(), 'tripfery_booking_category' );
							if( $term_lists ) {
							foreach ( $term_lists as $term_list ){ 
							$link = get_term_link( $term_list->term_id, 'tripfery_booking_category' ); ?><?php if ( $i > 1 ){ echo esc_html( ', ' ); } ?><a aria-label="Locations" href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $term_list->name ); ?></a><?php $i++; } } ?>
						</span>
						<?php } ?>
						<?php if ( $data['content_display']  == 'yes' ) { ?>
						<p><?php echo wp_kses( $content , 'alltext_allow' ); ?></p>
						<?php } ?>
					</div>
					<?php if ( $data['action_display']  == 'yes' ) { ?>
					<div class="content-action">
						<a aria-label="Locations" href="<?php the_permalink();?>"><i class="icon-tripfery-right-arrow"></i></a>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		</div>
			<?php
			$count++;
			 $m = $m + 0.2; $n = $n + 0.1; } ?>
		<?php } ?>
	</div>
	<?php if ( $data['more_button'] == 'show' ) { ?>
		<?php if ( !empty( $data['see_button_text'] ) ) { ?>
		<div class="booking-button"><a class="button-style-2 btn-common" aria-label="Locations" href="<?php echo esc_url( $data['see_button_link'] );?>"><?php echo esc_html( $data['see_button_text'] );?><i class="icon-tripfery-right-arrow"></i></a></div>
		<?php } ?>
	<?php } else { ?>
		<?php TripferyTheme_Helper::pagination(); ?>
	<?php } ?>
	<?php TripferyTheme_Helper::wp_reset_temp_query( $temp ); ?>
</div>