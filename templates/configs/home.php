<?php
/**
 * Configuration for the home view.
 *
 * @package Xavier
 */

$view = array(
	'view'     => 'home',
	'query'    => $GLOBALS['wp_query'],
	'per_page' => get_option( 'posts_per_page' ),
);

add_filter( 'xavier/configs', function( $config ) use ( $view ) {
	return array_merge( $view, $config );
} );

get_template_part( 'index' );
