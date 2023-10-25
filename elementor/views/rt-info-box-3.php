<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
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
			<?php if ( !empty( $data['icontype']== 'image' ) ) { ?>		            
				<span class="rt-img"><?php echo wp_kses_post($getimg);?></span>  
			<?php }else{?> 	
			<?php if ( $final_icon_image_url ): ?>
				<span class="rt-icon"><img src="<?php echo esc_url( $final_icon_image_url ); ?>" alt="SVG Icon"></span>
			<?php else: ?>
				<span class="rt-icon"><i class="<?php  echo esc_attr( $final_icon_class ); ?>"></i></span>
			<?php endif ?>
			<?php }  ?>	
		</div>
		<div class="rt-content">
			<?php if ( !empty( $data['title'] ) ) { ?>
			<h3 class="rt-title"><?php echo wp_kses_post( $title );?></h3>
			<?php } if ( !empty( $data['content'] ) ) { ?>
			<div class="rt-text"><?php echo wp_kses_post( $data['content'] );?></div>
			<?php } ?>
		</div>
	</div>
</div>