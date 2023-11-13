<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
extract($data);
if (class_exists('BABE_Functions')) {
	 ?>
	<div class="rt-booking-rating <?php echo esc_attr($data['animation']); ?> <?php echo esc_attr($data['animation_effect']); ?>" data-wow-delay="0.6s" data-wow-duration="1.4s">
		<?php
			echo BABE_Rating::post_stars_rendering(get_the_ID());
		?>
	</div>
<?php } 
?>