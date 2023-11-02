<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;

extract($data); ?>

<div class="row rt-featured-room">
    <div class="col-xl-6 col-lg-7 col-md-12">
        <div class="image-column">


            <?php $i = 0;
            foreach ($data['rt-rooms'] as $item) : ?>
                <div class="col-img active" data-list-img="<?php echo esc_attr($i); ?>" style="overflow: hidden;">
                    <?php echo wp_get_attachment_image($item['image']['id'], 'full') ?>
                </div>
            <?php $i++;
            endforeach; ?>


        </div>
    </div>
    <div class="col-xl-6 col-lg-5 col-md-12">
        <div class="room-feature-box-1">
            <div class="rooms-feature-info">

                <?php if ($data['subtitle']) { ?>
                    <span class="rooms-info-subtitle"><?php echo wp_kses_post($data['subtitle']) ?></span>
                <?php } ?>
                <?php if ($data['title']) { ?>
                    <h2 class="rooms-info-title"><?php echo wp_kses_post($data['title']) ?></h2>
                <?php } ?>
                <?php if ($data['description']) { ?>
                    <p class="rooms-info-desc">
                        <?php echo wp_kses_post($data['description']) ?>
                    </p>
                <?php } ?>

            </div>
            <div class="list-feature">
                <ul>
                    <?php $i = 0;
                    foreach ($data['rt-rooms'] as $item) : ?>
                        <li>
                            <a href="#" class="list-item" data-list-hover="<?php echo esc_attr($i); ?>">
                                <span class="list-title"><?php echo wp_kses_post($item['title']); ?></span>
                            </a>
                        </li>
                    <?php $i++;
                    endforeach; ?>

                </ul>
            </div>
        </div>
    </div>
</div>