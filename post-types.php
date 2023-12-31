<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use \RT_Posts;
use TripferyTheme;


if ( !class_exists( 'RT_Posts' ) ) {
	return;
}
$post_types = array(
	'tripfery_team'       => array(
		'title'           => __( 'Team Member', 'tripfery-core' ),
		'plural_title'    => __( 'Team', 'tripfery-core' ),
		'menu_icon'       => 'dashicons-businessman',
		'labels_override' => array(
			'menu_name'   => __( 'Team', 'tripfery-core' ),
		),
		'rewrite'         => TripferyTheme::$options['team_slug'],
		'supports'        => array( 'title', 'thumbnail', 'editor', 'excerpt', 'page-attributes' )
	),

	'tripfery_guided'       => array(
		'title'           => __('Guided Member', 'tripfery-core' ),
		'plural_title'    => __('Guided', 'tripfery-core' ),
		'menu_icon'       => 'dashicons-businessman',
		'labels_override' => array(
			'menu_name'   => __('Guided', 'tripfery-core' ),
		),
		//'rewrite'         => TripferyTheme::$options['team_slug'],
		'supports'        => array( 'title', 'thumbnail', 'editor', 'comments')
	),
);

$taxonomies = array(
	'tripfery_team_category' => array(
		'title'        => __( 'Team Category', 'tripfery-core' ),
		'plural_title' => __( 'Team Categories', 'tripfery-core' ),
		'post_types'   => 'tripfery_team',
		'rewrite'      => array( 'slug' => TripferyTheme::$options['team_cat_slug'] ),
	),	
	'tripfery_booking_category' => array(
		'title'        => __( 'Locations Category', 'tripfery-core' ),
		'plural_title' => __( 'Locations Categories', 'tripfery-core' ),
		'post_types'   => 'tripfery_booking',
		'rewrite'      => array( 'slug' => TripferyTheme::$options['booking_cat_slug'] ),
	),
);
$Posts = RT_Posts::getInstance();
$Posts->add_post_types( $post_types );
$Posts->add_taxonomies( $taxonomies );