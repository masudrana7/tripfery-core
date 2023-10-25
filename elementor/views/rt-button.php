<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use Elementor\Icons_Manager;

$attr = '';
if ( !empty( $data['buttonurl']['url'] ) ) {
    $attr  = 'href="' . $data['buttonurl']['url'] . '"';
    $attr .= !empty( $data['buttonurl']['is_external'] ) ? ' target="_blank"' : '';
    $attr .= !empty( $data['buttonurl']['nofollow'] ) ? ' rel="nofollow"' : '';
}

if ( ! isset( $data['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
    $data['icon'] = 'fa fa-plus';
    $data['icon_align'] = $this->get_settings( 'icon_align' );
}

$is_new = empty( $data['icon'] ) && Icons_Manager::is_migration_allowed();
$has_icon = ( ! $is_new || ! empty( $data['selected_icon']['value'] ) );


?>
<div class="rt-button <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $data['delay'] );?>s" data-wow-duration="<?php echo esc_attr( $data['duration'] );?>s">
	<?php if( !empty( $data['buttontext'] ) ) { ?>
		<a class="button-link button-<?php echo esc_attr( $data['style'] ); ?>" <?php echo $attr; ?>>
            <?php if( $data['icon_align'] == 'left' ) { ?>
            <span class="icon icon-<?php echo esc_attr( $data['icon_align'] ); ?>"><?php Icons_Manager::render_icon( $data['selected_icon'] ); ?></span>
            <?php } ?>
            <span class="button-text button-text-<?php echo esc_attr( $data['icon_align'] ); ?>"><?php echo esc_html( $data['buttontext'] );?></span>
            <?php if( $data['icon_align'] == 'right' ) { ?>
            <span class="icon icon-<?php echo esc_attr( $data['icon_align'] ); ?>"><?php Icons_Manager::render_icon( $data['selected_icon'] ); ?></span>
            <?php } ?>
        </a>
	<?php } ?>
</div>