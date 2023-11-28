<?php
  $taxonomies_list = $this->rt_fields();
    $title =" ";
    echo '<div class="rt-search-customize">';
        $html = BABE_Search_From::render_form($title);
        echo $html;
    echo '<div class="form-fields-title hidden">';


    if ($taxonomies_list) {
      foreach ($taxonomies_list as $key => $tax_term) {
        $name_title = BABE_Post_types::$attr_tax_pref . $key . '_title';

        //$title = $data[$name_title] ? $data[$name_title] : ucfirst($key);

      }
    }



echo '</div>';
    echo '</div>';
?>

