<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

add_action( 'widgets_init', 'tripfery_widgets_init' );
function tripfery_widgets_init() {
	// Register Custom Widgets
	register_widget( 'TripferyTheme_About_Widget' );
	register_widget( 'TripferyTheme_Address_Widget' );
	register_widget( 'TripferyTheme_Social_Widget' );
	register_widget( 'TripferyTheme_Post_Box' );
	register_widget( 'TripferyTheme_Post_Tab' );
	register_widget( 'TripferyTheme_Feature_Post' );
	register_widget( 'TripferyTheme_Product_Box' );
	register_widget( 'TripferyTheme_Category_Widget' );
	register_widget( 'TripferyTheme_Download_Widget' );
	register_widget( 'TripferyTheme_Contact_Widget' );
}