<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

/**
* About Widget with Social for footer by TripferyTheme
**/
class TripferyTheme_Social_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname' => 'rt_footer_social_widget',
			'description' => esc_html__( 'Tripfery : (For Footer) Social Link widget with Description' , 'tripfery-core' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'rt-about-social', esc_html__( 'Tripfery : Social Widget' , 'tripfery-core' ), $widget_ops );
		$this->alt_option_name = 'tripfery_about_widget';
	}

	public function widget( $args, $instance ){
		echo wp_kses_post( $args['before_widget'] );
		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] ) . apply_filters( 'widget_title', esc_html( $instance['title'] ) ) . wp_kses_post( $args['after_title'] );
		}
		?>
		<div class="rt-about-widget">
			<?php if( !empty( $instance['description'] ) ) { ?>
				<div class="footer-about"><?php echo wp_kses_post( $instance['description'] ); ?></div>
			<?php } ?>
			<?php if( !empty( $instance['social_label'] ) ) { ?>
				<h3 class="social-label"><?php echo wp_kses_post( $instance['social_label'] ); ?></h3>
			<?php } ?>
			<ul class="footer-social">
				<?php
				if( !empty( $instance['facebook'] ) ){
					?><li class="facebook"><a href="<?php echo esc_url( $instance['facebook'] ); ?>" target="_blank" aria-label="Social Link"><i class="fab fa-facebook-f"></i></a></li><?php
				}
				if( !empty( $instance['twitter'] ) ){
					?><li class="twitter"><a href="<?php echo esc_url( $instance['twitter'] ); ?>" target="_blank" aria-label="Social Link"><i class="fab fa-twitter"></i></a></li><?php
				}
				if( !empty( $instance['linkedin'] ) ){
					?><li class="linkedin"><a href="<?php echo esc_url( $instance['linkedin'] ); ?>" target="_blank" aria-label="Social Link"><i class="fab fa-linkedin-in"></i></a></li><?php
				}
				if( !empty( $instance['pinterest'] ) ){
					?><li class="pinterest"><a href="<?php echo esc_url( $instance['pinterest'] ); ?>" target="_blank" aria-label="Social Link"><i class="fab fa-pinterest-p"></i></a></li><?php
				}
				if( !empty( $instance['skype'] ) ){
					?><li class="skype"><a href="<?php echo esc_url( $instance['skype'] ); ?>" target="_blank" aria-label="Social Link"><i class="fab fa-skype"></i></a></li><?php
				}
				if( !empty( $instance['youtube'] ) ){
					?><li class="youtube"><a href="<?php echo esc_url( $instance['youtube'] ); ?>" target="_blank" aria-label="Social Link"><i class="fab fa-youtube"></i></a></li><?php
				}
				if( !empty( $instance['instagram'] ) ){
					?><li class="instagram"><a href="<?php echo esc_url( $instance['instagram'] ); ?>" target="_blank" aria-label="Social Link"><i class="fab fa-instagram"></i></a></li><?php
				}
				if( !empty( $instance['behance'] ) ){
					?><li class="behance"><a href="<?php echo esc_url( $instance['behance'] ); ?>" target="_blank" aria-label="Social Link"><i class="fab fa-behance"></i></a></li><?php
				}
				if( !empty( $instance['dribbble'] ) ){
					?><li class="dribbble"><a href="<?php echo esc_url( $instance['dribbble'] ); ?>" target="_blank" aria-label="Social Link"><i class="fab fa-dribbble"></i></a></li><?php
				}
				?>
			</ul>
		</div>

		<?php
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ){
		$instance                  = array();
		$instance['title']         = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['description']   = ( ! empty( $new_instance['description'] ) ) ? wp_kses_post( $new_instance['description'] ) : '';
		$instance['social_label']   = ( ! empty( $new_instance['social_label'] ) ) ? wp_kses_post( $new_instance['social_label'] ) : '';
		$instance['facebook']      = ( ! empty( $new_instance['facebook'] ) ) ? sanitize_text_field( $new_instance['facebook'] ) : '';
		$instance['twitter']       = ( ! empty( $new_instance['twitter'] ) ) ? sanitize_text_field( $new_instance['twitter'] ) : '';
		$instance['linkedin']      = ( ! empty( $new_instance['linkedin'] ) ) ? sanitize_text_field( $new_instance['linkedin'] ) : '';
		$instance['pinterest']     = ( ! empty( $new_instance['pinterest'] ) ) ? sanitize_text_field( $new_instance['pinterest'] ) : '';
		$instance['skype']       = ( ! empty( $new_instance['skype'] ) ) ? sanitize_text_field( $new_instance['skype'] ) : '';
		$instance['youtube']      = ( ! empty( $new_instance['youtube'] ) ) ? sanitize_text_field( $new_instance['youtube'] ) : '';
		$instance['instagram']     = ( ! empty( $new_instance['instagram'] ) ) ? sanitize_text_field( $new_instance['instagram'] ) : '';
		$instance['behance']       = ( ! empty( $new_instance['behance'] ) ) ? sanitize_text_field( $new_instance['behance'] ) : '';
		$instance['dribbble']      = ( ! empty( $new_instance['dribbble'] ) ) ? sanitize_text_field( $new_instance['dribbble'] ) : '';
		return $instance;
	}

	public function form( $instance ){
		$defaults = array(
			'title'       => esc_html__( 'About Company' , 'tripfery-core' ),
			'description' => '',
			'social_label'=> '',
			'facebook'    => '',
			'twitter'     => '',
			'skype'       => '',
			'youtube'     => '',
			'linkedin'    => '',
			'pinterest'   => '',
			'instagram'   => '',
			'behance'     => '',
			'dribbble'    => '',
			);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = array(
			'title'        => array(
				'label'    => esc_html__( 'Title', 'tripfery-core' ),
				'type'     => 'text',
				),
			'description'  => array(
				'label'    => esc_html__( 'Description', 'tripfery-core' ),
				'type'     => 'textarea',
				),			
			'social_label'  => array(
				'label'    => esc_html__( 'Social Label', 'tripfery-core' ),
				'type'     => 'text',
				),
			'facebook'     => array(
				'label'    => esc_html__( 'Facebook URL', 'tripfery-core' ),
				'type'     => 'url',
				),
			'twitter'      => array(
				'label'    => esc_html__( 'Twitter URL', 'tripfery-core' ),
				'type'     => 'url',
				),
			'linkedin'     => array(
				'label'    => esc_html__( 'LinkedIn URL', 'tripfery-core' ),
				'type'     => 'url',
				),
			'pinterest'    => array(
				'label'    => esc_html__( 'Pinterest URL', 'tripfery-core' ),
				'type'     => 'url',
				),
			'skype'        => array(
				'label'    => esc_html__( 'Skype URL', 'tripfery-core' ),
				'type'     => 'url',
				),
			'youtube'      => array(
				'label'    => esc_html__( 'Youtube URL', 'tripfery-core' ),
				'type'     => 'url',
				),
			'instagram'    => array(
				'label'    => esc_html__( 'Instagram URL', 'tripfery-core' ),
				'type'     => 'url',
				),
			'behance'      => array(
				'label'    => esc_html__( 'Behance Plus URL', 'tripfery-core' ),
				'type'     => 'url',
				),
			'dribbble'     => array(
				'label'    => esc_html__( 'Dribbble Plus URL', 'tripfery-core' ),
				'type'     => 'url',
				),
			);
		
		RT_Widget_Fields::display( $fields, $instance, $this );
	}	
}