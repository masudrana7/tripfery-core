<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
extract($data);

$attr = '';
if ( !empty( $data['buttonurl']['url'] ) ) {
	$attr  = 'href="' . $data['buttonurl']['url'] . '"';
	$attr .= !empty( $data['buttonurl']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['buttonurl']['nofollow'] ) ? ' rel="nofollow"' : '';
	$title = '<a ' . $attr . '>' . $data['title'] . '</a>';
	
}
else {
	$title = $data['title'];
}

// icon , image
if ( $attr ) {
  $getimg = '<a ' . $attr . '>' .Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size' , 'icon_image' ).'</a>';
}
else {
	$getimg = Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size', 'icon_image' );
}

$final_icon_class       = " fas fa-thumbs-up";
$final_icon_image_url   = '';
if ( is_string( $icon_class['value'] ) && $dynamic_icon_class =  $icon_class['value']  ) {
  $final_icon_class     = $dynamic_icon_class;
}
if ( is_array( $icon_class['value'] ) ) {
  $final_icon_image_url = $icon_class['value']['url'];
}

?>
<div class="rt-info-box rt-info-<?php echo esc_attr( $data['style'] );?> <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $data['delay'] );?>s" data-wow-duration="<?php echo esc_attr( $data['duration'] );?>s">
	<div class="rt-info-item media-<?php echo esc_attr( $data['icontype'] );?> <?php if( $data['hover_animation'] == 'yes' ) { ?>hover-animation<?php } ?> <?php if( $data['active_hover'] == 'yes') { ?>hover-animation-active<?php } ?>">		
		<div class="rt-media">
			<?php
				if (!empty($data['icontype']) && $data['icontype'] == 'image') {
					echo '<span class="rt-img">' . wp_kses_post($getimg) . '</span>';
				} elseif ($data['icon_class']) {
					echo '<span class="rt-icon">';
					Icons_Manager::render_icon($data['icon_class']);
					echo '</span>';
				} else {
					echo '<span class="rt-icon"><i>' . esc_attr($final_icon_class) . '</i></span>';
				}
			?>
		</div>
		<div class="rt-content">
			<?php if ( !empty( $data['title'] ) ) { ?>
			<h4 class="rt-title"><?php echo wp_kses_post( $title );?></h4>
			<?php } if ( !empty( $data['content'] ) ) { ?>
			<div class="rt-text"><?php echo wp_kses_post( $data['content'] );?></div>
			<?php } ?>
		</div>
	</div>
</div>