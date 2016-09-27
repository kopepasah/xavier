<?php
/**
 * Compatability
 *
 * @package Xavier
 */

namespace Xavier;

// Required to use some of the plugin functions.
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Class Compatability
 */
class Compatability extends Module {

	/**
	 * Required Plugins
	 *
	 * @var array $required
	 */
	public $required = array(
		'rest-api/plugin.php' => array(
			'name' => 'WP REST API',
			'url'  => 'https://wordpress.org/plugins/rest-api/',
		),
	);

	/**
	 * Initialization.
	 */
	public function init() {
		$inactive = $this->inactive_plugins();

		if ( $inactive['state'] ) {
			// On change theme, prevent activation if a default theme exists.
			if ( $this->default_theme_exists() ) {
				add_action( 'after_switch_theme', array( $this, 'prevent_switch' ) );
			}

			$this->throw_errors();

			add_action( 'load-customize.php', array( $this, 'prevent_preview' ) );
		}
	}

	/**
	 * Checks that the required plugins are active.
	 *
	 * @return array $inactive The inactive state and inactive plugins (if any).
	 */
	public function inactive_plugins() {
		$inactive = array(
			'state' => false,
		);

		foreach ( $this->required as $plugin => $data ) {
			if ( is_plugin_inactive( $plugin ) ) {
				$inactive['state'] = true;
				$inactive['plugins'][] = $data;
			}
		}

		return $inactive;
	}

	/**
	 * Checks to see if a default theme exists.
	 *
	 * @return boolean $exists True if default theme exists, otherwise false.
	 */
	public function default_theme_exists() {
		$exists = false;

		$default = wp_get_theme( WP_DEFAULT_THEME );

		if ( ! $default->exists() ) {
			$default = \WP_Theme::get_core_default_theme();
		}

		if ( $default && $default->exists() ) {
			$exists = true;
		}

		return $exists;
	}

	/**
	 * Prevents switching to this theme.
	 */
	public function prevent_switch() {
		switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

		unset( $_GET['activated'] ); // WPCS: input var okay.
	}

	/**
	 * When trying to customize or preview, throw a permanent failure.
	 */
	public function prevent_preview() {
		wp_die( // WPCS: XSS ok.
			esc_html__( 'Xavier is not available to preview or customize because of missing plugins. Please log in, install and activate required plugins before using this feature.', 'xavier' ),
			__( 'Xavier', 'xavier' ),
			array(
				'back_link' => true,
			)
		);
	}

	/**
	 * Add error messages for each inactive plugin.
	 */
	public function throw_errors() {
		$inactive = $this->inactive_plugins();

		foreach ( $inactive['plugins'] as $plugin ) {
			add_action( 'admin_notices', function() use ( $plugin ) {
				printf( // WPCS: XSS ok.
					'<div class="error"><p>%s</p></div>',
					sprintf(
						esc_html__( 'Xavier requires %1$s plugin. Please install and/or activate %1$s in order to use Xavier.', 'xavier' ),
						'<a href="' . $plugin['url'] . '" target="_">' . $plugin['name'] . '</a>'
					)
				);
			} );
		}
	}
}
