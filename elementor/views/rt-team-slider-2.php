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

$thumb_size  = 'tripfery-size8';
$args = array(
	'post_type'      	=> 'tripfery_team',
	'posts_per_page' 	=> $data['number'],
	'order' 			=> $data['post_ordering'],
	'orderby' 			=> $data['post_orderby'],
);

if ( !empty( $data['cat'] ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'tripfery_team_category',
			'field' => 'term_id',
			'terms' => $data['cat'],
		)
	);
}

$query = new WP_Query( $args );

?>
<div class="rt-team-default rt-team-multi-layout-2 team-slider-<?php echo esc_attr( $data['style'] );?> <?php echo esc_attr( $data['nav_position'] ) ?>">
	<div class="rt-swiper-slider swiper-slider rt-swiper-nav" data-xld ="<?php echo esc_attr( $data['swiper_data'] );?>">
		<div class="swiper-wrapper">
		<?php $i = $data['delay']; $j = $data['duration']; 
			if ( $query->have_posts() ) :?>
			<?php while ( $query->have_posts() ) : $query->the_post();?>
				<?php
				$id            	= get_the_id();
				$position   	= get_post_meta( $id, 'tripfery_team_position', true );
				$socials       	= get_post_meta( $id, 'tripfery_team_socials', true );
				$social_fields 	= TripferyTheme_Helper::team_socials();
				if ( $data['contype'] == 'content' ) {
					$content = apply_filters( 'the_content', get_the_content() );
				}
				else {
					$content = apply_filters( 'the_excerpt', get_the_excerpt() );;
				}
				$content = wp_trim_words( $content, $data['count'], '' );
				$content = "<p>$content</p>";
				?>
				<div class="team-item swiper-slide <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $i );?>s" data-wow-duration="<?php echo esc_attr( $j );?>s">
					<div class="team-content-wrap">		
						<div class="team-thums">
							<a href="<?php the_permalink();?>">
								<?php
								if ( has_post_thumbnail() ){
									the_post_thumbnail( $thumb_size );
								}
								else {
									if ( !empty( TripferyTheme::$options['no_preview_image']['id'] ) ) {
										echo wp_get_attachment_image( TripferyTheme::$options['no_preview_image']['id'], $thumb_size );
									}
									else {
										echo '<img class="wp-post-image " src="' . TripferyTheme_Helper::get_img( 'noimage_480X480.jpg' ) . '" alt="'.get_the_title().'">';
									}
								}
								?>
							</a>
						</div>
						<div class="team-content">					
							<h3 class="team-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
							<?php if ( $data['designation_display']  == 'yes' ) { ?>
							<div class="team-designation"><?php echo esc_html( $position );?></div>
							<?php } ?>
							<?php if ( $data['content_display']  == 'yes' ) { ?>
							<p><?php echo wp_kses( $content , 'alltext_allow' ); ?></p>
							<?php } ?>
						</div>
						<?php if ( !empty( $socials ) && $data['social_display']  == 'yes' ) { ?>
							<ul class="team-social">
								<li class="social-item"><a href="#" class="social-hover-icon social-link" aria-label="Social Share"><i class="icon-tripfery-share"></i></a>
									<ul class="team-social-dropdown">
										<?php foreach ( $socials as $key => $social ): ?>
											<?php if ( !empty( $social ) ): ?>
												<li class="social-item"><a class="social-link" target="_blank" href="<?php echo esc_url( $social );?>"><i class="fab <?php echo esc_attr( $social_fields[$key]['icon'] );?>" aria-hidden="true"></i></a></li>
											<?php endif; ?>
										<?php endforeach; ?>
									</ul>
								</li>
							</ul>
						<?php } ?>
					</div>
				</div>
			<?php $i = $i + 0.2; $j = $j + 0.1; endwhile;?>
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