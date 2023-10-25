<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use TripferyTheme_Helper;

?>
<div class="rt-video-layout rt-video-<?php echo esc_attr( $data['style'] ) ?>">
	<div class="rt-video <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $data['delay'] );?>s" data-wow-duration="<?php echo esc_attr( $data['duration'] );?>s">
		<div class="rt-img">
			<div class="rt-icon">			
				<a class="rt-play <?php echo esc_attr( $data['video_layout'] );?> rt-video-popup" aria-label="Video Popup" href="<?php echo esc_url( $data['videourl']['url'] );?>"><i class="icon-tripfery-play"></i></a>
			</div>
		</div>		
	</div>
</div>