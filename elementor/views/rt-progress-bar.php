<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;

?>
<div class="rt-progress-bar counter-appear">
	<h3 class="entry-name"><?php echo esc_html( $data['title'] );?></h3>
	<div class="progress">
		<div class="progress-bar wow slideInLeft skill-per" data-wow-delay="0s" data-wow-duration="3s" data-progress="<?php echo esc_attr( $data['number']['size'] );?>%" style="height:<?php echo esc_html( $data['number_height'] );?>px; width: <?php echo esc_attr( $data['number']['size'] );?>%; animation-name: slideInLeft;"> <span><?php echo esc_html( $data['number']['size'] );?>%</span></div>
	</div>
</div>