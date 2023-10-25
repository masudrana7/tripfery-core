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
				'title' => __( 'Factory', 'tripfery-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/tripfery/home-02/',
			),
			'demo3' => array(
				'title' => __( 'Industry', 'tripfery-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/tripfery/home-03/',
			),
			'demo4' => array(
				'title' => __( 'Construction', 'tripfery-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/tripfery/home-04/',
			),
			'demo5' => array(
				'title' => __( 'Manufacture', 'tripfery-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/tripfery/home-05/',
			),
			'demo6' => array(
				'title' => __( 'Industry 02', 'tripfery-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/tripfery/home-06/',
			),
			'demo7' => array(
				'title' => __( 'Factory Black', 'tripfery-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot7.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/tripfery/home-07/',
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
			'demo1'  => 6,
			'demo2'  => 8,
			'demo3'  => 3914,
			'demo4'  => 4007,
			'demo5'  => 4023,
			'demo6'  => 4170,
			'demo7'  => 4359,
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