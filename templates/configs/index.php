<?php
/**
 * Configuration for the default fallback view.
 *
 * @package Xavier
 */

$view = array(
	'view'  => 'default',
	'query' => $GLOBALS['wp_query'],
);

add_filter( 'xavier/configs', function( $config ) use ( $view ) {
	return array_merge( $view, $config );
} );

get_template_part( 'index' );
