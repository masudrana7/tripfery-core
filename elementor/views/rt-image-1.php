<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;

use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
extract($data);

$attr = '';
if ( !empty( $data['url']['url'] ) ) {
	$attr  = 'href="' . $data['url']['url'] . '"';
	$attr .= !empty( $data['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['url']['nofollow'] ) ? ' rel="nofollow"' : '';
	
}
//image
if ( $attr ) {
  $getimg = '<a ' . $attr . '>' .Group_Control_Image_Size::get_attachment_image_html( $data, 'image_size' , 'rt_image' ).'</a>';
}
else {
	$getimg = Group_Control_Image_Size::get_attachment_image_html( $data, 'image_size', 'rt_image' );
}

?>

<div class="rt-image-banner rt-banner-<?php echo esc_attr( $data['style'] );?>">
	<div class="rt-banner-item <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $data['delay'] );?>s" data-wow-duration="<?php echo esc_attr( $data['duration'] );?>s">
		<div class="rt-image bouncing-bubble-animation"><?php echo wp_kses_post($getimg);?></div>
	</div>
</div>