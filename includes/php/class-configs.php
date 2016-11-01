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
	 * Template configs.
	 *
	 * @var configs (string)
	 */
	private $configs = 'templates/configs';

	/**
	 * An array of template names.
	 *
	 * @var types (array)
	 */
	private $templates = array(
		'index' => array(
			'prefix'   => 'index',
			'priority' => 100,
		),
		'not_found' => array(
			'prefix'   => '404',
			'priority' => 100,
		),
		'home' => array(
			'prefix'   => 'home',
			'priority' => 100,
		),
		'frontpage' => array(
			'prefix'   => 'frontpage',
			'priority' => 100,
		),
		'singular' => array(
			'prefix'   => 'singular',
			'priority' => -1000,
		),
		'single' => array(
			'prefix'   => 'single',
			'priority' => -1000,
		),
		'archive' => array(
			'prefix'   => 'archive',
			'priority' => 100,
		),
	);

	/**
	 * Initilizer
	 */
	public function init() {
		// Allow configs configuration location to be changed.
		$this->configs = trailingslashit( apply_filters( 'template_router_configs', $this->configs ) );

		foreach ( $this->templates as $method => $args ) {
			if ( method_exists( $this, $method . '_template' ) ) {
				add_filter( $args['prefix'] . '_template', array( $this, $method . '_template' ), $args['priority'] );
			}
		}
	}

	/**
	 * Check to see if the template exists in a specific location and, if so,
	 * route to that new template.
	 *
	 * @param string $location The template location.
	 * @param string $template The template.
	 *
	 * @return string $template The template.
	 */
	private function get_template( $location, $template ) {
		if ( ! empty( locate_template( $location ) ) ) {
			$template = trailingslashit( get_stylesheet_directory() ) . $location;
		}

		return $template;
	}

	/**
	 * Filter the index template to look in our new templates directory.
	 *
	 * @param string $template The current template location.
	 *
	 * @return template The filtered template location.
	 */
	public function index_template( $template ) {
		$location = $this->configs . 'index.php';

		return $this->get_template( $location, $template );
	}

	/**
	 * Filter the 404 template to look in our new templates directory.
	 *
	 * @param string $template The current template location.
	 *
	 * @return template The filtered template location.
	 */
	public function not_found_template( $template ) {
		$location = $this->configs . 'not-found.php';

		return $this->get_template( $location, $template );
	}

	/**
	 * Filter the home template to look in our new templates directory.
	 *
	 * @param string $template The current template location.
	 *
	 * @return string $template The filtered template location.
	 */
	public function home_template( $template ) {
		$location = $this->configs . 'home.php';

		return $this->get_template( $location, $template );
	}

	/**
	 * Filter the front page template to look in our new templates directory.
	 *
	 * @param string $template The current template location.
	 *
	 * @return string $template The filtered template location.
	 */
	public function frontpage_template( $template ) {
		$location = $this->configs . 'front.php';

		return $this->get_template( $location, $template );
	}

	/**
	 * Filter the singular template to look in our new templates directory.
	 *
	 * @param string $template The current template location.
	 *
	 * @return string $template The filtered template location.
	 */
	public function singular_template( $template ) {
		$location = $this->configs . 'singular.php';

		return $this->get_template( $location, $template );
	}

	/**
	 * Filter the single template to look in our new templates directory.
	 *
	 * @param string $template The current template location.
	 *
	 * @return string $template The filtered template location.
	 */
	public function single_template( $template ) {
		$location = $this->configs . 'single.php';

		return $this->get_template( $location, $template );
	}

	/**
	 * Filter the single template to look in our new templates directory.
	 *
	 * @param string $template The current template location.
	 *
	 * @return string $template The filtered template location.
	 */
	public function archive_template( $template ) {
		$location = $this->configs . 'archive.php';

		return $this->get_template( $location, $template );
	}
}
