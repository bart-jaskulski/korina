<?php
declare(strict_types=1);

namespace CleanWeb\Theme;

use CleanWeb\Component;

/**
* Register basic theme element as menu, sidebars etc.
*/
final class Elements implements Component {

	public function initialize(): void {
		add_action( 'after_setup_theme', [ $this, 'register_nav_menus' ] );
		add_action( 'widgets_init', [ $this, 'register_widgets' ] );
	}

	public function register_nav_menus(): void {
		register_nav_menus(
			[
				'header-menu' => 'Menu główne',
				'footer-menu' => 'Menu w stopce',
				'top-menu' => 'Menu górne',
			]
		);
	}

	public function register_widgets(): void {
		$this->register_widget_area( 'footer_contact', 'Stopka - Dane kontaktowe' );
		$this->register_widget_area( 'shop-sidebar', 'Sklep - Filtry' );
	}

	private function register_widget_area( string $id, string $name ): void {
		register_sidebar(
			[
				'name'           => $name,
				'id'             => $id,
				'before_sidebar' => '',
				'after_sidebar'  => '',
				'before_widget'  => '',
				'after_widget'   => '',
				'before_title'   => '',
				'after_title'    => '',
			]
		);
	}
}
