<?php
/**
 * Theme
 *
 * @package Xavier
 */

namespace Xavier;

/**
 * Class Theme
 */
class Theme {

	/**
	 * Compatability.
	 *
	 * @var Compatability
	 */
	public $compatability;

	/**
	 * Assets.
	 *
	 * @var Assets
	 */
	public $assets;

	/**
	 * Setup.
	 *
	 * @var Setup
	 */
	public $setup;

	/**
	 * Template router.
	 *
	 * @var Router
	 */
	public $router;

	/**
	 * Template router.
	 *
	 * @var Router
	 */
	public $menu;

	/**
	 * Theme constructor.
	 */
	public function __construct() {
		// If Timber is not active, do not activate Xavier.
		if ( is_admin() && is_plugin_inactive( 'timber-library/timber.php' ) ) {
			$this->compatability = new Compatability( $this );
		}

		$this->assets = new Assets( $this );
		$this->setup = new Setup( $this );
		$this->router = new Router( $this );
		$this->menu = new Menu( $this );
	}

	/**
	 * Initialize modules.
	 */
	public function init() {
		foreach ( get_object_vars( $this ) as $var ) {
			if ( $var instanceof Module ) {
				$var->init();
			}
		}
	}
}
