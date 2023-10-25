<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use NiftricTheme;
use NiftricTheme_Helper;
use \WP_Query;

$col_class = "col-xl-{$data['col_xl']} col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-xs-{$data['col_xs']}";

?>
<div class="rt-logo-default rt-logo-grid">
	<div class="row <?php echo esc_attr( $data['item_space'] );?>">		
        <?php $i = $data['delay']; $j = $data['duration']; ?>
        <?php foreach ( $data['logos'] as $logo ): ?>
            <?php if ( empty( $logo['image']['id'] ) ) continue; ?>
            <div class="<?php echo esc_attr( $col_class );?> <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $i );?>s" data-wow-duration="<?php echo esc_attr( $j );?>s">
                <div class="logo-box <?php echo esc_attr( $data['logo_color_mode'] );?>">	
                    <?php if ( !empty( $logo['url'] ) ): ?>
                        <a href="<?php echo esc_url( $logo['url'] );?>" target="_blank"><?php echo wp_get_attachment_image( $logo['image']['id'], 'full' )?></a>
                    <?php else: ?>
                        <?php echo wp_get_attachment_image( $logo['image']['id'], 'full' )?>
                    <?php endif; ?>
                    <?php if ( !empty($logo['title']) ) { ?>
                        <h3 class="entry-title"><?php echo wp_kses_post( $logo['title'] ); ?></h3>				
                    <?php } ?>
                </div>
            </div>
        <?php $i = $i + 0.2; $j = $j + 0.01; endforeach; ?>		
	</div>
</div>