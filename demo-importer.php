<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;

use \FW_Ext_Backups_Demo;
use \WPCF7_ContactFormTemplate;

if ( ! defined( 'ABSPATH' ) ) exit;

class Demo_Importer {

	public function __construct() {
		add_filter( 'plugin_action_links_rt-demo-importer/rt-demo-importer.php', array( $this, 'add_action_links' ) ); // Link from plugins page 
		add_filter( 'rt_demo_installer_warning', array( $this, 'data_loss_warning' ) );
		add_filter( 'fw:ext:backups-demo:demos', array( $this, 'demo_config' ) );
		add_action( 'fw:ext:backups:tasks:success:id:demo-content-install', array( $this, 'after_demo_install' ) );
	}

	public function add_action_links( $links ) {
		$mylinks = array(
			'<a href="' . esc_url( admin_url( 'tools.php?page=fw-backups-demo-content' ) ) . '">'.__( 'Install Demo Contents', 'tripfery-core' ).'</a>',
		);
		return array_merge( $links, $mylinks );
	}

	public function data_loss_warning( $links ) {
		$html  = '<div style="margin-top:20px;color:#f00;font-size:20px;line-height:1.3;font-weight:600;margin-bottom:40px;border-color: #f00;border-style: dashed;border-width: 1px 0;padding:10px 0;">';
		$html .= __( 'Warning: All your old data will be lost if you install One Click demo data from here, so it is suitable only for a new website.', 'tripfery-core');
		$html .= '</div>';
		return $html;
	}

	public function demo_config( $demos ) {
		$demos_array = array(
			'demo1' => array(
				'title' => __( 'Main Home', 'tripfery-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/tripfery/',
			),
			'demo2' => array(
				'title' => __('Hotel Boking', 'tripfery-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/tripfery/home-2/',
			),
			'demo3' => array(
				'title' => __('Tour Package', 'tripfery-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/tripfery/home-3/',
			),
			'demo4' => array(
				'title' => __('Activity Place', 'tripfery-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/tripfery/home-4/',
			),
			'demo5' => array(
				'title' => __('Rental House', 'tripfery-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/tripfery/home-5/',
			),
			'demo6' => array(
				'title' => __('Rent A Car', 'tripfery-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/tripfery/home-6/',
			),
			'demo7' => array(
				'title' => __('Restaurant Booking', 'tripfery-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot7.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/tripfery/home-7/',
			),
			'demo8' => array(
				'title' => __('City Tour Activity', 'tripfery-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot8.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/tripfery/home-8/',
			),
			'demo9' => array(
				'title' => __('Tour Agency', 'tripfery-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot9.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/tripfery/home-9/',
			),
			'demo10' => array(
				'title' => __('Hotel Room', 'tripfery-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot10.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/tripfery/home-10/',
			),
		);

		$download_url = 'http://demo.radiustheme.com/wordpress/demo-content/tripfery/';

		foreach ($demos_array as $id => $data) {
			$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
				'url' => $download_url,
				'file_id' => $id,
			));
			$demo->set_title($data['title']);
			$demo->set_screenshot($data['screenshot']);
			$demo->set_preview_link($data['preview_link']);

			$demos[ $demo->get_id() ] = $demo;

			unset($demo);
		}

		return $demos;
	}

	public function after_demo_install( $collection ){
		// Update front page id
		$demos = array(
			'demo1'  => 14,
			'demo2'  => 833,
			'demo3'  => 1076,
			'demo4'  => 1335,
			'demo5'  => 1543,
			'demo6'  => 1657,
			'demo7'  => 1770,
			'demo8'  => 6169,
			'demo9'  => 6219,
			'demo10'  => 6286,
		);

		$data = $collection->to_array();

		foreach( $data['tasks'] as $task ) {
			if( $task['id'] == 'demo:demo-download' ){
				$demo_id = $task['args']['demo_id'];
				$page_id = $demos[$demo_id];
				update_option( 'page_on_front', $page_id );
				flush_rewrite_rules();
				break;
			}
		}
		
	}
}

new Demo_Importer;