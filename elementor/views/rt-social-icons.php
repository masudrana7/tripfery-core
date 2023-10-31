<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use Elementor\Icons_Manager;



?>
<div class="rt-social-links">
	<div class="rt-social-item">		
		<?php foreach ( $data['social_icon_list'] as $social_icons ): 
			$attr = '';
	        if ( !empty( $social_icons['link']['url'] ) ) {
	            $attr  = 'href="' . $social_icons['link']['url'] . '"';
	            $attr .= !empty( $social_icons['link']['is_external'] ) ? ' target="_blank"' : '';
	            $attr .= !empty( $social_icons['link']['nofollow'] ) ? ' rel="nofollow"' : '';
	        }
		?>
		<div class="rt-social">
			<a aria-label="Social Link" class="<?php echo wp_kses_post( $social_icons['title'] ); ?>" <?php echo $attr; ?> ><?php Icons_Manager::render_icon( $social_icons['social_icon'] ); ?><?php echo wp_kses_post( $social_icons['title'] ); ?></a>
		</div>
		<?php endforeach; ?> 
	</div>
</div>