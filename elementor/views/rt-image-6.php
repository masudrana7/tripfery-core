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

function radius_about_shape() {
    return '<svg width="133" height="82" viewBox="0 0 133 82" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 82C97.6084 82 95.2945 81.5534 93.0583 80.6603C90.8102 79.7671 88.9387 78.5763 87.4439 77.0878L4.93273 -5.08016C1.64424 -8.35497 0 -12.5229 0 -17.584C0 -22.6451 1.64424 -26.813 4.93273 -30.0878C8.22122 -33.3626 12.4066 -35 17.4888 -35C22.571 -35 26.7564 -33.3626 30.0448 -30.0878L100 39.5763L169.955 -30.0878C173.244 -33.3626 177.429 -35 182.511 -35C187.593 -35 191.779 -33.3626 195.067 -30.0878C198.356 -26.813 200 -22.6451 200 -17.584C200 -12.5229 198.356 -8.35497 195.067 -5.08016L112.556 77.0878C110.762 78.874 108.819 80.1363 106.726 80.8746C104.634 81.6249 102.392 82 100 82Z" fill="white"></path></svg>';
}

?>

<div class="rt-image-banner rt-banner-<?php echo esc_attr( $data['style'] );?>">
	<div class="rt-banner-item <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $data['delay'] );?>s" data-wow-duration="<?php echo esc_attr( $data['duration'] );?>s">
		<div class="rt-image">
			<?php echo wp_kses_post($getimg);?>
			<div class="shape">
				<div class="icon icon1"><?php echo radius_about_shape(); ?></div>
				<div class="icon icon2"><?php echo radius_about_shape(); ?></div>
				<div class="icon icon3"><?php echo radius_about_shape(); ?></div>
				<div class="icon icon4"><?php echo radius_about_shape(); ?></div>
				<div class="icon icon5"><?php echo radius_about_shape(); ?></div>
				<div class="icon icon6"><?php echo radius_about_shape(); ?></div>
				<div class="icon icon7"><?php echo radius_about_shape(); ?></div>
			</div>
			<div class="dot-shape"><?php echo wp_kses_post($getimg2);?></div>
		</div>
	</div>
</div>