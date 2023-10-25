<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use Elementor\Group_Control_Image_Size;

?>

<div class="rt-shape-layout rt-shape-<?php echo esc_attr( $data['style'] );?> <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $data['delay'] );?>s" data-wow-duration="<?php echo esc_attr( $data['duration'] );?>s">	

    <?php if( $data['style'] == 'style1' ) { ?>
	<div class="rt-shape-item" 
        style="position: <?php echo esc_attr( $data['position'] );?>;
            --tripfery-shape:url(<?php echo esc_url($data['shape_one']['url']); ?>);">
	</div>
    <?php } if( $data['style'] == 'style2' ) { 
        $getimg = Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size', 'shape_one' );
        ?>
        <div class="rt-shape-item" style="position: <?php echo esc_attr( $data['position'] );?>"><span class="rt-img fa-spin" style="animation-duration: 10s"><?php echo wp_kses_post($getimg);?></span></div>
    <?php } ?>
</div>