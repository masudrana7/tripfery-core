<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use Elementor\Utils;
extract($data);
?>
<div class="rt-section-title has-animation">
	<div class="title-holder">	
		<<?php echo esc_attr( $data['heading_size'] ); ?> class="entry-title <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="0.6s" data-wow-duration="1.4s">
		<?php echo the_title(); ?>
		</<?php echo esc_attr( $data['heading_size'] ); ?>>
	</div>
</div>
