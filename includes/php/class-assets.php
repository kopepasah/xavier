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
		$scripts = get_template_directory_uri() . '/assets/js/';
		$styles = get_template_directory_uri() . '/assets/css/';

		wp_register_script( 'xavier', $scripts . 'xavier' . $this->ext['scripts'], array(), filemtime( get_template_directory() . '/assets/js/xavier' . $this->ext['scripts'] ), true );
		wp_register_style( 'xavier', $styles . 'xavier' . $this->ext['styles'], array(), filemtime( get_template_directory() . '/assets/css/xavier' . $this->ext['styles'] ) );
	}

	/**
	 * Enqueues assets.
	 */
	public function enqueue_assets() {
		wp_enqueue_style( 'xavier' );

		wp_enqueue_script( 'xavier' );

		wp_localize_script( 'xavier', 'xavier', apply_filters( 'xavier/configs', array(
			'utils' => array(
				'root'      => esc_url_raw( rest_url() ),
				'home_url'  => esc_url_raw( home_url() ),
				'nonce'     => wp_create_nonce( 'wp_rest' ),
				'site_name' => get_bloginfo( 'name' ),
			),
		) ) );
	}
}
