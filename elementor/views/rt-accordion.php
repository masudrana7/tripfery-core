<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use Elementor\Icons_Manager;

global $rt_accordion_id;

$rt_accordion_id = empty($rt_accordion_id) ? 1 : $rt_accordion_id + 1;
$accordian_id = 'rtaccordion-'.$rt_accordion_id;

if ( ! isset( $data['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
    $data['icon'] = 'fa fa-plus';
    $data['icon_active'] = 'fa fa-minus';
    $data['icon_align'] = $this->get_settings( 'icon_align' );
}

$is_new = empty( $data['icon'] ) && Icons_Manager::is_migration_allowed();
$has_icon = ( ! $is_new || ! empty( $data['selected_icon']['value'] ) );

?>
<div id="<?php echo esc_attr( $accordian_id ) ?>" class="rt-accordion rt-accordion-<?php echo esc_attr( $data['style'] );?>" >
    <?php $i = 1;
      foreach ( $data['accordion_repeat'] as $accordion ) {
      $show =  $i == 1 ? 'show' : '';
      $collapse=$i!==1 ? 'collapsed':'';
      $t = $accordion['title'];
      $uid = strtolower(str_replace(array('%', ':', '\\', '/', '*', '?', '.', ';', ' '), '', $t));
      $unique_id = uniqid();
    ?>
   <div class="rt-accordion-item">
        <h2 class="rt-accordion-header <?php if ( $i == 1 ) { ?>active<?php } ?>" id="rtaccordion-<?php echo esc_attr($unique_id); ?>" >
            <button class="rt-accordion-button <?php echo esc_attr( $collapse ); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#rtaccordion-collapse-<?php echo esc_attr( $unique_id ); ?>" aria-expanded="true">
                <span class="rt-accordion-icon rt-accordion-icon-<?php echo esc_attr( $data['icon_align'] ); ?>" aria-hidden="true">
                    <?php
                    if ( $is_new || $migrated ) { ?>
                        <span class="rt-accordion-icon-closed"><?php Icons_Manager::render_icon( $data['selected_icon'] ); ?></span>
                        <span class="rt-accordion-icon-opened"><?php Icons_Manager::render_icon( $data['selected_active_icon'] ); ?></span>
                    <?php } else { ?>
                        <i class="rt-accordion-icon-closed <?php echo esc_attr( $data['icon'] ); ?>"></i>
                        <i class="rt-accordion-icon-opened <?php echo esc_attr( $data['icon_active'] ); ?>"></i>
                    <?php } ?>
                </span>
                <span class="rt-accordion-title rt-title-<?php echo esc_attr( $data['icon_align'] ); ?>"><?php echo wp_kses_post( $accordion['title'] ); ?></span>
            </button>
       </h2>       
        <div id="rtaccordion-collapse-<?php echo esc_attr( $unique_id ); ?>" class="accordion-collapse collapse <?php echo esc_attr( $show ); ?>" aria-labelledby="rtaccordion-<?php echo esc_attr($unique_id); ?>" data-bs-parent="#<?php echo esc_attr( $accordian_id ) ?>">
            <div class="accordion-body">
              <?php echo wp_kses_post( $accordion['accodion_text'] ) ?>
            </div>
        </div>
   </div>
    <?php $i++; } ?>
</div>
