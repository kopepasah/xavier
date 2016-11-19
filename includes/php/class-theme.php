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
	 * Enqueues.
	 *
	 * @var Enqueues
	 */
	public $enqueues;

	/**
	 * Setup.
	 *
	 * @var Setup
	 */
	public $setup;

	/**
	 * Template configs.
	 *
	 * @var Configs
	 */
	public $configs;

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
		$this->compatability = new Compatability( $this );
		$this->enqueues      = new Enqueues( $this );
		$this->setup         = new Setup( $this );
		$this->configs       = new Configs( $this );
		$this->menu          = new Menu( $this );
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
