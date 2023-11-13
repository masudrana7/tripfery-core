<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
extract($data);
if (class_exists('BABE_Functions')) {
	$ba_info 	= BABE_Post_types::get_post(get_the_ID());
	if (!isset($ba_info['discount_price_from']) || !isset($ba_info['price_from']) || !isset($ba_info['discount_date_to']) || !isset($ba_info['discount'])) {
		$price = BABE_Post_types::get_post_price_from($ba_info['ID']);
	} else {
		$price = $ba_info;
	}
?>
	<div class="rt-booking-preice <?php echo esc_attr($data['animation']); ?> <?php echo esc_attr($data['animation_effect']); ?>" data-wow-delay="0.6s" data-wow-duration="1.4s">
		<?php
		if ($price) { ?>
			<div class="rt-price-item">
				<?php if ($price['discount_price_from'] < $price['price_from']) { ?>
					<div class="rt-old-price">
						<?php echo BABE_Currency::get_currency_price($price['price_from']); ?>
					</div>
				<?php }else{ ?>
					<div class="rt-new-price">
						<?php echo BABE_Currency::get_currency_price($price['discount_price_from']); ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
<?php }
?>