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

class RT_Service_Reviews extends Custom_Widget_Base {
	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'RT Services Reviews', 'tripfery-core' );
		$this->rt_base = 'rt-services-reviews';
		$this->rt_translate = array(
			'cols'  => array(
				'12' => esc_html__('1 Col', 'tripfery-core'),
				'6'  => esc_html__('2 Col', 'tripfery-core'),
				'4'  => esc_html__('3 Col', 'tripfery-core'),
				'3'  => esc_html__('4 Col', 'tripfery-core'),
				'2'  => esc_html__('6 Col', 'tripfery-core'),
			),
		);
		parent::__construct( $data, $args );
	}
	public function rt_fields(){
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'General', 'tripfery-core' ),
			),
			/*Start category*/
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'subtitle',
				'label'   => esc_html__('Subtitle', 'tripfery-core'),
			),		
			
			array(
				'id'      => 'query_type',
				'label' => esc_html__('Query type', 'tripfery-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'category',
				'options' => array(
					'category'  => esc_html__('Category', 'tripfery-core'),
					'posts' => esc_html__('Services', 'tripfery-core'),
				),
			),
			array(
				'id'      => 'postid',
				'label' => esc_html__('Service Name', 'tripfery-core'),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_all_posts('to_book'),
				'label_block' => true,
				'multiple' => true,
				'condition' => array(
					'query_type' => 'posts',
				),
			),
			array(
				'id'      => 'catid',
				'label' => esc_html__('Categories', 'tripfery-core'),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_taxonomy_drops('categories'),
				'label_block' => true,
				'multiple' => true,
				'condition' => array(
					'query_type' => 'category',
				),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'itemlimit',
				'label'   => esc_html__('Item Limit', 'tripfery-core'),
				'range' => array(
					'px' => array(
						'min' => 1,
						'max' => 12,
					),
				),
				'default' => array(
					'size' => 3,
				),
				'description' => esc_html__('Maximum number of Item', 'tripfery-core'),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'post_ordering',
				'label'   => esc_html__('Post Ordering', 'tripfery-core'),
				'options' => array(
					'DESC'	=> esc_html__('Desecending', 'tripfery-core'),
					'ASC'	=> esc_html__('Ascending', 'tripfery-core'),
				),
				'default' => 'DESC',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'post_orderby',
				'label'   => esc_html__('Post Sorting', 'tripfery-core'),
				'options' => array(
					'recent' 		=> esc_html__('Recent Post', 'tripfery-core'),
					'rand' 			=> esc_html__('Random Post', 'tripfery-core'),
					'title' 		=> esc_html__('By Name', 'tripfery-core'),
				),
				'default' => 'recent',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'item_gutter',
				'label'   => esc_html__('Item Gutter', 'tripfery-core'),
				'options' => array(
					'g-0' => esc_html__('Gutters 0', 'tripfery-core'),
					'g-1' => esc_html__('Gutters 1', 'tripfery-core'),
					'g-2' => esc_html__('Gutters 2', 'tripfery-core'),
					'g-3' => esc_html__('Gutters 3', 'tripfery-core'),
					'g-4' => esc_html__('Gutters 4', 'tripfery-core'),
					'g-5' => esc_html__('Gutters 5', 'tripfery-core'),
				),
				'default' => 'g-4',
			),
			array(
				'mode' => 'section_end',
			),
			/*Option section*/
			array(
	            'mode'    => 'section_start',
	            'id'      => 'sec_option_style',
	            'label'   => esc_html__( 'Option', 'tripfery-core' ),
	            'tab'     => Controls_Manager::TAB_STYLE,
	        ),
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'subtitle_color',
				'label'   => esc_html__( 'Subtitle Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .info-subtitle' => 'color: {{VALUE}}',
				),
			),
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .info-title a' => 'color: {{VALUE}}',
				),
			),
			array (
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color_hover',
				'label'   => esc_html__( 'Title Hover Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .info-title a:hover' => 'color: {{VALUE}}',
				),
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__('Title Typography', 'tripfery-core'),
				'selector' => '{{WRAPPER}} .info-title',
			),		
			array(
				'mode' => 'section_end',
			),

			// Responsive Columns
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_responsive',
				'label'   => esc_html__('Number of Responsive Columns', 'tripfery-core'),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_xl',
				'label'   => esc_html__('Desktops: > 1199px', 'tripfery-core'),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_lg',
				'label'   => esc_html__('Desktops: > 991px', 'tripfery-core'),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_md',
				'label'   => esc_html__('Tablets: > 767px', 'tripfery-core'),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_sm',
				'label'   => esc_html__('Phones: < 768px', 'tripfery-core'),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_xs',
				'label'   => esc_html__('Small Phones: < 480px', 'tripfery-core'),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
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
			
		);
		return $fields;
	}
	protected function render() {
		$data = $this->get_settings();
		$template = 'rt-service-review';
		$this->rt_template($template, $data);
	}
}