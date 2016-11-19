<?php
/**
 * Enqueues
 *
 * @package Xavier
 */

namespace Xavier;

/**
 * Class Enqueues
 *
 * @package Xavier
 */
class Enqueues extends Module {

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

		add_action( 'wp_enqueue_scripts', array( $this, 'register_and_enqueue' ) );
	}

	/**
	 * Registers enqueues.
	 */
	public function register_and_enqueue() {
		$scripts = get_template_directory_uri() . '/includes/js/';
		$styles = get_template_directory_uri() . '/includes/css/';

		wp_register_script( 'xavier', $scripts . 'xavier' . $this->ext['scripts'], array(), filemtime( get_template_directory() . '/includes/js/xavier' . $this->ext['scripts'] ), true );
		wp_register_style( 'xavier', $styles . 'xavier' . $this->ext['styles'], array(), filemtime( get_template_directory() . '/includes/css/xavier' . $this->ext['styles'] ) );

		wp_enqueue_style( 'xavier' );
		wp_enqueue_script( 'xavier' );

		wp_localize_script( 'xavier', 'xavier', apply_filters( 'xavier/configs', array( // @codingStandardsIgnoreLine
			'routes' => $this->routes(),
			'utils' => array(
				'root'      => esc_url_raw( rest_url() ),
				'home'      => esc_url_raw( home_url() ),
				'nonce'     => wp_create_nonce( 'wp_rest' ),
				'site_name' => get_bloginfo( 'name' ),
			),
		) ) );
	}

	/**
	 * Routes (TEMP)
	 */
	public function routes() {
		$routes = array(
			array(
				'component' => 'Posts',
				'path'      => '/',
			),
			array(
				'component' => 'Posts',
				'name'      => 'paged',
				'path'      => '/page/:page',
			),
		);

		$query = new \WP_Query( array(
			'post_type'      => 'any',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
		) );

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$routes[] = array(
					'id'        => get_the_ID(),
					'name'      => get_post_type(),
					'component' => ucfirst( get_post_type() ),
					'path'      => '/' . basename( get_permalink() ),
				);
			}
		}

		wp_reset_postdata();

		return $routes;
	}

}
