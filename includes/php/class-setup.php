<?php
/**
 * Setup
 *
 * @package Xavier
 */

namespace Xavier;

/**
 * Class Setup
 *
 * @package Xavier
 */
class Setup extends Module {

	/**
	 * Supports
	 *
	 * @var $supports
	 */
	private $supports = array(
		'post-thumbnails',
		'automatic-feed-links',
		'title-tag',
		'html5' => array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		),
		'post-formats' => array(
			'aside',
			'gallery',
			'image',
			'video',
			'quote',
			'link',
			'status',
			'audio',
			'chat',
		),
	);

	/**
	 * Menus
	 *
	 * @var $menus
	 */
	private $menus = array(
		'header' => 'Header',
		'footer' => 'Footer',
	);

	/**
	 * Initilizer
	 */
	public function init() {
		add_action( 'after_setup_theme', array( $this, 'support' ) );
		add_action( 'after_setup_theme', array( $this, 'menus' ) );
	}

	/**
	 * Theme Supports
	 */
	public function support() {
		foreach ( $this->supports as $key => $feature ) {
			if ( is_array( $feature ) ) {
				add_theme_support( $key, $feature );
			} else {
				add_theme_support( $feature );
			}
		}
	}

	/**
	 * Theme Menus
	 */
	public function menus() {
		foreach ( $this->menus as $location => $description ) {
			register_nav_menu( $location, __( $description, 'xavier' ) );
		}
	}
}
