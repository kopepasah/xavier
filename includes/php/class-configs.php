<?php
/**
 * Template Configs
 *
 * @package Xavier
 */

namespace Xavier;

/**
 * Class Configs
 *
 * @package Xavier
 */
class Configs extends Module {
	/**
	 * Initilizer
	 */
	public function init() {
		$view = array(
			'view'  => 'default',
			'query' => $GLOBALS['wp_query'],
		);

		add_filter( 'xavier/configs', function( $config ) use ( $view ) {
			return array_merge( $view, $config );
		} );
	}
}
