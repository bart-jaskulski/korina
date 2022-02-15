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
		add_action( 'widgets_init', [ $this, 'register_widget_area' ] );
	}

	public function register_nav_menus(): void {
		register_nav_menus(
			[
				'header-menu' => esc_html__( 'Primary', 'wojewodastudio' ),
				'social-menu' => esc_html__( 'Social Links', 'wojewodastudio' ),
				'footer'      => esc_html__( 'Footer menu', 'wojewodastudio' ),
				'shop-menu' => esc_html__('Shop menu', 'wojewodastudio'),
			]
		);
	}

	public function register_widget_area(): void {
		register_sidebar(
			[
				'name'           => esc_html__( 'Footer', 'wojewodastudio' ),
				'id'             => 'footer',
				'before_sidebar' => '',
				'after_sidebar'  => '',
				'before_widget'  => '',
				'after_widget'   => '',
				'before_title'   => '',
				'after_title'    => '',
			]
		);
		register_sidebar(
			[
				'name'           => esc_html__( 'Blog', 'wojewodastudio' ),
				'id'             => 'blog',
				'before_sidebar' => '',
				'after_sidebar'  => '',
				'before_widget'  => '',
				'after_widget'   => '',
				'before_title'   => '',
				'after_title'    => '',
			]
		);
		register_sidebar(
			[
				'name'           => esc_html__( 'Shop', 'wojewodastudio' ),
				'id'             => 'shop',
				'before_sidebar' => '',
				'after_sidebar'  => '',
				'before_widget'  => '',
				'after_widget'   => '',
				'before_title'   => '',
				'after_title'    => '',
			]
		);
		register_sidebar(
			[
				'name'           => esc_html__( 'Search', 'wojewodastudio' ),
				'id'             => 'search',
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
