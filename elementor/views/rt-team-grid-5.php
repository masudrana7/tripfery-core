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

$thumb_size  = 'tripfery-size8';
if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
}
else if ( get_query_var('page') ) {
	$paged = get_query_var('page');
}
else {
	$paged = 1;
}

$args = array(
	'post_type'      => 'tripfery_team',
	'posts_per_page' => $data['number'],
	'order' 			=> $data['post_ordering'],
	'orderby' 			=> $data['post_orderby'],
	'paged' => $paged
);

if ( !empty( $data['cat'] ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'tripfery_team_category',
			'field' => 'term_id',
			'terms' => $data['cat'],
		)
	);
}

$query = new WP_Query( $args );
$temp = TripferyTheme_Helper::wp_set_temp_query( $query );
$col_class = "col-xl-{$data['col_xl']} col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-xs-{$data['col_xs']}";
?>
<div class="rt-team-default rt-team-multi-layout-5 team-grid-<?php echo esc_attr( $data['style'] );?>">
	<div class="row <?php echo esc_attr( $data['item_space'] );?>">
		<?php $i = $data['delay']; $j = $data['duration'];
			if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$id            = get_the_id();
				$position   	= get_post_meta( $id, 'tripfery_team_position', true );
				$socials       	= get_post_meta( $id, 'tripfery_team_socials', true );
				$social_fields 	= TripferyTheme_Helper::team_socials();
				if ( $data['contype'] == 'content' ) {
					$content = apply_filters( 'the_content', get_the_content() );
				}
				else {
					$content = apply_filters( 'the_excerpt', get_the_excerpt() );;
				}
				$content = wp_trim_words( $content, $data['count'], '' );
				$content = "$content";
				?>
				<div class="<?php echo esc_attr( $col_class );?>">
					<div class="team-item <?php echo esc_attr( $data['animation'] );?> <?php echo esc_attr( $data['animation_effect'] );?>" data-wow-delay="<?php echo esc_attr( $i );?>s" data-wow-duration="<?php echo esc_attr( $j );?>s">
						<div class="team-content-wrap">
							<div class="team-thums">
								<a href="<?php the_permalink();?>">
									<?php
									if ( has_post_thumbnail() ){
										the_post_thumbnail( $thumb_size );
									}
									else {
										if ( !empty( TripferyTheme::$options['no_preview_image']['id'] ) ) {
											echo wp_get_attachment_image( TripferyTheme::$options['no_preview_image']['id'], $thumb_size );
										}
										else {
											echo '<img class="wp-post-image" src="' . TripferyTheme_Helper::get_img( 'noimage_480X480.jpg' ) . '" alt="'.get_the_title().'">';
										}
									}
									?>
								</a>
							</div>
							<div class="team-content">
								<h3 class="team-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
								<?php if ( $data['designation_display']  == 'yes' ) { ?>
								<div class="team-designation"><?php echo esc_html( $position );?></div>
								<?php } ?>
								<?php if ( $data['content_display']  == 'yes' ) { ?>
								<p><?php echo wp_kses( $content , 'alltext_allow' ); ?></p>
								<?php } ?>
								<?php if ( $data['vactor_display']  == 'yes' ) { ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="295" height="108" viewBox="0 0 295 108" fill="none">
									<path d="M159.953 38.1989L42.4399 154.408H110.652L228.165 38.1989H159.953Z" fill="currentColor"/>
									<path d="M295 1.20927L293.795 0L180.811 111.296L182.015 112.505L295 1.20927Z" fill="currentColor"/>
									<path d="M96.7835 68.8403L95.5661 67.6438L0 163.804L1.21744 165L96.7835 68.8403Z" fill="currentColor"/>
								</svg>
								<?php } ?>
							</div>
							<?php if ( !empty( $socials ) && $data['social_display']  == 'yes' ) { ?>
								<ul class="team-social">
									<li class="social-item"><a href="#" class="social-hover-icon social-link" aria-label="Social Share"><i class="icon-tripfery-share"></i></a>
										<ul class="team-social-dropdown">
											<?php foreach ( $socials as $key => $social ): ?>
												<?php if ( !empty( $social ) ): ?>
													<li class="social-item"><a class="social-link" target="_blank" href="<?php echo esc_url( $social );?>"><i class="fab <?php echo esc_attr( $social_fields[$key]['icon'] );?>" aria-hidden="true"></i></a></li>
												<?php endif; ?>
											<?php endforeach; ?>
										</ul>
									</li>
								</ul>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php $i = $i + 0.2; $j = $j + 0.1; } ?>
		<?php } ?>
		<?php //wp_reset_postdata();?>
	</div>
	<?php if ( $data['more_button'] == 'show' ) { ?>
		<?php if ( !empty( $data['see_button_text'] ) ) { ?>
		<div class="team-button"><a class="button-style-2 btn-common" href="<?php echo esc_url( $data['see_button_link'] );?>"><?php echo esc_html( $data['see_button_text'] );?><i class="icon-tripfery-right-arrow"></i></a></div>
		<?php } ?>
	<?php } else { ?>
		<?php TripferyTheme_Helper::pagination(); ?>
	<?php } ?>
	<?php TripferyTheme_Helper::wp_reset_temp_query( $temp ); ?>
</div>