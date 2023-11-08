<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Tripfery_Core;
use TripferyTheme;
use TripferyTheme_Helper;
use \WP_Query;

$tripfery_has_entry_meta  = ( $data['post_author'] == 'yes' || $data['post_date'] == 'yes' || $data['post_category'] == 'yes' || $data['post_comment'] == 'yes' || $data['post_length'] == 'yes' && function_exists( 'tripfery_reading_time' ) || $data['post_view'] == 'yes' && function_exists( 'tripfery_views' ) ) ? true : false;

$thumb_size = 'tripfery-size3';

$p_ids = array();
foreach ( $data['posts_not_in'] as $p_idsn ) {
	$p_ids[] = $p_idsn['post_not_in'];
}
$args = array(
	'posts_per_page' 	=> $data['itemlimit']['size'],
	'order' 			=> $data['post_ordering'],
	'orderby' 			=> $data['post_orderby'],
	'offset' 	 	 	=> $data['number_of_post_offset'],
	'post__not_in'   	=> $p_ids,
	'post_type'			=> 'post',
	'post_status'		=> 'publish',
);

if(!empty($data['catid'])){
	if( $data['query_type'] == 'category'){
	    $args['tax_query'] = [
	        [
	            'taxonomy' => 'category',
	            'field' => 'term_id',
	            'terms' => $data['catid'],                    
	        ],
	    ];
	}
}
if(!empty($data['postid'])){
	
	if( $data['query_type'] == 'posts'){

	    $args['post__in'] = $data['postid'];
	}
}
$query = new WP_Query( $args );
$temp = TripferyTheme_Helper::wp_set_temp_query( $query );
$col_class = "col-xl-{$data['col_xl']} col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-xs-{$data['col_xs']}";
?>
<div class="rt-post-grid-default rt-post-grid-<?php echo esc_attr( $data['style'] );?>">
	<div class="row <?php echo esc_attr( $data['item_gutter'] );?> <?php if ( $data['grid_maso_layout'] == 'masonry_layout' ) { ?>rt-masonry-grid<?php } ?> grid-one-loadmore-items">
	<?php $i = $data['delay']; $j = $data['duration']; 
		if ( $query->have_posts() ) :?>
		<?php while ( $query->have_posts() ) : $query->the_post();?>
			<?php
			$content = TripferyTheme_Helper::get_current_post_content();
			$content = wp_trim_words( get_the_excerpt(), $data['count'], '.' );
			$content = "<p>$content</p>";
			$title = wp_trim_words( get_the_title(), $data['title_count'], '' );			
			$tripfery_comments_number = number_format_i18n( get_comments_number() );
			$tripfery_comments_html = $tripfery_comments_number == 1 ? esc_html__( 'Comment' , 'tripfery-core' ) : esc_html__( 'Comments' , 'tripfery-core' );
			$tripfery_comments_html = '<span class="comment-number">'. $tripfery_comments_number . '</span> ' . $tripfery_comments_html;	

			$id = get_the_ID();
			$youtube_link = get_post_meta( get_the_ID(), 'tripfery_youtube_link', true );

			?>
			<div class="rt-grid-item <?php echo esc_attr( $col_class );?> <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $i );?>s" data-wow-duration="<?php echo esc_attr( $j );?>s">
				<div class="rt-item">
					<div class="rt-image">
						<?php if ( ( $data['post_video'] == 'yes' && 'video' == get_post_format( $id ) && !empty( $youtube_link ) ) ) { ?>
							<div class="rt-video"><a class="rt-play <?php echo esc_attr( $data['video_layout'] );?> rt-video-popup" href="<?php echo esc_url( $youtube_link );?>"><i class="fas fa-play"></i></a></div>
						<?php } ?>
						<a href="<?php the_permalink(); ?>" class="img-opacity-hover" aria-label="<?php echo esc_html( $title );?>"><?php if ( has_post_thumbnail() ) { ?>
						<?php the_post_thumbnail( $thumb_size, ['class' => 'img-responsive'] ); ?>
						<?php } else {
							if ( TripferyTheme::$options['display_no_preview_image'] == '1' ) {
								if ( !empty( TripferyTheme::$options['no_preview_image']['id'] ) ) {
									$thumbnail = wp_get_attachment_image( TripferyTheme::$options['no_preview_image']['id'], $thumb_size );						
								}
								elseif ( empty( TripferyTheme::$options['no_preview_image']['id'] ) ) {
									$thumbnail = '<img class="wp-post-image" src="'.TRIPFERY_ASSETS_URL.'img/noimage_520X330.jpg" alt="'. the_title_attribute( array( 'echo'=> false ) ) .'">';
								}
								echo wp_kses( $thumbnail , 'alltext_allow' );
							}
						}
					?>
					</a>
					</div>
					<div class="entry-content">
						<?php if ( $tripfery_has_entry_meta ) { ?>
						<ul class="entry-meta">
							<?php if ( $data['post_author'] == 'yes' ) { ?>
							<li class="post-author"><?php esc_html_e( 'by ', 'tripfery' );?><?php the_author_posts_link(); ?></li>
							<?php } if ( $data['post_category'] == 'yes' ) { ?>
							<li class="entry-categories"><?php echo the_category( ', ' );?></li>
							<?php } if ( $data['post_date'] == 'yes' ) { ?>	
							<li class="post-date"><?php echo get_the_date(); ?></li>
							<?php } if ( $data['post_comment'] == 'yes' ) { ?>
							<li class="post-comment"><a href="<?php echo get_comments_link( get_the_ID() ); ?>"><?php echo wp_kses( $tripfery_comments_html , 'alltext_allow' );?></a></li>
							<?php } if ( ( $data['post_length'] == 'yes' ) && function_exists( 'tripfery_reading_time' ) ) { ?>
							<li class="post-reading-time meta-item"><?php echo tripfery_reading_time(); ?></li>
							<?php } if ( ( $data['post_view'] == 'yes' ) && function_exists( 'tripfery_views' ) ) { ?>
							<li><span class="post-views"><?php echo tripfery_views(); ?></span></li>
							<?php } ?>
						</ul>
						<?php } ?>
						<h3 class="entry-title"><a href="<?php the_permalink();?>"><?php echo esc_html( $title );?></a></h3>
						<?php if ( $data['content_display'] == 'yes' ) { ?>
							<div class="post_excerpt"><?php echo wp_kses_post( $content );?></div>
						<?php } ?>
						<?php if ( $data['post_read'] == 'yes' ) { ?>
						<div class="post-read-more"><a class="<?php echo esc_attr( $data['read_more_layout'] );?> btn-common" href="<?php the_permalink();?>"><?php esc_html_e( 'Continue Reading', 'tripfery' );?><i class="icon-tripfery-right-arrow"></i></a></div>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php $i = $i + 0.2; $j = $j + 0.1; endwhile;?>
	<?php endif;?>
	</div>
	<?php TripferyTheme_Helper::wp_reset_temp_query( $temp );?>
</div>