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
?>
<div class="rt_booking_<?php echo esc_attr($cat_style); ?>">
    <div class="listing-card">
        <?php
        if (!empty($image_srcs)) { ?>
            <a class="<?php if (!empty($discount)) { echo 'discount_available ';	} ?>text-decoration-none listing-thumb-wrapper" href="<?php echo esc_url($item_url); ?>">
                <img src="<?php echo esc_attr($image_srcs[0]); ?>" alt="featured-image" />
                <?php echo wp_kses_post($discount); ?>
                <?php if ('on' == $featured_text) { ?>
                    <div class="feature-text"><?php echo esc_html__('Featured', 'tripfery-core') ?></div>
                <?php } ?>
            </a>
        <?php } ?>
        <div class="listing-card-content d-flex align-items-center justify-content-between">
            <div class="rtrs-rating-item">
                <h3 class="listing-card-title">
                    <a href="<?php echo esc_url($url); ?>"><?php echo apply_filters('translate_text', $post['post_title']); ?></a>
                </h3>
                <?php if ($data['rating_display'] == 'yes' && class_exists(Review::class) && $avg_rating = Review::getAvgRatings($post_id)) { ?>	
                <?php echo Functions::review_stars($avg_rating); ?>
                <span class="rating-percent">
                    (<?php $total_rating = Review::getTotalRatings($post_id);
                        printf(
                            esc_html(_n('%s Review', '%s Reviews', $total_rating, 'revieweb')),
                            esc_html($total_rating)
                        ); ?>)
                </span>
                <?php } ?>		
            </div>
            <?php if ($data['price_display'] == 'yes' && !empty($item_info_price)) { ?>
                <div class="rt-price">
                    <?php echo wp_kses_post($item_info_price); ?>
                    <?php if (!empty($tripfery_per_rate)) { ?>
                        <span class="activity-person"><?php echo esc_html($tripfery_per_rate); ?>
                        </span>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>