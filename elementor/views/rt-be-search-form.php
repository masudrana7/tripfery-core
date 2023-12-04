<?php
$taxonomies_list = $this->rt_fields(); ?>
  <div class="rt-search-customize menu_bar_<?php echo esc_attr($data['display_menu']); ?> content_align_<?php echo esc_attr($data['content_align']); ?>">
    <div class="form-fields-title hidden">
        <?php
            $html = BABE_Search_From::render_form();
            echo $html;
        ?>
    </div>
  </div>
<?php ?>
