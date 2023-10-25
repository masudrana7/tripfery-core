<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use Elementor\Group_Control_Image_Size;

$attr = '';
if ( !empty( $data['buttonurl']['url'] ) ) {
    $attr  = 'href="' . $data['buttonurl']['url'] . '"';
    $attr .= !empty( $data['buttonurl']['is_external'] ) ? ' target="_blank"' : '';
    $attr .= !empty( $data['buttonurl']['nofollow'] ) ? ' rel="nofollow"' : '';
}

// image
$getimg = Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size', 'cta_image' );

?>
<div class="rt-call-action">
	<div class="rt-action-item">
		<?php if( !empty( $getimg ) ) { ?>
		<div class="rt-action-img"><?php echo wp_kses_post($getimg);?></div><?php } ?>
		<h3 class="rt-title"><?php echo wp_kses_post( $data['title'] ) ?></h3>
		<?php if( !empty( $data['phone'] ) ) { ?>
		<h4 class="rt-phone"><?php if( $data['phone_label'] ) { ?><span><?php echo esc_html( $data['phone_label'] );?></span><?php } ?><a href="tel:<?php echo esc_attr( $data['phone'] );?>"><?php echo wp_kses_post( $data['phone'] ) ?></a></h4><?php } ?>
		<?php if( !empty( $data['buttontext'] ) ) { ?>
		<a class="button-link button-<?php echo esc_attr( $data['button_style'] ); ?> btn-common" <?php echo $attr; ?>><?php echo esc_html( $data['buttontext'] );?><i class="icon-tripfery-right-arrow"></i></a><?php } ?>
	</div>
</div>