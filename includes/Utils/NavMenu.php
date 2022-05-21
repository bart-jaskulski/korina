<?php declare( strict_types=1 );

namespace CleanWeb\Utils;

class NavMenu {

	/**
	 * Outputs WordPress nav menu without fallback.
	 *
	 * @param string $id
	 * @param array $args
	 *
	 * @return void
	 */
	public static function display_menu( string $id, array $args = [] ): void {
		wp_nav_menu(
			array_merge(
				[ 'theme_location' => $id, 'fallback_cb' => null ],
				$args
			)
		);
	}

}
