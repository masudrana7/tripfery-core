<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\Tripfery_Core;
extract( $data );

$banners = array();
foreach ( $data['banner_lists'] as $banner_list ) {
    $banners[] = array(
        'slider_sub_title'      => $banner_list['slider_sub_title'],
        'slider_title'          => $banner_list['slider_title'],
        'slider_shadow_title'   => $banner_list['slider_shadow_title'],
        'slider_text'           => $banner_list['slider_text'],     
        'button_text'           => $banner_list['button_text'],
        'button_url'            => $banner_list['button_url']['url'],
        'img'                   => $banner_list['banner_image']['url'] ? $banner_list['banner_image']['url'] : "", 
    );
}
?>

<div class="banner-slider <?php echo esc_attr( $data['nav_position'] ) ?>">
    <div class="rt-swiper-slider swiper-slider rt-swiper-nav" data-xld ="<?php echo esc_attr( $data['swiper_data'] );?>">
        <div class="swiper-wrapper <?php if( $data['slider_animation'] == 'yes' ) { ?>animation<?php } ?>">
            <?php $i = 1;
                foreach ($banners as $banner){ ?>                   
                <div class="swiper-slide single-slide slide-<?php echo esc_attr( $i ); ?>">
                    <div class="single-slider" data-bg-image="<?php echo esc_attr($banner['img']); ?>">
                        <div class="container">
                            <div class="slider-content">
                                <?php if( !empty( $banner['slider_sub_title'] ) ) { ?>
                                <div class="sub-title has-animation"><?php echo $banner['slider_sub_title']; ?><?php if( $data['display_line'] ) { ?><span class="line"></span><?php } ?></div>
                                <?php } if( !empty( $banner['slider_shadow_title'] ) ) { ?>
                                <h1 class="shadow-title"><?php echo $banner['slider_shadow_title']; ?></h1>
                                <?php } if( !empty( $banner['slider_title'] ) ) { ?>
                                <h2 class="slider-title <?php echo esc_attr( $data['title_align'] );?>"><?php echo $banner['slider_title']; ?></h2>
                                <?php } if( !empty( $banner['slider_text'] ) ) { ?>
                                <div class="slider-text <?php echo esc_attr( $data['text_align'] );?>"><?php echo $banner['slider_text']; ?></div>
                                <?php } ?>
                                <?php if ( $data['button_display']  == 'yes' ) { ?>
                                <div class="slider-btn-area">
                                    <a class="button-style-4 btn-common" href="<?php echo esc_url( $banner['button_url'] ); ?>"><?php echo wp_kses( $banner['button_text'], 'alltext_allow' ); ?><i class="icon-tripfery-right-arrow"></i></a>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $i++; } ?>            
        </div>
        <?php if($data['display_arrow']=='yes'){  ?>
        <div class="swiper-navigation">
            <div class="swiper-button-prev"><i class="icon-tripfery-left-arrow"></i><?php echo esc_html__( 'Prev' , 'tripfery' ) ?></div>
            <div class="swiper-button-next"><?php echo esc_html__( 'Next' , 'tripfery' ) ?><i class="icon-tripfery-right-arrow"></i></div>
        </div>
        <?php } if($data['display_buttet']=='yes') { ?>
        <div class="swiper-pagination"></div>
        <?php } ?>
    </div>    
</div>

<?php


