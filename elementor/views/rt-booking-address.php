<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
extract($data);
if (class_exists('BABE_Functions')) {
	$ba_address 	= BABE_Post_types::get_post(get_the_ID());
	$address = isset($ba_address['address']) ? $ba_address['address'] : false;
?>
	<div class="rt-booking-address <?php echo esc_attr($data['animation']); ?> <?php echo esc_attr($data['animation_effect']); ?>" data-wow-delay="0.6s" data-wow-duration="1.4s">
		<?php $address = isset($ba_address['address']) ? $ba_address['address'] : false;
		if ($address) {  ?>
			<span class="address-icon"><i class="icon-tripfery-map-iocn"></i></span>
			<span class="address-text"><?php echo esc_html($address['address']); ?></span>
		<?php } ?>
	</div>
<?php }
?>