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
	<div class="row justify-content-center">
		<div class="col-auto">
			<div class="listing-filter-btns d-flex align-items-center justify-content-center flex-wrap">
				<?php if ( $data['all_button'] == 'show' ) { ?>
					<button data-filter=".hotel" class="filter-btn hotel active"><?php esc_html_e( 'See All', 'tripfery-core' );?></button>
				<?php } ?>
				<?php
				$terms = get_terms( array( 
				    'taxonomy' => 'categories', 
				    'include'  => $data['catid'],
				    'orderby' => 'include',
				) );				
				foreach( $terms as $term ) {
					?>
					<button data-filter=".restaurant" class="filter-btn restaurant"><?php echo esc_html($term->name); ?></button>
					<?php
				}
				?> 

			</div>
		</div>
	</div>


			
		


		<div class="row <?php echo esc_attr( $data['item_space'] );?> rt-isotope-content rt-masonry-grid justify-content-center cardContainer">	
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
		<div class="<?php echo esc_attr( $col_class ); ?> rt-grid-item <?php echo esc_attr( $terms_of_item ); ?> mb-4">
			<div class="rtin-item <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $j );?>s" data-wow-duration="<?php echo esc_attr( $k );?>s">

			<div class="listing-card">
				<a href="<?php the_permalink(); ?>" class="text-decoration-none listing-thumb-wrapper">
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
				<div class="listing-card-content">
					<div class="d-flex justify-content-between">
						<div class="badge bage-pink">
							<svg class="badge-icon" width="12" height="12" viewBox="0 0 12 12" fill="none"
								xmlns="http://www.w3.org/2000/svg">
								<path
								d="M5.99994 6.71503C6.86151 6.71503 7.55994 6.0166 7.55994 5.15503C7.55994 4.29347 6.86151 3.59503 5.99994 3.59503C5.13838 3.59503 4.43994 4.29347 4.43994 5.15503C4.43994 6.0166 5.13838 6.71503 5.99994 6.71503Z"
								stroke="currentColor" stroke-opacity="0.99" />
								<path
								d="M1.8101 4.24506C2.7951 -0.0849378 9.2101 -0.0799377 10.1901 4.25006C10.7651 6.79006 9.1851 8.94006 7.8001 10.2701C6.7951 11.2401 5.2051 11.2401 4.1951 10.2701C2.8151 8.94006 1.2351 6.78506 1.8101 4.24506Z"
								stroke="currentColor" stroke-opacity="0.99" />
							</svg>
							<span class="badge-text">New York City</span>
						</div>
						<div class="wishlist">
							<svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path
								d="M10.5167 16.3416C10.2334 16.4416 9.76675 16.4416 9.48341 16.3416C7.06675 15.5166 1.66675 12.075 1.66675 6.24165C1.66675 3.66665 3.74175 1.58331 6.30008 1.58331C7.81675 1.58331 9.15841 2.31665 10.0001 3.44998C10.8417 2.31665 12.1917 1.58331 13.7001 1.58331C16.2584 1.58331 18.3334 3.66665 18.3334 6.24165C18.3334 12.075 12.9334 15.5166 10.5167 16.3416Z"
								stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</div>
					</div>
					<h3 class="listing-card-title">
						<a href="<?php the_permalink(); ?>"><?php echo esc_html( $title );?></a>
					</h3>
					
					<div class="d-flex align-item listing-card-review-area">
						<div class="listing-card-review-text">Excellent</div>
						<div class="d-flex align-items-center rating-stars-area">
							<ul class="rating-stars d-flex">
								<li class="star-item">
								<i class="fa-solid fa-star"></i>
								</li>
								<li class="star-item">
								<i class="fa-solid fa-star"></i>
								</li>
								<li class="star-item">
								<i class="fa-solid fa-star"></i>
								</li>
								<li class="star-item">
								<i class="fa-solid fa-star"></i>
								</li>
								<li class="star-item">
								<i class="fa-solid fa-star"></i>
								</li>
							</ul>
							<div class="number-of-reviews">(3 Reviews)</div>
						</div>
					</div>
					<div class="d-flex align-items-center justify-content-between price-area">
						<span class="price-text">$80<span class="price-time">/Night</span></span>
						<a href="<?php the_permalink(); ?>" class="btn-light-sm btn-light-animated">View Availability</a>
					</div>
				</div>
			</div>


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




	
	</div>
</div>








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