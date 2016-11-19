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
		add_filter( 'xavier/configs', function( $configs ) {

			$configs['menus'] = array(
				'header' => $this->organize_menu_items( 'header' ),
				'footer' => $this->organize_menu_items( 'footer' ),
			);

			return $configs;
		} );
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
					'id'          => ( 0 !== url_to_postid( $item->url ) ) ? url_to_postid( $item->url ) : false,
					'url'         => $item->url,
					'route'       => str_replace( home_url(), '', $item->url ),
					'title'       => $item->title,
					'target'      => $item->target,
					'attr_title'  => $item->attr_title,
					'description' => $item->description,
					'classes'     => ( empty( $item->classes[0] ) ) ? '' :  ' ' . implode( ' ', $item->classes ),
					'rel'         => $item->xfn,
					'children'    => false,
					'type'        => $item->object,
				);
			} elseif ( isset( $menu[ $item->menu_item_parent ] ) ) {
				$menu[ $item->menu_item_parent ]['children'][ $item->ID ] = array(
					'id'          => ( 0 !== url_to_postid( $item->url ) ) ? url_to_postid( $item->url ) : false,
					'url'         => $item->url,
					'route'       => str_replace( home_url(), '', $item->url ),
					'title'       => $item->title,
					'target'      => $item->target,
					'attr_title'  => $item->attr_title,
					'description' => $item->description,
					'classes'     => ( empty( $item->classes[0] ) ) ? '' : ' ' . implode( ' ', $item->classes ),
					'rel'         => $item->xfn,
					'type'        => $item->object,
				);
			} else {
				// If is a submenu, but nested three levels or above, skip.
				continue;
			}
		}

		return $menu;
	}
}
