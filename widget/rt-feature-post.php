<?php 
/**
* Widget API: Recent Post Widget class
* By : Radius Theme
*/
use Rtrs\Models\Review; 
use Rtrs\Helpers\Functions; 

Class TripferyTheme_Feature_Post extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname' => 'rt-feature-post',
			'description' => esc_html__( 'Feature Post Display Widget' , 'tripfery-core' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'rt-feature-post', esc_html__( 'Tripfery : Feature Posts display' , 'tripfery-core' ), $widget_ops );
	}
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		$title = ( !empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts' , 'tripfery-core' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 6;
		if ( ! $number )
			$number = 6;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : true;
		$show_cat = isset( $instance['show_cat'] ) ? $instance['show_cat'] : false;
		$show_post_image = ( !empty( $instance['show_post_image'] ) ) ? $instance['show_post_image'] : 'yes';
		$post_display_order = ( !empty( $instance['post_display_order'] ) ) ? $instance['post_display_order'] : 'view';
		$show_no_preview_img = ( !empty( $instance['show_no_preview_img'] ) ) ? $instance['show_no_preview_img'] : 'none';
		
		if ( $post_display_order == 'view' ) {
		
			$result_query = new WP_Query( apply_filters( 'widget_posts_args', array(
				'posts_per_page'      => $number,
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'orderby'   		  => 'meta_value_num',
				'meta_key'  		  => 'tripfery_views',
				'ignore_sticky_posts' => true
			) ) );
		
		} else if ( $post_display_order == 'comment' ) {

			$result_query = new WP_Query( apply_filters( 'widget_posts_args', array(
				'posts_per_page'      => $number,
				'post_status'         => 'publish',
				'orderby'   		  => 'comment_count',
				'ignore_sticky_posts' => true
			) ) );
		
		} else {
			
			$result_query = new WP_Query( apply_filters( 'widget_posts_args', array(
				'posts_per_page'      => $number,
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true
			) ) );			
		}
		$i = 1;
		if ($result_query->have_posts()) :
		?>
		<?php echo wp_kses_post($args['before_widget']); ?>
		<?php if ( $title ) {
			echo wp_kses_post($args['before_title']) . $title . wp_kses_post($args['after_title']);
		} ?>
		<div class="feature-post-layout">
		<?php while ( $result_query->have_posts() ) {
				$result_query->the_post(); ?>
			<?php if ( $i == 1 ) { ?>
			<div class="rt-feature-widget">
				<div class="media">
					<?php if ( $show_post_image == 'yes' ) { ?>
						<?php if ( has_post_thumbnail() ){ ?>
							<a class="post-img-holder img-opacity-hover" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php
									if ( has_post_thumbnail() ){
										the_post_thumbnail( 'tripfery-size4', ['class' => 'media-object'] );
									} else {
										if ( $show_no_preview_img == 'view' ) { ?>
											<img class="rt-lazy" src="<?php echo esc_url( FAKTORIE_ASSETS_URL ); ?>img/noimage_400X400.jpg" alt="<?php the_title_attribute(); ?>">
									<?php }
									}
								?></a>
						<?php } ?>
					<?php } ?>
				</div>
				<div class="media-body">
					<?php if ( $show_date || $show_cat ) { ?>
						<div class="meta-wrap">
							<?php if ( $show_date ) { ?>
								<div class="entry-date"><i class="icon-tripfery-calendar"></i><?php echo get_the_time( get_option( 'date_format' ) ); ?></div>
							<?php } ?>
							<?php if ( $show_cat ) { ?>
							<div class="entry-cat"><i class="icon-tripfery-tags"></i>
							<?php
								$i = 1;
								$term_lists = get_the_terms( get_the_ID(), 'category' );
								foreach ( $term_lists as $term_list ){
									$link = get_term_link( $term_list->term_id, 'category' ); ?><?php if ( $i > 1 ){ echo esc_html( ', ' ); } ?><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $term_list->name ); ?></a><?php $i++; } ?>
							</div>
							<?php } ?>
						</div>
					<?php } ?>
					<h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h4>
					<p><?php echo wp_trim_words( get_the_content(), 15, '' ); ?></p>
				</div>
			</div>
			<?php } else { ?>
			<div class="rt-feature-widget list-item">
				<div class="media-body">
					<?php if ( $show_date || $show_cat ) { ?>
						<div class="meta-wrap">
							<?php if ( $show_date ) { ?>
								<div class="entry-date"><i class="icon-tripfery-calendar"></i><?php echo get_the_time( get_option( 'date_format' ) ); ?></div>
							<?php } ?>
							<?php if ( $show_cat ) { ?>
							<div class="entry-cat"><i class="icon-tripfery-tags"></i>
							<?php
								$i = 1;
								$term_lists = get_the_terms( get_the_ID(), 'category' );
								foreach ( $term_lists as $term_list ){
									$link = get_term_link( $term_list->term_id, 'category' ); ?><?php if ( $i > 1 ){ echo esc_html( ', ' ); } ?><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $term_list->name ); ?></a><?php $i++; } ?>
							</div>
							<?php } ?>
						</div>
					<?php } ?>
					<h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h4>
				</div>
			</div>	
			<?php } ?>
		<?php $i++; } ?>
		</div>
		<?php echo wp_kses_post($args['after_widget']); ?>
		<?php
		wp_reset_postdata();
		endif;
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance 				  = $old_instance;
		$instance['title'] 		  = sanitize_text_field( $new_instance['title'] );
		$instance['number'] 	  = (int) $new_instance['number'];
		$instance['show_date']    = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['show_cat']     = isset( $new_instance['show_cat'] ) ? (bool) $new_instance['show_cat'] : false;
		$instance['show_post_image'] = isset( $new_instance['show_post_image'] ) ? $new_instance['show_post_image'] : 'yes';
		$instance['post_display_order'] = isset( $new_instance['post_display_order'] ) ? $new_instance['post_display_order'] : 'view';
		$instance['show_no_preview_img'] = isset( $new_instance['show_no_preview_img'] ) ? $new_instance['show_no_preview_img'] : 'none';
		return $instance;
	}
	
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 6;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$show_cat = isset( $instance['show_cat'] ) ? (bool) $instance['show_cat'] : false;
		$show_post_image = ( !empty( $instance['show_post_image'] ) ) ? $instance['show_post_image'] : 'yes';
		$post_display_order = ( !empty( $instance['post_display_order'] ) ) ? $instance['post_display_order'] : 'view';
		$show_no_preview_img = ( !empty( $instance['show_no_preview_img'] ) ) ? $instance['show_no_preview_img'] : 'none';
		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:' , 'tripfery-core' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title); ?>" /></p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_display_order' )); ?>"><?php esc_html_e( 'Post Display Order : ', 'tripfery-core'  ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'post_display_order' )); ?>">
					<option <?php if ( $post_display_order == 'none' ) {  echo 'selected'; } ?> value="none"><?php esc_html_e( 'Recent' , 'tripfery-core' ); ?></option>
					<option <?php if ( $post_display_order == 'view' ) {  echo 'selected'; } ?> value="view"><?php esc_html_e( 'Most Viewed' , 'tripfery-core' ); ?></option>
					<option <?php if ( $post_display_order == 'comment' ) {  echo 'selected'; } ?> value="comment"><?php esc_html_e( 'Most Commented' , 'tripfery-core' ); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'show_no_preview_img' )); ?>"><?php esc_html_e( 'Show no preview image : ' , 'tripfery-core' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'show_no_preview_img' )); ?>">
					<option <?php if ( $show_no_preview_img == 'none' ) {  echo 'selected'; } ?> value="none"><?php esc_html_e( 'Hide' , 'tripfery-core' ); ?></option>
					<option <?php if ( $show_no_preview_img == 'view' ) {  echo 'selected'; } ?> value="view"><?php esc_html_e( 'Show' , 'tripfery-core' ); ?></option>
				</select>
			</p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of posts to show:', 'tripfery-core' ); ?></label>
			<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number); ?>" size="3" /></p>

			<p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' )); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_date' )); ?>"><?php esc_html_e( 'Display post date?' , 'tripfery-core'); ?></label></p>
			
			<p><input class="checkbox" type="checkbox"<?php checked( $show_cat ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_cat' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_cat' )); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_cat' )); ?>"><?php esc_html_e( 'Display post category?', 'tripfery-core' ); ?></label></p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'show_post_image' )); ?>"><?php esc_html_e( 'Show Post Image : ', 'tripfery-core' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'show_post_image' )); ?>">
					<option <?php if ( $show_post_image == 'yes' ) {  echo 'selected'; } ?> value="yes"><?php esc_html_e( 'Display' , 'tripfery-core' ); ?></option>
					<option <?php if ( $show_post_image == 'no' ) {  echo 'selected'; } ?> value="no"><?php esc_html_e( 'Hide' , 'tripfery-core' ); ?></option>
				</select>
			</p>
		<?php
	}	
}