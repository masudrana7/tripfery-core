<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;

if ( ! defined( 'ABSPATH' ) ) exit;

class RT_Locations extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'RT Locations', 'tripfery-core' );
		$this->rt_base = 'rt-locations';
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
		$terms = get_terms( array( 'taxonomy' => 'tripfery_locations_category', 'fields' => 'id=>name' ) );
		$category_dropdown = array( '0' => esc_html__( 'All Categories', 'tripfery-core' ) );

		foreach ( $terms as $id => $name ) {
			$category_dropdown[$id] = $name;
		}

		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'General', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => esc_html__( 'Style', 'tripfery-core' ),
				'options' => array(
					'style1' => esc_html__( 'Locations Grid 1', 'tripfery-core' ),
					'style2' => esc_html__( 'Locations Grid 2', 'tripfery-core' ),
					'style3' => esc_html__( 'Locations Grid 3', 'tripfery-core' ),
					'style7' => esc_html__( 'Locations Grid 4', 'tripfery-core' ),
					'style8' => esc_html__( 'Locations Grid 5', 'tripfery-core' ),
					'style10' => esc_html__( 'Locations Grid 6', 'tripfery-core' ),
					'style11' => esc_html__( 'Locations Grid 7', 'tripfery-core' ),
					'style4' => esc_html__( 'Locations Slider 1', 'tripfery-core' ),
					'style5' => esc_html__( 'Locations Slider 2', 'tripfery-core' ),
					'style6' => esc_html__( 'Locations Slider 3', 'tripfery-core' ),
					'style9' => esc_html__( 'Locations Slider 4', 'tripfery-core' ),
				),
				'default' => 'style1',
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'number',
				'label'   => esc_html__( 'Total number of items', 'tripfery-core' ),
				'default' => 6,
				'description' => esc_html__( 'Write -1 to show all', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'item_space',
				'label'   => esc_html__( 'Item Space', 'tripfery-core' ),
				'options' => array(
					'g-0' => esc_html__( 'Gutters 0', 'tripfery-core' ),
					'g-1' => esc_html__( 'Gutters 1', 'tripfery-core' ),
					'g-2' => esc_html__( 'Gutters 2', 'tripfery-core' ),
					'g-3' => esc_html__( 'Gutters 3', 'tripfery-core' ),
					'g-4' => esc_html__( 'Gutters 4', 'tripfery-core' ),
					'g-5' => esc_html__( 'Gutters 5', 'tripfery-core' ),
				),
				'default' => 'g-4',
				'condition'   => array( 'style' => array( 'style1', 'style2', 'style3', 'style7', 'style8', 'style10', 'style11' ) ),
			),			
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'cat',
				'label'   => esc_html__( 'Categories', 'tripfery-core' ),
				'options' => $category_dropdown,
				'default' => '0',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'post_ordering',
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
					'title' 		=> esc_html__( 'By Name', 'tripfery-core' ),
				),
				'default' => 'recent',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'more_button',
				'label'   => esc_html__( 'More Button', 'tripfery-core' ),
				'options' => array(
					'show'        => esc_html__( 'Show Read More', 'tripfery-core' ),
					'hide'        => esc_html__( 'Show Pagination', 'tripfery-core' ),
				),
				'default' => 'show',
				'condition'   => array( 'style' => array( 'style1', 'style2', 'style3', 'style7', 'style8', 'style10', 'style11' ) ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'see_button_text',
				'label'   => esc_html__( 'Button Text', 'tripfery-core' ),
				'condition'   => array( 'more_button' => array( 'show' ) ),
				'default' => esc_html__( 'More Locationss', 'tripfery-core' ),
				'condition'   => array( 'more_button' => array( 'show' ), 'style' => array( 'style1', 'style2', 'style3', 'style7', 'style8', 'style10', 'style11' ) ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'see_button_link',
				'label'   => esc_html__( 'Button Link', 'tripfery-core' ),
				'condition'   => array( 'more_button' => array( 'show' ), 'style' => array( 'style1', 'style2', 'style3', 'style7', 'style8', 'style10', 'style11' ) ),
			),
			array(
				'mode' => 'section_end',
			),
			// Option
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_option',
				'label'   => esc_html__( 'Option', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
	        array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Title Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-locations-default .entry-title',
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'title_space',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Title Space', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .rt-locations-default .entry-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'content_display',
				'label'       => esc_html__( 'Content Display', 'tripfery-core' ),
				'label_on'    => esc_html__( 'On', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Off', 'tripfery-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Show or Hide Content. Default: off', 'tripfery-core' ),
				'condition'   => array( 'style!' => array( 'style11' ) ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'contype',
				'label'   => esc_html__( 'Content Type', 'tripfery-core' ),
				'options' => array(
					'content' => esc_html__( 'Conents', 'tripfery-core' ),
					'excerpt' => esc_html__( 'Excerpts', 'tripfery-core' ),
				),
				'default'     => 'content',
				'description' => esc_html__( 'Display contents from Editor or Excerpt field', 'tripfery-core' ),
				'condition'   => array( 'content_display' => array( 'yes' ), 'style!' => array( 'style11' ) ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'count',
				'label'   => esc_html__( 'Word count', 'tripfery-core' ),
				'default' => 9,
				'description' => esc_html__( 'Maximum number of words', 'tripfery-core' ),
				'condition'   => array( 'content_display' => array( 'yes' ), 'style!' => array( 'style11' ) ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'category_display',
				'label'       => esc_html__( 'Category Display', 'tripfery-core' ),
				'label_on'    => esc_html__( 'On', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Off', 'tripfery-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Category. Default: On', 'tripfery-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'action_display',
				'label'       => esc_html__( 'Action Display', 'tripfery-core' ),
				'label_on'    => esc_html__( 'On', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Off', 'tripfery-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Readmore. Default: On', 'tripfery-core' ),
			),
			array(
				'type'    => Group_Control_Css_Filter::get_type(),
				'mode'    => 'group',				
				'label'   => esc_html__( 'Image Blend', 'tripfery-core' ),	
				'name' => 'blend', 
				'selector' => '{{WRAPPER}} .rt-locations-default .locations-figure img',		
			),
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'border_radius',
	            'label'   => __( 'Box Radius', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .rt-locations-default .locations-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                 
	            ),
	            'separator' => 'before',
	        ),
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'border_image_radius',
	            'label'   => __( 'Image Radius', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .rt-locations-multi-layout-7 .rt-locations-grid .locations-figure' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                 
	            ),
				'condition'   => array( 'style' => array( 'style11' ) ),
	        ),
			array(
				'mode' => 'section_end',
			),
			// Option
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_style_option',
				'label'   => esc_html__( 'Style', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-locations-default .entry-title a' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_hover_color',
				'label'   => esc_html__( 'Title Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-locations-default .entry-title a:hover' => 'color: {{VALUE}} !important',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'cat_color',
				'label'   => esc_html__( 'Category Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-locations-default .locations-cat a' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'cat_hover_color',
				'label'   => esc_html__( 'Category Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-locations-default .locations-cat a:hover' => 'color: {{VALUE}} !important',
				),
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
				'condition'   => array( 'style' => array( 'style4', 'style5', 'style6', 'style9' ) ),
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
					'bottom-center' => esc_html__( 'Bottom Center', 'tripfery-core' ),
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
						'min' => -1000,
						'max' => 1000,
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
				'default'     => 'yes',
				'description' => esc_html__( 'Navigation Arrow. Default: On', 'tripfery-core' ),
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
				'default' => '1.2',
				'condition'   => array( 'animation' => array( 'wow' ) ),
			),
			array(
				'mode' => 'section_end',
			),

			// Responsive Grid Columns
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_responsive',
				'label'   => esc_html__( 'Number of Responsive Columns', 'tripfery-core' ),
				'condition'   => array( 'style' => array( 'style1', 'style2', 'style3', 'style8' ) ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_xl',
				'label'   => esc_html__( 'Desktops: > 1199px', 'tripfery-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_lg',
				'label'   => esc_html__( 'Desktops: > 991px', 'tripfery-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_md',
				'label'   => esc_html__( 'Tablets: > 767px', 'tripfery-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_sm',
				'label'   => esc_html__( 'Phones: < 768px', 'tripfery-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_xs',
				'label'   => esc_html__( 'Small Phones: < 480px', 'tripfery-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
			),
			array(
				'mode' => 'section_end',
			),

			// Responsive Slider Columns
			array(
				'mode'        => 'section_start',
				'id'          => 'sec_slider_pervice',
				'label'       => esc_html__( 'PerView Options', 'tripfery-core' ),
				'condition'   => array( 'style' => array( 'style4', 'style5', 'style6', 'style9' ) ),
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
					'5' => esc_html__( '5',  'tripfery-core' ),
					'6' => esc_html__( '6',  'tripfery-core' ),
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
				'condition'   => array( 'style' => array( 'style4', 'style5', 'style6', 'style9' ) ),
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
				'description' => esc_html__( 'Centered Slides. Default: On', 'tripfery-core' ),
				
			),
			array(
				'type'        => Controls_Manager::NUMBER,
				'id'          => 'slides_space',
				'label'       => esc_html__( 'Slides Space', 'tripfery-core' ),
				'default'     => 24,
				'description' => esc_html__( 'Slides Space. Default: 10', 'tripfery-core' ),
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
			'centeredSlides'	=>$data['centered_slides']=='yes' ? true:false ,
			'loop'				=>$data['slider_loop']=='yes' ? true:false,
			'spaceBetween'		=>$data['slides_space'],
			'slidesPerGroup'	=>$data['slides_per_group']['size'],
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
		
		
		switch ( $data['style'] ) {
			case 'style9':
			$data['swiper_data'] = json_encode( $swiper_data ); 
			$template = 'rt-locations-slider-4';
			break;
			case 'style6':
			$data['swiper_data'] = json_encode( $swiper_data ); 
			$template = 'rt-locations-slider-3';
			break;
			case 'style5':
			$data['swiper_data'] = json_encode( $swiper_data ); 
			$template = 'rt-locations-slider-2';
			break;
			case 'style4':
			$data['swiper_data'] = json_encode( $swiper_data ); 
			$template = 'rt-locations-slider-1';
			break;
			case 'style11':
			$template = 'rt-locations-grid-7';
			break;
			case 'style10':
			$template = 'rt-locations-grid-6';
			break;
			case 'style8':
			$template = 'rt-locations-grid-5';
			break;
			case 'style7':
			$template = 'rt-locations-grid-4';
			break;
			case 'style3':
			$template = 'rt-locations-grid-3';
			break;
			case 'style2':
			$template = 'rt-locations-grid-2';
			break;
			default:
			$template = 'rt-locations-grid-1';
			break;
		}

		return $this->rt_template( $template, $data );
	}
}