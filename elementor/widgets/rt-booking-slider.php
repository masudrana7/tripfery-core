<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
if ( ! defined( 'ABSPATH' ) ) exit;

class RT_Booking_Slider extends Custom_Widget_Base {
	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'RT Booking Slider', 'tripfery-core' );
		$this->rt_base = 'rt-booking-slider';
		$this->rt_translate = array(
			'cols'  => array(
				'12' => esc_html__( '1 Col', 'tripfery-core' ),
				'6'  => esc_html__( '2 Col', 'tripfery-core' ),
				'4'  => esc_html__( '3 Col', 'tripfery-core' ),
				'3'  => esc_html__( '4 Col', 'tripfery-core' ),
				'2'  => esc_html__( '6 Col', 'tripfery-core' ),
			),
		);
		parent::__construct( $data, $args );
	}

	public function rt_fields(){
		$terms  = get_terms( array( 'taxonomy' => 'categories', 'fields' => 'id=>name' ) );
		$category_dropdown = array( '0' => __( 'Please Selecet category', 'tripfery-core' ) );
		foreach ( $terms as $id => $name ) {
			$category_dropdown[$id] = $name;
		}
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'sec_cat',
			array(
				'type' => Controls_Manager::SELECT2,
				'label' => esc_html__('Select Category', 'tripfery-core'),
				'options' => $category_dropdown,
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'sec_style',
			array(
				'type' => Controls_Manager::SELECT2,
				'label' => esc_html__('Select Style', 'tripfery-core'),
				'options' => array(
					'style1' => esc_html__('Style Hotel', 'tripfery-core'),
					'style2' => esc_html__('Style Car', 'tripfery-core'),
					'style3' => esc_html__('Style Tour', 'tripfery-core'),
					'style4' => esc_html__('Style Activity', 'tripfery-core'),
					'style7' => esc_html__('Style Activity Two', 'tripfery-core'),
					'style5' => esc_html__('Style Rental', 'tripfery-core'),
					'style6' => esc_html__('Style Restaurant', 'tripfery-core'),
				),
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'cat_icon',
			[
				'type' => Controls_Manager::SELECT2,
				'label' => esc_html__('Select Icon', 'tripfery-core'),
				'options' => array(
					'icon-tripfery-hotel' => esc_html__('Hotel', 'tripfery-core'),
					'icon-tripfery-tours' => esc_html__('Tours', 'tripfery-core'),
					'icon-tripfery-activity' => esc_html__('Activity', 'tripfery-core'),
					'icon-tripfery-hostel' => esc_html__('Hostel', 'tripfery-core'),
					'icon-tripfery-car' => esc_html__('Car', 'tripfery-core'),
					'icon-tripfery-restaurant' => esc_html__('Restaurant', 'tripfery-core'),
				),
				'label_block' => true,
				'default' => 'icon-tripfery-hotel',
			]
		);
		$repeater->add_control(
			'button_text',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__('Button Text', 'tripfery-core'),
				'default' => 'View Availability',
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'post_not_in',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__('Post ID', 'tripfery-core'),
				'default' => '0',
				'label_block' => true,
			]
		);
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'General', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'tab_items',
				'label'   => esc_html__('BA Booking Items', 'tripfery-core'),
				'name'    => 'cat_multi_box',
				'options' => $category_dropdown,
				'fields' => $repeater->get_controls(),
			),
			
			/*Start category*/			


			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'rating_display',
				'label'       => esc_html__('Rating Display', 'tripfery-core'),
				'label_on'    => esc_html__('Show', 'tripfery-core'),
				'label_off'   => esc_html__('Hide', 'tripfery-core'),
				'default'     => 'yes',
				'condition'   => array('style' => array('style1')),
				
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'button_display',
				'label'       => esc_html__('Button Display', 'tripfery-core'),
				'label_on'    => esc_html__('Show', 'tripfery-core'),
				'label_off'   => esc_html__('Hide', 'tripfery-core'),
				'default'     => 'yes',
				'condition'   => array('style' => array('style1')),
				
			),

			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'featured_display',
				'label'       => esc_html__('Featured Display', 'tripfery-core'),
				'label_on'    => esc_html__('Show', 'tripfery-core'),
				'label_off'   => esc_html__('Hide', 'tripfery-core'),
				'default'     => 'no',
			),

			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'price_display',
				'label'       => esc_html__('Price Display', 'tripfery-core'),
				'label_on'    => esc_html__('Show', 'tripfery-core'),
				'label_off'   => esc_html__('Hide', 'tripfery-core'),
				'default'     => 'yes',
			),
			
			/*Post Order*/
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'post_order',
				'label'   => esc_html__( 'Post Ordering', 'tripfery-core' ),
				'options' => array(
					'DESC'	=> esc_html__( 'Desecending', 'tripfery-core' ),
					'ASC'	=> esc_html__( 'Ascending', 'tripfery-core' ),
				),
				'default' => 'DESC',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'post_orderby',
				'label'   => esc_html__( 'Post Sorting', 'tripfery-core' ),				
				'options' => array(
					'recent' 		=> esc_html__( 'Recent Post', 'tripfery-core' ),
					'rand' 			=> esc_html__( 'Random Post', 'tripfery-core' ),
					'menu_order' 	=> esc_html__( 'Custom Order', 'tripfery-core' ),
					'title' 		=> esc_html__( 'By Name', 'tripfery-core' ),
				),
				'default' => 'recent',
			),	

			array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'posts_not_in',
				'label'   => esc_html__( 'Enter Post ID that will not display', 'tripfery-core' ),
				'fields' => $repeater->get_controls(),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'itemnumber',
				'label'   => esc_html__( 'Item Number', 'tripfery-core' ),
				'default' => -1,
				'description' => esc_html__( 'Use -1 for showing all items( Showing items per category )', 'tripfery-core' ),
			),
			array(
				'mode' => 'section_end',
			),

			

			/*Location Style*/
			array(
				'mode'    => 'section_start',
				'id'      => 'location_style',
				'label'   => esc_html__('Location Style', 'tripfery-core'),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'loc_color',
				'label'   => esc_html__( 'Text Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .badge .badge-text' => 'color: {{VALUE}}',
				),
			),
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'loc_hover_color',
				'label'   => esc_html__( 'Text Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .badge:hover .badge-text' => 'color: {{VALUE}}',
				),
			),	
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'loc_icon',
				'label'   => esc_html__( 'Icon Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .badge .badge-icon' => 'color: {{VALUE}}',
				),
			),	
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'loc_hover_icon',
				'label'   => esc_html__( 'Icon Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .badge:hover .badge-icon' => 'color: {{VALUE}}',
				),
			),	
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'loc_bg',
				'label'   => esc_html__( 'Background Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .badge' => 'background-color: {{VALUE}}',
				),
			),	
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'loc_hover_bg',
				'label'   => esc_html__( 'Background Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .badge:hover' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'badge_padding',
				'mode'    => 'responsive',
				'label'   => esc_html__('Padding', 'tripfery-core'),
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'loc_typo',
				'label'   => esc_html__('Typography', 'tripfery-core'),
				'selector' => '{{WRAPPER}} .badge .badge-text',
			),	
			array(
				'mode' => 'section_end',
			),

			/*Title Style*/
			array(
				'mode'    => 'section_start',
				'id'      => 'title_style',
				'label'   => esc_html__('Title Style', 'tripfery-core'),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__('Title Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .listing-card .listing-card-title a' => 'color: {{VALUE}}',
				),
			),

			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_hover_color',
				'label'   => esc_html__('Title Hover Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .listing-card:hover .listing-card-title a' => 'color: {{VALUE}}',
				),
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__('Typography', 'tripfery-core'),
				'selector' => '{{WRAPPER}} .listing-card-title',
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'title_margin',
				'mode'    => 'responsive',
				'label'   => esc_html__('Padding', 'tripfery-core'),
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .listing-card-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'mode' => 'section_end',
			),

			/*Price Style*/
			array(
				'mode'    => 'section_start',
				'id'      => 'price_style',
				'label'   => esc_html__('Price Style', 'tripfery-core'),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'price_color',
				'label'   => esc_html__('Price Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .listing-card .price-text' => 'color: {{VALUE}}',
				),
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'prcie_typo',
				'label'   => esc_html__('Typography', 'tripfery-core'),
				'selector' => '{{WRAPPER}} .listing-card .price-text',
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'price_padding',
				'mode'    => 'responsive',
				'label'   => esc_html__('Price Area Padding', 'tripfery-core'),
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .price-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'mode' => 'section_end',
			),

			/*Button Style*/
			array(
				'mode'    => 'section_start',
				'id'      => 'button_style',
				'label'   => esc_html__('Button Style', 'tripfery-core'),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'btn_color',
				'label'   => esc_html__('Button Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .price-area a' => 'color: {{VALUE}}',
				),
			),

			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'btn_hover_color',
				'label'   => esc_html__('Button Hover Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .price-area a:hover' => 'color: {{VALUE}}',
				),
			),

			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'btn_bg_color',
				'label'   => esc_html__('Button Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .price-area a' => 'background-color: {{VALUE}}',
				),
			),

			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'btn_bg_hover_color',
				'label'   => esc_html__('Button BG Hover Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .price-area a:hover' => 'background-color: {{VALUE}}',
				),
			),

			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'btn_padding',
				'mode'    => 'responsive',
				'label'   => esc_html__('Padding', 'tripfery-core'),
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .price-area a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'btn_typo',
				'label'   => esc_html__('Typography', 'tripfery-core'),
				'selector' => '{{WRAPPER}} .price-area a',
			),
			
			array(
				'mode' => 'section_end',
			),
			// Global Style
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_option_style',
				'label'   => esc_html__('Global Option', 'tripfery-core'),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'wishlist_icon_color',
				'label'   => esc_html__('Wishlist Icon Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .wishlist svg' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'wishlist_icon_hover_color',
				'label'   => esc_html__('Wishlist Icon Hover Color', 'tripfery-core'),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .wishlist svg:hover' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'sec_padding',
				'mode'    => 'responsive',
				'label'   => esc_html__('Padding', 'tripfery-core'),
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .listing-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'img_radius',
				'mode'    => 'responsive',
				'label'   => esc_html__('Image Radius', 'tripfery-core'),
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .listing-card .listing-thumb-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'sec_radius',
				'mode'    => 'responsive',
				'label'   => esc_html__('Button Radius', 'tripfery-core'),
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .listing-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			),
			array(
				'mode' => 'section_end',
			),

			// Nav Option
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_nav_option',
				'label'   => esc_html__( 'Nav Option', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'display_arrow',
				'label'       => esc_html__( 'Navigation Arrow', 'tripfery-core' ),
				'label_on'    => esc_html__( 'On', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Off', 'tripfery-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Navigation Arrow. Default: On', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'nav_position',
				'label'   => esc_html__( 'Nav Position', 'tripfery-core' ),				
				'options' => array(
					'default' 		=> esc_html__( 'Default', 'tripfery-core' ),
					'top-right' 	=> esc_html__( 'Top Right', 'tripfery-core' ),
				),
				'default' => 'default',
				'condition'   => array( 'display_arrow' => array( 'yes' ) ),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'nav_space',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Nav Space', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => -100,
						'max' => 100,
					),
					'px' => array(
						'min' => -200,
						'max' => 200,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .top-right .rt-swiper-slider .swiper-navigation' => 'top: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array( 'display_arrow' => array( 'yes' ), 'nav_position' => array( 'top-right' ) ),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'prev_arrow',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Prev Arrow', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => -100,
						'max' => 100,
					),
					'px' => array(
						'min' => -1000,
						'max' => 1000,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-slider .swiper-navigation .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array( 'display_arrow' => array( 'yes' ) ),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'next_arrow',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Next Arrow', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => -100,
						'max' => 100,
					),
					'px' => array(
						'min' => -1000,
						'max' => 1000,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-slider .swiper-navigation .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array( 'display_arrow' => array( 'yes' ) ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'display_buttet',
				'label'       => esc_html__( 'Pagination', 'tripfery-core' ),
				'label_on'    => esc_html__( 'On', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Off', 'tripfery-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Navigation Arrow. Default: Off', 'tripfery-core' ),
			),
	        array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'nav_color',
				'label'   => esc_html__( 'Nav Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-nav .swiper-navigation > div' => 'color: {{VALUE}}',
				),
			),
	        array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'nav_hover_color',
				'label'   => esc_html__( 'Nav Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-nav .swiper-navigation > div:hover' => 'color: {{VALUE}}',
				),
			),
	        array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'nav_bg_color',
				'label'   => esc_html__( 'Nav Background Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-nav .swiper-navigation > div' => 'background-color: {{VALUE}}',
				),
			),
	        array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'nav_bg_hover_color',
				'label'   => esc_html__( 'Nav Background Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-nav .swiper-navigation > div:hover' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'nav_width',
				'label'   => esc_html__( 'Nav Width', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-nav .swiper-navigation > div' => 'width: {{SIZE}}px;',
				),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'nav_height',
				'label'   => esc_html__( 'Nav Height', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-nav .swiper-navigation > div' => 'width: {{SIZE}}px;',
				),
			),
			array(
				'type'    => Controls_Manager::DIMENSIONS,
				'id'      => 'nav_radius',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Nav Radius', 'tripfery-core' ),
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-swiper-nav .swiper-navigation > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			),
	        array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'pag_bg_color',
				'label'   => esc_html__( 'Pagination BG Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-nav .swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
				),
			),
	        array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'pag_bg_active_color',
				'label'   => esc_html__( 'Pagination BG Active Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-nav .swiper-pagination .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'pagination_space',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Pagination Space', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 500,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .rt-swiper-nav .swiper-pagination-bullets' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
			),
			array(
				'mode' => 'section_end',
			),

			// Animation style
			array(
	            'mode'    => 'section_start',
	            'id'      => 'sec_animation_style',
	            'label'   => esc_html__( 'Animation', 'tripfery-core' ),
	            'tab'     => Controls_Manager::TAB_STYLE,
	        ),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'animation',
				'label'   => esc_html__( 'Animation', 'tripfery-core' ),
				'options' => array(
					'wow'        => esc_html__( 'On', 'tripfery-core' ),
					'hide'        => esc_html__( 'Off', 'tripfery-core' ),
				),
				'default' => 'wow',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'animation_effect',
				'label'   => esc_html__( 'Entrance Animation', 'tripfery-core' ),
				'options' => array(
                    'none' => esc_html__( 'none', 'tripfery-core' ),
					'bounce' => esc_html__( 'bounce', 'tripfery-core' ),
					'flash' => esc_html__( 'flash', 'tripfery-core' ),
					'pulse' => esc_html__( 'pulse', 'tripfery-core' ),
					'rubberBand' => esc_html__( 'rubberBand', 'tripfery-core' ),
					'shakeX' => esc_html__( 'shakeX', 'tripfery-core' ),
					'shakeY' => esc_html__( 'shakeY', 'tripfery-core' ),
					'headShake' => esc_html__( 'headShake', 'tripfery-core' ),
					'swing' => esc_html__( 'swing', 'tripfery-core' ),					
					'fadeIn' => esc_html__( 'fadeIn', 'tripfery-core' ),
					'fadeInDown' => esc_html__( 'fadeInDown', 'tripfery-core' ),
					'fadeInLeft' => esc_html__( 'fadeInLeft', 'tripfery-core' ),
					'fadeInRight' => esc_html__( 'fadeInRight', 'tripfery-core' ),
					'fadeInUp' => esc_html__( 'fadeInUp', 'tripfery-core' ),					
					'bounceIn' => esc_html__( 'bounceIn', 'tripfery-core' ),
					'bounceInDown' => esc_html__( 'bounceInDown', 'tripfery-core' ),
					'bounceInLeft' => esc_html__( 'bounceInLeft', 'tripfery-core' ),
					'bounceInRight' => esc_html__( 'bounceInRight', 'tripfery-core' ),
					'bounceInUp' => esc_html__( 'bounceInUp', 'tripfery-core' ),			
					'slideInDown' => esc_html__( 'slideInDown', 'tripfery-core' ),
					'slideInLeft' => esc_html__( 'slideInLeft', 'tripfery-core' ),
					'slideInRight' => esc_html__( 'slideInRight', 'tripfery-core' ),
					'slideInUp' => esc_html__( 'slideInUp', 'tripfery-core' ), 
                ),
				'default' => 'fadeInUp',
				'condition'   => array('animation' => array( 'wow' ) ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'delay',
				'label'   => esc_html__( 'Delay', 'tripfery-core' ),
				'default' => '0.2',
				'condition'   => array( 'animation' => array( 'wow' ) ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'duration',
				'label'   => esc_html__( 'Duration', 'tripfery-core' ),
				'default' => '0.4',
				'condition'   => array( 'animation' => array( 'wow' ) ),
			),
			array(
				'mode' => 'section_end',
			),

			// Responsive Slider Columns
			array(
				'mode'        => 'section_start',
				'id'          => 'sec_slider_perview',
				'label'       => esc_html__( 'Per View Options', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'desktop',
				'label'   => esc_html__( 'Desktops: > 1600px', 'tripfery-core' ),
				'default' => '4',
				'options' => array(
					'1' => esc_html__( '1', 'tripfery-core' ),
					'2' => esc_html__( '2', 'tripfery-core' ),
					'3' => esc_html__( '3',  'tripfery-core' ),
					'4' => esc_html__( '4',  'tripfery-core' ),
					'5' => esc_html__( '5',  'tripfery-core' ),
					'6' => esc_html__( '6',  'tripfery-core' ),
				),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'md_desktop',
				'label'   => esc_html__( 'Desktops: > 1200px', 'tripfery-core' ),
				'default' => '3',
				'options' => array(
					'1' => esc_html__( '1', 'tripfery-core' ),
					'2' => esc_html__( '2', 'tripfery-core' ),
					'3' => esc_html__( '3',  'tripfery-core' ),
					'4' => esc_html__( '4',  'tripfery-core' ),
				),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'sm_desktop',
				'label'   => esc_html__( 'Desktops: > 992px', 'tripfery-core' ),
				'default' => '2',
				'options' => array(
					'1' => esc_html__( '1', 'tripfery-core' ),
					'2' => esc_html__( '2', 'tripfery-core' ),
					'3' => esc_html__( '3',  'tripfery-core' ),
					'4' => esc_html__( '4',  'tripfery-core' ),
				),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'tablet',
				'label'   => esc_html__( 'Tablets: > 768px', 'tripfery-core' ),
				'default' => '2',
				'options' => array(
					'1' => esc_html__( '1', 'tripfery-core' ),
					'2' => esc_html__( '2', 'tripfery-core' ),
					'3' => esc_html__( '3',  'tripfery-core' ),
					'4' => esc_html__( '4',  'tripfery-core' ),
				),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'mobile',
				'label'   => esc_html__( 'Phones: > 576px', 'tripfery-core' ),
				'default' => '1',
				'options' => array(
					'1' => esc_html__( '1', 'tripfery-core' ),
					'2' => esc_html__( '2', 'tripfery-core' ),
					'3' => esc_html__( '3',  'tripfery-core' ),
					'4' => esc_html__( '4',  'tripfery-core' ),
				),
			),
			array(
				'mode' => 'section_end',
			),

			// Slider options
			array(
				'mode'        => 'section_start',
				'id'          => 'sec_slider',
				'label'       => esc_html__( 'Slider Options', 'tripfery-core' ),
			),			
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_autoplay',
				'label'       => esc_html__( 'Autoplay', 'tripfery-core' ),
				'label_on'    => esc_html__( 'On', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Off', 'tripfery-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Enable or disable autoplay. Default: On', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'mode' 			=> 'responsive',
				'id'      => 'slides_per_group',
				'label'   => esc_html__( 'slides Per Group', 'tripfery-core' ),
				'default' => array(
					'size' => 1,
				),
				'description' => esc_html__( 'slides Per Group. Default: 1', 'tripfery-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'centered_slides',
				'label'       => esc_html__( 'Centered Slides', 'tripfery-core' ),
				'label_on'    => esc_html__( 'On', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Off', 'tripfery-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Centered Slides. Default: Off', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'mode' 			=> 'responsive',
				'id'      => 'slides_space',
				'label'   => esc_html__( 'Slides Space', 'tripfery-core' ),
				'size_units' => array( 'px', '%' ),
				'default' => array(
					'unit' => 'px',
					'size' => 24,
				),
				'description' => esc_html__( 'Slides Space. Default: 24', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'slider_autoplay_delay',
				'label'   => esc_html__( 'Autoplay Slide Delay', 'tripfery-core' ),
				'default' => 5000,
				'description' => esc_html__( 'Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds', 'tripfery-core' ),
				'condition'   => array( 'slider_autoplay' => 'yes' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'slider_autoplay_speed',
				'label'   => esc_html__( 'Autoplay Slide Speed', 'tripfery-core' ),
				'default' => 1000,
				'description' => esc_html__( 'Set any value for example .8 seconds to play it in every 2 seconds. Default: .8 Seconds', 'tripfery-core' ),
				'condition'   => array( 'slider_autoplay' => 'yes' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_loop',
				'label'       => esc_html__( 'Loop', 'tripfery-core' ),
				'label_on'    => esc_html__( 'On', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Off', 'tripfery-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Loop to first item. Default: On', 'tripfery-core' ),
			),
			array(
				'mode' => 'section_end',
			),
		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();
		if($data['slider_autoplay']=='yes'){
			$data['slider_autoplay']=true;
		}
		else{
			$data['slider_autoplay']=false;
		}

		$swiper_data = array(
			'slidesPerView' 	=>2,
			'loop'				=>$data['slider_loop']=='yes' ? true:false,
			'spaceBetween'		=>$data['slides_space']['size'],
			'slidesPerGroup'	=>$data['slides_per_group']['size'],
			'centeredSlides'	=>$data['centered_slides']=='yes' ? true:false ,
			'slideToClickedSlide' =>true,
			'autoplay'				=>array(
				'delay'  => $data['slider_autoplay_delay'],
			),
			'speed'      =>$data['slider_autoplay_speed'],
			'breakpoints' =>array(
				'0'    =>array('slidesPerView' =>1),
				'576'    =>array('slidesPerView' =>$data['mobile']),
				'768'    =>array('slidesPerView' =>$data['tablet']),
				'992'    =>array('slidesPerView' =>$data['sm_desktop']),
				'1200'    =>array('slidesPerView' =>$data['md_desktop']),				
				'1600'    =>array('slidesPerView' =>$data['desktop'])
			),
			'auto'   =>$data['slider_autoplay']
		);
		
		$template = 'rt-booking-slider';

		$data['swiper_data'] = json_encode( $swiper_data );   
		
		return $this->rt_template( $template, $data );
	}

	
}