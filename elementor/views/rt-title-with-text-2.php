<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;

?>
<div class="rt-title-text has-animation title-text-<?php echo esc_attr( $data['style'] ); ?>">
	<?php if ( !empty( $data['sub_title'] ) ) { ?>
		<div class="entry-subtitle <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="0.2s" data-wow-duration="1.2s"><?php echo wp_kses_post( $data['sub_title'] );?><?php if( $data['display_line'] ) { ?><span class="line"></span><?php } ?></div>
	<?php } ?>
	<?php if ( !empty( $data['title'] ) ) { ?>
		<<?php echo esc_attr( $data['heading_size'] ); ?> class="entry-title <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="0.4s" data-wow-duration="1.2s"><?php echo wp_kses_post( $data['title'] );?></<?php echo esc_attr( $data['heading_size'] ); ?>>		
	<?php } ?>
    <?php if( !empty ( $data['shadow_title'] ) ) { ?>
	<div class="shadow-title-wrap <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="0.6s" data-wow-duration="1.2s">
		<div class="shadow-title">
		<?php if ( $data['shape_display']  == 'yes' ) { ?>
			<svg width="74" height="74" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M40.1007 3.10073C40.1007 1.38825 38.7125 0 37 0C35.2875 0 33.8993 1.38824 33.8993 3.10073V70.8993C33.8993 72.6118 35.2875 74 37 74C38.7125 74 40.1007 72.6118 40.1007 70.8993V3.10073Z" fill="#FE5716"/>
				<path d="M70.8993 40.1007C72.6118 40.1007 74 38.7125 74 37C74 35.2875 72.6118 33.8993 70.8993 33.8993H3.10073C1.38825 33.8993 0 35.2875 0 37C0 38.7125 1.38824 40.1007 3.10073 40.1007H70.8993Z" fill="#FE5716"/>
				<path d="M58.7785 63.1656C59.9894 64.3765 61.9527 64.3765 63.1636 63.1656C64.3745 61.9547 64.3745 59.9914 63.1636 58.7805L15.2228 10.8397C14.0119 9.62878 12.0486 9.62879 10.8377 10.8397C9.6268 12.0506 9.6268 14.0139 10.8377 15.2248L58.7785 63.1656Z" fill="#FE5716"/>
				<path d="M10.8397 58.7785C9.62878 59.9894 9.62878 61.9527 10.8397 63.1636C12.0506 64.3745 14.0139 64.3745 15.2248 63.1636L63.1656 15.2228C64.3765 14.0119 64.3765 12.0486 63.1656 10.8377C61.9547 9.6268 59.9914 9.62681 58.7805 10.8377L10.8397 58.7785Z" fill="#FE5716"/>
			</svg><?php } ?><?php echo wp_kses_post( $data['shadow_title'] ); ?>
		</div>
	</div>
    <?php } ?>
	<div class="entry-content <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="0.8s" data-wow-duration="1.2s"><?php echo wp_kses_post( $data['content'] );?></div>

	<?php if ( $data['feature_display']  == 'yes' ) { ?>
	<ul class="feature-list <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="1s" data-wow-duration="1.2s">
	  <?php foreach ($data['list_feature'] as $feature): ?>
		<li>
		  <?php
		  extract($feature);
			$final_icon_class       = "";
			$final_icon_image_url   = '';
			if ( is_string( $list_icon_class['value'] ) && $dynamic_icon_class =  $list_icon_class['value']  ) {
			  $final_icon_class     = $dynamic_icon_class;
			}
			if ( is_array( $list_icon_class['value'] ) ) {
			  $final_icon_image_url = $list_icon_class['value']['url'];
			}
		  ?>
		  <?php if ($data['has_icon'] == 'yes'): ?>
			<?php if ( $final_icon_image_url ): ?>
			  <img src="<?php echo esc_url( $final_icon_image_url ); ?>" alt="SVG Icon">
			<?php else: ?>
			  <i style="color: <?php echo esc_attr( $list_icon_color ); ?>"  class="<?php echo esc_attr( $final_icon_class ); ?>"></i><?php endif ?><?php endif ?><?php echo esc_html( $feature['list_text'] ); ?>
		</li>
	  <?php endforeach ?>
	</ul>	
	<?php } ?>
</div>