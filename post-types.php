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
	'tripfery_service'  => array(
		'title'           => __( 'Service', 'tripfery-core' ),
		'plural_title'    => __( 'Services', 'tripfery-core' ),
		'menu_icon'       => 'dashicons-book',
		'rewrite'         => TripferyTheme::$options['service_slug'],
		'supports'        => array( 'title', 'thumbnail', 'editor', 'excerpt', 'page-attributes' ),
	),
	'tripfery_locations'  => array(
		'title'           => __( 'Locations', 'tripfery-core' ),
		'plural_title'    => __( 'Locationss', 'tripfery-core' ),
		'menu_icon'       => 'dashicons-book',
		'rewrite'         => TripferyTheme::$options['locations_slug'],
		'supports'        => array( 'title', 'thumbnail', 'editor', 'excerpt', 'page-attributes' ),
		'taxonomies' 	  => array( 'post_tag' ),
	),
);

$taxonomies = array(
	'tripfery_team_category' => array(
		'title'        => __( 'Team Category', 'tripfery-core' ),
		'plural_title' => __( 'Team Categories', 'tripfery-core' ),
		'post_types'   => 'tripfery_team',
		'rewrite'      => array( 'slug' => TripferyTheme::$options['team_cat_slug'] ),
	),	
	'tripfery_service_category' => array(
		'title'        => __( 'Service Category', 'tripfery-core' ),
		'plural_title' => __( 'Service Categories', 'tripfery-core' ),
		'post_types'   => 'tripfery_service',
		'rewrite'      => array( 'slug' => TripferyTheme::$options['service_cat_slug'] ),
	),
	'tripfery_locations_category' => array(
		'title'        => __( 'Locations Category', 'tripfery-core' ),
		'plural_title' => __( 'Locations Categories', 'tripfery-core' ),
		'post_types'   => 'tripfery_locations',
		'rewrite'      => array( 'slug' => TripferyTheme::$options['locations_cat_slug'] ),
	),
);


$Posts = RT_Posts::getInstance();
$Posts->add_post_types( $post_types );
$Posts->add_taxonomies( $taxonomies );