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

$getimg = Group_Control_Image_Size::get_attachment_image_html( $data, 'image_size', 'rt_image' );
$getimg2 = Group_Control_Image_Size::get_attachment_image_html( $data, 'image_size', 'rt_image2' );

?>

<div class="rt-image-banner rt-banner-<?php echo esc_attr( $data['style'] );?>">
	<div class="rt-banner-item <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $data['delay'] );?>s" data-wow-duration="<?php echo esc_attr( $data['duration'] );?>s">
		<div class="rt-image">
			<?php echo wp_kses_post($getimg);?>
			<span class="shape"></span>
			<div class="dot-shape"><?php echo wp_kses_post($getimg2);?></div>
		</div>
	</div>
</div>
