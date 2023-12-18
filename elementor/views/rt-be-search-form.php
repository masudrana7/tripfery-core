<?php
$taxonomies_list = $this->rt_fields(); ?>
<div class="rt-search-customize menu_bar_<?php echo esc_attr($data['display_menu']); ?> content_align_<?php echo esc_attr($data['content_align']); ?>">

    <div class="form-fields-title">
      <?php
      $html = BABE_Search_From::render_form();
      echo $html;
      ?>
    </div>
    <div class="rt-hide">
      <?php

        $location_title = !empty($data['location']) ? $data['location'] : esc_html__('location', 'gowilds-themer');
        echo '<span  class="rt_location_title">' . $location_title . '</span>';

        $start_date = !empty($data['start_date']) ? $data['start_date'] : esc_html__('Start Date', 'gowilds-themer');
        echo '<span  class="rt_start_date">' . $start_date . '</span>';

        $end_date = !empty($data['end_date']) ? $data['end_date'] : esc_html__('End Date', 'gowilds-themer');
        echo '<span  class="rt_end_date">' . $end_date . '</span>';

        $guests = !empty($data['guests']) ? $data['guests'] : esc_html__('Guests', 'gowilds-themer');
        echo '<span  class="rt_guests">' . $guests . '</span>';

      ?>

    </div>
  </div>
  <?php ?>