<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
    use Rtrs\Models\Review;
    use Rtrs\Helpers\Functions;
    extract(array($data, $booking));  
    $post_id 	= $post['ID'];
    $ba_info 	= BABE_Post_types::get_post($post_id);
    $cat_style = !empty($cat['sec_style']) ? $cat['sec_style'] : $data['sec_style'];
    $btn_text = !empty($cat['button_text']) ? $cat['button_text'] : $data['button_text'];
?>
<div class="rt_booking_<?php echo esc_attr($cat_style); ?>">
    <div class="listing-card">
        <?php
        if (!empty($image_srcs)) { ?>
            <a class="<?php if (!empty($discount)) {
                            echo 'discount_available ';
                        } ?> text-decoration-none listing-thumb-wrapper" href="<?php echo esc_url($item_url); ?>">
                <img src="<?php echo esc_attr($image_srcs[0]); ?>" alt="featured-image" />
                <?php echo wp_kses_post($discount); ?>
                <?php if ($data['rating_display'] == 'yes' && class_exists(Review::class)) {
                    echo '<span class="booking-top-rating">';
                    echo '<i class="fa-solid fa-star"></i>';
                    if ($avg_rating = Review::getAvgRatings(get_the_ID())) {
                        echo esc_html($avg_rating);
                    }
                    echo '</span>';
                } ?>
                <?php if ('on' == $featured_text) { ?>
                    <div class="feature-text"><?php echo esc_html__('Featured', 'tripfery-core') ?></div>
                <?php } ?>
            </a>
        <?php } ?>

        <div class="listing-card-content">
            <h3 class="listing-card-title mt-0 mb-1">
                <a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
            </h3>
            <div class="d-flex justify-content-between">
                <?php $address = isset($ba_info['address']) ? $ba_info['address'] : false;
                if ($address) {
                ?>
                    <div class="badge2 bage-pink">
                        <svg class="badge-icon" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.99994 6.71503C6.86151 6.71503 7.55994 6.0166 7.55994 5.15503C7.55994 4.29347 6.86151 3.59503 5.99994 3.59503C5.13838 3.59503 4.43994 4.29347 4.43994 5.15503C4.43994 6.0166 5.13838 6.71503 5.99994 6.71503Z" stroke="currentColor" stroke-opacity="0.99" />
                            <path d="M1.8101 4.24506C2.7951 -0.0849378 9.2101 -0.0799377 10.1901 4.25006C10.7651 6.79006 9.1851 8.94006 7.8001 10.2701C6.7951 11.2401 5.2051 11.2401 4.1951 10.2701C2.8151 8.94006 1.2351 6.78506 1.8101 4.24506Z" stroke="currentColor" stroke-opacity="0.99" />
                        </svg>
                        <span class="badge-text"><?php echo esc_html($address['address']); ?></span>
                    </div>
                <?php } ?>
                <?php if (class_exists('RTWishlist')) {
                    echo RTWishlist::wishlist_html($post_id);
                } ?>
            </div>
            <div class="d-flex align-items-center justify-content-between price-area">
                <?php if ($data['price_display'] == 'yes' && !empty($item_info_price)) { ?>
                    <div class="rt-price">
                        <?php echo wp_kses_post($item_info_price); ?>
                        <?php if (!empty($tripfery_per_rate)) { ?>
                            <span class="activity-person">
                                <?php echo esc_html($tripfery_per_rate); ?>
                            </span>
                        <?php } ?>
                    </div>
                <?php } ?>
                <?php if ($data['button_display'] == 'yes') { ?>
                    <a href="<?php echo esc_url($url); ?>" class="btn-light-sm btn-light-animated">
                        <?php echo esc_html( $btn_text ); ?>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>