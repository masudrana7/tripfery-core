<?php
if (class_exists('BABE_Functions')) {
$taxonomies_list = $this->rt_fields(); ?>
<div class="rt-search-customize menu_bar_<?php echo esc_attr($data['display_menu']); ?> content_align_<?php echo esc_attr($data['content_align']); ?>">

    <div class="form-fields-title">
      <?php
          $html = BABE_Search_From::render_form();
          $dynamicTabValue = $data['catid'];
          $term = get_term_by('id', $dynamicTabValue, 'categories');
          if ($term) {
              $term_slug = $term->slug;
              $html = str_replace('name="search_tab"', 'name="search_tab" value="' . $term_slug . '"', $html);
              echo $html;
          }else{
              echo $html;
          }
      ?>
    </div>
    <div class="rt-hide">
      <?php
        $location_title = !empty($data['location']) ? $data['location'] : esc_html__('location', 'tripfery-core');
        echo '<span  class="rt_location_title">' . $location_title . '</span>';

        $start_date = !empty($data['start_date']) ? $data['start_date'] : esc_html__('Start Date', 'tripfery-core');
        echo '<span  class="rt_start_date">' . $start_date . '</span>';

        $end_date = !empty($data['end_date']) ? $data['end_date'] : esc_html__('End Date', 'tripfery-core');
        echo '<span  class="rt_end_date">' . $end_date . '</span>';

        $guests = !empty($data['guests']) ? $data['guests'] : esc_html__('Guests', 'tripfery-core');
        echo '<span  class="rt_guests">' . $guests . '</span>';

      ?>

    </div>
  </div>
  <?php } ?>