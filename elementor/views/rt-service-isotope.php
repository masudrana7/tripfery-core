<?php
	if (!empty($data['tab_items'])) {
		foreach ($data['tab_items'] as $cat) {
		    $cats = explode(',', $cat['sec_cat']);
		}
	}


	$template = 'rt-service-isotope-2';
	return $this->rt_template($template, $data);
	
 ?>