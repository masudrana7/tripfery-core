<?php



wp_enqueue_script('jquery-ui-slider');
wp_register_script('babe-price-slider', plugins_url("js/babe-price-slider.js", BABE_PLUGIN), array('jquery-ui-slider'), BABE_VERSION, true);
wp_localize_script('babe-price-slider', 'babe_price_slider', array(
	'currency_symbol' 	=> BABE_Currency::get_currency_symbol(),
	'currency_pos'      => BABE_Currency::get_currency_place(),
	'min_price'			=> isset($_GET['min_price']) ? esc_attr($_GET['min_price']) : '',
	'max_price'			=> isset($_GET['max_price']) ? esc_attr($_GET['max_price']) : ''
));
wp_enqueue_script('babe-price-slider');
$min = (int)BABE_Post_types::get_posts_range_price($_GET, 'min');
$max = (int)BABE_Post_types::get_posts_range_price($_GET, 'max');
$price_text = $data['price'];
$price = '<span class="price-text">'. $price_text .'</span>';
echo '<div class="rt-price-filter widget-babe-price-slider">
        <div class="babe_price_slider_label">
		  '. $price.' 
          <input type="text" id="babe_range_price" readonly data-min="' . $min . '" data-max="' . $max . '">
        </div>
        <div class="babe_price_slider"></div>
     </div>';
?>

