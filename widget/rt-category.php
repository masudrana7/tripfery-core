<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
class TripferyTheme_Category_Widget extends WP_Widget {

	/**
	 * Sets up a new Categories widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'rt-widget-category',
			'description' => esc_html__( 'Tripfery Category Widget' , 'tripfery-core' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'rt-categories', __( 'Tripfery: Categories' ), $widget_ops );
	}
	public function widget( $args, $instance ) {
		static $first_dropdown = true;

		$default_title = __( '' );
		$title         = ! empty( $instance['title'] ) ? $instance['title'] : $default_title;

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$count        = ! empty( $instance['count'] ) ? '1' : '0';
		$limit        = ! empty( $instance['limit'] ) ? $instance['limit'] : 6;
		$cat_id       = ! empty( $instance['cat_id'] ) ? $instance['cat_id'] : 'all';
		$select_style = ( !empty( $instance['select_style'] ) ) ? $instance['select_style'] : 'category-style-1';
		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		
		$rt_args = array (
		    'taxonomy' => 'category',  
		    'hide_empty' => true,  
		    'include' => explode( ',', $cat_id ),  
		    'fields' => 'all', 
		);

		$terms = get_terms($rt_args );

		?>
		<?php if ( $select_style == 'category-style-1' ) { ?>
		<div class="rt-widget-category-style1">
			<?php 
			$i = 0;
			foreach( $terms as $term ) { 
				if( $limit && $i == $limit ) {
					break;
				}
				?>
				<div class="rt-item space">
					<a href="<?php echo esc_url( get_category_link( $term->term_id ) ); ?>">
					<div class="rt-content">
			            <h4 class="rt-cat-name">
			                <?php echo esc_html( $term->name ); ?>
			            </h4>
			            <?php if( $count == 1 ) { ?>
			            <span class="rt-cat-count"><?php echo esc_html( $term->count ); ?></span>
			        	<?php } ?>
			        </div>
			    </a>
			    </div>
			<?php $i++; } ?>
		</div>

		<?php } else if ( $select_style == 'category-style-2' ) { ?>
			<div class="rt-widget-category-style2">
				<ul>
				<?php 
				$i = 0;
				foreach( $terms as $term ) { 
					if( $limit && $i == $limit ) {
						break;
					}
					?>
					<li class="rt-item">
						<a href="<?php echo esc_url( get_category_link( $term->term_id ) ); ?>">
					        <?php echo esc_html( $term->name ); ?>
				    	</a>
				    	<?php if( $count == 1 ) { ?> (<?php echo esc_html( $term->count ); ?>) <?php } ?>
				    </li>
				<?php $i++; } ?>
			</ul>
		</div>

		<?php } ?>

		<?php
		
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance                 = $old_instance;
		$instance['title']        = sanitize_text_field( $new_instance['title'] );
		$instance['limit']        = absint( $new_instance['limit'] );
		$instance['count']        = ! empty( $new_instance['count'] ) ? 1 : 0;
		$instance['cat_id']        = ! empty( $new_instance['cat_id'] ) ? $new_instance['cat_id'] : null;
		$instance['select_style'] = isset( $new_instance['select_style'] ) ? $new_instance['select_style'] : 'category-style-1';

		return $instance;
	}

	public function form( $instance ) {
		// Defaults.
		$instance     = wp_parse_args( (array) $instance, array( 
			'title' => '', 
			'limit' => '',
			'cat_id' => '',
			'count' => ''
		) );
		$count = isset( $instance['count'] ) ? (bool) $instance['count'] : false;
		$select_style = ( !empty( $instance['select_style'] ) ) ? $instance['select_style'] : 'category-style-1';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'cat_id' ); ?>"><?php _e( 'Category Id ( "," separated ) for ex: 41,42' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'cat_id' ); ?>" name="<?php echo $this->get_field_name( 'cat_id' ); ?>" type="text" value="<?php echo esc_attr( $instance['cat_id'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Limit:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="text" value="<?php echo esc_attr( $instance['limit'] ); ?>" />
		</p>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>"<?php checked( $count ); ?> />
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Show post counts' ); ?></label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'select_style' )); ?>"><?php esc_html_e( 'Select Category Style : ', 'tripfery-core' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'select_style' )); ?>">
				<option <?php if ( $select_style == 'category-style-1' ) {  echo 'selected'; } ?> value="category-style-1"><?php esc_html_e( 'Style 1' , 'tripfery-core' ); ?></option>
				<option <?php if ( $select_style == 'category-style-2' ) {  echo 'selected'; } ?> value="category-style-2"><?php esc_html_e( 'Style 2' , 'tripfery-core' ); ?></option>
			</select>
		</p>

		<?php
	}

}
