<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
extract($data);

$col_class = "col-xl-{$data['col_xl']} col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-{$data['col']}";

use Elementor\Icons_Manager;

if ( ! isset( $data['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
    $data['icon'] = 'fa fa-plus';
    $data['icon_align'] = $this->get_settings( 'icon_align' );
}
$is_new = empty( $data['icon'] ) && Icons_Manager::is_migration_allowed();
$has_icon = ( ! $is_new || ! empty( $testimonial['selected_icon']['value'] ) );

?>

<div class="rt-testimonial-default testimonial-multi-layout-1 testimonial-<?php echo esc_attr( $data['layout'] );?>">
	<div class="row <?php echo esc_attr( $data['item_gutter'] );?>">
		<?php $m = $data['delay']; $n = $data['duration']; 
			foreach ( $data['testimonials'] as $testimonial ) { ?>
			<div class="rt-item has-animation <?php echo esc_attr( $col_class );?> <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $m );?>s" data-wow-duration="<?php echo esc_attr( $n );?>s">				
				<div class="item-content" <?php if( $testimonial['item_color'] ) { ?> style="background-color: <?php echo esc_attr( $testimonial['item_color'] ); ?>" <?php } ?>>
					<?php if( $data['quote_display'] == 'yes' ) { ?>
					<span class="tquote"><?php Icons_Manager::render_icon( $testimonial['selected_icon'] ); ?></span>
					<?php } ?>
					<div class="tcontent"><?php echo wp_kses_post( $testimonial['content'] );?></div>
					<?php if ( !empty( $testimonial['image']['id'] ) && $data['author_display'] == 'yes' ) { ?>
					<div class="item-img">
						<?php echo wp_get_attachment_image($testimonial['image']['id'],'full');?>
					</div>
					<?php } ?>
					<?php if( $data['rating_display'] == 'yes' ) { ?>
					<ul class="item-rating">
					<?php for ( $i=0; $i <=4 ; $i++ ) {
          				if ( $i < $testimonial['rating'] ) {
            				$full = 'active';
          				} else {
            				$full = 'deactive';
          				}
          				echo '<li class="has-rating"><i class="fa-regular fa-star '.$full.'"></i></li>';
        			} ?>
					</ul>
					<?php } ?>
					<h3 class="item-title"><?php echo wp_kses_post( $testimonial['title'] );?></h3>
					<div class="item-designation"><?php echo wp_kses_post( $testimonial['designation'] );?></div>
					<span class="line"></span>
				</div>
			</div>
		<?php $m = $m + 0.2; $n = $n + 0.1; } ?>
	</div>
</div>