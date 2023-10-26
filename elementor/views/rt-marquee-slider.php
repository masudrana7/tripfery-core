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

extract($data);
if( $data['rt_image']['url'] ) {
	$tripfery_bg = 'url(' . $data['rt_image']['url'] . ')' ;
} else {
	$tripfery_img_url = TRIPFERY_ASSETS_URL . 'img/marque_bg.jpg';
	$tripfery_bg = 'url(' . $tripfery_img_url . ')';
}

?>
<?php if( $data['style'] == 'style1' ) { ?>
<div class="rt-marquee-slider marquee-slider-1">
	<div class="rt-marquee <?php echo esc_attr( $data['marquee_direction'] );?>">
		<div class="rt-marquee-item">
			<?php foreach ( $data['marquee_slide'] as $marquee_slides ): ?>
			<h3 class="entry-title"><a href="<?php echo esc_url( $marquee_slides['url'] );?>" target="_blank" style="background-image: <?php echo esc_html( $tripfery_bg ); ?>"><?php echo wp_kses_post( $marquee_slides['title'] ); ?></a></h3>
			<?php endforeach; ?> 
		</div>
		<div class="rt-marquee-item">
			<?php foreach ( $data['marquee_slide'] as $marquee_slides ): ?>
			<h3 class="entry-title"><a href="<?php echo esc_url( $marquee_slides['url'] );?>" target="_blank" style="background-image: <?php echo esc_html( $tripfery_bg ); ?>"><?php echo wp_kses_post( $marquee_slides['title'] ); ?></a></h3>
			<?php endforeach; ?> 
		</div>
	</div>
</div>
<?php } if( $data['style'] == 'style2' ) { ?>
<div class="rt-marquee-slider marquee-slider-2" style="background-image: <?php echo esc_html( $tripfery_bg ); ?>">
	<div class="rt-marquee <?php echo esc_attr( $data['marquee_direction'] );?>">
		<div class="rt-marquee-item">
			<?php foreach ( $data['marquee_slide'] as $marquee_slides ): ?>
			<h3 class="entry-title"><a href="<?php echo esc_url( $marquee_slides['url'] );?>" target="_blank"><?php echo wp_kses_post( $marquee_slides['title'] ); ?></a></h3>
			<?php endforeach; ?> 
		</div>
		<div class="rt-marquee-item">
			<?php foreach ( $data['marquee_slide'] as $marquee_slides ): ?>
			<h3 class="entry-title"><a href="<?php echo esc_url( $marquee_slides['url'] );?>" target="_blank">
			<?php echo wp_kses_post( $marquee_slides['title'] ); ?></a></h3>
			<?php endforeach; ?> 
		</div>
	</div>
</div>
<?php } ?>