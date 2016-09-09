<?php
/**
 * Compatability
 *
 * @package Xavier
 */

namespace Xavier;

/**
 * Class Compatability
 */
class Compatability extends Module {

	/**
	 * Initialization.
	 */
	public function init() {
		add_action( 'after_switch_theme', array( $this, 'switch_theme' ) );
		add_action( 'load-customize.php', array( $this, 'customize_or_preview' ) );
		add_action( 'template_redirect',  array( $this, 'customize_or_preview' ) );
	}

	/**
	 * Error message.
	 */
	public function error_message() {
		return sprintf(
			esc_html__( 'Xavier requires %1$s plugin. Please install and/or activate %1$s in order to use Xavier.', 'xavier' ),
			'<a href="https://wordpress.org/plugins/timber-library/" target="_">Timber</a>'
		);
	}

	/**
	 * On theme switch, change back to the default theme, unset the activated
	 * parameter and post an admin notice.
	 */
	public function switch_theme() {
		switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

		unset( $_GET['activated'] ); // WPCS: input var okay.

		add_action( 'admin_notices', function() {
			printf( // WPCS: XSS ok.
				'<div class="error"><p>%s</p></div>',
				$this->error_message()
			);
		} );
	}

	/**
	 * When trying to customize or preview, throw a permanent failure.
	 */
	public function customize_or_preview() {
		wp_die( // WPCS: XSS ok.
			$this->error_message(),
			__( 'Xavier', 'xavier' ),
			array(
				'back_link' => true,
			)
		);
	}
}
