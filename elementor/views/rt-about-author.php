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

$getimg = Group_Control_Image_Size::get_attachment_image_html( $data, 'image_size', 'rt_image' );
$getimg2 = Group_Control_Image_Size::get_attachment_image_html( $data, 'image_size', 'rt_image2' );

?>

<div class="rt-about-author">
	<div class="rt-about-item <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $data['delay'] );?>s" data-wow-duration="<?php echo esc_attr( $data['duration'] );?>s">
		<div class="rt-author"><?php echo wp_kses_post($getimg);?></div>
		<div class="rt-content">
			<div class="rt-signature"><?php echo wp_kses_post($getimg2);?></div>
			<h3 class="rt-title"><?php echo wp_kses_post( $data['title'] );?></h3>
			<?php if( $designation ) { ?><h4 class="rt-designation"><?php echo wp_kses_post( $data['designation'] );?></h4><?php } ?>
		</div>
	</div>
</div>
