<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use Elementor\Icons_Manager;
use TripferyTheme;
use TripferyTheme_Helper;
use \WP_Query;
extract($data);
$thumb_size = 'tripfery-size5';

if ( ! isset( $data['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
    $data['icon'] = 'fa fa-plus';
    $data['icon_align'] = $this->get_settings( 'icon_align' );
}

?>
<div class="rt-service-tab rt-service-tab-<?php echo esc_attr( $data['layout'] );?>">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
            	<div class="rt-section-title">
					<div class="section-subtitle has-animation"><?php echo wp_kses_post($data['section_sub_title']) ?><span class="line"></span></div>
					<h2 class="section-title"><?php echo wp_kses_post($data['section_title']) ?></h2>			
					<div class="section-content"><?php echo wp_kses_post($data['section_text']) ?></div>
				</div>
                <div class="list-feature">
                	<?php $i = 1;
					foreach ( $data['tab_items'] as $tab_item_list ) { ?>
                    <a href="#" class="list-item <?php if ( $i == 1 ) { ?>active<?php } ?>" data-list-hover="<?php echo esc_html( $i ); ?>">
                        <?php if( $tab_item_list['count_title'] ) { ?><div class="list-counter"><?php echo wp_kses_post( $tab_item_list['count_title'] ); ?></div><?php } ?>
                        <div class="content-wrap">
                            <?php if( $tab_item_list['title'] ) { ?><span class="entry-title"><?php echo wp_kses_post( $tab_item_list['title'] ); ?></span><?php } ?>
                            <?php if( $tab_item_list['sub_title'] ) { ?><span class="sub-title"><?php echo wp_kses_post( $tab_item_list['sub_title'] ); ?></span><?php } ?>
                            <?php if ( $data['layout_two_content'] == 'yes' ) { ?><?php echo wp_kses_post( $tab_item_list['content'] ); ?><?php } ?>
                        </div>
                        <?php if ( $data['layout_two_icon'] == 'yes' ) { ?><span class="shape-icon"><?php Icons_Manager::render_icon( $tab_item_list['selected_icon'] ); ?></span><?php } ?>
                    </a>
                    <?php $i++; } ?>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="image-column">
                	<?php $i = 1;
						foreach ( $data['tab_items'] as $tab_item_list ) {
						if( $tab_item_list['image']['id'] ) {
							$image_class = 'image';
						} else {
							$image_class = 'noimage';
						}
					?>
                        <div class="col-img <?php if ( $i == 1 ) { ?>active<?php } ?>" data-list-img="<?php echo esc_html( $i ); ?>" style="overflow: hidden;">
                            <?php echo wp_get_attachment_image( $tab_item_list['image']['id'], $thumb_size ); ?>
                        </div>
                    <?php $i++; } ?>
                </div>
            </div>
        </div>
    </div>
</div>