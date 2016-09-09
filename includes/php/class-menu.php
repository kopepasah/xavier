<?php
/**
 * Menu
 *
 * @package Xavier
 */

namespace Xavier;

/**
 * Class Menu
 *
 * @package Xavier
 */
class Menu extends Module {

	/**
	 * Initilizer
	 */
	public function init() {
		add_filter( 'get_twig', array( $this, 'twig_menu_items' ) );
	}

	/**
	 * Gets the menu items for a specific location.
	 *
	 * @param string $location The registered menu location.
	 *
	 * @return object $items Set menu items.
	 */
	public function get_menu_items( $location ) {
		// Get the available nav menu locations.
		$locations = get_nav_menu_locations();

		// If there is no nav location, return false.
		if ( ! isset( $locations[ $location ] ) ) {
			return false;
		}

		return wp_get_nav_menu_items( wp_get_nav_menu_object( $locations[ $location ] ) );
	}

	/**
	 * Create and organize menu sturcture for the template.
	 *
	 * @param string $location Registered menu location.
	 *
	 * @return array $menu Template menu array.
	 */
	public function organize_menu_items( $location ) {
		$items = $this->get_menu_items( $location );

		// If there are no items, bail.
		if ( ! $items ) {
			return $items;
		}

		$menu = array();

		// Loop through the items and create a one level deep menu.
		foreach ( $items as $item ) {
			if ( '0' === $item->menu_item_parent ) {
				$menu[ $item->ID ] = array(
					'url'         => $item->url,
					'title'       => $item->title,
					'target'      => $item->target,
					'attr_title'  => $item->attr_title,
					'description' => $item->description,
					'classes'     => ( empty( $item->classes[0] ) ) ? '' :  ' ' . implode( ' ', $item->classes ),
					'rel'         => $item->xfn,
					'children'    => false,
				);
			} elseif ( isset( $menu[ $item->menu_item_parent ] ) ) {
				$menu[ $item->menu_item_parent ]['children'][ $item->ID ] = array(
					'url'         => $item->url,
					'title'       => $item->title,
					'target'      => $item->target,
					'attr_title'  => $item->attr_title,
					'description' => $item->description,
					'classes'     => ( empty( $item->classes[0] ) ) ? '' : ' ' . implode( ' ', $item->classes ),
					'rel'         => $item->xfn,
				);
			} else {
				// If is a submenu, but nested three levels or above, skip.
				continue;
			}
		}

		return $menu;
	}

	/**
	 * Adds a new Twig function to use within templates.
	 */
	public function twig_menu_items( $twig ) {
		$twig->addExtension( new \Twig_Extension_StringLoader() );
		$twig->addFunction( new \Twig_SimpleFunction( 'menu_items', array( $this, 'organize_menu_items' ) ) );

		return $twig;
	}
}
