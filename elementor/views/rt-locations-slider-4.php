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

$thumb_size  = 'tripfery-size5';

$args = array(
	'post_type'      	=> 'tripfery_booking',
	'posts_per_page' 	=> $data['number'],
	'order' 			=> $data['post_ordering'],
	'orderby' 			=> $data['post_orderby'],
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

?>
<div class="rt-booking-default rt-booking-multi-layout-5 booking-slider-<?php echo esc_attr( $data['style'] );?> <?php echo esc_attr( $data['nav_position'] ) ?>">
	<div class="rt-swiper-slider swiper-slider rt-swiper-nav" data-xld ="<?php echo esc_attr( $data['swiper_data'] );?>">
		<div class="swiper-wrapper">
		<?php $m = $data['delay']; $n = $data['duration'];
			if ( $query->have_posts() ) :?>
			<?php while ( $query->have_posts() ) : $query->the_post();?>
				<?php
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
				<div class="booking-item swiper-slide <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $m );?>s" data-wow-duration="<?php echo esc_attr( $n );?>s">
					<div class="booking-figure">
						<a aria-label="Locations" href="<?php the_permalink(); ?>">
							<?php
								if ( has_post_thumbnail() ){
									the_post_thumbnail( $thumb_size, ['class' => 'img-fluid width-100'] );
								} else {
									if ( !empty( TripferyTheme::$options['no_preview_image']['id'] ) ) {
										echo wp_get_attachment_image( TripferyTheme::$options['no_preview_image']['id'], $thumb_size );
									} else {
										echo '<img class="wp-post-image" src="' . TripferyTheme_Helper::get_img( 'noimage_480X480.jpg' ) . '" alt="'.get_the_title().'" loading="lazy" >';
									}
								}
							?>
						</a>			
					</div>
					<div class="booking-content">
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
			<?php $m = $m + 0.2; $n = $n + 0.1; endwhile;?>
		<?php endif;?>
		<?php wp_reset_postdata();?>
		</div>
		<?php if($data['display_arrow']=='yes'){  ?>
        <div class="swiper-navigation">
            <div class="swiper-button-prev"><i class="icon-tripfery-left-arrow"></i><?php echo esc_html__( 'Prev' , 'tripfery' ) ?></div>
		    <div class="swiper-button-next"><?php echo esc_html__( 'Next' , 'tripfery' ) ?><i class="icon-tripfery-right-arrow"></i></div>
        </div>
        <?php } if($data['display_buttet']=='yes') { ?>
        <div class="swiper-pagination"></div>
        <?php } ?>
	</div>
</div>