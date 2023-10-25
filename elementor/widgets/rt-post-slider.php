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

class RT_Post_Slider extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'RT Post Slider', 'tripfery-core' );
		$this->rt_base = 'rt-post-slider';
		parent::__construct( $data, $args );
	}

	public function rt_fields(){
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'post_not_in', array(
				'type'    => Controls_Manager::NUMBER,
				'label'   => __( 'Post ID', 'tripfery-core' ),
				'default' => '0',
			)
		);
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'General', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => esc_html__( 'Slider Style', 'tripfery-core' ),
				'options' => array(
					'style1' => esc_html__( 'Slider Layout 01', 'tripfery-core' ),
					'style2' => esc_html__( 'Slider Layout 02', 'tripfery-core' ),
				),
				'default' => 'style1',
			),
			array(
				'type' => Controls_Manager::CHOOSE,
				'id'      => 'content_align',
				'mode'    => 'responsive',
				'label'   => esc_html__( 'Alignment', 'tripfery-core' ),
				'options' => array(
					'left' => array(
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					),
					'right' => array(
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					),
				),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'video_layout',
				'label'   => esc_html__( 'Play Button', 'tripfery-core' ),				
				'options' => array(
					'play-btn-primary' 		=> esc_html__( 'Play Primary', 'tripfery-core' ),
					'play-btn-white' 	 	=> esc_html__( 'Play White', 'tripfery-core' ),
					'play-btn-white-lg' 	=> esc_html__( 'Play White-lg', 'tripfery-core' ),
					'play-btn-transparent' 	=> esc_html__( 'Play transparent', 'tripfery-core' ),
				),
				'default' => 'play-btn-white',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'read_more_layout',
				'label'   => esc_html__( 'Readmore Button', 'tripfery-core' ),				
				'options' => array(
					'button-style-1' 	=> esc_html__( 'Button 01', 'tripfery-core' ),
					'button-style-2' 	=> esc_html__( 'Button 02', 'tripfery-core' ),
					'button-style-3' 	=> esc_html__( 'Button 03', 'tripfery-core' ),
					'button-style-4' 	=> esc_html__( 'Button 04', 'tripfery-core' ),
					'button-style-5' 	=> esc_html__( 'Button 05', 'tripfery-core' ),
				),
				'default' => 'button-style-1',
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'itemlimit',
				'label'   => esc_html__( 'Item Limit', 'tripfery-core' ),
				'range' => array(
	                'px' => array(
	                    'min' => 1,
	                    'max' => 27,
	               	),
		       	),
	            'default' => array(
	                'size' => 3,
	            ),
				'description' => esc_html__( 'Maximum number of Item 27', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'title_count',
				'label'   => esc_html__( 'Title count', 'tripfery-core' ),
				'default' => 15,
				'description' => esc_html__( 'Maximum number of title', 'tripfery-core' ),
			),
			array(
				'mode' => 'section_end',
			),
			/*query option*/
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_query',
				'label'   => esc_html__( 'Query Settings', 'tripfery-core' ),
			),
			/*Post Order*/
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
			/*Start category*/
			array(
				'id'      => 'query_type',
				'label' => esc_html__( 'Query type', 'tripfery-core' ),
            	'type' => Controls_Manager::SELECT,
            	'default' => 'category',
            	'options' => array(
					'category'  => esc_html__( 'Category', 'tripfery-core' ),
                	'posts' => esc_html__( 'Posts', 'tripfery-core' ),
				),
			),
			array(
				'id'      => 'postid',
				'label' => esc_html__( 'Selects posts', 'tripfery-core' ),
	            'type' => Controls_Manager::SELECT2,
	            'options' => $this->get_all_posts('post'),
	            'label_block' => true,
	            'multiple' => true,
            	'condition' => array(
					'query_type' => 'posts',
				),
			),
			array(
				'id'      => 'catid',
				'label' => esc_html__( 'Categories', 'tripfery-core' ),
	            'type' => Controls_Manager::SELECT2,
	            'options' => $this->get_taxonomy_drops('category'),
	            'label_block' => true,
	            'multiple' => true,
            	'condition' => array(
					'query_type' => 'category',
				),
			),
			/*post offset*/
	        array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'number_of_post_offset',
				'label'   => __( 'Offset ( No of Posts )', 'tripfery-core' ),
				'default' => '0',
				'separator' => 'before',
			),
			array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'posts_not_in',
				'label'   => __( 'Exclude Post by ID', 'tripfery-core' ),
				'fields' => $repeater->get_controls(),
			),
			array(
				'mode' => 'section_end',
			),
			// Option
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_style',
				'label'   => esc_html__( 'Option', 'tripfery-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'post_author',
				'label'       => esc_html__( 'Show Author', 'tripfery-core' ),
				'label_on'    => esc_html__( 'Show', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Hide', 'tripfery-core' ),
				'default'     => 'yes',
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'post_date',
				'label'       => esc_html__( 'Show Date', 'tripfery-core' ),
				'label_on'    => esc_html__( 'Show', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Hide', 'tripfery-core' ),
				'default'     => 'yes',
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'post_category',
				'label'       => esc_html__( 'Show Categories', 'tripfery-core' ),
				'label_on'    => esc_html__( 'Show', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Hide', 'tripfery-core' ),
				'default'     => 'yes',
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'post_comment',
				'label'       => esc_html__( 'Show Comment', 'tripfery-core' ),
				'label_on'    => esc_html__( 'Show', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Hide', 'tripfery-core' ),
				'default'     => 'no',
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'post_length',
				'label'       => esc_html__( 'Show Lenght', 'tripfery-core' ),
				'label_on'    => esc_html__( 'Show', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Hide', 'tripfery-core' ),
				'default'     => 'no',
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'post_view',
				'label'       => esc_html__( 'Show View', 'tripfery-core' ),
				'label_on'    => esc_html__( 'Show', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Hide', 'tripfery-core' ),
				'default'     => 'no',
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'post_video',
				'label'       => esc_html__( 'Show Video', 'tripfery-core' ),
				'label_on'    => esc_html__( 'Show', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Hide', 'tripfery-core' ),
				'default'     => 'no',
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'post_read',
				'label'       => esc_html__( 'Show Read More', 'tripfery-core' ),
				'label_on'    => esc_html__( 'Show', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Hide', 'tripfery-core' ),
				'default'     => 'no',
			),
			array(
				'type'    => Group_Control_Css_Filter::get_type(),
				'mode'    => 'group',				
				'label'   => esc_html__( 'Image Blend', 'tripfery-core' ),	
				'name' => 'blend', 
				'selector' => '{{WRAPPER}} img',		
			),			
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'border_radius',
	            'label'   => __( 'Box Radius', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .rt-post-slider-default .rt-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                  
	            ),
	            'separator' => 'before',
	        ),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'box_bg_color',
				'label'   => esc_html__( 'Box Background Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-post-slider-default .rt-item' => 'background-color: {{VALUE}}',
				),
			),			
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'box_border_color',
				'label'   => esc_html__( 'Box Border Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-post-slider-default .rt-item' => 'border-color: {{VALUE}}',
				),
			),
			array(
				'mode' => 'section_end',
			),
			// Title style
			array(
	            'mode'    => 'section_start',
	            'id'      => 'sec_title_style',
	            'label'   => esc_html__( 'Title Style', 'tripfery-core' ),
	            'tab'     => Controls_Manager::TAB_STYLE,
	        ),
	        array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Title Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-post-slider-default .rt-item .entry-title',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-post-slider-default .rt-item .entry-title a' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_hover_color',
				'label'   => esc_html__( 'Title Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-post-slider-default .rt-item .entry-title a:hover' => 'color: {{VALUE}}',
				),
			),
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'title_margin',
	            'label'   => __( 'Margin', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .rt-post-slider-default .rt-item .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
	            ),
	            'separator' => 'before',
	        ),
			array(
				'mode' => 'section_end',
			),
			// Content style
			array(
	            'mode'    => 'section_start',
	            'id'      => 'sec_content_style',
	            'label'   => esc_html__( 'Content Style', 'tripfery-core' ),
	            'tab'     => Controls_Manager::TAB_STYLE,
	        ),
	        array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'content_display',
				'label'       => esc_html__( 'Content Display', 'tripfery-core' ),
				'label_on'    => esc_html__( 'Show', 'tripfery-core' ),
				'label_off'   => esc_html__( 'Hide', 'tripfery-core' ),
				'default'     => 'no',
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'count',
				'label'   => esc_html__( 'Word count', 'tripfery-core' ),
				'default' => 20,
				'condition' => array( 'content_display' => array( 'yes' ) ),
				'description' => esc_html__( 'Maximum number of words', 'tripfery-core' ),
			),
	        array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'content_typo',
				'label'   => esc_html__( 'Content_typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-post-slider-default .rt-item .post_excerpt p',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'content_color',
				'label'   => esc_html__( 'Content Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-post-slider-default .rt-item .post_excerpt p' => 'color: {{VALUE}}',
				),
			),
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'content_margin',
	            'label'   => __( 'Margin', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .rt-post-slider-default .rt-item .post_excerpt p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
	            ),
	            'separator' => 'before',
	        ),
			array(
				'mode' => 'section_end',
			),			
			// Meta style
			array(
	            'mode'    => 'section_start',
	            'id'      => 'sec_meta_style',
	            'label'   => esc_html__( 'Meta Style', 'tripfery-core' ),
	            'tab'     => Controls_Manager::TAB_STYLE,
	        ),
	        array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'meta_typo',
				'label'   => esc_html__( 'Meta Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-post-slider-default ul.entry-meta li',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'meta_color',
				'label'   => esc_html__( 'Meta Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-post-slider-default ul.entry-meta li' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-post-slider-default ul.entry-meta li a' => 'color: {{VALUE}}',					
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'meta_author_color',
				'label'   => esc_html__( 'Meta Author Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-post-slider-default .rt-item .post-author a' => 'color: {{VALUE}}',
				),
			),
			array(
	            'type'    => Controls_Manager::DIMENSIONS,
	            'mode'          => 'responsive',
	            'size_units' => [ 'px', '%', 'em' ],
	            'id'      => 'meta_margin',
	            'label'   => __( 'Margin', 'tripfery-core' ),                 
	            'selectors' => array(
	                '{{WRAPPER}} .rt-post-slider-default ul.entry-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',                    
	            ),
	            'separator' => 'before',
	        ),
	        array(
				'mode' => 'section_end',
			),
			// Image style
			array(
	            'mode'    => 'section_start',
	            'id'      => 'sec_image_style',
	            'label'   => esc_html__( 'Image', 'tripfery-core' ),
	            'tab'     => Controls_Manager::TAB_STYLE,
	        ),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'image_width',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Width', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .rt-post-slider-default .rt-item .rt-image img' => 'width: {{SIZE}}{{UNIT}};',
				),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'image_height',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Height', 'tripfery-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .rt-post-slider-default .rt-item .rt-image img' => 'height: {{SIZE}}{{UNIT}};',
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
				'default' => '1.2',
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
		
		switch ( $data['style'] ) {
			case 'style2':
			$template = 'rt-post-slider-2';
			break;
			default:
			$template = 'rt-post-slider-1';
			break;
		}

		$data['swiper_data'] = json_encode( $swiper_data );   
		
		return $this->rt_template( $template, $data );
	}
}