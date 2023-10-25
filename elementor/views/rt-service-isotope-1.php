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

$thumb_size = 'tripfery-size3';


$number_of_post = $data['itemnumber'];
$post_orderby = $data['post_orderby'];
$post_order = $data['post_order'];
$title_count = $data['title_count'];
$excerpt_count = $data['excerpt_count'];

$p_ids = array();
foreach ( $data['posts_not_in'] as $p_idsn ) {
	$p_ids[] = $p_idsn['post_not_in'];
}

$args = array(
	'post_type'			=> 'to_book',
	'posts_per_page' 	=> $number_of_post,
	'order' 			=> $post_order,
	'orderby' 			=> $post_orderby,
	'post__not_in'   	=> $p_ids,
);

if(!empty($data['catid'])){
    $args['tax_query'] = [
        [
            'taxonomy' => 'categories',
            'field' => 'term_id',
            'terms' => $data['catid'],                    
        ],
    ];

}
$query = new WP_Query( $args );

$temp = TripferyTheme_Helper::wp_set_temp_query( $query );
$col_class = "col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-xs-{$data['col_xs']}";

?>
<div class="rt-case-isotope case-multi-isotope-1 <?php if ( $data['all_button'] == 'hide' ) {?>hide-all<?php } ?> rt-isotope-wrapper">
	<div class="text-center">
		<div class="rt-case-tab rt-isotope-tab">
			<div class="case-cat-tab">
				<?php if ( $data['all_button'] == 'show' ) { ?>
					<a href="#" data-filter="*" class="current"><?php esc_html_e( 'See All', 'tripfery-core' );?></a>
				<?php } ?>
				<?php
				$terms = get_terms( array( 
				    'taxonomy' => 'categories', 
				    'include'  => $data['catid'],
				    'orderby' => 'include',
				) );				
				foreach( $terms as $term ) {
					?>
					<a href="#" data-filter=".tab-<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></a>
					<?php
				}
				?> 
			</div>
		</div>
	</div>

	<div class="row <?php echo esc_attr( $data['item_space'] );?> rt-isotope-content rt-masonry-grid">	
		<?php $j = $data['delay']; $k = $data['duration'];
			if ( $query->have_posts() ) {				
				while ( $query->have_posts() ) {
				$query->the_post();					

				$title = wp_trim_words( get_the_title(), $title_count, '' );	
				$excerpt = wp_trim_words( get_the_excerpt(), $excerpt_count, '' );

				$item_terms = get_the_terms( get_the_ID(), 'categories' ); 
				$term_links = array(); 
				$terms_of_item = '';
				foreach ( $item_terms as $term ) {
					$terms_of_item .= 'tab-'.$term->slug . ' ';
				} 
		?>
		<div class="<?php echo esc_attr( $col_class ); ?> rt-grid-item <?php echo esc_attr( $terms_of_item ); ?>">
			<div class="rtin-item <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $j );?>s" data-wow-duration="<?php echo esc_attr( $k );?>s">
				<div class="item-image multi-side-hover">
					<div class="rtin-figure">
						<a href="<?php the_permalink(); ?>">
							<?php
								if ( has_post_thumbnail() ){
									the_post_thumbnail( $thumb_size , ['class' => 'img-fluid mb-10 width-100'] );
								} else {
									if ( !empty( TripferyTheme::$options['no_preview_image']['id'] ) ) {
										echo wp_get_attachment_image( TripferyTheme::$options['no_preview_image']['id'], $thumb_size );
									} else {
										echo '<img class="wp-post-image" src="' . TripferyTheme_Helper::get_img( 'noimage_442X500.jpg' ) . '" alt="'.get_the_title().'">';
									}
								}
							?>
						</a>
						<a class="image__link" href="<?php the_permalink(); ?>"><i class="fas fa-arrow-right"></i></a>
					</div>				
				<div class="item-overlay"></div>
				</div>
				<div class="rtin-content">					
					<h3 class="rtin-title"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $title );?></a></h3>
					<?php if ( $data['cat_display'] == 'yes' ) { ?>
					<div class="rt-cat">
						<?php 
						$i = 1;
						foreach ( $item_terms as $term ) { ?>
							<?php if ( $i > 1 ){ echo esc_html( ', ' ); } ?><a href="<?php echo esc_url( get_term_link($term->slug, 'categories') ); ?>" class="current"><?php echo esc_html($term->name); ?></a>
						<?php $i++; } ?>
					</div>
					<?php } ?>
					<?php if ( $data['excerpt_display'] == 'yes' ) { ?>
						<p><?php echo wp_kses_post( $excerpt );?></p>
					<?php } ?>

				</div>
			</div>
		</div>			
		<?php  $j = $j + 0.2; $k = $k + 0.2; } ?>
	<?php } TripferyTheme_Helper::wp_reset_temp_query( $temp );?>
	
	</div>    
	<?php if ( $data['more_button'] == 'show' ) { ?>
	<?php if ( !empty( $data['see_button_text'] ) ) { ?>
	<div class="case-button"><a class="button-style-2 btn-common rt-animation-out" href="<?php echo esc_url( $data['see_button_link'] );?>"><?php echo esc_html( $data['see_button_text'] );?><?php //echo radius_arrow_shape(); ?></a>
    </div>
	<?php } } ?>      
</div>
<?php if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) { ?>
  <script>jQuery('.rt-isotope-content').isotope();</script>
<?php }