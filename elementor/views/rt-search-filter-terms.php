<?php
if (class_exists('BABE_Functions')) {
  $taxonomy_id = $data['category_list'];
  if ( isset( BABE_Post_types::$taxonomies_list[ $taxonomy_id ] ) ) {
    $taxonomy     = BABE_Post_types::$taxonomies_list[ $taxonomy_id ]['slug'];
    $id           = 'filter_' . $taxonomy;
    $args         = array(
        'taxonomy'     => $taxonomy,
        'level'        => 0,
        'view'         => 'multicheck', // 'select', 'multicheck' or 'list'
        'id'           => $id,
        'class'        => 'babe-search-filter-terms',
        'name'         => $id,
        'term_id_name' => 'term_taxonomy_id',
    );
    $selected_arr = isset( $_GET['terms'] ) ? (array) $_GET['terms'] : array();
    $selected_arr = array_map( 'intval', $selected_arr );
    echo '<div class="rt-filter-terms widget-babe-search-filter-terms">' . BABE_Post_types::get_terms_children_hierarchy( $args, $selected_arr ) . '</div>';
  }
}

?>

