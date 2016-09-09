<?php
/**
 * Module
 *
 * @package Xavier
 */

namespace Xavier;

/**
 * Class Module
 *
 * @package Xavier
 */
abstract class Module {

	/**
	 * Theme.
	 *
	 * @var Theme
	 */
	public $theme;

	/**
	 * Theme constructor.
	 *
	 * @param Theme $theme instance.
	 */
	public function __construct( Theme $theme ) {
		$this->theme = $theme;
	}

	/**
	 * Add theme hooks.
	 */
	public function init() {
		/* Noop */
	}
}
