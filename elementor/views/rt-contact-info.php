<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use NiftricTheme_Helper;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Image_Size;
extract($data);
// icon , image
$getimg = Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size', 'icon_image' );

$final_icon_class       = " fas fa-map-marker-alt";
$final_icon_image_url   = '';
if ( is_string( $icon_class['value'] ) && $dynamic_icon_class =  $icon_class['value']  ) {
    $final_icon_class     = $dynamic_icon_class;
}
if ( is_array( $icon_class['value'] ) ) {
    $final_icon_image_url = $icon_class['value']['url'];
}
?>

<div class="rt-contact-info">
    <div class="rt-item item-<?php echo esc_attr( $data['icontype'] );?> <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $data['delay'] );?>s" data-wow-duration="<?php echo esc_attr( $data['duration'] );?>s">
    	<div class="rt-item-icon">
	        <?php if ( !empty( $data['icontype']== 'image' ) ) { ?>                 
	            <span class="rt-img"><?php echo wp_kses_post($getimg);?></span>  
	        <?php }else{?>  
	        <?php if( !empty($data['icon_class']) ) { ?>
	            <?php Icons_Manager::render_icon( $data['icon_class'], [ 'aria-hidden' => 'true' ] ); ?>
	        <?php } ?>
	        <?php }  ?> 
	    </div>
	    <div class="rt-item-content">
	        <h4 class="entry-title"><?php echo wp_kses_post( $data['item_title'] );?></h4>
	        <ul class="contact-list">
	            <?php
	            foreach ( $data['rt_lists'] as $index => $item ) { 
	                $data_type = $item['list_text'];
	                if(filter_var($data_type, FILTER_VALIDATE_EMAIL)){
	                    $href_value = 'mailto:'. sanitize_email( $data_type );
	                } elseif ( preg_match('/^[0-9\-\(\)\/\+\s]*$/', $data_type ) ) {
	                    $href_value = 'tel:'.esc_attr($data_type);
	                } elseif (filter_var($data_type, FILTER_VALIDATE_URL)) {
	                    $href_value = "esc_url($data_type)";
	                } else {
	                    $href_value = '';
	                }
	                $link_key = 'link_' . $index;
	                $this->add_render_attribute( $link_key, 'href', $href_value );
	            ?>
	            <li>
	                <?php if ( $item['list_type'] == 'icon_list' ) { ?>
	                   <?php if( !empty($item['list_icon']) ) { ?>
	                        <?php Icons_Manager::render_icon( $item['list_icon'], [ 'aria-hidden' => 'true' ] ); ?>
	                    <?php } ?>
	                <?php } else if ( $item['list_type'] == 'title_list' ) { ?>
	                    <span><?php echo $item['list_title']; ?>:</span>
	                <?php } if (!empty( $href_value ) ) { ?>
	                <a <?php echo $this->get_render_attribute_string( $link_key ); ?>>
	                    <?php echo $item['list_text']; ?>
	                </a>
	                <?php } else { ?>
	                    <?php echo $item['list_text']; ?>
	                <?php } ?>
	            </li>
	            <?php } ?>
	        </ul>
	    </div>
    </div>
</div>