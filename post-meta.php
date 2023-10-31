<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;

use TripferyTheme;
use TripferyTheme_Helper;
use \RT_Postmeta;

if ( ! defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'RT_Postmeta' ) ) {
	return;
}

$Postmeta = RT_Postmeta::getInstance();

$prefix = TRIPFERY_CORE_CPT_PREFIX;

/*-------------------------------------
#. Layout Settings
---------------------------------------*/
$nav_menus = wp_get_nav_menus( array( 'fields' => 'id=>name' ) );
$nav_menus = array( 'default' => __( 'Default', 'tripfery-core' ) ) + $nav_menus;
$sidebars  = array( 'default' => __( 'Default', 'tripfery-core' ) ) + TripferyTheme_Helper::custom_sidebar_fields();

$Postmeta->add_meta_box( "{$prefix}_page_settings", __( 'Layout Settings', 'tripfery-core' ), array( 'page', 'post', 'tripfery_team', 'tripfery_locations', 'tripfery_service', 'product' ), '', '', 'high', array(
	'fields' => array(
	
		"{$prefix}_layout_settings" => array(
			'label'   => __( 'Layouts', 'tripfery-core' ),
			'type'    => 'group',
			'value'  => array(	
			
				"{$prefix}_layout" => array(
					'label'   => __( 'Layout', 'tripfery-core' ),
					'type'    => 'select',
					'options' => array(
						'default'       => __( 'Default', 'tripfery-core' ),
						'full-width'    => __( 'Full Width', 'tripfery-core' ),
						'left-sidebar'  => __( 'Left Sidebar', 'tripfery-core' ),
						'right-sidebar' => __( 'Right Sidebar', 'tripfery-core' ),
					),
					'default'  => 'default',
				),		
				'tripfery_sidebar' => array(
					'label'    => __( 'Custom Sidebar', 'tripfery-core' ),
					'type'     => 'select',
					'options'  => $sidebars,
					'default'  => 'default',
				),
				"{$prefix}_page_menu" => array(
					'label'    => __( 'Main Menu', 'tripfery-core' ),
					'type'     => 'select',
					'options'  => $nav_menus,
					'default'  => 'default',
				),
				"{$prefix}_top_bar" => array(
					'label' 	  => __( 'Top Bar', 'tripfery-core' ),
					'type'  	  => 'select',
					'options' => array(
						'default' => __( 'Default', 'tripfery-core' ),
						'on'      => __( 'Enabled', 'tripfery-core' ),
						'off'     => __( 'Disabled', 'tripfery-core' ),
					),
					'default'  	  => 'default',
				),
				"{$prefix}_top_bar_style" => array(
					'label' 	=> __( 'Top Bar Layout', 'tripfery-core' ),
					'type'  	=> 'select',
					'options'	=> array(
						'default' => __( 'Default', 'tripfery-core' ),
						'1'       => __( 'Layout 1', 'tripfery-core' ),
						'2'       => __( 'Layout 2', 'tripfery-core' ),
						'3'       => __( 'Layout 3', 'tripfery-core' ),
						'4'       => __( 'Layout 4', 'tripfery-core' ),
					),
					'default'   => 'default',
				),
				"{$prefix}_header_opt" => array(
					'label' 	  => __( 'Header On/Off', 'tripfery-core' ),
					'type'  	  => 'select',
					'options' => array(
						'default' => __( 'Default', 'tripfery-core' ),
						'on'      => __( 'Enabled', 'tripfery-core' ),
						'off'     => __( 'Disabled', 'tripfery-core' ),
					),
					'default'  	  => 'default',
				),
				"{$prefix}_tr_header" => array(
					'label'    	  => __( 'Transparent Header', 'tripfery-core' ),
					'type'     	  => 'select',
					'options'  	  => array(
						'default' => __( 'Default', 'tripfery-core' ),
						'on'      => __( 'Enabled', 'tripfery-core' ),
						'off'     => __( 'Disabled', 'tripfery-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_header" => array(
					'label'   => __( 'Header Layout', 'tripfery-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'tripfery-core' ),
						'1'       => __( 'Layout 1', 'tripfery-core' ),
						'2'       => __( 'Layout 2', 'tripfery-core' ),
						'3'       => __( 'Layout 3', 'tripfery-core' ),
						'4'       => __( 'Layout 4', 'tripfery-core' ),
						'5'       => __( 'Layout 5', 'tripfery-core' ),
						'6'       => __( 'Layout 6', 'tripfery-core' ),
						'7'       => __( 'Layout 7', 'tripfery-core' ),
						'8'       => __( 'Layout 8', 'tripfery-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_footer" => array(
					'label'   => __( 'Footer Layout', 'tripfery-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'tripfery-core' ),
						'1'       => __( 'Layout 1', 'tripfery-core' ),
						'2'       => __( 'Layout 2', 'tripfery-core' ),
						'3'       => __( 'Layout 3', 'tripfery-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_footer_area" => array(
					'label' 	  => __( 'Footer Area', 'tripfery-core' ),
					'type'  	  => 'select',
					'options' => array(
						'default' => __( 'Default', 'tripfery-core' ),
						'on'      => __( 'Enabled', 'tripfery-core' ),
						'off'     => __( 'Disabled', 'tripfery-core' ),
					),
					'default'  	  => 'default',
				),
				"{$prefix}_copyright_area" => array(
					'label' 	  => __( 'Copyright Area', 'tripfery-core' ),
					'type'  	  => 'select',
					'options' => array(
						'default' => __( 'Default', 'tripfery-core' ),
						'on'      => __( 'Enabled', 'tripfery-core' ),
						'off'     => __( 'Disabled', 'tripfery-core' ),
					),
					'default'  	  => 'default',
				),
				"{$prefix}_top_padding" => array(
					'label'   => __( 'Content Padding Top', 'tripfery-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'tripfery-core' ),
						'0px'     => __( '0px', 'tripfery-core' ),
						'10px'    => __( '10px', 'tripfery-core' ),
						'20px'    => __( '20px', 'tripfery-core' ),
						'30px'    => __( '30px', 'tripfery-core' ),
						'40px'    => __( '40px', 'tripfery-core' ),
						'50px'    => __( '50px', 'tripfery-core' ),
						'60px'    => __( '60px', 'tripfery-core' ),
						'70px'    => __( '70px', 'tripfery-core' ),
						'80px'    => __( '80px', 'tripfery-core' ),
						'90px'    => __( '90px', 'tripfery-core' ),
						'100px'   => __( '100px', 'tripfery-core' ),
						'110px'   => __( '110px', 'tripfery-core' ),
						'120px'   => __( '120px', 'tripfery-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_bottom_padding" => array(
					'label'   => __( 'Content Padding Bottom', 'tripfery-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'tripfery-core' ),
						'0px'     => __( '0px', 'tripfery-core' ),
						'10px'    => __( '10px', 'tripfery-core' ),
						'20px'    => __( '20px', 'tripfery-core' ),
						'30px'    => __( '30px', 'tripfery-core' ),
						'40px'    => __( '40px', 'tripfery-core' ),
						'50px'    => __( '50px', 'tripfery-core' ),
						'60px'    => __( '60px', 'tripfery-core' ),
						'70px'    => __( '70px', 'tripfery-core' ),
						'80px'    => __( '80px', 'tripfery-core' ),
						'90px'    => __( '90px', 'tripfery-core' ),
						'100px'   => __( '100px', 'tripfery-core' ),
						'110px'   => __( '110px', 'tripfery-core' ),
						'120px'   => __( '120px', 'tripfery-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_banner" => array(
					'label'   => __( 'Banner', 'tripfery-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'tripfery-core' ),
						'on'	  => __( 'Enable', 'tripfery-core' ),
						'off'	  => __( 'Disable', 'tripfery-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_breadcrumb" => array(
					'label'   => __( 'Breadcrumb', 'tripfery-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'tripfery-core' ),
						'on'      => __( 'Enable', 'tripfery-core' ),
						'off'	  => __( 'Disable', 'tripfery-core' ),
					),
					'default'  => 'default',
				),
				"{$prefix}_banner_type" => array(
					'label'   => __( 'Banner Background Type', 'tripfery-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'tripfery-core' ),
						'bgimg'   => __( 'Background Image', 'tripfery-core' ),
						'bgcolor' => __( 'Background Color', 'tripfery-core' ),
					),
					'default' => 'default',
				),
				"{$prefix}_banner_bgimg" => array(
					'label' => __( 'Banner Background Image', 'tripfery-core' ),
					'type'  => 'image',
					'desc'  => __( 'If not selected, default will be used', 'tripfery-core' ),
				),
				"{$prefix}_banner_bgcolor" => array(
					'label' => __( 'Banner Background Color', 'tripfery-core' ),
					'type'  => 'color_picker',
					'desc'  => __( 'If not selected, default will be used', 'tripfery-core' ),
				),		
				"{$prefix}_page_bgimg" => array(
					'label' => __( 'Page/Post Background Image', 'tripfery-core' ),
					'type'  => 'image',
					'desc'  => __( 'If not selected, default will be used', 'tripfery-core' ),
				),
				"{$prefix}_page_bgcolor" => array(
					'label' => __( 'Page/Post Background Color', 'tripfery-core' ),
					'type'  => 'color_picker',
					'desc'  => __( 'If not selected, default will be used', 'tripfery-core' ),
				),
			)
		)
	),
) );

/*-------------------------------------
#. Single Post Gallery
---------------------------------------*/
$Postmeta->add_meta_box( 'tripfery_post_info', __( 'Post Info', 'tripfery-core' ), array( 'post' ), '', '', 'high', array(
	'fields' => array(
		"tripfery_youtube_link" => array(
			'label'   => __( 'Youtube Link', 'tripfery-core' ),
			'type'    => 'text',
			'default'  => '',
			'desc'  => __( 'Only work for the video post format', 'tripfery-core' ),
		),
		'tripfery_post_gallery' => array(
			'label' => __( 'Post Gallery', 'tripfery-core' ),
			'type'  => 'gallery',
			'desc'  => __( 'Only work for the gallery post format', 'tripfery-core' ),
		),
	),
) );

/*-------------------------------------
#. Team
---------------------------------------*/
$Postmeta->add_meta_box( 'tripfery_team_settings', __( 'Team Member Settings', 'tripfery-core' ), array( 'tripfery_team' ), '', '', 'high', array(
	'fields' => array(
		'tripfery_team_position' => array(
			'label' => __( 'Position', 'tripfery-core' ),
			'type'  => 'text',
		),
		'tripfery_team_website' => array(
			'label' => __( 'Website', 'tripfery-core' ),
			'type'  => 'text',
		),
		'tripfery_team_email' => array(
			'label' => __( 'Email', 'tripfery-core' ),
			'type'  => 'text',
		),
		'tripfery_team_phone' => array(
			'label' => __( 'Phone', 'tripfery-core' ),
			'type'  => 'text',
		),
		'tripfery_team_address' => array(
			'label' => __( 'Address', 'tripfery-core' ),
			'type'  => 'text',
		),
		'tripfery_team_socials_header' => array(
			'label' => __( 'Socials', 'tripfery-core' ),
			'type'  => 'header',
			'desc'  => __( 'Enter your social links here', 'tripfery-core' ),
		),
		'tripfery_team_socials' => array(
			'type'  => 'group',
			'value'  => TripferyTheme_Helper::team_socials()
		),
	)
) );

$Postmeta->add_meta_box( 'tripfery_team_skills', __( 'Team Member Skills', 'tripfery-core' ), array( 'tripfery_team' ), '', '', 'high', array(
	'fields' => array(
		'tripfery_team_skill_info' => array(
			'label' => __( 'Skill Info', 'tripfery-core' ),
			'type'  => 'textarea',
		),
		'tripfery_team_skill' => array(
			'type'  => 'repeater',
			'button' => __( 'Add New Skill', 'tripfery-core' ),
			'value'  => array(
				'skill_name' => array(
					'label' => __( 'Skill Name', 'tripfery-core' ),
					'type'  => 'text',
					'desc'  => __( 'eg. Marketing', 'tripfery-core' ),
				),
				'skill_value' => array(
					'label' => __( 'Skill Percentage (%)', 'tripfery-core' ),
					'type'  => 'text',
					'desc'  => __( 'eg. 75', 'tripfery-core' ),
				),
				'skill_color' => array(
					'label' => __( 'Skill Color', 'tripfery-core' ),
					'type'  => 'color_picker',
					'desc'  => __( 'If not selected, primary color will be used', 'tripfery-core' ),
				),
			)
		),
	)
) );
$Postmeta->add_meta_box( 'tripfery_team_contact', __( 'Team Member Contact', 'tripfery-core' ), array( 'tripfery_team' ), '', '', 'high', array(
	'fields' => array(
		'tripfery_team_contact_form' => array(
			'label' => __( 'Contct Shortcode', 'tripfery-core' ),
			'type'  => 'text',
		),
	)
) );

/*-------------------------------------
#. Locations
---------------------------------------*/
$Postmeta->add_meta_box( 'tripfery_locations_info', __( 'Locations Area Information', 'tripfery-core' ), array( 'tripfery_locations' ), '', '', 'high', array(
	'fields' => array(
		'tripfery_location_activities' => array(
			'label' => __( 'Location Activities', 'tripfery-core' ),
			'type'  => 'text',
		),
		'tripfery_location_cars' => array(
			'label' => __( 'Location Cars', 'tripfery-core' ),
			'type'  => 'text',
		),
		'tripfery_location_hotel' => array(
			'label' => __( 'Location Hotel', 'tripfery-core' ),
			'type'  => 'text',
		),
		'tripfery_location_tours' => array(
			'label' => __( 'Location Tours', 'tripfery-core' ),
			'type'  => 'text',
		),
		'tripfery_location_rentals' => array(
			'label' => __( 'Location Rentals', 'tripfery-core' ),
			'type'  => 'text',
		),			
	)
) );

/*-------------------------------------
#. Service
---------------------------------------*/
$Postmeta->add_meta_box( 'tripfery_service_style_box', __( 'Service style', 'tripfery-core' ), array( 'tripfery_service' ), '', '', 'high', array(
	'fields' => array(
		"tripfery_service_style" => array(
			'label'   => __( 'Service Template', 'tripfery-core' ),
			'type'    => 'select',
			'options' => array(
				'default'  => __( 'Default', 'tripfery-core' ),
				'style1'  => __( 'Style 1', 'tripfery-core' ),
				'style2'  => __( 'Style 2', 'tripfery-core' ),
			),
			'default'  => 'default',
		),
	),
) );

$Postmeta->add_meta_box( 'tripfery_service_media', __( 'Service Icon image', 'tripfery-core' ),array( "tripfery_service" ),'',
		'side',
		'default', array(
		'fields' => array(
			"tripfery_service_icon" => array(
			  'label' => __( 'Service Icon', 'tripfery-core' ),
			  'type'  => 'icon_select',
			  'desc'  => __( "Choose a Icon for your service", 'tripfery-core' ),
			  'options' => TripferyTheme_Helper::get_icons(),
			),
		)
) );

/*-------------------------------------
#. WooCommerce
---------------------------------------*/
$Postmeta->add_meta_box( 'tripfery_woo_product', __( 'Product Background', 'tripfery-core' ), array( 'product' ), '', '', 'high', array(
	'fields' => array(
		'tripfery_product_bgc' => array(
			'label' => __( 'Product Background Color', 'tripfery-core' ),
			'type'  => 'color_picker',
		),
	)
) );