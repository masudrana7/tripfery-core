<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use Elementor\Icons_Manager;
extract($data);

if ( ! isset( $data['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
    $data['icon'] = 'fa fa-plus';
    $data['icon_align'] = $this->get_settings( 'icon_align' );
}
$is_new = empty( $data['icon'] ) && Icons_Manager::is_migration_allowed();
$has_icon = ( ! $is_new || ! empty( $testimonial['selected_icon']['value'] ) );

?>

<div class="rt-testimonial-default testimonial-multi-layout-2 rt-swiper-nav testimonial-slider-<?php echo esc_attr( $data['layout'] );?> <?php echo esc_attr( $data['nav_position'] ) ?> tripfery-horizontal-slider">
    <?php if( $data['quote_display'] == 'yes' ) { ?>
        <span class="tquote"><i class="icon-tripfery-quote-left"></i></span>
    <?php } ?>
    <!-- start video-thumnail-area -->

    <div class="swiper-container horizontal-slider" data-xld ="<?php echo esc_attr( $data['swiper_data'] );?>">
        <div class="swiper-wrapper">
        <?php foreach ( $data['testimonials'] as $testimonial ) { ?>
            <div class="swiper-slide">
                <div class="rt-item has-animation">
                    <div class="item-content" <?php if( $testimonial['item_color'] ) { ?> style="background-color: <?php echo esc_attr( $testimonial['item_color'] ); ?>" <?php } ?>>  

                    
                        <?php if ( !empty( $testimonial['image']['id'] && $data['author_display'] == 'yes' ) ) { ?>
                        <div class="tesimonial-author">
                            <?php echo wp_get_attachment_image($testimonial['image']['id'],'full');?>
                            <span class="q-icon"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.5 9.26257H5.84999C6.99749 9.26257 7.785 10.1326 7.785 11.1976V13.6126C7.785 14.6776 6.99749 15.5476 5.84999 15.5476H3.43501C2.37001 15.5476 1.5 14.6776 1.5 13.6126V9.26257" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M1.5 9.26242C1.5 4.72492 2.34752 3.97496 4.89752 2.45996" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M10.2224 9.26257H14.5724C15.7199 9.26257 16.5074 10.1326 16.5074 11.1976V13.6126C16.5074 14.6776 15.7199 15.5476 14.5724 15.5476H12.1574C11.0924 15.5476 10.2224 14.6776 10.2224 13.6126V9.26257" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M10.2224 9.26242C10.2224 4.72492 11.0699 3.97496 13.6199 2.45996" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div> 
                        <?php } ?>   

                       <div class="tcontent"><?php echo wp_kses_post( $testimonial['content'] );?></div>
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
					</div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
    <!-- end video-slider-style-1 -->
    
    <?php if ( $data['display_arrow'] == 'yes' ) { ?>
	<div class="swiper-navigation">
        <div class="swiper-button-prev"><i class="fa-solid fa-chevron-left"></i></div>
        <div class="swiper-button-next"><i class="fa-solid fa-chevron-right"></i></div>
    </div>
	<?php } ?>
</div>