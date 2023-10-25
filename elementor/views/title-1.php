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
<div class="rt-section-title has-animation <?php echo esc_attr( $data['style'] ); ?>">
	<div class="title-holder">		
		<?php if( !empty ( $data['sub_title'] ) ) { ?>
		<div class="sub-title <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="0.2s" data-wow-duration="1.4s"><?php echo wp_kses_post( $data['sub_title'] ); ?>
		<?php if( $data['display_line'] ) { ?><span class="line"></span><?php } ?></div>
		<?php } ?>
		<?php if( !empty ( $data['title'] ) ) { ?>
		<<?php echo esc_attr( $data['heading_size'] ); ?> class="entry-title <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="0.6s" data-wow-duration="1.4s"><?php echo wp_kses_post( $data['title'] ); ?></<?php echo esc_attr( $data['heading_size'] ); ?>>
		<?php } ?>		
	</div>
</div>
