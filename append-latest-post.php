<?php
/*
Plugin Name: Append Latest Post
Plugin URI: https://www.advancedcustomfields.com
Description: Adds a content box to the bottom of every article containing the latest available post.
Version: 1
*/

if ( !class_exists('Append_Latest_Post') ) {

class Append_Latest_Post {
	public function __construct() {
		add_filter( 'the_content', array( &$this, 'alp_append') );
		add_action( 'wp_enqueue_scripts', array( &$this, 'alp_scripts') );
	}

	/**
	 * Append latest post
	 */
	public function alp_append ( $content ) {
		$query_args = array(
			'post_per_page' => 1
		);

		$posts = new WP_Query($query_args);

		if ( $posts->have_posts() ) {
			while ( $posts->have_posts() ) {
				$posts->the_post();

				// Output *There has to be a better way to do this than using OB. 
				ob_start();
				require 'templates/latest.php';
				$latest = ob_get_clean();
				$content .= $latest;
				return $content;				
			}
		}
	}

	public function alp_scripts() {
		wp_enqueue_style( 'append-latest-post', plugins_url( '/css/append-latest-post.css', __FILE__ ) );
	}
}

new Append_Latest_Post();

}