<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use NiftricTheme;
use NiftricTheme_Helper;
use \WP_Query;

?>
<div class="rt-logo-default rt-logo-slider rt-swiper-nav">
	<div class="rt-swiper-slider" data-xld ="<?php echo esc_attr( $data['swiper_data'] );?>">
		<div class="swiper-wrapper">
		<?php $i = $data['delay']; $j = $data['duration']; ?>
			<?php foreach ( $data['logos'] as $logo ): ?>
				<?php if ( empty( $logo['image']['id'] ) ) continue; ?>
				<div class="swiper-slide">
					<div class="logo-box <?php echo esc_attr( $data['logo_color_mode'] );?> <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $i );?>s" data-wow-duration="<?php echo esc_attr( $j );?>s">	
						<?php if ( !empty( $logo['url'] ) ): ?>
							<a href="<?php echo esc_url( $logo['url'] );?>" target="_blank"><?php echo wp_get_attachment_image( $logo['image']['id'], 'full' )?></a>
						<?php else: ?>
							<?php echo wp_get_attachment_image( $logo['image']['id'], 'full' )?>
						<?php endif; ?>
						<?php if ( !empty($logo['title']) ) { ?>
							<h3 class="entry-title"><?php echo wp_kses_post( $logo['title'] ); ?></h3>				
						<?php } ?>
					</div>
				</div>
			<?php $i = $i + 0.2; $j = $j + 0.01; endforeach; ?> 
		</div>
		<?php if ( $data['display_arrow'] == 'yes' ) { ?>
			<div class="swiper-navigation">
	            <div class="swiper-button-prev"><i class="icon-tripfery-left-arrow"></i><?php echo esc_html__( 'Prev' , 'tripfery' ) ?></div>
		    	<div class="swiper-button-next"><?php echo esc_html__( 'Next' , 'tripfery' ) ?><i class="icon-tripfery-right-arrow"></i></div>
	        </div>
		<?php } ?>
		<?php if ( $data['display_buttet'] == 'yes' ) { ?>
			<div class="swiper-pagination"></div>
		<?php } ?>
	</div>
</div>