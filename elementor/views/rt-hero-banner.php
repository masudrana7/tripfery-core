<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;

$attr = '';
if ( !empty( $data['buttonurl']['url'] ) ) {
    $attr  = 'href="' . $data['buttonurl']['url'] . '"';
    $attr .= !empty( $data['buttonurl']['is_external'] ) ? ' target="_blank"' : '';
    $attr .= !empty( $data['buttonurl']['nofollow'] ) ? ' rel="nofollow"' : '';
}

$attr2 = '';
if ( !empty( $data['buttonurl2']['url'] ) ) {
    $attr2  = 'href="' . $data['buttonurl2']['url'] . '"';
    $attr2 .= !empty( $data['buttonurl2']['is_external'] ) ? ' target="_blank"' : '';
    $attr2 .= !empty( $data['buttonurl2']['nofollow'] ) ? ' rel="nofollow"' : '';
}

?>
<div class="rt-hero-banner has-animation">
	<?php if ( !empty( $data['sub_title'] ) ) { ?>		
		<span class="entry-subtitle <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="0.2s" data-wow-duration="1.2s"><?php echo wp_kses_post( $data['sub_title'] );?><?php if( $data['display_line'] ) { ?><span class="line"></span><?php } ?></span>
	<?php } ?>
	<?php if( !empty( $data['shadow_title'] ) ) { ?>
        <h1 class="shadow-title <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="0.4s" data-wow-duration="1.2s"><?php echo wp_kses_post( $data['shadow_title'] );?></h1>
    <?php } ?>
	<?php if ( !empty( $data['title'] ) ) { ?>
		<<?php echo esc_attr( $data['heading_size'] ); ?> class="entry-title <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="0.6s" data-wow-duration="1.2s"><?php echo wp_kses_post( $data['title'] );?></<?php echo esc_attr( $data['heading_size'] ); ?>>		
	<?php } ?>
	<?php if ( !empty( $data['content'] ) ) { ?>
		<div class="entry-content <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="0.8s" data-wow-duration="1.2s"><?php echo wp_kses_post( $data['content'] );?></div>
	<?php } ?>
	<?php if ( ( $data['button_display']  == 'yes' ) || ( $data['button_display2']  == 'yes') ) { ?>
	<div class="button-list">
		<?php if ( $data['button_display']  == 'yes' ) { ?>
	    <div class="rt-button1 <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="1s" data-wow-duration="1.2s">
			<a class="button-style-4 btn-common" <?php echo $attr; ?> ><?php echo esc_html( $data['buttontext'] );?><i class="icon-tripfery-right-arrow"></i></a>
	          </div>
		<?php } ?>
		<?php if ( $data['button_display2']  == 'yes' ) { ?>
	    <div class="rt-button2 <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="1.2s" data-wow-duration="1.2s">
			<a class="button-style-2 btn-common" <?php echo $attr2; ?> ><?php echo esc_html( $data['buttontext2'] );?><i class="icon-tripfery-right-arrow"></i></a>
	          </div>
		<?php } ?>
	</div>
	<?php } ?>
</div>