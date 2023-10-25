<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
use Elementor\Utils;
extract($data);

?>

<div class="rt-pricing-tab">
    <div class="text-center">
        <div class="price-switch-box price-switch-box--style-1">
            <span class="pack-name"><?php echo wp_kses_post($data['monthly_text']); ?></span>
            <div class="pricing-switch-container">
              <div class="pricing-switch"></div>
              <div class="pricing-switch pricing-switch-active"></div>
              <div class="switch-button"></div>
            </div>
            <span class="pack-name"><?php echo wp_kses_post($data['yearly_text']); ?><?php if( $data['offer_display'] && $data['offer_text'] ) { ?><span class="offer"><?php echo wp_kses_post( $data['offer_text'] ); ?></span><?php } ?></span>            
        </div>
    </div>
    <div class="rt-tab-content" id="nav-tabContent">
        <div class="rt-tab-pane rtTabFadeInUp">
            <div class="row g-4">
                <?php foreach ( $data['feature_monthly'] as $feature_list ) : 
                    $attr = '';
                    if ( !empty( $feature_list['buttonurl']['url'] ) ) {
                        $attr  = 'href="' . $feature_list['buttonurl']['url'] . '"';
                        $attr .= !empty( $feature_list['buttonurl']['is_external'] ) ? ' target="_blank"' : '';
                        $attr .= !empty( $feature_list['buttonurl']['nofollow'] ) ? ' rel="nofollow"' : '';
                    }
                ?>   
                <div class="col-md-4 col-12">
                    <div class="rt-price-tab-box">
                        <div class="price-header">
                            <h3 class="rt-title"><?php echo wp_kses_post( $feature_list['title'] ); ?></h3>
                            <h4 class="rt-price">
                                <?php if( !empty( $feature_list['offer_price'] ) ) { ?>
                                    <del><?php echo esc_html__( 'Regularly', 'tripfery-core' ); ?> <?php echo wp_kses_post( $feature_list['price'] );?></del>
                                    <?php echo wp_kses_post( $feature_list['offer_price'] );?><span class="price-unit"><?php echo wp_kses_post( $feature_list['unit'] ); ?></span>                                    
                                <?php } else { ?>
                                    <?php echo wp_kses_post( $feature_list['price'] );?><span class="price-unit"><?php echo wp_kses_post( $feature_list['unit'] ); ?></span>
                                <?php } ?>
                            </h4> 
                            <?php 
                                if( $feature_list['offer_price'] ) { 
                                    $reg_price = explode('$', $feature_list['price']);                                
                                    $offer_price = explode('$', $feature_list['offer_price']);
                                    $reg_price_slice = $reg_price[1];
                                    $offer_price_slice = $offer_price[1];
                                    $discounted_price = ( (100 / $reg_price_slice ) * ( $reg_price_slice -  $offer_price_slice ) );
                                }
                            ?>
                            <?php if( $feature_list['offer_price'] ) { ?><div class="save-price"><?php echo esc_html__( 'Save', 'tripfery-core' ); ?> <?php echo floor($discounted_price); ?>%</div><?php } ?>
                        </div>
                        <div class="rt-features"><?php echo wp_kses_post( $feature_list['text'] ); ?></div>  
                        <div class="rt-price-button">
                            <a <?php echo $attr; ?> class="button-style-2 btn-common">
                                <?php echo esc_html( $feature_list['buttontext'] );?><i class="icon-tripfery-right-arrow"></i>
                            </a>
                        </div>      
                    </div>
                </div>
            <?php endforeach; ?> 
            </div>
        </div>
        <div class="rt-tab-pane rtTabFadeInUp">
            <div class="row g-4">
                <?php foreach ( $data['feature_yearly'] as $feature_list2 ) : 
                    $attr2 = '';
                    if ( !empty( $feature_list2['buttonurl2']['url'] ) ) {
                        $attr2  = 'href="' . $feature_list2['buttonurl2']['url'] . '"';
                        $attr2 .= !empty( $feature_list2['buttonurl2']['is_external'] ) ? ' target="_blank"' : '';
                        $attr2 .= !empty( $feature_list2['buttonurl2']['nofollow'] ) ? ' rel="nofollow"' : '';
                    }
                ?>   
                <div class="col-md-4 col-12">
                    <div class="rt-price-tab-box">
                        <div class="price-header">
                            <h3 class="rt-title"><?php echo wp_kses_post( $feature_list2['title2'] ); ?></h3>
                            <h4 class="rt-price">
                                <?php if( !empty( $feature_list2['offer_price2'] ) ) { ?>
                                    <del><?php echo esc_html__( 'Regularly', 'tripfery-core' ); ?> <?php echo wp_kses_post( $feature_list2['price2'] );?></del>
                                    <?php echo wp_kses_post( $feature_list2['offer_price2'] );?><span class="price-unit"><?php echo wp_kses_post( $feature_list2['unit2'] ); ?></span>                                    
                                <?php } else { ?>
                                    <?php echo wp_kses_post( $feature_list2['price2'] );?><span class="price-unit"><?php echo wp_kses_post( $feature_list2['unit2'] ); ?></span>
                                <?php } ?>
                            </h4>
                            <?php 
                                if( $feature_list2['offer_price2'] ) { 
                                    $reg_price2 = explode('$', $feature_list2['price2']);                                
                                    $offer_price2 = explode('$', $feature_list2['offer_price2']);
                                    $reg_price_slice2 = $reg_price2[1];
                                    $offer_price_slice2 = $offer_price2[1];
                                    $discounted_price2 = ( (100 / $reg_price_slice2 ) * ( $reg_price_slice2 -  $offer_price_slice2 ) );
                                }
                            ?>
                            <?php if( $feature_list2['offer_price2'] ) { ?><div class="save-price"><?php echo esc_html__( 'Save', 'tripfery-core' ); ?> <?php echo floor($discounted_price2); ?>%</div><?php } ?>
                        </div>
                        <div class="rt-features"><?php echo wp_kses_post( $feature_list2['text2'] ); ?></div>  
                        <div class="rt-price-button">
                            <a <?php echo $attr2; ?> class="button-style-2 btn-common">
                                <?php echo esc_html( $feature_list2['buttontext2'] );?><i class="icon-tripfery-right-arrow"></i>
                            </a>
                        </div>      
                    </div>
                </div>
                <?php endforeach; ?> 
            </div>
        </div>
    </div>
    <?php if( $data['note_display'] == 'yes' && $data['note_desc'] ) { ?><div class="price-note"><?php echo esc_html( $data['note_desc'] );?></div><?php } ?>
</div>