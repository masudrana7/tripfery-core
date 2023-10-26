<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;

use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Base;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

abstract class Custom_Widget_Base extends Widget_Base {
	public $rt_name;
	public $rt_base;
	public $rt_category;
	public $rt_icon;
	public $rt_translate;

	public function __construct( $data = [], $args = null ) {
		$this->rt_category = TRIPFERY_CORE_THEME_PREFIX . '-widgets'; // Category /@dev
		$this->rt_icon     = 'rdtheme-el-custom';
		parent::__construct( $data, $args );
	}

	abstract public function rt_fields();

	public function get_name() {
		return $this->rt_base;
	}

	public function get_title() {
		return $this->rt_name;
	}

	public function get_icon() {
		return $this->rt_icon;
	}

	public function get_categories() {
		return array( $this->rt_category );
	}

	protected function register_controls() {
		$fields = $this->rt_fields();
		foreach ( $fields as $field ) {
			if ( isset( $field['mode'] ) && $field['mode'] == 'section_start' ) {
				$id = $field['id'];
				unset( $field['id'] );
				unset( $field['mode'] );
				$this->start_controls_section( $id, $field );
			}
			elseif ( isset( $field['mode'] ) && $field['mode'] == 'section_end' ) {
				$this->end_controls_section();
			}
			elseif ( isset( $field['mode'] ) && 'tabs_start' === $field['mode'] ) {
				$id = $field['id'];
				unset( $field['id'] );
				unset( $field['mode'] );
				$this->start_controls_tabs( $id );
			} elseif ( isset( $field['mode'] ) && 'tabs_end' === $field['mode'] ) {
				$this->end_controls_tabs();
			} elseif ( isset( $field['mode'] ) && 'tab_start' === $field['mode'] ) {
				$id = $field['id'];
				unset( $field['id'] );
				unset( $field['mode'] );
				$this->start_controls_tab( $id, $field );
			} elseif ( isset( $field['mode'] ) && 'tab_end' === $field['mode'] ) {
				$this->end_controls_tab();
			} elseif ( isset( $field['mode'] ) && $field['mode'] == 'group' ) {
				$type = $field['type'];
				unset( $field['mode'] );
				unset( $field['type'] );
				$this->add_group_control( $type, $field );
			}
			elseif ( isset( $field['mode'] ) && $field['mode'] == 'responsive' ) {
				$id = $field['id'];
				unset( $field['id'] );
				unset( $field['mode'] );
				$this->add_responsive_control( $id, $field );
			}
			else {
				$id = $field['id'];
				unset( $field['id'] );
				$this->add_control( $id, $field );
			}
		}
	}
	

	public function rt_template( $template, $data ) {
		$template_name = "/elementor-custom/views/{$template}.php";
		if ( file_exists( STYLESHEETPATH . $template_name ) ) {
			$file = STYLESHEETPATH . $template_name;
		}
		elseif ( file_exists( TEMPLATEPATH . $template_name ) ) {
			$file = TEMPLATEPATH . $template_name;
		}
		else {
			$file = __DIR__ . "/views/{$template}.php";
		}

		ob_start();
		include $file;
		echo ob_get_clean();
	}

	public function get_all_posts($post_type) {
        global $post;
        $type = $post_type ? $post_type : 'post';
        $args = array('numberposts' => -1,'post_type' => $type,);
        $posts = get_posts($args);  

        foreach ($posts as $pn_cat) {
            $categories[$pn_cat->ID] = get_the_title($pn_cat->ID);
        }
        return $categories;
	} 

    public function get_taxonomy_drops($taxonomy='category'){
        $categories = get_categories( array( 'taxonomy' => $taxonomy) );

        if( empty( $categories ) ) {
        	return;
        }

        foreach ( $categories as $category ) {
            $category_dropdown[$category->term_id] = $category->name;
        }        
        return $category_dropdown;
    }
}