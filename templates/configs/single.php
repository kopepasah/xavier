<?php
/**
 * Configuration for the single view.
 *
 * @package Xavier
 */

$view = array(
	'view'  => 'single',
	'query' => $GLOBALS['wp_query'],
);

add_filter( 'xavier/configs', function( $config ) use ( $view ) {
	return array_merge( $view, $config );
} );

get_template_part( 'index' );
