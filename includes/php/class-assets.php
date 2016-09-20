<?php
/**
 * Assets
 *
 * @package Xavier
 */

namespace Xavier;

/**
 * Class Assets
 *
 * @package Xavier
 */
class Assets extends Module {

	/**
	 * File extension array.
	 *
	 * @var $ext The file extension.
	 */
	public $ext = array(
		'styles'  => null,
		'scripts' => null,
	);

	/**
	 * Initilizer
	 */
	public function init() {
		$this->ext['scripts'] = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '.js' : '.min.js';
		$this->ext['styles'] = ( defined( 'STYLE_DEBUG' ) && STYLE_DEBUG ) ? '.css' : '.min.css';

		add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
	}

	/**
	 * Registers assets.
	 */
	public function register_assets() {
		$scripts = get_template_directory_uri() . '/build/scripts/';
		$styles = get_template_directory_uri() . '/build/styles/';

		wp_register_script( 'vuejs', $scripts . 'libs/vue/vue' . $this->ext['scripts'], array(), '1.0.26', true );
		wp_register_script( 'xavier', $scripts . 'xavier' . $this->ext['scripts'], array( 'vuejs' ), filemtime( get_template_directory() . '/build/scripts/xavier' . $this->ext['scripts'] ), true );
	}

	/**
	 * Enqueues assets.
	 */
	public function enqueue_assets() {
		wp_enqueue_script( 'xavier' );

		// wp_enqueue_inline_script.
	}
}
