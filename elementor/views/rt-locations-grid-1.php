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
	'post_type'      	=> 'tripfery_locations',
	'posts_per_page' 	=> $data['number'],
	'order' 			=> $data['post_ordering'],
	'orderby' 			=> $data['post_orderby'],
	'paged' 			=> $paged
);

if ( !empty( $data['cat'] ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'tripfery_locations_category',
			'field' => 'term_id',
			'terms' => $data['cat'],
		)
	);
}

$query = new WP_Query( $args );
$temp = TripferyTheme_Helper::wp_set_temp_query( $query );
$col_class = "col-xl-{$data['col_xl']} col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-xs-{$data['col_xs']}";

?>
<div class="rt-locations-default rt-locations-layout-1 locations-grid-<?php echo esc_attr( $data['style'] );?>">
	<div class="row <?php echo esc_attr( $data['item_space'] );?>">

		<div class="cards-row d-flex">
			<?php $m = $data['delay']; $n = $data['duration']; 
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
				$thumbnail_url ="";
				if ( has_post_thumbnail() ) {
					$thumbnail_url = get_the_post_thumbnail_url();
				}

				global $post;
				$tripfery_location_activities 	= get_post_meta( $post->ID, 'tripfery_location_activities', true );
				$tripfery_location_cars 		= get_post_meta( $post->ID, 'tripfery_location_cars', true );
				$tripfery_location_hotel 		= get_post_meta( $post->ID, 'tripfery_location_hotel', true );
				$tripfery_location_tours 		= get_post_meta( $post->ID, 'tripfery_location_tours', true );
				$tripfery_location_rentals 		= get_post_meta( $post->ID, 'tripfery_location_rentals', true );

			?>

				<div class="panel <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $m );?>s" data-wow-duration="<?php echo esc_attr( $n );?>s" style="background-image: url('<?php echo esc_attr($thumbnail_url);?>')">
					<h3 class="panel-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
					<div class="panel-content">
						<ul class="d-flex flex-wrap justify-content-center feature-list">


							<?php if ( !empty( $tripfery_location_activities ) ) { ?>
								<li><span class="feature-name"><?php echo esc_html( $tripfery_location_activities );?></span></li>
							<?php } ?>

							<?php if ( !empty( $tripfery_location_cars ) ) { ?>
								<li><span class="feature-name"><?php echo esc_html( $tripfery_location_cars );?></span></li>
							<?php } ?>

							<?php if ( !empty( $tripfery_location_hotel ) ) { ?>
								<li><span class="feature-name"><?php echo esc_html( $tripfery_location_hotel );?></span></li>
							<?php } ?>

							<?php if ( !empty( $tripfery_location_tours ) ) { ?>
								<li><span class="feature-name"><?php echo esc_html( $tripfery_location_tours );?></span></li>
							<?php } ?>

							<?php if ( !empty( $tripfery_location_rentals ) ) { ?>
								<li><span class="feature-name"><?php echo esc_html( $tripfery_location_rentals );?></span></li>
							<?php } ?>
							
						</ul>
					</div>
				</div>
				<?php $m = $m + 0.2; $n = $n + 0.1; } ?>
			<?php } ?>
			</div>
	</div>
	<?php if ( $data['more_button'] == 'show' ) { ?>
		<?php if ( !empty( $data['see_button_text'] ) ) { ?>
		<div class="locations-button"><a class="button-style-2 btn-common" aria-label="Locations" href="<?php echo esc_url( $data['see_button_link'] );?>"><?php echo esc_html( $data['see_button_text'] );?></a></div>
		<?php } ?>
	<?php } else { ?>
		<?php TripferyTheme_Helper::pagination(); ?>
	<?php } ?>
	<?php TripferyTheme_Helper::wp_reset_temp_query( $temp ); ?>
</div>