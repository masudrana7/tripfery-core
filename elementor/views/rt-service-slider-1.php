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

$args = array(
	'post_type'      	=> 'tripfery_service',
	'posts_per_page' 	=> $data['number'],
	'order' 			=> $data['post_ordering'],
	'orderby' 			=> $data['post_orderby'],
);

if ( !empty( $data['cat'] ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'tripfery_service_category',
			'field' => 'term_id',
			'terms' => $data['cat'],
		)
	);
}

$query = new WP_Query( $args );

?>
<div class="rt-service-default rt-service-layout-1 service-slider-<?php echo esc_attr( $data['style'] );?>">
	<div class="rt-swiper-slider swiper-slider rt-swiper-nav" data-xld ="<?php echo esc_attr( $data['swiper_data'] );?>">
		<div class="swiper-wrapper">
		<?php $m = 1; $i = $data['delay']; $j = $data['duration']; 
			if ( $query->have_posts() ) :?>
			<?php while ( $query->have_posts() ) : $query->the_post();?>
				<?php
				$id            	= get_the_id();
				$tripfery_service_icon= get_post_meta( get_the_ID(), 'tripfery_service_icon', true );
				$icon_class 			= '' ;
				if ( empty( $tripfery_service_icon ) ) {
					$icon_class 		= ' no-icon';	
				}

				if ( $data['contype'] == 'content' ) {
					$content = apply_filters( 'the_content', get_the_content() );
				}
				else {
					$content = apply_filters( 'the_excerpt', get_the_excerpt() );;
				}
				$content = wp_trim_words( $content, $data['count'], '' );
				$content = "$content";
				?>

				<div class="swiper-slide <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $i );?>s" data-wow-duration="<?php echo esc_attr( $j );?>s">
					<div class="service-item <?php if( $data['hover_animation'] == 'yes' ) { ?>hover-animation<?php } ?> <?php if( $data['active_hover'] == 'yes' && $m == 1 ) { ?>hover-animation-active<?php } ?> <?php echo esc_attr( $icon_class ); ?>">
						<div class="service-content">
							<?php if ( !empty( $tripfery_service_icon ) && $data['icon_display']  == 'yes' ) { ?>
							<div class="service-icon"><i class="<?php echo wp_kses( $tripfery_service_icon , 'alltext_allow' );?>"></i></div>
							<?php } ?>
							<h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
							<?php if ( $data['content_display']  == 'yes' ) { ?>
							<div class="service-text"><?php echo wp_kses( $content , 'alltext_allow' ); ?></div>
							<?php } if ( $data['action_display']  == 'yes' ) { ?>
							<div class="service-action"><a class="button-style-3 btn-common" href="<?php the_permalink();?>"><?php esc_html_e( 'See Details', 'tripfery' );?><i class="icon-tripfery-right-arrow"></i></a>
				      		</div>	
							<?php } ?>
						</div>
					</div>
				</div>
			<?php $i = $i + 0.2; $j = $j + 0.1; $m++; endwhile;?>
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