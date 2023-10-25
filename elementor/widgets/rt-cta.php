<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit;

class RT_Call_Action extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'RT CTA', 'tripfery-core' );
		$this->rt_base = 'rt-call-action';
		parent::__construct( $data, $args );
	}	

	public function rt_fields(){
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'General', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'title',
				'label'   => esc_html__( 'Title', 'tripfery-core' ),
				'default' => esc_html__( 'Providing Full Range of High Quality Services Solution', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'phone_label',
				'label'   => esc_html__( 'Phone Label', 'tripfery-core' ),
				'default' => esc_html__( 'Emergency', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'phone',
				'label'   => esc_html__( 'Phone Number', 'tripfery-core' ),
				'default' => esc_html__( '+123-554-666', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'cta_image',
				'label'   => esc_html__( 'Image', 'tripfery-core' ),
				'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
				'description' => esc_html__( 'Recommended full image', 'tripfery-core' ),
			),
			array(
				'type'    => Group_Control_Image_Size::get_type(),
				'mode'    => 'group',				
				'label'   => esc_html__( 'image size', 'tripfery-core' ),	
				'name' => 'icon_image_size', 
				'separator' => 'none',		
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'button_style',
				'label'   => esc_html__( 'Button Style', 'tripfery-core' ),
				'options' => array(
					'style-1' => esc_html__( 'Style 1' , 'tripfery-core' ),
					'style-2' => esc_html__( 'Style 2', 'tripfery-core' ),
					'style-3' => esc_html__( 'Style 3', 'tripfery-core' ),
					'style-4' => esc_html__( 'Style 4', 'tripfery-core' ),
				),
				'default' => 'style-1',
			),
			array(
				'type'    	  => Controls_Manager::TEXT,
				'id'      	  => 'buttontext',
				'label'   	  => esc_html__( 'Button Text', 'tripfery-core' ),
				'default' 	  => esc_html__( 'Contact Us', 'tripfery-core' ),
			),
			array(
				'type'    => Controls_Manager::URL,
				'id'      => 'buttonurl',
				'label'   => esc_html__( 'Button URL', 'tripfery-core' ),
				'placeholder' => 'https://your-link.com',
			),

			array(
				'mode' => 'section_end',
			),
			/* Style */
			array(
	            'mode'    => 'section_start',
	            'id'      => 'sec_style',
	            'label'   => esc_html__( 'CTA Style', 'tripfery-core' ),
	            'tab'     => Controls_Manager::TAB_STYLE,
	        ),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'box_bg_color',
				'label'   => esc_html__( 'Box BG Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-call-action .rt-action-item' => 'background-color: {{VALUE}}',
				),
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Title Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-call-action .rt-title',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-call-action .rt-title' => 'color: {{VALUE}}',
				),
			),
			array(
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'phone_typo',
				'label'   => esc_html__( 'Phone Typo', 'tripfery-core' ),
				'selector' => '{{WRAPPER}} .rt-call-action .rt-phone',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'phone_color',
				'label'   => esc_html__( 'Phone Color', 'tripfery-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .rt-call-action .rt-phone a' => 'color: {{VALUE}}',
				),
			),
	        array(
				'mode' => 'section_end',
			),
		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'rt-cta';

		return $this->rt_template( $template, $data );
	}
}